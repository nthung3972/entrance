@extends('layouts.app')

@section('title', 'Trang tìm kiếm khách sạn Nhật Bản')

@section('content')
    <h1 class="mb-4">Tìm kiếm khách sạn tại Nhật Bản</h1>

    <form class="row g-3">
        <div class="col-md-4">
            <label for="city" class="form-label">Thành phố</label>
            <select class="form-select" name="city" id="city">
                <option value="">-- Chọn thành phố --</option>
                <option value="tokyo">Tokyo</option>
                <option value="osaka">Osaka</option>
                <option value="kyoto">Kyoto</option>
                <option value="sapporo">Sapporo</option>
                <option value="nagasaki">Nagasaki</option>
            </select>
        </div>

        <div class="col-md-3">
            <label for="checkin" class="form-label">Ngày nhận phòng</label>
            <input type="date" class="form-control" name="checkin" id="checkin">
        </div>

        <div class="col-md-3">
            <label for="checkout" class="form-label">Ngày trả phòng</label>
            <input type="date" class="form-control" name="checkout" id="checkout">
        </div>

        <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-success w-100">Tìm kiếm</button>
        </div>
    </form>

    <hr class="my-4">

    @isset($hotels)
        <h2>Kết quả tìm kiếm</h2>
        @if(count($hotels) > 0)
            <div class="row">
                @foreach($hotels as $hotel)
                    <div class="col-md-4 mb-3">
                        <div class="card h-100">
                            <img src="{{ $hotel->image_url ?? 'https://via.placeholder.com/300x200' }}" class="card-img-top" alt="{{ $hotel->name }}">
                            <div class="card-body">
                                <h5 class="card-title">{{ $hotel->name }}</h5>
                                <p class="card-text">
                                    {{ $hotel->city }}, Giá: {{ number_format($hotel->price_per_night) }}¥ / đêm
                                </p>
                                <a href="{{ route('hotels.show', $hotel->id) }}" class="btn btn-outline-primary">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>Không tìm thấy khách sạn nào.</p>
        @endif
    @endisset
@endsection
