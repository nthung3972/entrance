@extends('layouts.admin-app')

@section('title', 'Create Hotel')

@section('custom_css')
@vite(['resources/scss/admin/search-hotel.scss', 'resources/js/admin/search-hotel.js'])
@endsection

@section('content')
<div class="search-container">
    <div class="search-card">
        <div class="search-title">
            <i class="fas fa-search"></i>
            <h2>ホテル検索</h2>
            <p>適切なホテルを検索するための情報を入力してください</p>
        </div>

        <form class="search-form" action="{{ route('hotel.search.submit') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="hotel_name">ホテル名</label>
                <input type="text"
                    id="hotel_name"
                    name="hotel_name"
                    class="form-control"
                    placeholder="ホテル名またはキーワードを入力してください..."
                    value="">
                @error('hotel_name')
                    <span class="error-field">{{ $message }}</span><br>
                @enderror
            </div>

            <div class="form-group">
                <label for="prefecture_name_alpha">都道府県</label>
                <select id="prefecture_name_alpha" name="prefecture_name_alpha" class="form-control">
                    <option value="">都道府県を選択してください</option>
                    @foreach ($prefectures as $prefecture)
                        <option
                        value="{{ $prefecture->prefecture_name_alpha }}">
                        {{ $prefecture->prefecture_name }} ({{ $prefecture->prefecture_name_alpha }})
                    </option>
                    @endforeach
                </select>
                @error('prefecture_name_alpha')
                    <span class="error-field">{{ $message }}</span><br>
                @enderror

            <button type="submit" class="search-btn" onclick="showLoading(this)">
                <i class="fas fa-search"></i>
                検索
            </button>
        </form>
    </div>
</div>
@endsection