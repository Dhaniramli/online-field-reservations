<div class="modal venue-create fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">Booking</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <table>
                            <tr>
                                <td class="title">Tanggal</td>
                                <td></td>
                                <td width="100%">
                                    <input type="date" name="date" class="form-control" id="date" placeholder="Tanggal">
                                </td>
                            </tr>
                            <tr>
                                <td class="title">Jam</td>
                                <td></td>
                                <td>
                                    <div class="dropdown">
                                        <input type="text" id="timeInput" placeholder="pilih waktu" autocomplete="off">
                                        <ul class="dropdown-list" id="timeDropdown">
                                            <li>00:00</li>
                                            <li>01:00</li>
                                            <li>02:00</li>
                                            <li>03:00</li>
                                            <li>04:00</li>
                                            <li>05:00</li>
                                            <li>06:00</li>
                                            <li>07:00</li>
                                            <li>08:00</li>
                                            <li>09:00</li>
                                            <li>10:00</li>
                                            <li>11:00</li>
                                            <li>12:00</li>
                                            <li>13:00</li>
                                            <li>14:00</li>
                                            <li>15:00</li>
                                            <li>16:00</li>
                                            <li>17:00</li>
                                            <li>18:00</li>
                                            <li>19:00</li>
                                            <li>20:00</li>
                                            <li>21:00</li>
                                            <li>22:00</li>
                                            <li>23:00</li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="title">Durasi</td>
                                <td></td>
                                <td>
                                    <input type="number" name="time_match" class="form-control" id="time_match"
                                        placeholder="contoh: 1 (Jam)">
                                </td>
                            </tr>
                            <tr>
                                <td class="title">Lapangan</td>
                                <td></td>
                                <td>
                                    <div class="dropdown">
                                        <input type="text" id="fieldSoccerInput" placeholder="pilih lapangan" autocomplete="off">
                                        <ul class="dropdown-list" id="fieldSoccerDropdown">
                                            <li>Lapangan 1</li>
                                            <li>Lapangan 2</li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td class="title">Harga</td>
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

{{-- JAM --}}
<script>
    // Ambil elemen-elemen yang dibutuhkan
    var timeInput = document.getElementById("timeInput");
    var timeDropdown = document.getElementById("timeDropdown");
    var dropdownItems = timeDropdown.getElementsByTagName("li");

    // Tambahkan event listener untuk setiap item di dropdown
    for (var i = 0; i < dropdownItems.length; i++) {
        dropdownItems[i].addEventListener("click", function () {
            timeInput.value = this.innerText;
            timeDropdown.style.display = "none"; // Sembunyikan dropdown setelah dipilih
        });
    }

    // Tampilkan dropdown saat input di-focus
    timeInput.addEventListener("focus", function () {
        timeDropdown.style.display = "block";
    });

    // Sembunyikan dropdown saat input kehilangan fokus
    timeInput.addEventListener("blur", function () {
        // Gunakan setTimeout untuk memberikan waktu kepada pengguna untuk memilih dari dropdown sebelum menyembunyikannya
        setTimeout(function () {
            timeDropdown.style.display = "none";
        }, 200);
    });

</script>

{{-- LAPANGAN --}}
<script>
    // Ambil elemen-elemen yang dibutuhkan
    var fieldSoccerInput = document.getElementById("fieldSoccerInput");
    var fieldSoccerDropdown = document.getElementById("fieldSoccerDropdown");
    var dropdownItems = fieldSoccerDropdown.getElementsByTagName("li");

    // Tambahkan event listener untuk setiap item di dropdown
    for (var i = 0; i < dropdownItems.length; i++) {
        dropdownItems[i].addEventListener("click", function () {
            fieldSoccerInput.value = this.innerText;
            fieldSoccerDropdown.style.display = "none"; // Sembunyikan dropdown setelah dipilih
        });
    }

    // Tampilkan dropdown saat input di-focus
    fieldSoccerInput.addEventListener("focus", function () {
        fieldSoccerDropdown.style.display = "block";
    });

    // Sembunyikan dropdown saat input kehilangan fokus
    fieldSoccerInput.addEventListener("blur", function () {
        // Gunakan setTimeout untuk memberikan waktu kepada pengguna untuk memilih dari dropdown sebelum menyembunyikannya
        setTimeout(function () {
            fieldSoccerDropdown.style.display = "none";
        }, 200);
    });

</script>
