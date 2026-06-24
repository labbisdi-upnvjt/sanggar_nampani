<?php
if (!defined('BASE_PATH')) {
    exit('No direct script access allowed.');
}

/*
|--------------------------------------------------------------------------
| GLOBAL DB STABILIZATION
|--------------------------------------------------------------------------
*/
$db = $GLOBALS['db'];

/*
|--------------------------------------------------------------------------
| FLASH MESSAGE HANDLING
|--------------------------------------------------------------------------
*/
$flash_success = $_SESSION['flash_success'] ?? null;
$flash_error   = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);

/*
|--------------------------------------------------------------------------
| DATA FETCHING
|--------------------------------------------------------------------------
*/

// Hero slides
try {
    $stmt = $db->query("SELECT * FROM hero_slides ORDER BY sort_order ASC");
    $hero = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $hero = [];
}

// About
try {
    $stmt = $db->query("SELECT * FROM about LIMIT 1");
    $about = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($about && !empty($about['statistics'])) {
        $about['statistics'] = json_decode($about['statistics'], true);
    }
} catch (Exception $e) {
    $about = null;
}

// Timeline
try {
    $stmt = $db->query("SELECT * FROM timeline ORDER BY sort_order ASC");
    $timeline = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $timeline = [];
}

// Visi Misi
try {
    $stmt = $db->query("SELECT * FROM visi_misi LIMIT 1");
    $vm = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($vm) {
        $visionMission = [
            'title'         => $vm['title'],
            'vision'        => [
                'title'       => $vm['vision_title'],
                'description' => $vm['visi']
            ],
            'mission'       => [
                'title'       => $vm['mission_title'],
                'description' => $vm['misi']
            ]
        ];
    } else {
        $visionMission = null;
    }
} catch (Exception $e) {
    $visionMission = null;
}

/*
|--------------------------------------------------------------------------
| LAYOUT START
|--------------------------------------------------------------------------
*/
require_once BASE_PATH . '/cms/includes/layout_start.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold mb-0">Dashboard Editor</h2>
    <span class="text-muted">Edit Homepage Components</span>
</div>

<?php if ($flash_success): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($flash_success); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if ($flash_error): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= htmlspecialchars($flash_error); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php
/*
|--------------------------------------------------------------------------
| CMS COMPONENTS
|--------------------------------------------------------------------------
*/
require_once BASE_PATH . '/cms/components/hero_editor.php';
require_once BASE_PATH . '/cms/components/tentang_editor.php';
require_once BASE_PATH . '/cms/components/sejarah_editor.php';
require_once BASE_PATH . '/cms/components/visi_misi_editor.php';

/*
|--------------------------------------------------------------------------
| LAYOUT END
|--------------------------------------------------------------------------
*/
require_once BASE_PATH . '/cms/includes/layout_end.php';