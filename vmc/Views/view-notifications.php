<section class="notifications">
    <?php if(count($templateParams['notifications']) == 0 ): ?>
        Nessuna notifica
    <?php else: ?>
        <?php foreach($templateParams['notifications'] as $noti):  ?>
            <a href="<?php
                if($noti->getComment() == NULL)
                {
                    if($noti->getPost() == NULL)
                        echo "index.php?view-profile=" . $noti->getAuthor();
                    else 
                        echo "index.php?view-post-game=" . $noti->getPost();
                }
                else
                    echo "index.php?view-post-comment=" . $templateParams['comment-controller']->getPostId($noti->getComment());
            ?>">
            
                <div class="notification" divNotiId='<?php echo $noti->getId() ?>'>
                    <button class='noti' notiId='<?php echo $noti->getId() ?>'>X</button>
                    <?php echo $noti->getAuthor(); ?> 
                    <?php   
                        if($noti->getComment() != NULL) echo "ha commentato il tuo post"; 
                        else if($noti->getPost() != NULL) echo "ha reagito al tuo post"; 
                        else echo "ha iniziato a seguirti";
                    ?>
                </div>
            </a>
        <?php endforeach; ?>
    <?php endif ?>
</section>
