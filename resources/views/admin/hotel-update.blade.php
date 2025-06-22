@extends('layouts.admin-app')

@section('title', 'Update Hotel')

@section('custom_css')
@vite(['resources/scss/admin/update-hotel.scss', 'resources/js/admin/hotel-update.js'])
@endsection

@section('content')
<div class="container">
    <!-- Hotel Edit Form -->
    <form id="updateHotelForm" class="form-card" action="/admin/hotel/{{ $hotel->hotel_id }}/update" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-header">
            <h2><i class="fas fa-hotel" style="margin-right: 0.5rem;"></i>ホテル情報の編集</h2>
        </div>

        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="fas fa-times-circle me-2"></i>
            ホテルの更新中にエラーが発生しました。もう一度お試しください。
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="form-body">
            <!-- Basic Information Section -->
            <div class="form-section">
                <h3 class="section-title">基本情報</h3>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label required" for="hotel_name">ホテル名（日本語）</label>
                        <input type="text"
                            id="hotel_name"
                            name="hotel_name"
                            class="form-control japanese-text"
                            value="{{ old('hotel_name', $hotel->hotel_name ?? '') }}"
                            placeholder="例: 桜ホテル東京"
                            required>

                        @error('hotel_name')
                        <span class="error-field">{{ $message }}</span><br>
                        @enderror
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label required" for="prefecture">都道府県</label>
                        <select id="prefecture_id" name="prefecture_id" class="form-control" required>
                            <option value="">選択してください</option>
                            @foreach($listPrefectures as $label)
                            <option value="{{ $label->prefecture_id }}"
                                {{ old('prefecture_id', $hotel->prefecture_id ?? '') == $label->prefecture_id ? 'selected' : '' }}>
                                {{ $label->prefecture_name }} ({{ $label->prefecture_name_alpha }})
                            </option>
                            @endforeach
                        </select>
                        @error('prefecture_id')
                        <span class="error-field">{{ $message }}</span><br>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Images Section -->
            <div class="form-section">
                <h3 class="section-title">ホテル画像</h3>

                <div class="form-group">
                    <label class="form-label" for="images">画像アップロード</label>

                    <div class="image-upload-wrapper">
                        <div id="previewContainer">
                            @if(isset($hotel->file_path))
                            <div class="image-preview">
                                <img src="{{ asset('assets/img/' . $hotel->file_path) }}" alt="Hotel Image" id="previewImage">
                                <button type="button" class="remove-image" onclick="removeImage()">×</button>
                            </div>
                            @else
                            <div class="image-placeholder" onclick="triggerFileInput()">
                                <i class="fas fa-upload"></i>
                                <p>Chọn ảnh để tải lên</p>
                            </div>
                            @endif
                        </div>

                        <input type="file" name="image" id="imageInput" accept="image/*" onchange="previewSelectedImage(event)" hidden>
                    </div>
                    @error('image')
                    <span class="error-field">{{ $message }}</span><br>
                    @enderror
                </div>
            </div>
        </div>

        <!-- Form Actions -->
        <div class="form-actions">
            <a href="{{ url()->previous() }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> キャンセル
            </a>
            <button type="submit" class="btn btn-primary" onclick="handleConfirmUpdate(event)">
                <i class="fas fa-save"></i> 変更を保存
            </button>
        </div>
    </form>
</div>
@endsection
