<?php
$hero = $homestayHero;
?>

<div class="card mb-4 border-0 shadow-sm">
    <div class="card-header bg-warning text-dark fw-bold">
        <i class="bi bi-image"></i> Hero Slider Homestay
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="save_homestay_hero">

            <div class="mb-3">
                <label class="form-label">Judul Utama</label>
                <input type="text" class="form-control" name="hero_title"
                       value="<?= htmlspecialchars($hero['title'] ?? 'Homestay & Resto') ?>" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Subtitle</label>
                <input type="text" class="form-control" name="hero_subtitle"
                       value="<?= htmlspecialchars($hero['subtitle'] ?? 'By Sanggar Nampani') ?>" required>
            </div>

            <div class="row">
                <?php for ($i = 1; $i <= 3; $i++): ?>
                <div class="col-md-4 mb-3">
                    <label class="form-label">Slide <?= $i ?></label>
                    <img src="<?= htmlspecialchars($hero["image_$i"] ?? "/project_sanggar/public/assets/images/homestay_background_{$i}.png") ?>"
                         class="img-thumbnail mb-2 d-block" style="max-height: 120px; width: 100%; object-fit: cover;">
                    <input type="file" class="form-control" name="hero_image_<?= $i ?>" accept="image/*">
                </div>
                <?php endfor; ?>
            </div>

            <button type="submit" class="btn btn-warning fw-bold text-dark">
                <i class="bi bi-save"></i> Simpan Hero Slider
            </button>
        </form>
    </div>
</div>