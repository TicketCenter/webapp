$(function() {
    bindFormButton();
});

function bindFormButton() {
    $('.dateofbirth-input').datepicker({
        format: 'dd-mm-yyyy'
    });

    $(".registration-form").unbind();
    $(".registration-form").bind('submit', function(event) {
        event.preventDefault();

        $('.error-message').addClass('hidden');
        if (checkEmail() && checkPassword()) {
            $.ajax({
                type: 'POST',
                url: '/handleRegistration',
                data: {
                    email: $('.email1-input').val(),
                    password: $('.password1-input').val(),
                    firstname: $('.firstname-input').val(),
                    lastname: $('.lastname-input').val(),
                    street: $('.street-input').val(),
                    housenumber: $('.housenumber-input').val(),
                    appendix: $('.appendix-input').val(),
                    postalcode: $('.postalcode-input').val(),
                    city: $('.city-input').val(),
                    country: $('.country-input').val(),
                    birthdate: $('.birthdate-input').val(),
                }
            }).done(function(data) {
                if (data.status = 200) {
                    window.location.href = baseurl + '/register/complete';
                }
            });
        } else {
            if (!checkEmail()) {
                $('.error-message').html("Email komt niet overeen!");
                $('.error-message').removeClass('hidden');
            } else if (!checkPassword()) {
                $('.error-message').html("Wachtwoord komt niet overeen!")
                $('.error-message').removeClass('hidden');
            }
        }
        return false;
    });
}

function checkEmail() {
    if ($('.email1-input').val() == $('.email2-input').val()) {
        return true;
    } else {
        return false;
    }
}

function checkPassword() {
    if ($('.password1-input').val() == $('.password2-input').val()) {
        return true;
    } else {
        return false;
    }
}
