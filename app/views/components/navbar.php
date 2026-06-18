<?php
    $currentPage = $_GET['page'] ?? 'dashboard';
?>

<style>
    .nav-active {
        border: 2px solid #FFDD00;
        border-radius: 8px;
        padding: 6px 14px !important;
        background-color: rgba(255, 221, 0, 0.23);
        transition: all 0.3s ease;
    }

    .navbar .nav-link {
        transition: all 0.3s ease;
        border: 2px solid transparent;
        border-radius: 8px;
        padding: 6px 14px !important;
        font-weight: 600;
        color: #000;
    }

    .navbar .nav-link:hover:not(.nav-active) {
        border-color: rgba(255, 221, 0, 0.4);
        background-color: rgba(255, 221, 0, 0.05);
    }
</style>

<nav class="navbar navbar-expand-lg bg-white shadow-sm sticky-top">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center gap-2" href="?page=dashboard">

            <img
                src="/project_sanggar/public/assets/images/logo_sanggar.jpeg"
                alt="Logo Sanggar Nampani"
                width="50"
                height="50"
                class="rounded-circle">

            <div>
                <div class="fw-bold">
                    Sanggar Tari Nampani
                </div>

                <small class="text-muted">
                    Kampunganyar, Banyuwangi
                </small>
            </div>

        </a>

        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#mainNavbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div
            class="collapse navbar-collapse"
            id="mainNavbar">

            <ul class="navbar-nav ms-auto align-items-lg-center">

                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'dashboard' ? 'nav-active' : '' ?>" href="?page=dashboard">
                        Beranda
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'kelas' ? 'nav-active' : '' ?>" href="?page=kelas">
                        Kelas Seni
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'umkm' ? 'nav-active' : '' ?>" href="?page=umkm">
                        UMKM
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link <?= $currentPage === 'homestay' ? 'nav-active' : '' ?>" href="?page=homestay">
                        Homestay & Resto
                    </a>
                </li>

                <li class="nav-item ms-lg-3">

                    <a
                        href="?page=redirect"
                        class="btn btn-warning fw-semibold text-black">

                        Hubungi Kami

                    </a>

                </li>

            </ul>

        </div>

    </div>
</nav>