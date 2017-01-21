var Urlaubsantrag = function () {

    function initTable() {
        var table = $('#vacation-request-table');
        $('#vacation-request-table tbody tr').remove();
        $.ajax({
            url: '/list',
            type: 'GET',
            success: function(data) {
                $.each(data, function(key, request) {
                    table.append(
                        '<tr>' +
                            '<td class="col-xs-8">' +
                                '<span data-toggle="tooltip" data-placement="top" title="TASK-ID: ' + request.task + '">' + request.employee + '</span>' +
                            '</td>' +
                            '<td class="col-xs-2">' +
                                '<a class="btn btn-success btn-block btn-xs approve-or-deny" href="/approve/' + request.task + '">' +
                                    '<span class="glyphicon glyphicon-thumbs-up"></span> GENEHMIGEN' +
                                '</a>' +
                            '</td>' +
                            '<td class="col-xs-2">' +
                                '<a class="btn btn-danger btn-block btn-xs approve-or-deny" href="/deny/' + request.task + '">' +
                                    '<span class="glyphicon glyphicon-thumbs-down"></span> ABLEHNEN' +
                                '</a>' +
                            '</td>' +
                        '</tr>'
                    );
                });
                initTooltips();
                initApproveOrDisapprove();
            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError);
            },
            timeout: 5000
        });
    }

    function initTooltips() {
        $('[data-toggle="tooltip"]').tooltip();
    }

    function initApproveOrDisapprove() {
        var buttons = $('.approve-or-deny');
        if (buttons.size() > 0) {
            buttons.each(function () {
                var currentButton = $(this);
                currentButton.click(function(e) {
                    e.preventDefault();
                    var row = currentButton.closest('tr');
                    $.ajax({
                        url: currentButton.attr('href'),
                        type: 'GET',
                        processData: false,
                        success: function() {
                            row.fadeTo('slow', 0.7, function(){
                                row.remove();
                            });
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            console.log(thrownError);
                        },
                        timeout: 5000
                    });
                });
            });
        }
    }

    function initCreateForm() {
        $('#vacation-request-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function() {
                    $('#name').val('');
                    initTable();
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                },
                timeout: 5000
            });
        });
        $('#create').on('shown.bs.modal', function () {
            $('#name').focus();
        })
    }

    return {
        init: function () {
            initTable();
            initCreateForm();
        }
    }

}(jQuery);