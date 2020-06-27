$(function () {
    let page = 2;
    $('#load-more').click(function () {
        $.ajax({
            url: '/topics',
            data: {
                page: page,
            },
            type: 'GET',
            success: function(data) {
                page = data.page + 1;
                $('#topics-data').append(data.html);
                if (data.hasMorePages === false) {
                    $('#load-more').remove();
                }
                console.log(data);
            },
            error: function (xhr, type) {
                alert('Server not responding...');
            }
        });
    });
});