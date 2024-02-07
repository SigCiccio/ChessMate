$(document).ready(function () {
    
    $('.btn-vote').click(function (e) { 
        e.preventDefault();
        const post = $(this).attr('data-post-id');
        let action = 'remove';
        if($(this).html() == '<i class="fa-solid fa-arrow-up" title="Upvote"></i>')
        {
            action = 'add';
        }
        console.log(action)
        $.ajax({
            type: "post",
            url: "vote.php",
            data: {
                'post': post,
                'action': action
            },
            success: function (response) {
                console.log(response);
                let vote =  Number($(`[data-vote-of=${post}]`).html());
                if($(`[data-post-id=${post}]`).html() == '<i class="fa-solid fa-arrow-up" title="Upvote"></i>')
                    {
                        $(`[data-post-id=${post}]`).html('<i class="fa-solid fa-arrow-down" title="Downvote"></i>');
                        $(`[data-post-id=${post}]`).removeClass('green').addClass('red');
                        vote = vote + 1;
                    }
                else
                {
                    $(`[data-post-id=${post}]`).html('<i class="fa-solid fa-arrow-up" title="Upvote"></i>');
                    $(`[data-post-id=${post}]`).removeClass('red').addClass('green');
                    vote = vote - 1;
                }
                console.log($(`[data-vote-of=${post}]`).html())
                $(`[data-vote-of=${post}]`).html(vote)
            }
        });

    });

});