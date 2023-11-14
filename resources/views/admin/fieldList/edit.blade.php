<div class="modal fade" id="{{ 'edit' . $item->id }}" tabindex="-1" aria-labelledby="{{ 'edit' . $item->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="{{ 'edit' . $item->id }}Label">Edit Lapangan</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('update-lapangan', ['id' => $item->id]) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lapangan</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="contoh : Lapangan 1" value="{{ old('name', $item->name) }}" required>
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
