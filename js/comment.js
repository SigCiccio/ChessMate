$(document).ready(function () {
    
    $('#submit').click(function (e) { 
        e.preventDefault();
        const comment = $('input#new-comment').val();
        const username = $('input#new-comment').attr('user');
        const post = $('input#new-comment').attr('post');
        $('input#new-comment').val("");
        $.ajax({
            type: "POST",
            url: "new-comment.php",
            data: {
                'user': username,
                'post-id': post,
                'new-comment': comment,
            },
            dataType: "json",
            success: function (response) {
                $('#comments-list').prepend(` \
                <div class='comment'> \
                    <div class='data'> \
                        ${response.author} ${response.publication_date} ${response.publication_time}  \
                        <button class='my-comment' commentId='${response.id}'>X</button> \
                    </div> \
                    <div class='content'> \
                        ${response.text} \
                    </div> \ 
                </div> \
                `); 
            }
        });
    });

    $(document).on('click', '.my-comment', function (e) { 
        e.preventDefault();
        const comment = $(this).attr('commentId');
        $.ajax({
            type: "POST",
            url: "new-comment.php?remove",
            data: {
                comment
            },
            dataType: "text",
            success: function () {
                $(`[commentId=${comment}]`).parent().parent().remove();
            }
        });
    });

});