<div class="modal login-create fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="loginModalLabel">Login</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="loginForm" action="/login" method="POST">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <table>

                            <tr>
                                <td class="loginIni">Email</td>
                                <td></td>
                                <td width="100%">
                                    <input type="email" name="email"
                                        class="form-control" id="emailInput"
                                        placeholder="name@example.com" autofocus>
                                </td>
                            </tr>

                            <tr>
                                <td class="loginIni">Password</td>
                                <td></td>
                                <td width="100%">
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="password">
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Login</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{-- 
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loginForm = document.getElementById('loginForm');

        loginForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(loginForm);

            fetch('/login', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        $('#loginModal').modal('hide');
                    } else {
                        let errorMessages = '';

                        if (data.errors) {
                            errorMessages = Object.values(data.errors).join('\n');
                        } else if (data.message) {
                            errorMessages = data.message;
                        } else {
                            errorMessages = 'Login failed.';
                        }

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: errorMessages,
                        });
                    }
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                });
        });
    });

</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const loginForm = document.getElementById('loginForm');

        loginForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(loginForm);

            fetch('/login', {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Tutup modal
                    $('#loginModal').modal('hide');

                    // Me-refresh halaman
                    window.location.reload();

                    // Tampilkan pesan "Login berhasil"
                    Swal.fire({
                        icon: 'success',
                        title: 'Login Berhasil',
                    });
                } else {
                    let errorMessages = '';

                    if (data.errors) {
                        errorMessages = Object.values(data.errors).join('\n');
                    } else if (data.message) {
                        errorMessages = data.message;
                    } else {
                        errorMessages = 'Login failed.';
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: errorMessages,
                    });
                }
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });
        });
    });

</script>
