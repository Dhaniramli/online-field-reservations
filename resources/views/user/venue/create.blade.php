<div class="modal venue-create fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel">Booking</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/booking/store" method="POST" id="bookingForm">
                <div class="modal-body">
                    @csrf

                    @if (auth()->user())
                    <input type="hidden" name="user_name" value="{{ auth()->user()->first_name }}">
                    @endif
                    <div class="mb-3">
                        <table>
                            <tr>
                                <td class="title">Tanggal</td>
                                <td></td>
                                <td width="100%">
                                    <input type="date" name="date" class="form-control" id="date" placeholder="Tanggal"
                                        min="<?php echo date('Y-m-d'); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td class="title">Jam</td>
                                <td></td>
                                <td>
                                    <div class="dropdown">
                                        <input name="time" type="text" id="time" placeholder="pilih waktu"
                                            autocomplete="off">
                                        <ul class="dropdown-list" id="timeDropdown">
                                            @foreach ($playingTimes as $playingTime)
                                            <li>{{ $playingTime->id }}</li>
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
                                        <input name="field_name" type="text" id="field_name"
                                            placeholder="pilih lapangan" autocomplete="off">
                                        <ul class="dropdown-list" id="fieldSoccerDropdown">
                                            @foreach ($fieldLists as $fieldList)
                                            <li>Lapangan {{ $fieldList->id }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            {{-- <tr> --}}
                            {{-- <td class="title">Harga</td> --}}
                            {{-- <td></td> --}}
                            {{-- <td> --}}
                            <input type="hidden" name="price" class="form-control" id="price" placeholder="Harga"
                                value="0">
                            {{-- </td> --}}
                            {{-- </tr> --}}
                            <input type="hidden" name="id" class="form-control" id="id" value="0">

                        </table>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Lanjut</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- JAM --}}
<script>
    // Ambil elemen-elemen yang dibutuhkan
    var time = document.getElementById("time");
    var timeDropdown = document.getElementById("timeDropdown");
    var dropdownTimes = timeDropdown.getElementsByTagName("li");

    // Tambahkan event listener untuk setiap item di dropdown
    for (var i = 0; i < dropdownTimes.length; i++) {
        dropdownTimes[i].addEventListener("click", function () {
            time.value = this.innerText;
            timeDropdown.style.display = "none"; // Sembunyikan dropdown setelah dipilih
        });
    }

    // Tampilkan dropdown saat input di-focus
    time.addEventListener("focus", function () {
        timeDropdown.style.display = "block";
    });

    // Sembunyikan dropdown saat input kehilangan fokus
    time.addEventListener("blur", function () {
        // Gunakan setTimeout untuk memberikan waktu kepada pengguna untuk memilih dari dropdown sebelum menyembunyikannya
        setTimeout(function () {
            timeDropdown.style.display = "none";
        }, 200);
    });

</script>

{{-- LAPANGAN --}}
{{-- <script>
    // Ambil elemen-elemen yang dibutuhkan
    var field_name = document.getElementById("field_name");
    var fieldSoccerDropdown = document.getElementById("fieldSoccerDropdown");
    var dropdownItems = fieldSoccerDropdown.getElementsByTagName("li");

    // Tambahkan event listener untuk setiap item di dropdown
    for (var i = 0; i < dropdownItems.length; i++) {
        dropdownItems[i].addEventListener("click", function () {
            field_name.value = this.innerText;
            fieldSoccerDropdown.style.display = "none"; // Sembunyikan dropdown setelah dipilih
        });
    }

    // Tampilkan dropdown saat input di-focus
    field_name.addEventListener("focus", function () {
        fieldSoccerDropdown.style.display = "block";
    });

    // Sembunyikan dropdown saat input kehilangan fokus
    field_name.addEventListener("blur", function () {
        // Gunakan setTimeout untuk memberikan waktu kepada pengguna untuk memilih dari dropdown sebelum menyembunyikannya
        setTimeout(function () {
            fieldSoccerDropdown.style.display = "none";
        }, 200);
    });

</script> --}}

<script>
    // Ambil elemen-elemen yang dibutuhkan
    var field_name = document.getElementById("field_name");
    var fieldSoccerDropdown = document.getElementById("fieldSoccerDropdown");
    var dropdownItems = fieldSoccerDropdown.getElementsByTagName("li");

    // Tambahkan event listener untuk setiap item di dropdown
    for (var i = 0; i < dropdownItems.length; i++) {
        dropdownItems[i].addEventListener("click", function () {
            // Ambil teks dari elemen li yang dipilih
            var labelText = this.innerText;

            // Pisahkan teks berdasarkan spasi
            var parts = labelText.split(' ');

            // Ambil angka terakhir (di sini diasumsikan bahwa angka adalah elemen terakhir dalam teks)
            var selectedId = parts[parts.length - 1];

            // Setel nilai input dengan ID yang dipilih
            field_name.value = selectedId;

            // Sembunyikan dropdown setelah dipilih
            fieldSoccerDropdown.style.display = "none";
        });
    }

    // Tampilkan dropdown saat input di-focus
    field_name.addEventListener("focus", function () {
        fieldSoccerDropdown.style.display = "block";
    });

    // Sembunyikan dropdown saat input kehilangan fokus
    field_name.addEventListener("blur", function () {
        // Gunakan setTimeout untuk memberikan waktu kepada pengguna untuk memilih dari dropdown sebelum menyembunyikannya
        setTimeout(function () {
            fieldSoccerDropdown.style.display = "none";
        }, 200);
    });

</script>

{{-- BOOKING --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const bookingForm = document.querySelector('form[action="/booking/store"]');

        bookingForm.addEventListener('submit', function (event) {
            event.preventDefault(); // Mencegah perilaku bawaan pengiriman formulir

            // Cek apakah pengguna sudah login
            @auth
            const formData = new FormData(bookingForm);

            let validationPassed = true;

            for (const [name, value] of formData) {
                if (value.trim() === '') {
                    validationPassed = false;
                    break;
                }
            }

            if (!validationPassed) {
                // Tampilkan pesan kesalahan dalam alert jika ada input yang masih kosong
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Lengkapi semua kolom input sebelum melanjutkan!',
                });
                return; // Hentikan pengiriman jika validasi gagal
            }

            // Mengambil nilai field_name dan time dari formulir
            const fieldName = formData.get('field_name');
            const time = formData.get('time');
            const timeMatch = formData.get('time_match');

            // Mengirimkan permintaan AJAX ke server untuk mengambil harga
            fetch('/get-price', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({
                        field_name: fieldName,
                        time: time,
                        time_match: timeMatch,
                    }),
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Mendapatkan harga dari respons server
                        const price = data.price;

                        // Mengatur nilai input harga dengan harga yang diterima dari server
                        document.getElementById('price').value = price;

                        // Buat pesan konfirmasi yang mencantumkan data yang diisi, termasuk harga
                        const userName = formData.get('user_name');
                        const date = formData.get('date');
                        const parts = date.split('-');

                        // Menghapus angka 0 di depan bulan dan hari jika ada
                        const tahun = parts[0];
                        const bulan = parts[1].replace(/^0+/,
                        ''); // Menghapus angka 0 di depan bulan
                        const hari = parts[2].replace(/^0+/, ''); // Menghapus angka 0 di depan hari

                        // Menggabungkan kembali tahun, bulan, dan hari ke dalam format yang diinginkan
                        const tanggalHasil = tahun + bulan + hari;

                        // Menggabungkan tanggal dan waktu ke dalam satu string
                        const combinedValue = tanggalHasil + time;

                        // Mengisi nilai gabungan ke dalam elemen dengan id 'id'
                        document.getElementById('id').value = combinedValue;

                        const confirmationMessage = `
                        Tanggal : ${date}<br>
                        Jam : ${time}<br>
                        Durasi : ${timeMatch} Jam<br>
                        Lapangan : ${fieldName}<br>
                        Harga : ${price}<br><br>

                        Anda yakin ingin melanjutkan proses booking?
                    `;

                        Swal.fire({
                            title: 'Konfirmasi Booking',
                            html: confirmationMessage, // Menggunakan "html" untuk memungkinkan HTML di dalam pesan
                            icon: 'question',
                            showCancelButton: true,
                            confirmButtonText: 'Ya',
                            cancelButtonText: 'Tidak',
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Jika pengguna mengonfirmasi, lanjutkan dengan pengiriman formulir
                                bookingForm.submit();
                            }
                        });
                    } else {
                        // Tampilkan pesan kesalahan jika harga tidak dapat diambil
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Terjadi kesalahan dalam mengambil harga. Silakan coba lagi nanti!',
                        });
                    }
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                });
            @else
            // Tampilkan pesan kesalahan dalam alert jika pengguna belum login
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Anda harus login terlebih dahulu!',
            });
            @endauth
        });
    });

</script>
