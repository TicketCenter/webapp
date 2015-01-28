$(function() {
    $('img.lazy').lazyload();

    bindLoadMore();
    bindSearch();
    bindGetArtist();

});

function bindLoadMore() {
    $('body').on('click', '.load-more>button', function() {
        $(this).html('<img src="' + baseurl + '/img/ajax-loader.gif"/>');
        var modulo = $('.artist').length % 30;
        if (modulo == 0) {
            if ($('.search-box input').attr('value') != '') {
                var search = $('.search-box input').attr('value');
                var currentPage = $('.artist').length / 30;
                $.ajax({
                    method: 'GET',
                    url: baseurl + '/artists/search/' + search + '/page/' + (currentPage + 1),
                }).done(function(data) {
                    if (data.status == 200) {
                        var html = $('.artists').html();
                        var toAppendHtml = '';
                        for (artist in data['data']) {
                            toAppendHtml = toAppendHtml + '<div class="artist" data-name="' + data['data'][artist]['name']+ '"><img class="lazy" data-original="' + data['data'][artist]['image']['url'] + '" width="42" height="42">' + data['data'][artist]['name'] + '</div>'
                        }
                        $('.artists').html(html + toAppendHtml);
                        $('img.lazy').lazyload();
                        $('.load-more>button').html('Meer laden');
                    };
                });
            } else {
                var currentPage = $('.artist').length / 30;
                $.ajax({
                    method: 'GET',
                    url: baseurl + '/artists/page/' + (currentPage + 1),
                }).done(function(data) {
                    if (data.status == 200) {
                        var html = $('.artists').html();
                        var toAppendHtml = '';
                        for (artist in data['data']) {
                            toAppendHtml = toAppendHtml + '<div class="artist" data-name="' + data['data'][artist]['name']+ '"><img class="lazy" data-original="' + data['data'][artist]['image']['url'] + '" width="42" height="42">' + data['data'][artist]['name'] + '</div>'
                        }
                        $('.artists').html(html + toAppendHtml);
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
            searchArtist();
        }
    });
    $('body').on('click', '.search-box>button', function() {
        searchArtist();
    });
}

function searchArtist() {
    var search = $('.search-box input').val();
    if (search == "") {
        window.location.href = baseurl + '/artists/';
    } else {
        window.location.href = baseurl + '/artists/search/' + search;
    }

}

function bindGetArtist() {
    $('body').on('click', '.artist', function() {
        window.location.href = baseurl + '/artist/' + $(this).data('name');
    });
}
