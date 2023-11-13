<script>
    $(document).ready(function () {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: '{!! session('success') !!}',
            showConfirmButton: false,
            timer: 1000
        });
    });
</script>
