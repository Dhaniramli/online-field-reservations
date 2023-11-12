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

{{-- <script>
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
                alert(data.message);
                location.reload();
            } else {
                // If validation fails, display an alert with the error messages
                var errors = Object.values(data.errors).flat();
                var errorMessage = errors.join('\n');
                alert(errorMessage);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    }
</script> --}}


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
                try {
                    if (data.success) {
                        // Close the modal
                        $('#cancelModal' + itemId).modal('hide');
                        alert(data.message);
                        location.reload();
                    } else {
                        // If validation fails or cancellation is being processed, display an alert with the appropriate message
                        if (data.done === 'sudahAda') {
                            // Display specific alert for the processing case
                            console.log('Pembatalan anda sedang di proses, mohon bersabar menunggu respon balik dari admin');
                            alert('Pembatalan anda sedang di proses, mohon bersabar menunggu respon balik dari admin');
                        } else {
                            // Display generic alert for validation errors or other failure cases
                            var errors = Object.values(data.errors).flat();
                            var errorMessage = errors.join('\n');
                            alert(errorMessage);
                        }
                    }
                } catch (error) {
                    console.error('Error parsing JSON:', error);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

</script>
