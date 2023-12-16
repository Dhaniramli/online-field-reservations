<script>
    $(document).ready(function () {
        Swal.fire({
            position: 'center',
            icon: 'error',
            title: '{!! session('error') !!}',
        });
    });
</script>
