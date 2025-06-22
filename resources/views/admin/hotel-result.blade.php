@extends('layouts.admin-app')

@section('title', 'Create Hotel')

@section('custom_css')
@vite(['resources/scss/admin/result-hotel.scss', 'resources/js/admin/hotel-delete.js',])
@endsection

@section('content')
<div class="container">
    <!-- Search Summary -->
    <div class="search-summary">
        <div class="search-info">
            <i class="fas fa-search"></i>
            <div class="search-text">
                <h3>検索結果</h3>
                <div class="search-keywords">
                    キーワード:
                    <span class="keyword">{{ $data['hotel_name'] ?? '' }}</span>
                    @if(isset($data['prefecture_name_alpha']))
                    <span class="keyword">{{ $data['prefecture_name_alpha'] ?? '' }}</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="search-actions">
            <a href="{{ route('hotel.search') }}" class="btn-secondary">
                <i class="fas fa-edit"></i> 再検索
            </a>
            <a href="{{ route('hotel.create') }}" class="btn-primary">
                <i class="fas fa-plus"></i> ホテルを追加
            </a>
        </div>
    </div>

    <!-- Session Messages -->
    @if(session('delete-success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>
        {{ session('delete-success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if ($errors->has('delete-error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-times-circle me-1"></i>
        {{ $errors->first('delete-error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Results Section -->
    <div class="results-section">
        <div class="results-header">
            <div class="results-title">
                <i class="fas fa-hotel"></i>
                <h3>ホテル一覧</h3>
                <div class="results-count">
                    合計 {{ isset($searchResults) ? $searchResults->total() : 0 }} 件
                </div>
            </div>
        </div>

        <!-- Table View -->
        <div class="table-container" id="tableView">
            <table class="hotel-table">
                <thead>
                    <tr>
                        <th>番号順</th>
                        <th>ホテル</th>
                        <th>位置</th>
                        <th>部屋数</th>
                        <th>評価する</th>
                        <th>状態</th>
                        <th>手術</th>
                    </tr>
                </thead>
                <tbody>
                    @if(isset($searchResults) && $searchResults->isNotEmpty())
                    @foreach($searchResults as $index => $hotel)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div class="hotel-info">
                                <div class="hotel-image">
                                    @if($hotel->file_path)
                                    <img src="{{ asset('assets/img/' . $hotel->file_path) }}" alt="{{ $hotel->hotel_name }}" class="hotel-image">
                                    @else
                                    <i class="fas fa-hotel"></i>
                                    @endif
                                </div>
                                <div class="hotel-details">
                                    <div class="hotel-name">{{ $hotel->hotel_name }}</div>
                                    <div class="hotel-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        {{ $hotel->prefecture->prefecture_name }} ({{ $hotel->prefecture->prefecture_name_alpha }})
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $hotel->prefecture->prefecture_name }} ({{ $hotel->prefecture->prefecture_name_alpha }})</td>
                        <td>120</td>
                        <td>
                            <div class="hotel-rating">
                                <div class="stars">⭐⭐⭐⭐⭐</div>
                                <span class="rating-score">5</span>
                            </div>
                        </td>
                        <td><span class="status-badge status-active">仕事</span></td>
                        <td>
                            <div class="action-btns">
                                <a href="{{ route('hotel.form.edit', ['hotel_id' => $hotel->hotel_id]) }}" class="btn-action btn-edit" title="編集">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <a href="#" class="btn-action btn-delete" title="削除" onclick="confirmDeleteHotel(event)">
                                    <i class="fas fa-trash"></i>
                                </a>

                                <form id="deleteHotelForm" action="{{ route('hotel.delete', ['hotel_id' => $hotel->hotel_id]) }}" method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="7" class="no-results">
                            <div class="no-results-text">
                                検索に一致する結果はありません。 <br>
                                別のキーワードでもう一度試すか、フィルターを調整してください。
                            </div>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
        </div>

        <div class="hotels-pagination">
            {{ $searchResults->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection