(function () {
    var $table = $('#datatable');

    $.ajax({
        url: '/api/tickets',
        type: 'GET',
        success: function (data) {
            data.forEach(createRow);
        }
    });

    function createRow (row) {
        var $tr = $('<tr>');
        $tr.append('<td>' + row.created + '</td>');
        $tr.append('<td>' + row.category_name + '</td>');
        $tr.append('<td>' + row.description + '</td>');
        $tr.append('<td>' + row.status + '</td>');
        $tr.append('<td>' + createAction(row.id, row.status) + '</td>');

        $table.find('tbody').append($tr);
        console.log(row);
    }

    function createAction (id, status) {
        var button = '';
        switch(status) {
            case 'waiting':
                button = '<button class="btn btn-round btn-primary" onClick="sendAction(id, 2)">start progress</button>';
                break;
            case 'in progress':
                button = '<button class="btn btn-round btn-success" onClick="sendAction(id, 2)">resolved</button>';
        }
        button += '<button class="btn btn-round btn-danger" onClick="sendAction(id, 2)">Cancel</button>';

        return button
    }

    function sendAction (id, type) {
        $.ajax({
            url: '/api/tickets',
            type: 'PUT',
            data: {

            },
            success: function (data) {
                console.log(data);
            }
        });
    }
})();
