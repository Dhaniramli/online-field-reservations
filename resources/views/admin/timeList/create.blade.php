<div class="modal fade" id="createTimeModal" tabindex="-1" aria-labelledby="createTimeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createTimeModalLabel">Tambah jam Main</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/jam-main/create" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="time" class="form-control" name="time" placeholder="Jam" autofocus>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>