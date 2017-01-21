var Urlaubsantrag = function () {

    function initTooltips() {
        $('[data-toggle="tooltip"]').tooltip();
    }

    function initApproveOrDisapprove() {
        var buttons = $('.approve-or-deny');
        if (buttons.size() > 0) {
            buttons.each(function () {
                var currentButton = $(this);
                currentButton.click(function (e) {
                    e.preventDefault();
                    var row = currentButton.closest('tr');
                    console.log(row);
                    $.ajax(
                        {
                            url: currentButton.attr('href'),
                            type: 'GET',
                            processData: false,
                            success: function () {
                                row.fadeTo('slow', 0.7, function(){
                                    console.log(123);
                                    row.remove();
                                });
                            },
                            error: function (xhr, ajaxOptions, thrownError) {
                                console.log(thrownError);
                            },
                            timeout: 5000
                        }
                    );
                });
            });
        }
    }

    return {
        init: function () {
            initTooltips();
            initApproveOrDisapprove();
        }
    }

}(jQuery);