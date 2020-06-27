$(function () {
    $('#search').keyup(function (e) {
        e.preventDefault();
        let search = $('#search').val();
        let page = $('#page-hidden').val();
        if (search.length >= 0) {
            getUsers(page, search);
        }
    });

    $(document).on('click', '.pagination li a', function(e){
        e.preventDefault();
        let page = $(this).attr('href').split('page=')[1];
        $('#page-hidden').val(page);

        let search = $('#search').val();

        $('li .page-item').removeClass('active');
        $(this).parent().addClass('active');

        getUsers(page, search);
    });

    function getUsers(page, search)
    {
        $.ajax({
            url: '/admin/users?page=' + page,
            data: {
                search: search,
            },
            type: 'get',
            success: function (response) {
                $('#table-user').html(response);
                statusChanged();
            },
            error: function (xhr, type) {
                alert('Server not responding...');
            }
        });
    }
});