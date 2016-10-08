(function () {
    var $table = $('#datatable');

    $.ajax({
        url: '/api/tickets',
        type: 'GET',
        success: function (data) {
            data.forEach(function (row) {
                var $tr = createRow(row);
                $table.find('tbody').append($tr)
            });
        }
    });

    function createRow (row) {
        var $tr = $('<tr id="ticket-' + row.id +'">');
        $tr.append('<td>' + row.created + '</td>');
        $tr.append('<td>' + row.category_name + '</td>');
        $tr.append('<td>' + row.description + '</td>');
        $tr.append('<td>' + row.status + '</td>');
        $tr.append('<td data-ticket-id="' + row.id + '">' + createComments((row.comments).length) + '</td>');
        $tr.append('<td data-ticket-id="' + row.id + '">' + createAction(row.status) + '</td>');

        return $tr;
    }

    function createAction (status) {
        var button = '';

        if(status === 'canceled' || status === 'closed') {
            return '';
        }

        switch(status) {
            case 'waiting':
                button = prepareButton('start progress', 'btn-primary', 2);
                break;
            case 'in progress':
                button = prepareButton('resolved', 'btn-success', 3);
                break;
        }

        button += prepareButton('cancel', 'btn-danger', 4);
        return button
    }

    function createComments (comments) {
        var button = '';
        button += prepareButton(comments, 'btn-info', 4);
        return button
    }

    function prepareButton (text, className, statusId) {
        return '<button class="btn btn-round ' + className + '" data-status-id=' + statusId + '>' + text + '</button>';
    }

    function sendAction (ticketid, newStatus) {
        $.ajax({
            url: '/api/tickets/' + ticketid,
            type: 'PUT',
            data: {
                status: newStatus
            },
            statusCode: {
                202: function() { $.ajax({
                    url: '/api/tickets/' + ticketid,
                    type: 'GET',
                    success: function (row) {
                        var $ticketRow = $('#ticket-' + row.id);
                        var $newRow = createRow(row);

                        $ticketRow.replaceWith($newRow);
                    }
                }); }
            }
        });
    }

    $table.on('click', 'button', function (event) {
        var $target = $(event.currentTarget);
        var data = $target.data();
        var ticketData = $target.parent().data();

        sendAction(ticketData.ticketId, data.statusId);
    });
})();
