<script src="{{ asset('assets/js/jquery-3.2.1.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/material.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/jasny-bootstrap.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/jquery.validate.min.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/jquery.tagsinput.js') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/material-dashboard.js?v=1.2.1') }}" type="text/javascript"></script>
<script src="{{ asset('assets/js/toastr.min.js') }}" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        if (localStorage.minutes != null && localStorage.seconds != null) {
            localStorage.removeItem('minutes');
            localStorage.removeItem('seconds');
            localStorage.removeItem('selected');
        }
    });
</script>
