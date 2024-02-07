<?php 
    require_once('GameViewer/Game.php');
    use GameViewer\Game;
    $g = new Game();
?>

<div class="posts">
    <?php foreach($templateParams['posts'] as $post): ?>
        <div class="post">
            <div class="post-data">
                <span class='username'><a href="index.php?view-profile=<?php echo $post->getAuthor() ?>"><?php echo $post->getAuthor() ?></a></span>
                <span class="time"><?php echo $post->getPublicationTime() ?></span>
                <span class="date"><?php echo $post->getPublicationDate() ?></span>
            </div>
            <div class="gameboard" data-position="<?php echo $g->getFinalPosition($post->getGame()) ?>">
            
            </div>
            <div class="title"><?php echo $post->getTitle() ?></div>
            <div class="option">
                <a href="index.php?view-post-comment=<?php echo $post->getId() ?>"><i class="fa-regular fa-comment" title="Commenti"></i></a>
                <a href="index.php?view-post-game=<?php echo $post->getId() ?>"><i class="fa-solid fa-chess-board" title="Visualizza"></i></a>
                <?php if($post->getAuthor() == $_SESSION['user']->getUsername()): ?>
                    <a href="delete.php?post=<?php echo $post->getId() ?>"><i class="fa-solid fa-trash" title='Elimina partita'></i></a>
                <?php endif ?>
                <span class='btn-updown'>
                    <span data-vote-of="<?php echo $post->getId() ?>" class="vote"><?php echo $post->getVote() ?></span>
                    <?php 
                        $uv;
                        foreach($templateParams['upvote'] as $up)
                        {
                            if($up['post'] == $post->getId())
                            {
                                $uv = $up;
                                break;
                            }
                        }
                    ?>
                    <?php if($uv['upvote']): ?>
                    <button class="btn-vote red" data-post-id="<?php echo $post->getId() ?>"><i class="fa-solid fa-arrow-down" title="Downvote"></i></button>
                    <?php else: ?>
                    <button class="btn-vote green" data-post-id="<?php echo $post->getId() ?>"><i class="fa-solid fa-arrow-up" title="Upvote"></i></button>
                    <?php endif ?>
                </span>
            </div>
        </div>
    <?php endforeach ?>

</div>