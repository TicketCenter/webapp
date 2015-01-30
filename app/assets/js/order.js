$(function() {
    bindButtons();
});

function bindButtons() {
    $('.dateofbirth-input').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('.product-overview .btn-pay').on('click', function() {
        $.ajax({
            type: 'POST',
            url: '/handlePayment',
            data: {}
        }).done(function(data) {
            if (data.status = 200) {
                window.location.href = baseurl + '/order/succes';
            }
        });
    })

    $(".pay-without-login").unbind();
    $(".pay-without-login").bind('submit', function(event) {
        event.preventDefault();
        if ($('.dateofbirth-input').val() != '' && $('.email-input').val() != '' && $('.name-input').val() != '') {
            $.ajax({
                type: 'POST',
                url: '/handlePayment',
                data: {
                    date_of_birth: $('.dateofbirth-input').val(),
                    email_address: $('.email-input').val(),
                    name: $('.name-input').val()
                }
            }).done(function(data) {
                console.log(data);
                if (data.status = 200) {
                    window.location.href = baseurl + '/order/succes';
                }
            });
        }

        return false;
    });
}
