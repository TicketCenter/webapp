$(function() {
    $('img.lazy').lazyload();
    bindGetConcerts();
    bindLoadMore();
    bindSearch();
});

function bindGetConcerts() {
    $('body').on('click', '.concert', function() {
        window.location.href = baseurl + '/concert/' + $(this).data('id');
    });
}


function bindLoadMore() {
    $('body').on('click', '.load-more>button', function() {
        $(this).html('<img src="' + baseurl + '/img/ajax-loader.gif"/>');
        var modulo = $('.concert').length % 30;
        if (modulo == 0) {
            if ($('.search-box input').attr('value') != '') {
                var search = $('.search-box input').attr('value');
                var currentPage = $('.concert').length / 30;
                $.ajax({
                    method: 'GET',
                    url: baseurl + '/concerts/search/' + search + '/page/' + (currentPage + 1),
                }).done(function(data) {
                    if (data.status == 200) {
                        var html = $('.concerts').html();
                        var toAppendHtml = '';
                        for (concert in data['data']) {
                        	toAppendHtml = toAppendHtml + '<div class="concert" data-id="' + data['data'][concert]['id'] + '"><img class="lazy" data-original="';
                            if (data['data'][concert]['image'] != null) {
                                toAppendHtml = toAppendHtml + data['data'][concert]['image']['url'];
                            }
                            toAppendHtml = toAppendHtml + '" width="42" height="42">' + data['data'][concert]['title'] + ', ' + data['data'][concert]['city'] + ', ' + data['data'][concert]['country'] + '<br>Datum: ' + data['data'][concert]['start_time']['date'] + '</div>';
                        }
                        $('.concerts').html(html + toAppendHtml);
                        $('img.lazy').lazyload();
                        $('.load-more>button').html('Meer laden');
                    };
                });
            } else {
                var currentPage = $('.concert').length / 30;
                $.ajax({
                    method: 'GET',
                    url: baseurl + '/concerts/page/' + (currentPage + 1),
                }).done(function(data) {
                    if (data.status == 200) {
                        var html = $('.concerts').html();
                        var toAppendHtml = '';
                        for (concert in data['data']) {
                            toAppendHtml = toAppendHtml + '<div class="concert" data-id="' + data['data'][concert]['id'] + '"><img class="lazy" data-original="';
                            if (data['data'][concert]['image'] != null) {
                                toAppendHtml = toAppendHtml + data['data'][concert]['image']['url'];
                            }
                            toAppendHtml = toAppendHtml + '" width="42" height="42">' + data['data'][concert]['title'] + ', ' + data['data'][concert]['city'] + ', ' + data['data'][concert]['country'] + '<br>Datum: ' + data['data'][concert]['start_time']['date'] + '</div>';
                        }
                        $('.concerts').html(html + toAppendHtml);
                        $('img.lazy').lazyload();
                        $('.load-more>button').html('Meer laden');
                    };
                });
            };
        } else {
            setTimeout(function() {
                $('.load-more>button').html('Geen resultaten meer.');
            }, 1000);

        }

    });
}

function bindSearch() {
    $(".search-box input").keypress(function(e) {
        if (e.keyCode == 13) {
            searchConcert();
        }
    });
    $('body').on('click', '.search-box>button', function() {
        searchConcert();
    });
}

function searchConcert() {
    var search = $('.search-box input').val();
    if (search == "") {
        window.location.href = baseurl + '/concerts/';
    } else {
        window.location.href = baseurl + '/concerts/search/' + search;
    }

}
