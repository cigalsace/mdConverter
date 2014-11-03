$(document).ready(function() {
    $('#unprintable').hide();
    $('h2').hide();
    $("#tabs").tabs();
    var url = window.location.href;
    $('span#md_file_url').text(url);
    $('#browsegraphic img').each(function(index) {
    var max = 200;
    var w0 = $(this).width();
    var h0 = $(this).height();
    h1 = h0;        w1 = w0;
    if ((h0 >= w0) && (h0 > max)) {
    h1 = max;
    w1 = ((max * w1) / h0);
    } else if ((w0 >= h0) && (w0 > max)) {
    w1 = max;
    h1 = ((max * h1) / w0);
    }        $(this).width(w1);        $(this).height(h1);    });    $('#browsegraphic img').on('click', function() {        window.open($(this).attr('src'));        return false;    });    $('div#printable').on("click", function(event){        $('h2').show();        $('#page').width('800px');        $("#tabs").tabs("destroy");        $("#tabs-list").hide();        $('#printable').hide();        $('#unprintable').show();    });        $('div#unprintable').on("click", function(event){        $('h2').hide();        $('#page').width('90%');        $("#tabs").tabs();        $("#tabs-list").show();        $('#printable').show();        $('#unprintable').hide();    });    });