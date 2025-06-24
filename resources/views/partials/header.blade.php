<!-- Header -->
@section('custom_css')
@vite('resources/scss/header.scss')
@endsection

<header class="header">
    <div class="container">
        <a href="{{ route('home') }}" class="logo">
            <div class="logo-icon">
                <i class="fas fa-torii-gate"></i>
            </div>
            <div class="logo-text">
                <h1>THK Holdings Vietnam</h1>
                <p>Hotel Management System</p>
            </div>
        </a>
        <nav class="nav-menu">
            <a href="/">ホーム</a>
            <a href="/">検索</a>
            <a href="/">会社概要</a>
            <a href="/">お問い合わせ</a>
        </nav>
    </div>
</header>