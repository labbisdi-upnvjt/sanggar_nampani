<nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar" style="min-height:100vh; border-right: 2px solid #C9A84C;">
    <div class="position-sticky pt-3">
        <!-- Header CMS -->
        <div class="text-center mb-4 pb-2" style="border-bottom: 3px solid #C9A84C;">
            <h4 class="fw-bold" style="color: #C9A84C;">CMS Sanggar</h4>
            <small style="color: #2A9D8F;">Nampani</small>
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= ($_GET['page'] ?? 'dashboard') == 'dashboard' ? 'active' : '' ?>" href="?page=dashboard">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($_GET['page'] ?? '') == 'kelas' ? 'active' : '' ?>" href="?page=kelas">
                    <i class="bi bi-book"></i> Kelas Seni
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($_GET['page'] ?? '') == 'homestay' ? 'active' : '' ?>" href="?page=homestay">
                    <i class="bi bi-house"></i> Homestay
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($_GET['page'] ?? '') == 'umkm' ? 'active' : '' ?>" href="?page=umkm">
                    <i class="bi bi-shop"></i> UMKM & Paket Wisata
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= ($_GET['page'] ?? '') == 'profil' ? 'active' : '' ?>" href="?page=profil">
                    <i class="bi bi-person"></i> Profil (Ganti Password)
                </a>
            </li>
        </ul>
        <hr style="border-color: #C9A84C;">
        <div class="mt-3 px-3">
            <a href="logout.php" class="btn w-100" style="background-color: #C9A84C; color: white; font-weight: bold;">Logout</a>
        </div>
    </div>
</nav>

<style>
    /* Sidebar link styles */
    .sidebar .nav-link {
        color: #333;
        padding: 10px 20px;
        border-radius: 0 20px 20px 0;
        margin: 4px 0;
        transition: all 0.3s;
    }
    .sidebar .nav-link i {
        margin-right: 12px;
        color: #2A9D8F;
    }
    .sidebar .nav-link:hover {
        background-color: #e9f5f2;
        color: #2A9D8F;
    }
    .sidebar .nav-link.active {
        background-color: #2A9D8F;
        color: white;
        font-weight: bold;
    }
    .sidebar .nav-link.active i {
        color: white;
    }
</style>