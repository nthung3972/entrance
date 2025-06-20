@extends('layouts.app')

@section('title', $prefectureModel->prefecture_name . 'のホテル一覧')

@section('custom_css')
@vite(['resources/scss/user/home.scss', 'resources/js/user/hotel-list.js'])
@endsection

@section('content')
<div class="container">
    <!-- Search Section -->
    <section class="search-section">
        <h1>{{ $prefectureModel->prefecture_name }}のホテルを検索</h1>
        <form class="search-form" id="searchForm" method="GET" action="{{ route('hotel.list', ['prefecture' => $currentPrefecture]) }}">
            <div class="form-group">
                <label for="prefecture">都道府県</label>
                <select id="prefecture" name="prefecture_select">
                    <option value="">都道府県を選択してください</option>
                    @foreach ($listPrefectures as $prefecture)
                    <option
                        value="{{ $prefecture->prefecture_name_alpha }}"
                        {{ $currentPrefecture === $prefecture->prefecture_name_alpha ? 'selected' : '' }}>
                        {{ $prefecture->prefecture_name }} ({{ $prefecture->prefecture_name_alpha }})
                    </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="search-btn">ホテルを検索</button>
            <a href="{{ route('home') }}" class="back-btn" style="margin-left: 10px;">トップページに戻る</a>
        </form>
    </section>

    <!-- Hotel List Section -->
    <section class="hotel-list-section">
        <h2 class="section-title">{{ $prefectureModel->prefecture_name }}の検索結果 ({{ $hotels->total() }}件)</h2>
        <div class="hotel-grid" id="hotelGrid">
            @if($hotels->isEmpty())
            <div class="no-results">
                <div class="no-results-icon">🏨</div>
                <h3>ホテルが見つかりません</h3>
                <p>検索条件を変更してもう一度お試しください</p>
            </div>
            @else
            @foreach($hotels as $hotel)
            <div class="hotel-card">
                <img src="{{ asset('assets/img/' . $hotel->file_path) }}" alt="{{ $hotel->hotel_name }}" class="hotel-image">
                <h3>{{ $hotel->hotel_name }}</h3>
                <p class="hotel-location">{{ $prefectureModel->prefecture_name }}</p>
            </div>
            @endforeach
            @endif
        </div>

        @if($hotels->count())
        <div class="hotels-pagination">
            {{ $hotels->withQueryString()->links() }}
        </div>
        @endif
    </section>
</div>
@endsection