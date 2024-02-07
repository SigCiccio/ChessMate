<?php

namespace GameViewer;

class Game
{

    private $board = "1. [rnbqkbnr/pppppppp/8/8/5P2/8/PPPPP1PP/RNBQKBNR] [rnbqkbnr/p1pppppp/1p6/8/5P2/8/PPPPP1PP/RNBQKBNR]";

    /* 

        input: 
            1. e4 e5
            2. Kf3 Kc6

    */

    public $gameState;

    public $closNumber = 8;

    public String $game =  "1. e4 e5 2. Kf3 Kc6";

    private function explodeBoard($board)
    {
        $state = explode("/", $board);

        $res = [
            "",
            "",
            "",
            "",
            "",
            "",
            "",
            "",
        ];

        $pos = 0;

        foreach($state as $s)
        {
            for($i = 0; $i < strlen($s); $i++)
            {
                switch(is_numeric($s[$i]))
                {
                    case true:
                        for($j = 0; $j < intval($s[$i]); $j++)
                        {
                            $res[$pos] = $res[$pos] . '.';
                        }
                        break;
                    case false:
                        $res[$pos] = $res[$pos] . $s[$i];
                }
            }
            $pos++;
        }
        return $res;
    }

    private function reassembleBoard($board)
    {
        $res = '';

        foreach($board as $row)
        {
            $local_count = 0;
            $isDot = false;
            for($i = 0; $i < strlen($row); $i++)
            {
                $column = $row[$i];

                if($column == '.')
                {
                    $isDot = true;
                    $local_count += 1;
                } 
                else 
                {
                    if($isDot)
                    {
                        $res = $res . $local_count;
                        $local_count = 0;
                        $isDot = false;
                    }
                    $res = $res . $column;
                }
            }
            if($isDot)
            {
                $res = $res . $local_count;
                $local_count = 0;
                $isDot = false;
            }
            $res = $res . '/';
        }

        return $res;

    }

    private function letterToNumber($l)
    {
        switch($l)
        {
            case 'a':
                return 0;
            case 'b':
                return 1;
            case 'c':
                return 2;
            case 'd':
                return 3;
            case 'e':
                return 4;
            case 'f':
                return 5;
            case 'g':
                return 6;
            case 'h':
                return 7;
        }
    }

    private function colomnToIndex($n)
    {
        switch($n)
        {
            case 1:
                return 7;
            case 2:
                return 6;
            case 3:
                return 5;
            case 4:
                return 4;
            case 5:
                return 3;
            case 6:
                return 2;
            case 7:
                return 1;
            case 8:
                return 0;
        } 
    }

    private function inIndex($r, $c, $len)
    {
        return ($r < $len && $c < $len && 0 <= $r && 0 <= $c);
    }

    private function extractDiag($row, $column)
    {
        $diag = [];

        $tempRow = $row; $tempColumn = $column;
        
        while($tempRow - 1 >= 0 && $tempColumn - 1 >= 0)
        {
            $tempRow--;
            $tempColumn--;
            $diag[] = [$tempRow, $tempColumn];
        }

        $tempRow = $row; $tempColumn = $column;

        while($tempRow + 1 <= 7 && $tempColumn + 1 <= 7)
        {
            $tempRow++;
            $tempColumn++;
            $diag[] = [$tempRow, $tempColumn];
        }

        $tempRow = $row; $tempColumn = $column;

        while($tempRow - 1 >= 0 && $tempColumn + 1 <= 7)
        {
            $tempRow--;
            $tempColumn++;
            $diag[] = [$tempRow, $tempColumn];
        }

        $tempRow = $row; $tempColumn = $column;

        while($tempRow + 1 <= 7 && $tempColumn - 1 >= 0)
        {
            $tempRow++;
            $tempColumn--;
            $diag[] = [$tempRow, $tempColumn];
        }

        $tempRow = $row; $tempColumn = $column;

        return $diag;        

    }

    private function pawnMove($player, $column, $row, $board, $isCapture = false, $from = 0)
    {
        if(!$isCapture)
        {
            if($player == 'w')
            {
                $board[$row][$column] = 'P';
                if($board[$row + 1][$column] == 'P')
                    $board[$row + 1][$column] = '.';
                else 
                    $board[$row + 2][$column] = '.';
                return $board;
            } 
            else
            {
                $board[$row][$column] = 'p';
                if($board[$row - 1][$column] == 'p')
                    $board[$row - 1][$column] = '.';
                else 
                    $board[$row - 2][$column] = '.';
                return $board;
            }
        }
        else 
        {
            if($player == 'w')
            {
                $board[$row + 1][$from] = '.';
                $board[$row][$column] = 'P';
                return $board;
            }
            
            $board[$row - 1][$from] = '.';
            $board[$row][$column] = 'p';
            return $board;
        }
    }

    private function RookMove($player, $column, $row, $board)
    {
        if($player == 'w')
        {
            $piece = 'R';
        }
        else 
        {
            $piece = "r";
        }

        for($i = $column + 1; $i < 8; $i++)
        {
            if($board[$row][$i] != $piece){
                if($board[$row][$i] != '.')
                    break;
            }
            else 
            {
                $board[$row][$i] = '.';
                return $board;
            }
            
        }
        for($i = $column - 1; $i >= 0; $i--)
        {
            if($board[$row][$i] != $piece){
                if($board[$row][$i] != '.')
                    break;
            }
            else 
            {
                $board[$row][$i] = '.';
                return $board;
            }
        }

        for($i = $row + 1; $i < 8; $i++)
        {
            if($board[$i][$column] != $piece){
                if($board[$i][$column] != '.')
                    break;
            }
            else 
            {
                $board[$i][$column] = '.';
                return $board;
            }
            
        }
        for($i = $row - 1; $i >= 0; $i--)
        {
            if($board[$i][$column] != $piece){
                if($board[$i][$column] != '.')
                    break;
            }
            else 
            {
                $board[$i][$column] = '.';
                return $board;
            }
        }
        return $board;

    }

    private function queen($player, $column, $row, $board)
    {
        if($player == 'w')
            $piece = 'Q';
        else
            $piece = 'q';

        for($i = 0; $i < 8; $i++)
        {
            for($j = 0; $j < 8; $j++)
            {
                if($i == $row && $j == $column){}
                else if($board[$i][$j] == $piece)
                {
                    $board[$i][$j] = '.';
                    return $board;
                }
            }
        }
        return $board;
    }

    private function king($player, $column, $row, $board)
    {
        if($player == 'w')
            $piece = 'K';
        else
            $piece = 'k';

        for($i = 0; $i < 8; $i++)
        {
            for($j = 0; $j < 8; $j++)
            {
                if($i == $row && $j == $column){}
                else if($board[$i][$j] == $piece)
                {
                    $board[$i][$j] = '.';
                    return $board;
                }
            }
        }
        return $board;
    }

    private function BishopMovement($player, $column, $row, $board)
    {
        if($player == 'w')
            $p = 'B';
        else
            $p = 'b';

        $diag = $this->extractDiag($row, $column);
        foreach($diag as $d)
        {
            if($board[$d[0]][$d[1]] == $p)
            {
                $board[$d[0]][$d[1]] = '.';
                break;
            }
        }
        return $board;
    }

    private function KnightMovement($player, $column, $row, $board)
    {
        $len = $this->closNumber;
        if($player == 'w')
            $p = 'N';
        else
            $p = 'n';   
        
        if($this->inIndex($row + 1, $column + 2, $this->closNumber) && $board[$row + 1][$column + 2] == $p)
        {
            $board[$row + 1][$column + 2] = '.';
        } 
        else if($this->inIndex($row + 1, $column - 2, $this->closNumber) && $board[$row + 1][$column - 2] == $p)
        {
            $board[$row + 1][$column - 2] = '.';
        }
        else if($this->inIndex($row - 1, $column + 2, $this->closNumber) && $board[$row - 1][$column + 2] == $p)
        {
            $board[$row - 1][$column + 2] = '.';
        } 
        else if($this->inIndex($row - 1, $column - 2, $this->closNumber) && $board[$row - 1][$column - 2] == $p)
        {
            $board[$row - 1][$column - 2] = '.';
        }
        else if($this->inIndex($row + 2, $column + 1, $this->closNumber) && $board[$row + 2][$column + 1] == $p)
        {
            $board[$row + 2][$column + 1] = '.';
        } 
        else if($this->inIndex($row + 2, $column - 1, $this->closNumber) && $board[$row + 2][$column - 1] == $p)
        {
            $board[$row + 2][$column - 1] = '.';
        }
        else if($this->inIndex($row - 2, $column + 1, $this->closNumber) && $board[$row - 2][$column + 1] == $p)
        {
            $board[$row - 2][$column + 1] = '.';
        } 
        else if($this->inIndex($row - 2, $column - 1, $this->closNumber) && $board[$row - 2][$column - 1] == $p)
        {
            $board[$row - 2][$column - 1] = '.';
        }

        return $board;
    }

    private function pieceMove($player, $piece, $column, $row, $board, $isCapture = false)
    {
        
        if($player == 'w')
        {
            $board[$row][$column] = strtoupper($piece);
            switch($piece)
            {
                case 'N':
                    return $this->KnightMovement($player, $column, $row, $board);
                case 'B':
                    return $this->BishopMovement($player, $column, $row, $board);
                case 'R':
                    return $this->RookMove($player, $column, $row, $board);
                case 'Q':
                    return $this->queen($player, $column, $row, $board);
                case 'K':
                    return $this->king($player, $column, $row, $board);

            }
            return $board;
        } 
        else
        {
            $board[$row][$column] = strtolower($piece);
            
            switch($piece)
            {
                case 'N':
                    return $this->KnightMovement($player, $column, $row, $board);
                case 'B':
                    return $this->BishopMovement($player, $column, $row, $board);
                case 'R':
                    return $this->RookMove($player, $column, $row, $board);
                case 'Q':
                    return $this->queen($player, $column, $row, $board);
                case 'K':
                    return $this->king($player, $column, $row, $board);

            }
            return $board;
        }
    }

    private function castleK($player, $board)
    {
        if($player == 'w')
        {
            $board[7][6] = 'K';
            $board[7][5] = 'R';
            $board[7][7] = '.';
            $board[7][4] = '.';
        }
        else 
        {
            $board[0][6] = 'k';
            $board[0][5] = 'r';
            $board[0][7] = '.';
            $board[0][4] = '.';
        }
        return $board;
    }

    private function castleQ($player, $board)
    {
        if($player == 'w')
        {
            $board[7][2] = 'K';
            $board[7][3] = 'R';
            $board[7][4] = '.';
            $board[7][0] = '.';
        }
        else 
        {
            $board[0][2] = 'k';
            $board[0][3] = 'r';
            $board[0][4] = '.';
            $board[0][0] = '.';
        }
        return $board;
    }

    private function pieceMoveConflict($player, $piece, $column, $row, $board, $from)
    {
        $notation = $piece;
        if($player != 'w')
            $notation = strtolower($piece);
        
        $board[$row][$column] = $notation;

        if(is_numeric($from))
        {
            $from = $this->colomnToIndex($from);
            switch($piece)
            {
                case 'R':
                    $board[$from][$column] = '.';
                    return $board;
                case 'N':
                    if($from - $row == 1 || $from - $row == -1)
                    {
                        if($this->inIndex($from, $column - 2, 8) && $board[$from][$column - 2] == $notation)
                            $board[$from][$column - 2] = '.';
                        else if($this->inIndex($from, $column + 2, 8) && $board[$from][$column + 2] == $notation)
                            $board[$from][$column + 2] = '.';
                        return $board;
                    }
                    else 
                    {
                        if($this->inIndex($from, $column + 1, 8) && $board[$from][$column + 1] == $notation)
                            $board[$from][$column + 1] = '.';
                        else if($this->inIndex($from, $column - 1, 8) && $board[$from][$column - 1] == $notation)
                            $board[$from][$column - 1] = '.';
                        return $board;
                    }
            }
        }
        else 
        {
            $from = $this->letterToNumber($from);
            switch($piece)
            {
                case 'R':
                    $board[$row][$from] = '.';
                    $board[$row][$column] = $notation;
                case 'N':
                    if($from - $column == 1 || $from - $column == -1)
                    {
                        if($this->inIndex($row - 2, $from, 8) && $board[$row - 2][$from] == $notation)
                            $board[$row - 2][$from] = '.';
                        else if($this->inIndex($row + 2, $from, 8) && $board[$row + 2][$from] == $notation)
                            $board[$row + 2][$from] = '.';
                        return $board;
                    }
                    else 
                    {
                        if($this->inIndex($row + 1, $from, 8) && $board[$row + 1][$from] == $notation)
                            $board[$row + 1][$from] = '.';
                        else if($this->inIndex($row - 1, $from, 8) && $board[$row - 1][$from] == $notation)
                            $board[$row - 1][$from] = '.';
                        return $board;
                    }
            }
        }
        return $board;
    }

    private function modifyBoard($player, $move, $board)
    {
        if(strlen($move) == 2)
        {
            $column = $this->letterToNumber($move[0]);
            $row = $this->colomnToIndex($move[1]); 
            return $this->pawnMove($player, $column, $row, $board); 
        }
        else if(strlen($move) == 3)
        {
            if($move == 'O-O')
            {
                return $this->castleK($player, $board);
            } 
            else if(ctype_lower($move[0]))
            {
                $column = $this->letterToNumber($move[0]);
                $row = $this->colomnToIndex($move[1]); 
                return $this->pawnMove($player, $column, $row, $board); 
            }
            else 
            {
                $piece = $move[0];
                $column = $this->letterToNumber($move[1]);
                $row = $this->colomnToIndex($move[2]); 
                return $this->pieceMove($player, $piece, $column, $row, $board);
            }
        }
        else if(strlen($move) == 4)
        {
            if(ctype_lower($move[0]))
            {
                $from =  $this->letterToNumber($move[0]);
                $column = $this->letterToNumber($move[2]);
                $row = $this->colomnToIndex($move[3]); 
                return $this->pawnMove($player, $column, $row, $board, true, $from); 
            }
            else if($move[3] == '+' || $move[3] == '#')
            {
                $piece = $move[0];
                $column = $this->letterToNumber($move[1]);
                $row = $this->colomnToIndex($move[2]); 
                return $this->pieceMove($player, $piece, $column, $row, $board);
            }
            else if($move[1] != 'x')
            {
                $piece = $move[0];
                $from = $move[1];
                $column = $this->letterToNumber($move[2]);
                $row = $this->colomnToIndex($move[3]); 
                return $this->pieceMoveConflict($player, $piece, $column, $row, $board, $from);
            }         
            else 
            {
                $piece = $move[0];
                $column = $this->letterToNumber($move[2]);
                $row = $this->colomnToIndex($move[3]); 
                return $this->pieceMove($player, $piece, $column, $row, $board);
            }
        }
        else if(strlen($move) == 5)
        {
            if($move == 'O-O-O')
                return $this->castleQ($player, $board);
            else if(ctype_lower($move[0]))
            {
                $from =  $this->letterToNumber($move[0]);
                $column = $this->letterToNumber($move[2]);
                $row = $this->colomnToIndex($move[3]); 
                return $this->pawnMove($player, $column, $row, $board, true, $from); 
            }
            else if($move[2] == 'x')
            {
                $piece = $move[0];
                $from = $move[1];
                $column = $this->letterToNumber($move[3]);
                $row = $this->colomnToIndex($move[4]); 
                return $this->pieceMoveConflict($player, $piece, $column, $row, $board, $from);
            }
            else if($move[4] == '+' || $move[4] == '#')
            {
                $piece = $move[0];
                $column = $this->letterToNumber($move[2]);
                $row = $this->colomnToIndex($move[3]); 
                return $this->pieceMove($player, $piece, $column, $row, $board);
            }
            
        }

        
        else if(strlen($move) == 7 || strlen($move) == 6)
        {
            return $board;
        }   

    }

    public function readMove($game)
    {

        $player = 'w';

        $gameState = "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR";

        $board = $this->explodeBoard($gameState);

        $move = explode(' ', $game);

        $isFirst = true;
        $count = 0;

        foreach($move as $m)
        {
            if($m[1] == '.' || (isset($m[2]) && $m[2] == '.'))
            {
                if($isFirst)
                {
                    $isFirst = false;
                }
                else
                {
                    echo '</ul></li>';
                }
                $player = 'w';
                echo '<li>' . $m . '<ul>';
            }
            else 
            {
                $board = $this->modifyBoard($player, $m, $board);

                echo "<li data-pos='" . $count . "' data-board='" . rtrim($this->reassembleBoard($board), '/') . "'>" . $m . "</li>";
                
                $player = 'b';
                $count++;
            }
        }

        echo '</ul></li>';

    }

    public function getFinalPosition($game)
    {
        $player = 'w';

        $gameState = "rnbqkbnr/pppppppp/8/8/8/8/PPPPPPPP/RNBQKBNR";

        $board = $this->explodeBoard($gameState);

        $move = explode(' ', $game);

        foreach($move as $m)
        {
            if($m[1] == '.' || (isset($m[2]) && $m[2] == '.'))
            {
                $player = 'w';
            }
            else 
            {
                $board = $this->modifyBoard($player, $m, $board);
                $player = 'b';
            }
        }

        return rtrim($this->reassembleBoard($board), '/');
    }
    
}