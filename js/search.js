$(document).ready(function () {

    $('#btn-search').click(function (e) { 
        e.preventDefault();
        
        const username = $('input#username').val();
        $.ajax({
            type: "GET",
            url: "search.php",
            data: {
                username
            },
            dataType: "json",
            success: function (response) {
                $('.result').empty();
                response.forEach(element => {
                    const html = `<a href="index.php?view-profile=${element.username}"><div width="500px" class="user"> <div class="img"> <img width="100px" src="imgs/${element.url}" alt="immagine profilo di ${element.username}"></div>${element.username}</div></a>`
                    $('.result').append(html);
                });
                
            }
        });

    });

});