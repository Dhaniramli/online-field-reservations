<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
</script>

<!-- MDB -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.1/mdb.min.js"></script>

{{-- FLICKITY CAROUSEL --}}
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>

{{-- SWEETALERT --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- DATATABLES --}}
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js">

<!-- Custom scripts for all pages-->
<script src="js/sb-admin-2.min.js"></script>
<!-- Page level plugins -->
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<!-- Page level custom scripts -->
<script src="js/demo/datatables-demo.js"></script>

<script type="text/javascript">
    $(function () {
        // ALERT
        $(document).on('click', '#logoutButton', function (e) {
            e.preventDefault();

            var link = $(this).attr("href");

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Kamu akan keluar dari aplikasi ini!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Verifikasi!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                }
            })
        })

        // ALERT DELETE
        $(document).on('click', '#deleteButton', function (e) {
            e.preventDefault();

            var link = $(this).attr("href");

            Swal.fire({
                title: 'Apakah kamu yakin?',
                text: "Anda tidak akan dapat mengembalikannya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = link;
                    Swal.fire(
                        'Terhapus!',
                        'Data berhasil dihapus!',
                        'success'
                    )
                }
            })
        })

        // ALERT SUCCESS
        $(document).on('click', '#successAlert', function (e) {
            e.preventDefault();

            var link = $(this).attr("href");

            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
            })
        })
    })

</script>
