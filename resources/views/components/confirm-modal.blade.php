<div class="modal" id="globalConfirmModal">
    <div class="modal-content">
        <h3 id="modalTitle"></h3>
        <p id="modalMessage"></p>
        <div class="modal-actions">
            <button id="confirmBtn" class="btn btn-success">Xác nhận</button>
            <button id="cancelBtn" class="btn btn-secondary">Hủy</button>
        </div>
    </div>
</div>

<script>
    function showConfirmModal({
        title,
        message,
        onConfirm
    }) {
        const modal = document.getElementById('globalConfirmModal');
        const titleEl = document.getElementById('modalTitle');
        const messageEl = document.getElementById('modalMessage');
        const confirmBtn = document.getElementById('confirmBtn');
        const cancelBtn = document.getElementById('cancelBtn');

        titleEl.textContent = title;
        messageEl.textContent = message;
        modal.style.display = 'flex';

        const handleConfirm = () => {
            onConfirm();
            modal.style.display = 'none';
            removeListeners();
        };

        const handleCancel = () => {
            modal.style.display = 'none';
            removeListeners();
        };

        function removeListeners() {
            confirmBtn.removeEventListener('click', handleConfirm);
            cancelBtn.removeEventListener('click', handleCancel);
        }

        confirmBtn.addEventListener('click', handleConfirm);
        cancelBtn.addEventListener('click', handleCancel);
    }
</script>