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
                                    <input type="date" name="date" class="form-control" id="date" placeholder="Tanggal" min="<?php echo date('Y-m-d'); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td class="title">Jam</td>
                                <td></td>
                                <td>
                                    <div class="dropdown">
                                        <input type="text" id="timeInput" placeholder="pilih waktu" autocomplete="off">
                                        <ul class="dropdown-list" id="timeDropdown">
                                            @foreach ($playingTimes as $playingTime)
                                            <li>{{ $playingTime->time }}</li>
                                            @endforeach
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
                                            @foreach ($fieldLists as $fieldList)
                                            <li>{{ $fieldList->name }}</li>
                                            @endforeach
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
