<div class="sidebar">
    <div class="sidebar-header">
        <div class="sidebar-brand">
            <h2>THK Holdings Vietnam</h2>
            <div class="subtitle">ホテル管理システム</div>
        </div>
        <button class="sidebar-toggle" id="sidebarToggle">☰</button>
    </div>
    <nav>
        <div class="nav-section">
            <div class="nav-section-title">メイン機能</div>
            <ul>
                <li><a href="{{ route('admin.index') }}" class="{{ request()->routeIs('admin.index') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-home"></i></span>ダッシュボード</a></li>
                <li><a href="{{ route('hotel.form.create') }}" class="{{ request()->routeIs('hotel.form.create') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-plus-square"></i></span>新しいホテルを作成</a></li>
                <li><a href="{{ route('hotel.search') }}" class="{{ request()->routeIs('hotel.search') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-hotel"></i></span>ホテルを検索</a></li>
                <li><a href="{{ route('booking.search') }}" class="{{ request()->routeIs('booking.search') ? 'active' : '' }}"><span class="nav-icon"><i class="fas fa-calendar-alt"></i></span>予約情報検索</a></li>
            </ul>
        </div>

    </nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggle = document.getElementById('sidebarToggle');
        const nav = document.querySelector('.sidebar nav');

        toggle.addEventListener('click', () => {
            nav.classList.toggle('show');
        });
    });
</script>
