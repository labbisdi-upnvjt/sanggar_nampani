<?php
if (!defined('BASE_PATH')) {
    exit('No direct script access allowed.');
}

$db = $GLOBALS['db'];

// Flash messages
$flash_success = $_SESSION['flash_success'] ?? null;
$flash_error   = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);

// ========================================
// FETCH ALL DATA
// ========================================

// Hero
try {
    $stmt = $db->query("SELECT * FROM kelas_hero LIMIT 1");
    $kelasHero = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $kelasHero = null;
}

// Kelas List
try {
    $stmt = $db->query("SELECT * FROM kelas_list ORDER BY sort_order ASC");
    $listKelas = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $listKelas = [];
}

// Prestasi
try {
    $stmt = $db->query("SELECT * FROM kelas_info WHERE section='prestasi' LIMIT 1");
    $prestasi = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $prestasi = null;
}

// Pengajar
try {
    $stmt = $db->query("SELECT * FROM kelas_info WHERE section='pengajar' ORDER BY sort_order ASC");
    $pengajar = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $pengajar = [];
}

// ========================================
// LAYOUT START
// ========================================
require_once BASE_PATH . '/cms/includes/layout_start.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Editor Halaman Kelas Seni</h2>
    <span class="text-muted">Kelola hero slider, daftar kelas, dan informasi</span>
</div>

<?php if ($flash_success): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($flash_success) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if ($flash_error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($flash_error) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php
// Komponen editor — data sudah tersedia sebagai variabel
require_once BASE_PATH . '/cms/components/kelas/hero.php';
require_once BASE_PATH . '/cms/components/kelas/kelas_list.php';
require_once BASE_PATH . '/cms/components/kelas/kelas_info.php';
?>

<?php require_once BASE_PATH . '/cms/includes/layout_end.php'; ?>