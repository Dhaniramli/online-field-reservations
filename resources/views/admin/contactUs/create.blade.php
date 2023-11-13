<div class="modal fade" id="tambahKontakModal" tabindex="-1" aria-labelledby="tambahKontakModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="tambahKontakModalLabel">Tambah</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ Route('store-contact') }}" method="POST">
                @csrf

                <input type="hidden" value="1" name="id">

                <div class="modal-body">
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address"
                            name="address" placeholder="alamat lengkap" value="{{ old('address') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone_number" class="form-label">Nomor Telpon</label>
                        <input type="number" class="form-control @error('phone_number') is-invalid @enderror"
                            id="phone_number" name="phone_number" placeholder="nomor telpon"
                            value="{{ old('phone_number') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" placeholder="email" value="{{ old('email') }}" required>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
