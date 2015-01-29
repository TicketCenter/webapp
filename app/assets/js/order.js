$(function() {
    bindButtons();
});

function bindButtons() {
    $('.dateofbirth-input').datepicker({
        format: 'yyyy-mm-dd'
    });

    $('.btn-pay').on('click', function(){
		$.ajax({
            type: 'POST',
            url: '/handlePayment',
            data: {
            }
        }).done(function(data) {
        	console.log(data);
            if (data.status = 200) {
                // window.location.href = baseurl + '/order/succes';
            }
        });
    })

    $(".pay-without-login").unbind();
    $(".pay-without-login").bind('submit', function(event) {
        event.preventDefault();
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
                // window.location.href = baseurl + '/order/succes';
            }
        });

        return false;
    });
}
