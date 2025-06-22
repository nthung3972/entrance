document.addEventListener('DOMContentLoaded', function () {
    window.confirmDeleteHotel = function (event) {
        event.preventDefault();
        showConfirmModal({
            title: "削除の確認",
            message: "このホテルを本当に削除しますか？",
            onConfirm: () => {
                document.getElementById('deleteHotelForm').submit();
            }
        });
    }
});
