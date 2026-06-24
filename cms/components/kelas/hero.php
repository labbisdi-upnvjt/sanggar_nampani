<?php
// Data dari database (sudah diambil di kelas.php)
$hero = $kelasHero; // diassign agar lebih ringkas
?>

<div class="card mb-4 border-0 shadow-sm">
    <div class="card-header bg-warning text-dark fw-bold">
        <i class="bi bi-image"></i> Hero Slider Kelas
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="save_kelas_hero">

            <div class="mb-3">
                <label for="hero_title" class="form-label">Judul Utama</label>
                <input type="text" class="form-control" id="hero_title" name="hero_title"
                       value="<?= htmlspecialchars($hero['title'] ?? 'Kelas Tari Nampani') ?>" required>
            </div>

            <div class="mb-3">
                <label for="hero_tagline" class="form-label">Tagline (pisahkan dengan baris baru untuk dua baris)</label>
                <textarea class="form-control" id="hero_tagline" name="hero_tagline" rows="3" required><?=
                    htmlspecialchars($hero['tagline'] ?? "Meregenerasi Masyarakat Melek Tradisi dan Budaya,\nMelahirkan ratusan insan tari nampani")
                ?></textarea>
                <div class="form-text">Contoh: "Baris pertama\nBaris kedua"</div>
            </div>

            <div class="row">
                <?php for ($i = 1; $i <= 4; $i++): ?>
                    <div class="col-md-3 mb-3">
                        <label class="form-label">Slide <?= $i ?></label>
                        <?php $imageField = 'image_' . $i; ?>
                        <img src="<?= htmlspecialchars($hero[$imageField] ?? "/project_sanggar/public/assets/images/bg_hero_kelas_{$i}.png") ?>"
                             class="img-thumbnail mb-2 d-block" style="max-height: 120px; width: 100%; object-fit: cover;">
                        <input type="file" class="form-control" name="hero_image_<?= $i ?>" accept="image/*">
                        <div class="form-text">Biarkan kosong jika tidak ingin mengganti gambar.</div>
                    </div>
                <?php endfor; ?>
            </div>

            <button type="submit" class="btn btn-warning fw-bold text-dark">
                <i class="bi bi-save"></i> Simpan Hero Slider
            </button>
        </form>
    </div>
</div>