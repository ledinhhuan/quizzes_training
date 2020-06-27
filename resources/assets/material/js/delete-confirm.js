$(function () {
    $(".delete").on("click", function(e) {
        e.preventDefault();
        if (confirm("Are you sure?")) {
            $('#submit-delete').submit();
        }
    });
});
