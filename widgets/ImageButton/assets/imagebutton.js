/**
 Imagebutton editable input.
 Internally value stored as {city: "Moscow", street: "Lenina", building: "15"}

 @class imagebutton
 @extends abstractinput
 @final
 @example
 <a href="#" id="imagebutton" data-type="imagebutton" data-pk="1">awesome</a>
 <script>
 $(function(){
    $('#imagebutton').editable({
        url: '/post',
        title: 'Enter city, street and building #',
        value: {
            image: "Moscow",
            link: "Lenina"
        }
    });
});
 </script>
 **/
(function ($) {
    "use strict";

    $(document).on('click', '.site-widget button.btn-success', function (e) {
        e.stopPropagation();
        e.preventDefault();
        var modal = $(this).closest('.site-widget');
        $("#" + modal.attr('data-target')).val(modal.find(':input, select').serialize());
        modal.find('button.btn-warning').trigger('click');
        var image = $("#" + modal.attr('data-target')).closest('div').find('img');
        image.attr('src', image.attr('data-sufix') + modal.find(':input[name="image"]').val());
    });
}(window.jQuery));