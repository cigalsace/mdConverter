$(document).ready(function() {    
    var url = window.location.href;
    
    $('.hidden').hide();
    /*
    $('img.browsegraphic').on('click', function(event) {
        window.open($(this).attr('src'));
        return false;
    });
    $("img.browsegraphic").error(function(){
        $(this).hide();
    });
    $('.title a').on('click', function(event) {
        window.open($(this).attr('href'));
        return false;
    });
    */
    /*
    $("tr").hover(function() {
        $(this).toggleClass("ui-widget-header");
    });
    */
    /*
    $('.bt_select_items_per_page').on("change", function() {
        var url = $(this).children('option:selected').attr("rel");
        $(location).attr('href',url);
    });
    
    $( "input#search_text" ).keypress(function( event ) {
        if ( event.which == 13 ) {
            event.defaultPrevented;
            var search = $(this).val();
            $("form#search_form").attr('action', url);
            $("form#search_form").submit();
        }
    });
    */
    $('.bt_logs').on("click", function(event) {
        event.defaultPrevented;
        $("#logs").dialog({
            height: 'auto',
            width: '600px',
            modal: true,
            buttons: {
                'Quitter': function() {
                    $("div#logs").dialog('close');
                }
            }
        });
    });    
});