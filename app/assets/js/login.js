$(function() {
    bindFormButton();
});

function bindFormButton() {
    $('.login-form').submit(function(e) {
        $.ajax({
            type: 'POST',
            url: '/handleLogin',
            data: {
                email: $('.email-input').val(),
                password: $('.password-input').val()
            }
        }).done(function(data) {
            if (data.status = 200) {
                window.location.href = baseurl;
            }
        });
        return false;
    });
}
