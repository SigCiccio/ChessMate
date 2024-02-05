$(document).ready(function () {
    $('#unfollow').click(function (e) { 
        e.preventDefault();
        const username = $(`[user-attr=username]`).text();
        $.ajax({
            type: "get",
            url: "follow-unfollow.php",
            data: {
                'username': username,
                'action': 'unfollow',
            },
            success: function (data) {
                console.log(data)
                const num = Number($('[user-attr=followers]').html());
                $('[user-attr=followers]').html(num - 1);
                $('#unfollow').addClass('hide');
                $('#follow').removeClass('hide');                
            }
        });
    });

    $('#follow').click(function (e) { 
        e.preventDefault();
        const username = $(`[user-attr=username]`).text();
        $.ajax({
            type: "get",
            url: "follow-unfollow.php",
            data: {
                'username': username,
                'action': 'follow',
            },
            success: function (data) {
                console.log(data)
                const num = Number($('[user-attr=followers]').html());
                $('[user-attr=followers]').html(num + 1);
                $('#unfollow').removeClass('hide');
                $('#follow').addClass('hide');                
            }
        });
    });
});