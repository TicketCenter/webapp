$(function() {
    bindFormButton();
});

function bindFormButton() {
    $('.login-form').submit(function(e) {
        console.log($('.email-input').val());
        $.ajax({
            type: 'POST',
            url: '/handleLogin',
            data: {
                email: $('.email-login-input').val(),
                password: CryptoJS.SHA1($('.password-input').val()).toString(),
            }
        }).done(function(data) {
            console.log(data);
            if (data.code == 200) {
                $('.error').hide();
                window.location.href = baseurl + data['url'];
            } else {
                $('.error').show();
            }
        });
        return false;
    });
}
