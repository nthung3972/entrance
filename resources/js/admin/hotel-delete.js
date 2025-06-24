document.addEventListener('DOMContentLoaded', function () {
    window.confirmDeleteHotel = function (event) {
        event.preventDefault();
        showConfirmModal({
            title: "削除の確認",
            message: "ホテルには予約がある可能性があります。削除してもよろしいですか?",
            onConfirm: () => {
                showGlobalLoading(); 
                setTimeout(() => {
                    document.getElementById('deleteHotelForm').submit();
                }, 300);
            }
        });
    }
});
