<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

<div class="modal fade" id="editHowToorderModal" tabindex="-1" aria-labelledby="editHowToorderModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="editHowToorderModalLabel">Edit</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ Route('update-howToorder') }}" method="POST">
                @csrf
                @method('put')

                <input type="hidden" value="1" name="id">

                <div class="modal-body">
                    <div class="mb-3">
                        <textarea id="ckEditor" name="body">{{ $item ? $item->body : '' }}</textarea>
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

<script>
    ClassicEditor
        .create( document.querySelector( '#ckEditor' ) )
        .catch( error => {
            console.error( error );
        });
</script>

