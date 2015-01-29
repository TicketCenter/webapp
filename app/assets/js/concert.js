$(function() {
    bindOrder();
});

function bindOrder() {
    $('body').on('click', '.btn-order', function() {
        order();
    });

    $(".quantity").keypress(function(e) {
        if (e.keyCode == 13) {
            order();
        }
    });
}

function order() {
    var price = $('.ticket-price').html();
    var quantity = $('.quantity').val();
    var concertId = $('.btn-order').data('concert-id');
    var concertTitle = $('.btn-order').data('concert-title');

    if (quantity > 0) {
        $.ajax({
            method: 'POST',
            url: baseurl + '/handleOrder',
            data: {
                ticket_price: price,
                ticket_quantity: quantity,
                ticket_concert_id: concertId,
                ticket_concert_title: concertTitle
            }
        }).done(function(data){
        	if(data['code'] == 200){

        		window.location.href = baseurl + '/order/';	
        	}
        });
    }

}
