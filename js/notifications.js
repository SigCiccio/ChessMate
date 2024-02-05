$(document).ready(function () {

    console.log("hello");

    $('.noti').on('click', function (e) {
        e.preventDefault();
        
        const notification = $(this).attr('notiId');
        console.log(notification);

        $.ajax({
            type: "POST",
            url: "notificationHandler.php",
            data: {
                'notification': notification,
            },
            dataType: "text",
            success: function (response) {
                console.log(response);
                $(`[divNotiId="${notification}"]`).addClass('hide');
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            } 
        });

    });

});