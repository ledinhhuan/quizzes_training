function setFormValidation(id) {
    $(id).validate({
        errorPlacement: function(error, element) {
            $(element).closest('div').addClass('has-error');
        }
    });
}

$(document).ready(function() {
    setFormValidation('#createTopic');
});