@extends('layouts.admin-app')

@section('title', 'Hotel Detail')

@section('custom_css')
@vite(['resources/scss/user/hotel-detail.scss'])
@endsection

@section('content')
<div class="container">
    <!-- Hotel Header -->
    @if(isset($hotel))
    <section class="hotel-header">
        @if(session('create-success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('create-success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        @if(session('update-success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('update-success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <div class="hotel-title">
            <div>
                <h1>{{ $hotel->hotel_name }}</h1>
                <div class="hotel-location">
                    <span class="location-icon">📍</span>
                    {{ $prefecture->prefecture_name }} ({{ $prefecture->prefecture_name_alpha }})
                </div>
            </div>
            <div class="hotel-rating">
                <div class="stars">⭐⭐⭐⭐⭐</div>
                <div class="rating-score">4.5/5.0</div>
            </div>
        </div>

        <div class="back-to-search">
            <a href="{{ url()->previous() }}" class="back-button">検索結果に戻る</a>
        </div>

        <div class="hotel-tags">
            <span class="tag">高級ホテル</span>
            <span class="tag">ビジネス</span>
            <span class="tag">WiFi無料</span>
            <span class="tag">駐車場あり</span>
            <span class="tag">レストラン</span>
        </div>
    </section>

    <!-- Hotel Gallery -->
    <section class="hotel-gallery">
        <h2 class="gallery-title">写真ギャラリー</h2>
        <div class="gallery-grid">
            <div class="gallery-item main-image">
                @if($hotel->file_path)
                <img src="{{ asset('assets/img/' . $hotel->file_path) }}" alt="{{ $hotel->hotel_name }}">
                @else
                <i class="fas fa-hotel"></i>
                <span>ホテルの写真がありません</span>
                @endif
            </div>
            <div class="gallery-item">
                客室写真
            </div>
            <div class="gallery-item">
                ロビー
            </div>
            <div class="gallery-item">
                レストラン
            </div>
            <div class="gallery-item more-photos">
                更に写真を見る
            </div>
        </div>
    </section>

    <!-- Hotel Content -->
    <section class="hotel-content">
        <div class="main-content-area">
            <!-- Description -->
            <div class="content-section">
                <h2 class="section-title">ホテル紹介</h2>
                <div class="description">
                    <p>東京グランドホテルは、新宿の中心部に位置する高級ビジネスホテルです。JR新宿駅から徒歩5分の好立地で、ビジネスにも観光にも最適な環境を提供しています。</p>
                    <p>全室に高速WiFi、エアコン、液晶テレビを完備し、快適なご滞在をお約束いたします。最上階にはスカイラウンジがあり、東京の夜景を一望できます。</p>
                    <p>経験豊富なスタッフが24時間体制でお客様をサポートし、安心してお過ごしいただけます。</p>
                </div>
            </div>

            <!-- Amenities -->
            <div class="content-section">
                <h2 class="section-title">設備・サービス</h2>
                <div class="amenities-grid">
                    <div class="amenity-item">
                        <span class="amenity-icon">📶</span>
                        <span>WiFi無料</span>
                    </div>
                    <div class="amenity-item">
                        <span class="amenity-icon">🚗</span>
                        <span>駐車場</span>
                    </div>
                    <div class="amenity-item">
                        <span class="amenity-icon">🍽️</span>
                        <span>レストラン</span>
                    </div>
                    <div class="amenity-item">
                        <span class="amenity-icon">🏋️</span>
                        <span>フィットネス</span>
                    </div>
                    <div class="amenity-item">
                        <span class="amenity-icon">🛁</span>
                        <span>スパ・温泉</span>
                    </div>
                    <div class="amenity-item">
                        <span class="amenity-icon">🏪</span>
                        <span>売店</span>
                    </div>
                    <div class="amenity-item">
                        <span class="amenity-icon">🧺</span>
                        <span>ランドリー</span>
                    </div>
                    <div class="amenity-item">
                        <span class="amenity-icon">🎯</span>
                        <span>コンシェルジュ</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="sidebar">
            <!-- Booking Card -->
            <div class="booking-card">
                <div class="price-section">
                    <div class="price">¥15,000</div>
                    <div class="price-note">1泊あたり（税込）</div>
                </div>
                <form class="booking-form">
                    <div class="form-group">
                        <label for="checkin">チェックイン</label>
                        <input type="date" id="checkin" name="checkin" required>
                    </div>
                    <div class="form-group">
                        <label for="checkout">チェックアウト</label>
                        <input type="date" id="checkout" name="checkout" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="guests">宿泊人数</label>
                            <select id="guests" name="guests" required>
                                <option value="1">1名</option>
                                <option value="2">2名</option>
                                <option value="3">3名</option>
                                <option value="4">4名</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="rooms">部屋数</label>
                            <select id="rooms" name="rooms" required>
                                <option value="1">1部屋</option>
                                <option value="2">2部屋</option>
                                <option value="3">3部屋</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="book-btn">今すぐ予約</button>
                </form>
            </div>
        </div>
    </section>
    @endif
</div>
@endsection
