@extends('layouts.admin-app')

@section('title', 'Dashboard')

@section('custom_css')
@vite(['resources/scss/admin/dashboard.scss'])
@endsection

@section('content')
<div class="jp-home">
    <div class="jp-grid">
        <a href="{{ route('hotel.search') }}" class="jp-card">
            <div class="jp-card-icon">
                <i class="fas fa-search"></i>
            </div>
            <div class="jp-card-content">
                <h3>ホテルを検索</h3>
                <p>さまざまな条件でホテルを検索・フィルタできます。</p>
            </div>
        </a>

        <a href="{{ route('hotel.form.create') }}" class="jp-card">
            <div class="jp-card-icon">
                <i class="fas fa-plus"></i>
            </div>
            <div class="jp-card-content">
                <h3>ホテルを登録</h3>
                <p>新しいホテル情報をシステムに追加します。</p>
            </div>
        </a>
    </div>
</div>
@endsection
