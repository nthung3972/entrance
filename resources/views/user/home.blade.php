@extends('layouts.app')

@section('title', 'Top Page')

@section('custom_css')
@vite(['resources/scss/user/home.scss', 'resources/js/user/home.js'])
@endsection

@section('content')
<div class="container">
    <!-- Search Section -->
    <section class="search-section">
        <h1>日本全国のホテルを検索</h1>
        <form class="search-form" id="searchForm" method="GET" action="{{ route('hotel.list', ['prefecture' => 'empty']) }}">
            <div class="form-group">
                <label for="prefecture">都道府県</label>
                <select id="prefecture" onchange="updateFormAction()">
                    <option value="">都道府県を選択してください</option>
                    @foreach ($listPrefectures as $prefecture)
                    <option
                        value="{{ $prefecture->prefecture_name_alpha }}"
                        {{ $currentPrefecture === $prefecture->prefecture_name_alpha ? 'selected' : '' }}>
                        {{ $prefecture->prefecture_name }} ({{ $prefecture->prefecture_name_alpha }})
                    </option>
                    @endforeach
                </select>
                <!-- Display validation errors -->
                @if ($errors->has('prefecture'))
                <div class="error-message">
                    {{ $errors->first('prefecture') }}
                </div>
                @endif
            </div>

            <button type="submit" class="search-btn">ホテルを検索</button>
        </form>
    </section>

    <!-- Hotel List Section -->
    <section class="hotel-list-section">
        @if(isset($hotels) && $hotels->isNotEmpty())
        <h2 class="section-title">{{ $prefectureModel->prefecture_name }}の検索結果 ({{ $hotels->total() }}件)</h2>
        <div class="hotel-grid" id="hotelGrid">
            @foreach($hotels as $hotel)
            <a href="{{ route('hotel.detail', ['hotel_id' => $hotel->hotel_id]) }}" class="hotel-card">
                @if($hotel->file_path)
                <img src="{{ asset('assets/img/' . $hotel->file_path) }}" alt="{{ $hotel->hotel_name }}" class="hotel-image">
                <h3>{{ $hotel->hotel_name }}</h3>
                @else
                <img src="{{ asset('assets/img/hotel/hotel-default.png') }}" alt="Default Hotel Image" class="hotel-image">
                <h3>{{ $hotel->hotel_name }}</h3>
                @endif
            </a>
            @endforeach
        </div>

        <div class="hotels-pagination">
            {{ $hotels->withQueryString()->links() }}
        </div>
        @else
        <div class="hotel-grid" id="hotelGrid">
            <div class="no-results">
                <div class="no-results-icon">🏨</div>
                <h3>ホテルを検索してください</h3>
                <p>上記のフォームから条件を入力して検索してください</p>
            </div>
        </div>
        @endif
    </section>
</div>
@endsection