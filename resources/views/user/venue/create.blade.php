<div class="modal venue-create fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Booking</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <table>
                            <tr>
                                <td>Tanggal</td>
                                <td></td>
                                <td width="100%">
                                    <input type="date" name="date" class="form-control" id="date" placeholder="Tanggal">
                                </td>
                            </tr>
                            <tr>
                                <td>Jam</td>
                                <td></td>
                                <td>
                                    <select id="time" class="form-select" aria-label="Size 3 select example">
                                        <option value="00:00"> 00:00</option>
                                        <option value="01:00"> 01:00</option>
                                        <option value="02:00"> 02:00</option>
                                        <option value="03:00"> 03:00</option>
                                        <option value="04:00"> 04:00</option>
                                        <option value="05:00"> 05:00</option>
                                        <option value="06:00"> 06:00</option>
                                        <option value="07:00"> 07:00</option>
                                        <option value="08:00"> 08:00</option>
                                        <option value="09:00"> 09:00</option>
                                        <option value="10:00"> 10:00</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Durasi</td>
                                <td></td>
                                <td>
                                    <input type="number" name="time_match" class="form-control" id="time_match"
                                        placeholder="contoh: 1 (Jam)">
                                </td>
                            </tr>
                            <tr>
                                <td>Lapangan</td>
                                <td></td>
                                <td>
                                    <select id="soccer_field" class="form-select">
                                        <option value="" disabled selected>pilih lapangan</option>
                                        <option value="Lapangan 1"> Lapangan 1</option>
                                        <option value="Lapangan 2"> Lapangan 2</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>Harga</td>
                                <td></td>
                                <td>
                                    <input type="text" name="price" class="form-control" id="price" placeholder="Harga"
                                        disabled>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success">Lanjut</button>
            </div>
        </div>
    </div>
</div>
