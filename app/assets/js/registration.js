$(function() {
    bindFormButton();
});

function bindFormButton() {
    $('.dateofbirth-input').datepicker({
        format: 'yyyy-mm-dd'
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
                    email_address: $('.email1-input').val(),
                    password: CryptoJS.SHA1($('.password1-input').val()).toString(),
                    first_name: $('.firstname-input').val(),
                    last_name: $('.lastname-input').val(),
                    street_name: $('.street-input').val(),
                    street_number: parseInt($('.housenumber-input').val()),
                    street_number_add: $('.appendix-input').val(),
                    postal_code: $('.postalcode-input').val(),
                    city: $('.city-input').val(),
                    country: $('.country-input').val(),
                    date_of_birth: $('.dateofbirth-input').val(),
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
