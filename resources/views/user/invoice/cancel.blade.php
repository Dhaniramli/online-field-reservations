<!-- Modal -->
<div class="modal fade" id="cancelModal{{ $item->id }}" tabindex="-1" aria-labelledby="cancelModal{{ $item->id }}Label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="cancelModal{{ $item->id }}Label">Pembatalan Booking</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="cancelForm{{ $item->id }}" action="/cancel/{{ $item->id }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <input type="text" class="form-control" id="bank_name" name="bank_name"
                            placeholder="Bank/E-Wallet">
                    </div>
                    <div class="mb-3">
                        <input type="text" class="form-control" id="account_number" name="account_number"
                            placeholder="Nomor Rekening/Nomor E-Wallet">
                    </div>
                    <div class="mb-3">
                        <textarea class="form-control" id="reason" name="reason"
                            placeholder="Alasan Pembatalan"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-success" onclick="submitForm({{ $item->id }})">Kirim</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function submitForm(itemId) {
        var form = document.getElementById('cancelForm' + itemId);
        var formData = new FormData(form);

        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {

                // Close the modal
                $('#cancelModal' + itemId).modal('hide');
                // alert(data.message);
                Swal.fire({
                        title: "Sukses!!!",
                        text: data.message,
                        icon: "success"
                });
                location.reload();
            } else if (data.done && data.done.common) {
                // Jika ada kondisi spesifik 'done' (atau kondisi lain yang sesuai)
                var doneMessage = data.done.common.join('\n');
                // alert(doneMessage);
                Swal.fire({
                        title: "Sukses!!!",
                        text: doneMessage,
                        icon: "success"
                });
                location.reload();
            } else if (data.errors && data.errors.common) {
                // Jika terjadi kesalahan umum (common errors)
                var errorMessage = data.errors.common.join('\n');
                // alert(errorMessage);
                Swal.fire({
                        title: "Eitss!!!",
                        text: errorMessage,
                        icon: "error"
                });
            } else {
                // Kondisi lainnya, misalnya jika ada kesalahan yang tidak dapat diatasi di sisi klien
                // alert('Terjadi kesalahan. Silakan coba lagi nanti.');
                Swal.fire({
                        title: "Eitss!!!",
                        text: 'Terjadi kesalahan. Silakan coba lagi nanti.',
                        icon: "error"
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script>