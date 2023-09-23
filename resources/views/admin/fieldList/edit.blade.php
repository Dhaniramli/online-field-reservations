<div class="modal fade" id="{{ 'edit'.$item->id }}" tabindex="-1" aria-labelledby="{{ 'edit'.$item->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="{{ 'edit'.$item->id }}Label">Edit Lapangan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="{{ 'formedit'.$item->id }}" action="{{ '/admin/daftar-lapangan/edit/'.$item->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lapangan</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" placeholder="contoh : Lapangan 1" value="{{ old('name', $item->name) }}">
                    </div>
                    <div class="mb-3 text-center">
                        <label for="time_price" class="form-label">Jam & Biaya Perjam</label>
                        @if ($itemTwo = $itemsTwo->where('field_list_id', $item->id))
                        @foreach ($itemTwo as $itemTwoo)

                        <!-- Input pertama -->
                        <div id="inputContainer">
                            <div class="row mb-2">
                                <div class="col">
                                    <input type="time" class="form-control" name="time[]" placeholder="Jam"
                                        value="{{ old('time', $itemTwoo->time) }}">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="price[]" placeholder="Harga"
                                        value="{{ old('price', $itemTwoo->price) }}">
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @else
                        Data tidak ditemukan.
                        @endif


                        <div class="container py-3 px-0 d-flex">
                            <button type="button" class="btn btn-success px-4 py-2 w-100" id="addInput"
                                onclick="tambahInput()">Tambah</button>
                        </div>
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

<script>
    function tambahInput() {
        // Tangkap elemen container untuk input
        var inputContainer = document.getElementById("inputContainer");

        // Buat elemen div untuk input baru
        var inputRow = document.createElement("div");
        inputRow.className = "row mb-2";

        // Buat elemen input untuk jam
        var timeInput = document.createElement("div");
        timeInput.className = "col";
        timeInput.innerHTML = '<input type="time" class="form-control" name="time[]" placeholder="Jam">';

        // Buat elemen input untuk harga
        var priceInput = document.createElement("div");
        priceInput.className = "col";
        priceInput.innerHTML = '<input type="number" class="form-control" name="price[]" placeholder="Harga">';

        // Gabungkan elemen-elemen input ke dalam div inputRow
        inputRow.appendChild(timeInput);
        inputRow.appendChild(priceInput);

        // Tambahkan div inputRow ke dalam inputContainer
        inputContainer.appendChild(inputRow);
    }
</script>
