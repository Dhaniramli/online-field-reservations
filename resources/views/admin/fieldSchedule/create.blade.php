<div class="modal fade" id="tambahJadwalModal" tabindex="-1" aria-labelledby="tambahJadwalModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title ms-auto" id="tambahJadwalModalLabel">Tambah Jadwal</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ Route('store-jadwalLapangan') }}" method="POST">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="field_list_id" value="{{ $items->id }}">
                    <table id="jadwalTable" class="table">
                        <!-- Table header -->
                        <tr>
                            <td class="text-center">
                                <label for="date" class="form-label">Tanggal</label>
                            </td>
                            <td class="text-center">
                                <label for="time_start" class="form-label">Jam Mulai</label>
                            </td>
                            <td class="text-center">
                                <label for="time_finish" class="form-label">Jam Selesai</label>
                            </td>
                            <td class="text-center">
                                <label for="price" class="form-label">Harga</label>
                            </td>
                            <td class="text-center">
                                <label for="actions" class="form-label">Aksi</label>
                            </td>
                        </tr>
                        <!-- Default row -->
                        <tr id="defaultRow">
                            <td>
                                <input type="date" name="date[]" class="form-control" required>
                            </td>
                            <td>
                                <input type="time" name="time_start[]" class="form-control" required>
                            </td>
                            <td>
                                <input type="time" name="time_finish[]" class="form-control" required>
                            </td>
                            <td>
                                <input type="number" name="price[]" class="form-control" required>
                            </td>
                            <td></td>
                        </tr>
                        <!-- Table rows will be added dynamically -->
                    </table>
                    <button type="button" class="btn btn-primary" onclick="addRow()">Tambah</button>
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
    function addRow() {
        const table = document.getElementById('jadwalTable');
        const defaultRow = document.getElementById('defaultRow');
        const newRow = defaultRow.cloneNode(true);
        newRow.removeAttribute('id');
        newRow.querySelectorAll('input').forEach(input => {
            input.value = '';
        });
        const deleteButton = document.createElement('button');
        deleteButton.type = 'button';
        deleteButton.className = 'btn btn-danger';
        deleteButton.textContent = 'Hapus';
        deleteButton.onclick = function () {
            deleteRow(this);
        };
        newRow.querySelector('td:last-child').appendChild(deleteButton);
        table.appendChild(newRow);
    }

    function deleteRow(btn) {
        const row = btn.parentNode.parentNode;
        if (row.id !== 'defaultRow') {
            row.parentNode.removeChild(row);
        }
    }

</script>
