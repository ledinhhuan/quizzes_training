$(function () {
    function delay(callback, ms)
    {
        let time = 0;
        return function (...args) {
            clearTimeout(time);
            time = setTimeout(callback.bind(this, ...args), ms || 0);
        }
    }

    $('#search').keyup(delay(function (e) {
        e.preventDefault();
        let search = $('#search').val();
        let page = $('#page-hidden').val();
        if (search.length >= 0) {
            getTopics(page, search);
        }
    }, 500));

    $(document).on('click', '.pagination li a', function(e) {
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        $('#page-hidden').val(page);

        let search = $('#search').val();

        $('li .page-item').removeClass('active');
        $(this).parent().addClass('active');

        getTopics(page, search);
    });

    function getTopics(page, search)
    {
        $.ajax({
            url: '/admin/topics?page=' + page,
            data: {
                search: search,
            },
            type: 'GET',
            success: function (response) {
                $('#table-topic').html(response);
                statusChanged();
            },
            error: function (xhr, type) {
                alert('Server not responding...');
            }
        });
    }
});