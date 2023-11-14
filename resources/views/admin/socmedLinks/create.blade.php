<div class="modal fade" id="tambahTautanModal" tabindex="-1" aria-labelledby="tambahTautanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="tambahTautanModalLabel">Tambah Tautan</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-tautan" action="{{ Route('store-tautan') }}" method="POST">
                <div class="modal-body">
                    @csrf

                    <script>
                        var validationErrors = @json($errors->all());
                    </script>

                    <div class="mb-3">
                        <label for="name" class="form-label">Sosial Media</label>
                        <select class="form-select @error('name') is-invalid @enderror" id="name" name="name" required>
                            <option selected disabled>pilih</option>
                            <option value="Facebook" {{ old('name') === 'Facebook' ? 'selected' : '' }}>Facebook</option>
                            <option value="Instagram" {{ old('name') === 'Instagram' ? 'selected' : '' }}>Instagram</option>
                            <option value="Twitter" {{ old('name') === 'Twitter' ? 'selected' : '' }}>Twitter</option>
                            <option value="Youtube" {{ old('name') === 'Youtube' ? 'selected' : '' }}>Youtube</option>
                            <option value="Linkedin" {{ old('name') === 'Linkedin' ? 'selected' : '' }}>Linkedin</option>
                        </select>
                    
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <div class="mb-3">
                        <label for="link" class="form-label">link</label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link"
                            name="link" placeholder="" value="{{ old('link') }}" required>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    {{-- <button type="submit" class="btn btn-success">Simpan</button> --}}
                    <button type="button" class="btn btn-success" onclick="submitForm()">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function submitForm() {
        var form = $('#form-tautan');

        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            success: function(response) {
                // Tanggapan sukses, mungkin Anda ingin menangani sesuatu di sini
                console.log(response);

                // Tutup modal jika berhasil
                $('#tambahTautanModal').modal('hide');
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
    }
</script>
