<!-- Header -->
@section('custom_css')
    @vite('resources/scss/header.scss')
@endsection

<header class="header">
    <div class="container">
        <a href="/" class="logo">THK Holdings Vietnam</a>
        <nav class="nav-menu">
            <a href="/">ホーム</a>
            <a href="/search">検索</a>
            <a href="/about">会社概要</a>
            <a href="/contact">お問い合わせ</a>
        </nav>
    </div>
</header>
