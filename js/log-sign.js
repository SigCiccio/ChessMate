$(document).ready(function() 
{
    $('#sign').change(function () {
        if (this.checked) 
        {
            $('.login').addClass('hide');
            $('.signin').removeClass('hide');
            $('#submit').val('Registrati');
        }
        else 
        {
            $('.login').removeClass('hide');
            $('.signin').addClass('hide');
            $('#submit').val('Accedi');
        }    
    });
});