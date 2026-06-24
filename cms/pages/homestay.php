<?php
// ============================================================
// Halaman Homestay - hanya tampilan, POST ditangani di content.php
// ============================================================
require_once BASE_PATH . '/app/models/Homestay.php';
require_once BASE_PATH . '/app/models/HomestaySlider.php';
require_once BASE_PATH . '/app/models/Restoran.php';

// --- Ambil data untuk ditampilkan ---
$homestay = Homestay::get();
$sliders = HomestaySlider::getAll();
$restoran = Restoran::get();

// Flash messages
$flash_success = $_SESSION['flash_success'] ?? null;
$flash_error   = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);
?>
<div class="container-fluid mt-4">
    <h2 class="mb-4">🏠 Kelola Homestay & Restoran</h2>

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

    <!-- ============================================================ -->
    <!-- EDIT HOMESTAY -->
    <!-- ============================================================ -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-warning text-dark fw-bold">
            Detail Homestay
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save_homestay">
                <input type="hidden" name="id_homestay" value="<?= $homestay['id'] ?? '' ?>">
                <input type="hidden" name="gambar_utama_existing" value="<?= $homestay['gambar_utama'] ?? '' ?>">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nama Homestay</label>
                        <input type="text" name="nama" class="form-control" required value="<?= htmlspecialchars($homestay['nama'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Harga (Rp)</label>
                        <input type="text" name="harga" class="form-control" value="<?= htmlspecialchars($homestay['harga'] ?? '') ?>">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Deskripsi</label>
                        <textarea name="deskripsi" class="form-control" rows="3"><?= htmlspecialchars($homestay['deskripsi'] ?? '') ?></textarea>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label fw-semibold">Fasilitas (pisahkan dengan koma)</label>
                        <input type="text" name="fasilitas" class="form-control" value="<?= htmlspecialchars($homestay['fasilitas'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Link Booking</label>
                        <input type="url" name="link_booking" class="form-control" value="<?= htmlspecialchars($homestay['link_booking'] ?? '') ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-semibold">Gambar Utama</label>
                        <input type="file" name="gambar_utama" class="form-control" accept="image/*">
                        <?php if (!empty($homestay['gambar_utama'])): ?>
                            <div class="mt-2">
                                <img src="<?= $homestay['gambar_utama'] ?>" style="max-height:80px;">
                                <small class="d-block text-muted">Kosongkan jika tidak ingin mengganti</small>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-warning fw-bold">Simpan Homestay</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- EDIT SLIDER -->
    <!-- ============================================================ -->
    <div class="card shadow-sm mb-5">
        <div class="card-header bg-primary text-white fw-bold">
            Slider Interior (3 gambar)
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save_slider">

                <?php foreach ($sliders as $index => $slide): ?>
                    <input type="hidden" name="id_slider[]" value="<?= $slide['id'] ?>">
                    <input type="hidden" name="gambar_slider_existing[]" value="<?= $slide['gambar'] ?? '' ?>">
                    <div class="row g-3 align-items-center border-bottom pb-3 mb-3">
                        <div class="col-md-3">
                            <label class="form-label fw-semibold">Gambar <?= $index+1 ?></label>
                            <input type="file" name="gambar_slider[]" class="form-control" accept="image/*">
                            <?php if (!empty($slide['gambar'])): ?>
                                <img src="<?= $slide['gambar'] ?>" style="max-height:60px; margin-top:5px;">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-9">
                            <label class="form-label fw-semibold">Caption</label>
                            <input type="text" name="caption[]" class="form-control" value="<?= htmlspecialchars($slide['caption'] ?? '') ?>">
                        </div>
                    </div>
                <?php endforeach; ?>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary fw-bold">Simpan Slider</button>
                </div>
            </form>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- EDIT RESTORAN -->
    <!-- ============================================================ -->
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white fw-bold">
            Restoran
        </div>
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save_restoran">
                <input type="hidden" name="id_restoran" value="<?= $restoran['id'] ?? '' ?>">
                <input type="hidden" name="gambar_1_existing" value="<?= $restoran['gambar_1'] ?? '' ?>">
                <input type="hidden" name="gambar_2_existing" value="<?= $restoran['gambar_2'] ?? '' ?>">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Harga per Pax</label>
                        <input type="text" name="harga_per_pax" class="form-control" value="<?= htmlspecialchars($restoran['harga_per_pax'] ?? '') ?>">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Include Text</label>
                        <input type="text" name="include_text" class="form-control" value="<?= htmlspecialchars($restoran['include_text'] ?? '') ?>">
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Deskripsi Restoran</label>
                        <textarea name="deskripsi_resto" class="form-control" rows="3"><?= htmlspecialchars($restoran['deskripsi'] ?? '') ?></textarea>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Gambar 1</label>
                        <input type="file" name="gambar_1" class="form-control" accept="image/*">
                        <?php if (!empty($restoran['gambar_1'])): ?>
                            <img src="<?= $restoran['gambar_1'] ?>" style="max-height:60px; margin-top:5px;">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Gambar 2</label>
                        <input type="file" name="gambar_2" class="form-control" accept="image/*">
                        <?php if (!empty($restoran['gambar_2'])): ?>
                            <img src="<?= $restoran['gambar_2'] ?>" style="max-height:60px; margin-top:5px;">
                        <?php endif; ?>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label fw-semibold">Link Info</label>
                        <input type="url" name="link_info" class="form-control" value="<?= htmlspecialchars($restoran['link_info'] ?? '') ?>">
                    </div>
                </div>
                <div class="text-end mt-3">
                    <button type="submit" class="btn btn-success fw-bold">Simpan Restoran</button>
                </div>
            </form>
        </div>
    </div>
</div>