<div class="modal register-create fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="registerModalLabel">Register</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/register" method="POST" id="registerForm">
                <div class="modal-body">
                    @csrf
                    <div class="mb-3">
                        <table>

                            <tr>
                                <td class="registerIni"><i class="fa fa-user" aria-hidden="true"></i></td>
                                <td></td>
                                <td width="100%">
                                    <input type="text" name="first_name" class="form-control" id="first_name"
                                        placeholder="Nama Depan">
                                    @error('first_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="registerIni"><i class="fa fa-user" aria-hidden="true"></i></td>
                                <td></td>
                                <td width="100%">
                                    <input type="text" name="last_name" class="form-control" id="last_name"
                                        placeholder="Nama Belakang">
                                    @error('last_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="registerIni"><i class="fa fa-phone" aria-hidden="true"></i></td>
                                <td></td>
                                <td width="100%">
                                    <input type="number" name="phone_number" class="form-control" id="phone_number"
                                        placeholder="Nomor HP">
                                    @error('phone_number')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td class="registerIni"><i class="fa fa-envelope" aria-hidden="true"></i></td>
                                <td></td>
                                <td width="100%">
                                    <input type="email" name="email" class="form-control" id="emailInput"
                                        placeholder="Email">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>

                            <tr>
                                <td class="registerIni"><i class="fa fa-unlock-alt" aria-hidden="true"></i></td>
                                <td></td>
                                <td width="100%">
                                    <input type="password" name="password" class="form-control" id="password"
                                        placeholder="Password">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>
                            <tr>
                                <td class="registerIni"><i class="fa fa-unlock-alt" aria-hidden="true"></i></td>
                                <td></td>
                                <td width="100%">
                                    <input type="password" name="password_confirm" class="form-control"
                                        id="password_confirm" placeholder="Konfirmasi Password">
                                    @error('password_confirm')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </td>
                            </tr>

                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const registerForm = document.getElementById('registerForm');

        registerForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah perilaku bawaan pengiriman formulir

            const formData = new FormData(registerForm);

            let validationPassed = true;

            for (const [name, value] of formData) {
                if (value.trim() === '') {
                    validationPassed = false;
                    break;
                }
            }

            const password = formData.get('password');
            const passwordConfirm = formData.get('password_confirm');
            if (password !== passwordConfirm) {
                validationPassed = false;
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Konfirmasi password tidak sesuai!',
                });
                return; // Hentikan pengiriman jika validasi gagal
            }

            if (!validationPassed) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Lengkapi data!',
                });
                return; // Hentikan pengiriman jika validasi gagal
            }


            fetch('/register', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {

                        // Menutup modal
                        $('#registerModal').modal('hide');

                        // Me-refresh halaman
                        window.location.reload();

                        Swal.fire({
                            icon: 'success',
                            title: 'Registrasi berhasil!',
                        })
                    } else {
                        if (data.errors) {
                            const errorMessages = Object.values(data.errors).join('\n');
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: errorMessages,
                            });
                        } else if (data.message) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: data.message,
                            });
                        }
                    }
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                });
        });
    });

</script>
