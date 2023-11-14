<div class="modal fade" id="{{ 'edit' . $item->id }}" tabindex="-1" aria-labelledby="{{ 'edit' . $item->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="{{ 'edit' . $item->id }}Label">Edit Lapangan</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="form-lapanganEdit" action="{{ route('update-lapangan', ['id' => $item->id]) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="modal-body">

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lapangan</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="contoh : Lapangan 1" value="{{ old('name', $item->name) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="body" class="form-label">Deskripsi Singkat</label>
                        <input type="text" class="form-control @error('body') is-invalid @enderror" id="body" name="body" placeholder="deskripsi singkat" value="{{ old('body', $item->body) }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="image" class="form-label">Gambar</label>
                        <input type="hidden" name="oldImage" value="{{ $item->image }}">
                        @if ($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                        @else
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        @endif
                        <input class="form-control" type="file" id="image" name="image" @error('image') is-invalid @enderror onchange="previewImage()">
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
    function previewImage() {
        const image = document.querySelector('#image');
        const imgPreview = document.querySelector('.img-preview');

        imgPreview.style.display = 'block';

        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);

        oFReader.onload = function (oFREvent) {
            imgPreview.src = oFREvent.target.result;
        }
    }

</script>