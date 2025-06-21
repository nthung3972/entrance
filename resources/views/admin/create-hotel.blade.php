@extends('layouts.admin-app')

@section('title', 'Create Hotel')

@section('custom_css')
@vite(['resources/scss/admin/create-hotel.scss'])
@endsection

@section('content')
<div class="container">
    <!-- Header -->
    <header class="create-header">
        <div class="create-header-content">
            <div class="create-header-title">
                <div class="create-header-icon">
                    <i class="fas fa-plus"></i>
                </div>
                <div>
                    <h1>Tạo mới khách sạn</h1>
                    <p>Thêm thông tin khách sạn mới vào hệ thống</p>
                </div>
            </div>
            <div class="create-breadcrumb">
                <a href="{{ route('admin.index') }}"><i class="fas fa-home"></i> Dashboard</a>
            </div>
        </div>
    </header>

    <!-- Form Container -->
    <div class="form-container">
        <!-- <div class="success-message" id="successMessage">
            <i class="fas fa-check-circle"></i>
            Khách sạn đã được tạo thành công!
        </div> -->

        @if ($errors->any())
        <div class="error-message" id="errorMessage">
            <i class="fas fa-exclamation-triangle"></i>
            ホテルの作成中にエラーが発生しました。もう一度お試しください。
        </div>
        @endif

        <form id="createHotelForm" action="{{ route('hotel.create') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <div class="form-grid">
                <!-- Thông tin cơ bản -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-info-circle"></i>
                        Thông tin cơ bản
                    </h3>

                    <div class="form-group">
                        <label for="hotelName">Tên khách sạn <span class="required">*</span></label>
                        <input type="text" id="hotelName" name="hotel_name" class="form-control"
                            placeholder="Nhập tên khách sạn">
                        @error('hotel_name')
                        <span class="error-field">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="hotelType">Loại khách sạn</label>
                        <select id="hotelType" name="hotel_type" class="form-control">
                            <option value="">Chọn loại khách sạn</option>
                            <option value="hotel">Khách sạn</option>
                            <option value="resort">Resort</option>
                            <option value="motel">Nhà nghỉ</option>
                            <option value="hostel">Hostel</option>
                            <option value="apartment">Căn hộ dịch vụ</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="starRating">Hạng sao</label>
                        <select id="starRating" name="star_rating" class="form-control">
                            <option value="">Chọn hạng sao</option>
                            <option value="1">1 sao</option>
                            <option value="2">2 sao</option>
                            <option value="3">3 sao</option>
                            <option value="4">4 sao</option>
                            <option value="5">5 sao</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea id="description" name="description" class="form-control"
                            placeholder="Mô tả về khách sạn..."></textarea>
                    </div>
                </div>

                <!-- Vị trí địa lý -->
                <div class="form-section">
                    <h3 class="section-title">
                        <i class="fas fa-map-marker-alt"></i>
                        Vị trí địa lý
                    </h3>

                    <div class="form-group">
                        <label for="prefecture_name_alpha">Thành phố <span class="required">*</span></label>
                        <select id="prefecture_id" name="prefecture_id" class="form-control">
                            <option value="">都道府県を選択してください</option>
                            @foreach ($listPrefectures as $prefecture)
                            <option
                                value="{{ $prefecture->prefecture_id }}">
                                {{ $prefecture->prefecture_name }} ({{ $prefecture->prefecture_name_alpha }})
                            </option>
                            @endforeach
                        </select>
                        @error('prefecture_id')
                        <span class="error-field">{{ $message }}</span><br>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="district">Quận/Huyện</label>
                        <input type="text" id="district" name="district" class="form-control"
                            placeholder="Quận/Huyện">
                    </div>

                    <div class="form-group">
                        <label for="latitude">Vĩ độ</label>
                        <input type="number" id="latitude" name="latitude" class="form-control"
                            placeholder="21.0285" step="any">
                    </div>

                    <div class="form-group">
                        <label for="longitude">Kinh độ</label>
                        <input type="number" id="longitude" name="longitude" class="form-control"
                            placeholder="105.8542" step="any">
                    </div>
                </div>

                <!-- Upload hình ảnh -->
                <div class="form-section image-upload-section">
                    <h3 class="section-title">
                        <i class="fas fa-images"></i>
                        Hình ảnh khách sạn
                    </h3>

                    <div class="image-upload-area" id="imageUploadArea">
                        <div class="upload-icon">
                            <i class="fas fa-cloud-upload-alt"></i>
                        </div>
                        <div class="upload-text">Kéo thả hình ảnh vào đây</div>
                        <div class="upload-hint">hoặc nhấp để chọn file (PNG, JPG, JPEG - tối đa 5MB)</div>
                        <input type="file" id="imageInput" name="images" multiple accept="image/*" style="display: none;">
                    </div>

                    <div class="image-preview" id="imagePreview"></div>
                    @error('images')
                    <span class="text-sm text-red-500">{{ $message }}</span><br>
                    @enderror
                </div>
            </div>

            <!-- Form Actions -->
            <div class="form-actions">
                <div class="loading" id="loadingIndicator">
                    <div class="spinner"></div>
                    Đang tạo khách sạn...
                </div>

                <div>
                    <a href="{{ url()->previous() }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i>
                        検索結果に戻る
                    </a>
                </div>

                <div>
                    <button type="button" class="btn btn-success" onclick="handleConfirmCreate()">
                        <i class="fas fa-save"></i>
                        Tạo khách sạn
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const imageInput = document.getElementById('imageInput');
        const imageUploadArea = document.getElementById('imageUploadArea');
        const imagePreview = document.getElementById('imagePreview');
        let currentImage = null;

        // Xử lý click để chọn file
        imageUploadArea.addEventListener('click', () => imageInput.click());

        // Xử lý kéo thả file
        imageUploadArea.addEventListener('dragover', (e) => {
            e.preventDefault();
            imageUploadArea.classList.add('dragover');
        });

        imageUploadArea.addEventListener('dragleave', () => {
            imageUploadArea.classList.remove('dragover');
        });

        imageUploadArea.addEventListener('drop', (e) => {
            e.preventDefault();
            imageUploadArea.classList.remove('dragover');
            handleFiles(e.dataTransfer.files);
        });

        // Xử lý chọn file từ input
        imageInput.addEventListener('change', (e) => handleFiles(e.target.files));

        function handleFiles(files) {
            if (files.length > 0) {
                const file = files[0]; // Chỉ lấy 1 file
                const validTypes = ['image/png', 'image/jpg', 'image/jpeg'];
                if (!validTypes.includes(file.type)) {
                    alert('Vui lòng chọn file PNG, JPG hoặc JPEG.');
                    return;
                }
                if (file.size > 5 * 1024 * 1024) {
                    alert('Kích thước file tối đa là 5MB.');
                    return;
                }
                currentImage = file;
                displayPreview();
            }
        }

        function displayPreview() {
            imagePreview.innerHTML = '';
            if (currentImage) {
                const reader = new FileReader();
                reader.onload = (e) => {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.className = 'preview-image';
                    const deleteBtn = document.createElement('button');
                    deleteBtn.textContent = 'Xóa';
                    deleteBtn.className = 'delete-btn';
                    deleteBtn.addEventListener('click', () => {
                        currentImage = null;
                        imagePreview.innerHTML = '';
                        imageInput.value = ''; // Reset input
                        imageUploadArea.style.display = 'block'; // Hiển thị lại upload area khi xóa
                    });
                    const previewDiv = document.createElement('div');
                    previewDiv.className = 'preview-container';
                    previewDiv.appendChild(img);
                    previewDiv.appendChild(deleteBtn);
                    imagePreview.appendChild(previewDiv);
                    imageUploadArea.style.display = 'none'; // Ẩn upload area sau khi chọn ảnh
                };
                reader.readAsDataURL(currentImage);
            }
        }
    });


    function handleConfirmCreate() {
        showConfirmModal({
            title: "Xác nhận tạo khách sạn",
            message: "Bạn có chắc chắn muốn tạo khách sạn mới?",
            onConfirm: () => {
                console.log("Gửi form");
                document.getElementById('createHotelForm').submit();
            }
        });
    }
</script>
@endsection