document.addEventListener('DOMContentLoaded', function () {

    window.triggerFileInput = function () {
        document.getElementById('imageInput').click();
    }

    window.previewSelectedImage = function (event) {
        const file = event.target.files[0];
        if (!file) return;

        const reader = new FileReader();
        reader.onload = function (e) {
            const previewContainer = document.getElementById('previewContainer');
            previewContainer.innerHTML = `
                <div class="image-preview">
                    <img src="${e.target.result}" id="previewImage">
                    <button type="button" class="remove-image" onclick="removeImage()">×</button>
                </div>
            `;
        };
        reader.readAsDataURL(file);
    }

    window.removeImage = function () {
        const previewContainer = document.getElementById('previewContainer');
        previewContainer.innerHTML = `
            <div class="image-placeholder" onclick="triggerFileInput()">
                <i class="fas fa-upload"></i>
                <p>Chọn ảnh để tải lên</p>
            </div>
        `;
        document.getElementById('imageInput').value = "";
    }

    window.handleConfirmCreate = function (event) {
        event.preventDefault();
        showConfirmModal({
            title: "ホテルの作成を確認",
            message: "新しいホテルを作成してもよろしいですか？",
            onConfirm: () => {
                console.log("Gửi form");
                document.getElementById('createHotelForm').submit();
            }
        });
    }
});
