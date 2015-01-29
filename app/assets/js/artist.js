$(function() {
    concertsAjaxCall();
});

function concertsAjaxCall() {
    $.ajax({
        method: 'GET',
        url: baseurl + '/concerts/artist/' + $('.artist-details').data('name')
    }).done(function(data) {
        if (data.status == 200) {
            loadArtistConcert(data['data']);
        };
    });
}

function loadArtistConcert(data) {
    var html = '';
    for (var i = 0; i < 5; i++) {
        var concertDetails = data[i];
        var html = html + '<div class="concert" data-id="' + concertDetails['id'] + '">';
        if (concertDetails['image'] != null) {
            html = html + '<img class="lazy" data-original="' + concertDetails['image']['url'] + '" width="42" height="42">';
        } else {
            html = html + '<img class="lazy" data-original="" width="42" height="42">';
        }
        html = html + concertDetails['title'] + ', ' + concertDetails['city'] + ', ' + concertDetails['country'] + '<br>Datum: ' + concertDetails['start_time']['date'] + '</div>';
    }
    $('.concerts').html(html);
    $('img.lazy').lazyload();
    $('body').on('click', '.concert', function() {
        window.location.href = baseurl + '/concert/' + $(this).data('id');
    });
}
