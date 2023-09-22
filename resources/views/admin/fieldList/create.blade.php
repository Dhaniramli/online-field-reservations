<div class="modal fade" id="createFieldModal" tabindex="-1" aria-labelledby="createFieldModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="createFieldModalLabel">Tambah Lapangan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/admin/daftar-lapangan/create" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lapangan</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="contoh : Lapangan 1">
                    </div>
                    <div class="mb-3 text-center">
                        <label for="time_price" class="form-label">Jam & Biaya Perjam</label>
                        <div id="inputContainer">
                            <!-- Input pertama -->
                            <div class="row mb-2">
                                <div class="col">
                                    <input type="time" class="form-control" name="time[]" placeholder="Jam">
                                </div>
                                <div class="col">
                                    <input type="number" class="form-control" name="price[]" placeholder="Harga">
                                </div>
                            </div>
                        </div>
                        <div class="container py-3 px-0 d-flex">
                            <button type="button" class="btn btn-success px-4 py-2 w-100" id="addInput" onclick="tambahInput()">Tambah</button>
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

        // Tangkap elemen container untuk input
        var inputContainer = document.getElementById("inputContainer");

        // Tambahkan div inputRow ke dalam inputContainer
        inputContainer.appendChild(inputRow);
    }
</script>
