@extends('layouts.admin-app')

@section('title', 'Create Hotel')

@section('custom_css')
@vite(['resources/scss/admin/search-hotel.scss', 'resources/js/admin/booking-search.js',])
@endsection

@section('content')
<div class="controller">
    <div class="search-card">
        <div class="search-card-header">
            <h3>検索条件</h3>
        </div>

        <form class="search-form" action="{{ route('booking.search') }}" method="GET" id="searchForm">
            <div class="form-group">
                <label for="customer_name">
                    顧客名
                </label>
                <input type="text"
                    name="customer_name"
                    value="{{ request('customer_name') }}"
                    placeholder="顧客名">
            </div>

            <div class="form-group">
                <label for="customerContact">連絡先情報</label>
                <input type="text"
                    name="customer_contact"
                    value="{{ request('customer_contact') }}"
                    placeholder="連絡先">
            </div>

            <div class="form-group">
                <label for="checkinTime">チェックイン日時</label>
                <input type="datetime-local"
                    id="checkin_time"
                    name="checkin_time"
                    class="form-control"
                    value="{{ request('checkin_time') }}">
            </div>

            <div class="form-group">
                <label for="checkoutTime">チェックアウト日時</label>
                <input type="datetime-local"
                    id="checkout_time"
                    name="checkout_time"
                    class="form-control"
                    value="{{ request('checkout_time') }}">
            </div>

            <div class="search-actions">
                <button type="button" class="btn btn-secondary" onclick="clearForm()">
                    <i class="fas fa-eraser"></i>クリア
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-search"></i>検索
                </button>
            </div>
        </form>
    </div>

    <div class="results-card">
        <div class="results-header">
            <h3>
                <i class="fas fa-clipboard-list"></i>
                検索結果
            </h3>
            <span class="results-count" id="resultsCount">{{ $bookings->total() }}件の結果</span>
        </div>

        <div class="table-container">
            <table id="resultsTable">
                <thead>
                    <tr>
                        <th>予約ID</th>
                        <th>ホテルID</th>
                        <th>氏名</th>
                        <th>連絡先</th>
                        <th>チェックイン</th>
                        <th>チェックアウト</th>
                    </tr>
                </thead>
                <tbody id="resultsBody">
                    @if($bookings->isEmpty())
                    @if(request()->hasAny(['customer_name', 'customer_contact', 'checkin_time', 'checkout_time']))
                    <tr>
                        <td colspan="8" class="no-results">
                            <div>
                                <div class="no-results-icon"><i class="fas fa-search"></i></div>
                                <h4>検索結果がありません</h4>
                                <p>検索条件に一致する予約が見つかりませんでした。条件を変更して再度検索してください。</p>
                            </div>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td colspan="8" class="no-results">
                            <div>
                                <div class="no-results-icon"><i class="fas fa-search"></i></div>
                                <h4>検索条件を入力してください</h4>
                                <p>検索条件を入力して「検索」ボタンをクリックしてください</p>
                            </div>
                        </td>
                    </tr>
                    @endif
                    @else
                    @foreach($bookings as $booking)
                    <tr>
                        <td>{{ $booking->booking_id }}</td>
                        <td>{{ $booking->hotel_id }}</td>
                        <td>{{ $booking->customer_name }}</td>
                        <td>{{ $booking->customer_contact }}</td>
                        <td>
                            @if($booking->checkin_time)
                            {{ is_string($booking->checkin_time) ? $booking->checkin_time : $booking->checkin_time->format('Y-m-d H:i') }}
                            @else
                            未定
                            @endif
                        </td>
                        <td>
                            @if($booking->checkout_time)
                            {{ is_string($booking->checkout_time) ? $booking->checkout_time : $booking->checkout_time->format('Y-m-d H:i') }}
                            @else
                            未定
                            @endif
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        </div>
        <div class="bookings-pagination">
            {{ $bookings->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
