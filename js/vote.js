$(document).ready(function () {
    
    $('.btn-vote').click(function (e) { 
        e.preventDefault();
        const post = $(this).attr('post-id');
        let action = 'remove';
        if($(this).html() == 'Upvote')
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
                let vote =  Number($(`[vote-of=${post}]`).html());
                if($(`[post-id=${post}]`).html() == 'Upvote')
                    {
                        $(`[post-id=${post}]`).html('Downvote');
                        vote = vote + 1;
                    }
                else
                {
                    $(`[post-id=${post}]`).html('Upvote');
                    vote = vote - 1;
                }
                $(`[vote-of=${post}]`).html(vote)
            }
        });

    });

});