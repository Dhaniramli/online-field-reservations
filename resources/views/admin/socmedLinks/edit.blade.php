<div class="modal fade" id="editTautanModal" tabindex="-1" aria-labelledby="editTautanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editTautanModalLabel">Tambah Tautan</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="edit-form-tautan" action="{{ route('update-tautan', ['id' => $item->id]) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="name" class="form-label">Sosial Media</label>
                        <select class="form-select @error('name') is-invalid @enderror" id="name" name="name" required disabled>
                            <option selected disabled>pilih</option>
                            <option value="Facebook" {{ old('name', $item->name) === 'Facebook' ? 'selected' : '' }}>Facebook</option>
                            <option value="Instagram" {{ old('name', $item->name) === 'Instagram' ? 'selected' : '' }}>Instagram</option>
                            <option value="Twitter" {{ old('name', $item->name) === 'Twitter' ? 'selected' : '' }}>Twitter</option>
                            <option value="Youtube" {{ old('name', $item->name) === 'Youtube' ? 'selected' : '' }}>Youtube</option>
                            <option value="Linkedin" {{ old('name', $item->name) === 'Linkedin' ? 'selected' : '' }}>Linkedin</option>
                        </select>
                    
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    

                    <div class="mb-3">
                        <label for="link" class="form-label">link</label>
                        <input type="text" class="form-control @error('link') is-invalid @enderror" id="link"
                            name="link" placeholder="" value="{{ old('link', $item->link) }}" required>
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