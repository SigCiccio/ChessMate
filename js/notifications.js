$(document).ready(function () {

    console.log("hello");

    $('.noti').on('click', function (e) {
        e.preventDefault();
        
        const notification = $(this).attr('data-notiId');
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
                $(`[data-divNotiId="${notification}"]`).remove();
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) { 
                alert("Status: " + textStatus); alert("Error: " + errorThrown); 
            } 
        });

    });

});