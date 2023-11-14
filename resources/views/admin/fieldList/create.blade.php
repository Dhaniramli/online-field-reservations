<div class="modal fade" id="tambahLapanganModal" tabindex="-1" aria-labelledby="tambahLapanganModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="tambahLapanganModalLabel">Tambah Lapangan</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-lapangan" action="{{ Route('store-lapangan') }}" method="POST" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lapangan</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="contoh : Lapangan 1" value="{{ old('name') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label">Deskripsi Singkat</label>
                        <input type="text" class="form-control @error('body') is-invalid @enderror" id="body"
                            name="body" placeholder="deskripsi singkat" value="{{ old('body') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        <input class="form-control" type="file" id="image" name="image" @error('image') is-invalid
                            @enderror onchange="previewImage()">
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="submitForm()">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        if (image.files && image.files[0]) {
            const oFReader = new FileReader();

            oFReader.onload = function (oFREvent) {
                imgPreview.style.display = 'block';
                imgPreview.src = oFREvent.target.result;
            };

            oFReader.readAsDataURL(image.files[0]);
        }
    }

    function submitForm() {
        var form = $('#form-lapangan');
        var isValid = form[0].checkValidity(); // Mengecek validitas form HTML5

        if (isValid) {
            $.ajax({
                type: form.attr('method'),
                url: form.attr('action'),
                data: new FormData(form[0]), // Menggunakan FormData untuk mengirim data termasuk file
                processData: false,
                contentType: false,
                success: function(response) {
                    // Tanggapan sukses, mungkin Anda ingin menangani sesuatu di sini
                    console.log(response);

                    // Tutup modal jika berhasil
                    $('#tambahLapanganModal').modal('hide');
                    location.reload();
                },
                error: function(response) {
                    // Tanggapan kesalahan, tampilkan pesan kesalahan
                    var errors = response.responseJSON.errors;
                    if (errors) {
                        var errorMessages = Object.values(errors).flat();
                        alert(errorMessages.join('\n'));
                    }
                }
            });
        } else {
            // Jika form tidak valid, fokuskan pada elemen yang tidak valid
            form.find(':invalid').first().focus();
            // Atau tampilkan pesan bahwa form tidak valid
            alert('Mohon lengkapi formulir dengan benar.');
        }
    }
</script>
