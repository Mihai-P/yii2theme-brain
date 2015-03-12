/**
 * Created by mp on 5/12/14.
 */
(function($) {
    $(document).on('change', '[data-ajax-update]', function (e) {
        var element = $(this);
        console.log(element);
        jQuery.ajax({
            "type": "POST",
            "url": element.attr('data-ajax-update'),
            "cache": false,
            "data":{value: element.val()}
        }).success(function ( response ) {
            if(response.success) {
                eval(element.attr('data-success'));
            } else {
                //console.log(response.message);
                $.growl(
                    {
                        "title": "Error",
                        "message": response.message
                    }, {
                        "type":"danger",
                        template:
                        "<div id=\"w7\" class=\"alert col-xs-5 col-sm-5 col-md-3\">" +
                            "<button type=\"button\" class=\"close\" data-growl=\"dismiss\">" +
                                "<span aria-hidden=\"true\">&times;<\/span>" +
                            "<\/button>\n" +
                            "<span data-growl=\"icon\"><\/span>\n" +
                            "<h4 data-growl=\"title\"><\/h4>\n" +
                            "<span data-growl=\"message\"><\/span>\n" +
                        "<\/div>"
                    });
            }
        });
    });
})(jQuery);