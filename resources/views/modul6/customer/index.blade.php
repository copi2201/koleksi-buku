<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kantin Online</title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }

        a {
            text-decoration: none;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
        }

        .navbar {
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
            padding: 18px 0;
        }

        .navbar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 15px;
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .brand-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            background-color: #6f42c1;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
        }

        .brand-text h1 {
            font-size: 26px;
            color: #6f42c1;
            margin-bottom: 4px;
        }

        .brand-text p {
            font-size: 14px;
            color: #666;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 10px;
            position: relative;
        }

        .btn {
            padding: 10px 18px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
            cursor: pointer;
            border: none;
            transition: 0.2s;
        }

        .btn-outline {
            background-color: white;
            border: 1px solid #6f42c1;
            color: #6f42c1;
        }

        .btn-outline:hover {
            background-color: #f3ebff;
        }

        .btn-primary {
            background-color: #6f42c1;
            color: white;
        }

        .btn-primary:hover {
            background-color: #5a32a3;
        }

        .dropdown {
            position: relative;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            top: 45px;
            right: 0;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            min-width: 200px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.08);
            z-index: 99;
        }

        .dropdown-menu.show {
            display: block;
        }

        .dropdown-item {
            display: block;
            padding: 12px 15px;
            color: #333;
            border-bottom: 1px solid #eee;
        }

        .dropdown-item:last-child {
            border-bottom: none;
        }

        .dropdown-item:hover {
            background-color: #f7f7f7;
        }

        .hero {
            padding: 40px 0;
        }

        .hero-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 25px;
        }

        .hero-left, .hero-right {
            background-color: white;
            border-radius: 10px;
            padding: 30px;
            border: 1px solid #ddd;
        }

        .hero-label {
            display: inline-block;
            background-color: #eee5ff;
            color: #6f42c1;
            padding: 8px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: bold;
            margin-bottom: 18px;
        }

        .hero-left h2 {
            font-size: 42px;
            line-height: 1.3;
            margin-bottom: 20px;
        }

        .hero-left h2 span {
            color: #6f42c1;
        }

        .hero-left p {
            font-size: 17px;
            line-height: 1.7;
            color: #555;
            margin-bottom: 25px;
        }

        .hero-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 20px;
        }

        .hero-badges {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .badge {
            background-color: #f1f1f1;
            color: #444;
            padding: 8px 12px;
            border-radius: 16px;
            font-size: 13px;
        }

        .hero-card-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
            color: #333;
        }

        .summary-box {
            background-color: #6f42c1;
            color: white;
            border-radius: 8px;
            padding: 20px;
            margin-bottom: 16px;
        }

        .summary-box small {
            font-size: 14px;
            display: block;
            margin-bottom: 10px;
        }

        .summary-box .big {
            font-size: 38px;
            font-weight: bold;
        }

        .summary-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .summary-item {
            background-color: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 14px 16px;
            display: flex;
            justify-content: space-between;
        }

        .menu-section {
            padding: 10px 0 50px;
        }

        .section-header {
            margin-bottom: 25px;
        }

        .section-header h3 {
            font-size: 30px;
            margin-bottom: 8px;
        }

        .section-header p {
            color: #666;
            font-size: 15px;
        }

        .menu-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 20px;
        }

        .menu-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
        }

        .menu-image {
            height: 180px;
            background-color: #ece3ff;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 50px;
        }

        .menu-body {
            padding: 18px;
        }

        .menu-title {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .menu-vendor {
            display: inline-block;
            background-color: #f3ebff;
            color: #6f42c1;
            padding: 6px 10px;
            border-radius: 14px;
            font-size: 12px;
            margin-bottom: 14px;
        }

        .menu-desc {
            font-size: 14px;
            color: #666;
            line-height: 1.6;
            margin-bottom: 16px;
        }

        .menu-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 10px;
            flex-wrap: wrap;
        }

        .price {
            font-size: 22px;
            font-weight: bold;
            color: #198754;
        }

        .buy-btn {
            background-color: #6f42c1;
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            font-size: 14px;
            font-weight: bold;
        }

        .buy-btn:hover {
            background-color: #5a32a3;
        }

        .empty-state {
            background-color: white;
            border: 1px dashed #bbb;
            border-radius: 10px;
            padding: 35px;
            text-align: center;
        }

        .empty-state h4 {
            margin-bottom: 10px;
            font-size: 22px;
        }

        .empty-state p {
            color: #666;
        }

        .footer {
            text-align: center;
            padding: 25px 15px;
            color: #777;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .hero-grid {
                grid-template-columns: 1fr;
            }

            .hero-left h2 {
                font-size: 34px;
            }
        }

        @media (max-width: 600px) {
            .navbar-inner {
                flex-direction: column;
                align-items: flex-start;
            }

            .hero-left h2 {
                font-size: 28px;
            }

            .hero-left p {
                font-size: 15px;
            }

            .menu-footer {
                flex-direction: column;
                align-items: flex-start;
            }

            .buy-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="container navbar-inner">
            <div class="brand">
                <div class="brand-icon">🍔</div>
                <div class="brand-text">
                    <h1>Kantin Online</h1>
                    <p>Praktis, cepat, dan nyaman untuk pemesanan harian</p>
                </div>
            </div>

            <div class="nav-actions">
                <a href="#menu" class="btn btn-outline">Lihat Menu</a>

                <div class="dropdown">
                    <button class="btn btn-primary" onclick="toggleDropdown()">
                        Masuk sebagai Pengelola
                    </button>

                    <div id="pengelolaDropdown" class="dropdown-menu">
                        <a href="/login/admin" class="dropdown-item">Masuk sebagai Admin</a>
                        <a href="/login/vendor" class="dropdown-item">Masuk sebagai Vendor</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <section class="hero">
        <div class="container hero-grid">
            <div class="hero-left">
                <div class="hero-label">Layanan pemesanan kantin digital</div>

                <h2>
                    Pesan makanan favoritmu dengan proses yang
                    <span>lebih cepat</span>,
                    praktis, dan mudah digunakan
                </h2>

                <p>
                    Selamat datang di Kantin Online. Di sini kamu bisa melihat berbagai menu dari vendor yang tersedia,
                    memilih makanan atau minuman yang diinginkan, lalu melanjutkan ke proses pemesanan dan pembayaran.
                </p>

                <div class="hero-buttons">
                    <a href="#menu" class="btn btn-primary">Pesan Sekarang</a>
                </div>

                <div class="hero-badges">
                    <div class="badge">Banyak pilihan menu</div>
                    <div class="badge">Pembayaran online</div>
                    <div class="badge">Proses pemesanan mudah</div>
                </div>
            </div>

            <div class="hero-right">
                <div class="hero-card-title">Ringkasan Kantin</div>

                <div class="summary-box">
                    <small>Total Menu Tersedia</small>
                    <div class="big">{{ count($menus) }}</div>
                </div>

                <div class="summary-list">
                    <div class="summary-item">
                        <span>Status Sistem</span>
                        <strong>Aktif</strong>
                    </div>
                    <div class="summary-item">
                        <span>Pembayaran</span>
                        <strong>Online</strong>
                    </div>
                    <div class="summary-item">
                        <span>Tipe Layanan</span>
                        <strong>Kantin Digital</strong>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="menu-section" id="menu">
        <div class="container">
            <div class="section-header">
                <h3>Menu Tersedia</h3>
                <p>Pilih makanan atau minuman yang ingin kamu pesan dari vendor yang tersedia.</p>
            </div>

            @if(count($menus) > 0)
                <div class="menu-grid">
                    @foreach($menus as $menu)
                        <div class="menu-card">
                            <div class="menu-image">🍜</div>

                            <div class="menu-body">
                                <div class="menu-title">{{ $menu->nama_menu }}</div>

                                <div class="menu-vendor">Vendor: {{ $menu->nama_vendor }}</div>

                                <div class="menu-desc">
                                    Menu tersedia untuk dipesan secara online dengan tampilan yang sederhana
                                    dan proses yang mudah dipahami oleh pengguna.
                                </div>

                                <div class="menu-footer">
                                    <div class="price">Rp {{ number_format($menu->harga, 0, ',', '.') }}</div>
                                    <a href="{{ url('/payment?menu_id=' . $menu->id) }}" class="buy-btn">Beli Sekarang</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <h4>Belum ada menu tersedia</h4>
                    <p>Silakan tambahkan menu terlebih dahulu dari halaman pengelola.</p>
                </div>
            @endif
        </div>
    </section>

    <div class="footer">
        © 2026 Kantin Online - Platform pemesanan kantin digital
    </div>

    <script>
        function toggleDropdown() {
            document.getElementById('pengelolaDropdown').classList.toggle('show');
        }

        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('pengelolaDropdown');
            const button = e.target.closest('.dropdown');

            if (!button && dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        });
    </script>

</body>
</html>