/* global ajax_object */
jQuery(document).ready(function ($) {
    //Search Ajax Request
    if ($('body').hasClass('page-template-templates-home')) {
        $(document).on('click', '.js-ajax-request', function (e) {
            e.preventDefault();
            let thisObj = $(this),
                inputValue = $('input#inputSearch').val(),
                pageNumber = 1;

            if (thisObj.hasClass('js-page-link')) {
                pageNumber = thisObj.data('page');
            } else {
                pageNumber = 1;
            }

                if (inputValue != '' || thisObj.hasClass('js-page-link')) {
                if (thisObj.data('requestRunning')) {return;}
                thisObj.data('requestRunning', true);

                let data = {
                    action: 'search_request',
                    nonce: ajax_object.nonce,
                    search_string: inputValue,
                    posts_per_page: ajax_object.posts_per_page,
                    page_number: pageNumber
                };
                $.ajax({
                    url: ajax_object.ajax_url,
                    type: 'POST',
                    data: data,
                    beforeSend: function () {
                        thisObj.addClass('loading');
                    },
                    success: function (resp) {
                        thisObj.removeClass('loading');
                        if (resp.content) {
                            $('.js-property-box').html(resp.content);
                        }
                    },
                    complete: function () {
                        thisObj.data('requestRunning', false);
                    },
                    error: function (err) {
                        console.log(err);
                    },
                });
            }
        });
    }
    //End of Search Ajax Request
});