@extends('layouts.admin-app')

@section('title', 'Dashboard')

@section('custom_css')
@vite(['resources/scss/admin/dashboard.scss'])
@endsection

@section('content')
<!-- Main Cards Grid -->
<div class="main-grid">
    <div class="card card-search" onclick="location.href='https://localhost/admin/hotel/search'">
        <div class="card-icon">
            <i class="fas fa-search"></i>
        </div>
        <div class="card-content">
            <h3>Tìm kiếm khách sạn</h3>
            <p>Tìm kiếm và lọc danh sách khách sạn theo nhiều tiêu chí khác nhau</p>
        </div>
    </div>

    <a href="{{ route('hotel.form.create') }}" class="card card-create">
        <div class="card-icon">
            <i class="fas fa-plus"></i>
        </div>
        <div class="card-content">
            <h3>Tạo mới khách sạn</h3>
            <p>Thêm thông tin khách sạn mới vào hệ thống quản lý</p>
        </div>
    </a>
    </form>
</div>
@endsection