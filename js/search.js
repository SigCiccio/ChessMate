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
                    const html = `<a href="index.php?view-profile=${element.username}"><div class="user"> <div class="img"> <img src="imgs/${element.url}" alt="immagine profilo di ${element.username}"></div><div class='username'>${element.username}</div></div></a>`
                    $('.result').append(html);
                });
                
            }
        });

    });

});