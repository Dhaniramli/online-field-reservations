<div class="modal fade" id="{{ 'edit' . $fieldSchedule->id }}" tabindex="-1" aria-labelledby="{{ 'edit' . $fieldSchedule->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="{{ 'edit' . $fieldSchedule->id }}Label">Tambah Jadwal</h3>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ Route('update-jadwalLapangan', ['id' => $fieldSchedule->id]) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('put')

                    <div class="mb-3">
                        <label for="date" class="form-label">Tanggal</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                            name="date" value="{{ old('date', $fieldSchedule->date) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="time_start" class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control @error('time_start') is-invalid @enderror" id="time_start"
                            name="time_start" value="{{ old('time_start', $fieldSchedule->time_start) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="time_finish" class="form-label">Jam Selesai</label>
                        <input type="time" class="form-control @error('time_finish') is-invalid @enderror" id="time_finish"
                            name="time_finish" value="{{ old('time_finish', $fieldSchedule->time_finish) }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Harga</label>
                        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price"
                            name="price" value="{{ old('price', $fieldSchedule->price) }}" required>
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