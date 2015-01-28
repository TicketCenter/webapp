$(function() {
    $('.owl-carousel').owlCarousel({
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        autoPlay: 3000
    });

    loadInterestingConcerts();
    loadInterestingArtists();
});

function loadInterestingConcerts() {
    $.ajax({
        method: 'GET',
        url: baseurl + '/concerts/interesting',
    }).done(function(data) {
        if (data.status == 200) {
            var html = $('.concerts').html();
            var toAppendHtml = '';
            for (concert in data['data']) {
                toAppendHtml = toAppendHtml + '<div class="list-item concert" data-id="' + data['data'][concert]['id'] + '"><img class="lazy" data-original="';
                if (data['data'][concert]['image'] != null) {
                    toAppendHtml = toAppendHtml + data['data'][concert]['image']['url'];
                }
                toAppendHtml = toAppendHtml + '" width="42" height="42">' + data['data'][concert]['title'] + ', ' + data['data'][concert]['city'] + ', ' + data['data'][concert]['country'] + '<br>Datum: ' + data['data'][concert]['start_time']['date'] + '</div>';
            }
            $('.concerts').html(html + toAppendHtml);
            $('img.lazy').lazyload();
            $('.interesting-concerts .loading-div').css('display', 'none');
            bindConcerts();
        };
    });
}

function loadInterestingArtists() {
    $.ajax({
        method: 'GET',
        url: baseurl + '/artists/interesting',
    }).done(function(data) {
        if (data.status == 200) {
            var html = $('.artists').html();
            var toAppendHtml = '';
            for (artist in data['data']) {
                toAppendHtml = toAppendHtml + '<div class="list-item artist" data-name="' + data['data'][artist]['name'] + '"><img class="lazy" data-original="' + data['data'][artist]['image']['url'] + '" width="42" height="42">' + data['data'][artist]['name'] + '</div>'
            }
            $('.artists').html(html + toAppendHtml);
            $('img.lazy').lazyload();
            $('.interesting-artists .loading-div').css('display', 'none');
            bindArtists();
        };
    });
}

function bindConcerts() {
    $('body').on('click', '.concert', function() {
        window.location.href = baseurl + '/concert/' + $(this).data('id');
    });;
}

function bindArtists() {
    $('body').on('click', '.artist', function() {
        window.location.href = baseurl + '/artist/' + $(this).data('name');
    });
}
