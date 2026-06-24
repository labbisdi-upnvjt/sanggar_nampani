<?php
$resto = $restoran;
?>

<div class="card mb-4 border-0 shadow-sm">
    <div class="card-header bg-danger text-white fw-bold">
        <i class="bi bi-shop"></i> Restoran
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="save_restoran">

            <div class="mb-3">
                <label class="form-label fw-bold">Deskripsi</label>
                <textarea class="form-control" name="resto_deskripsi" rows="4" required><?=
                    htmlspecialchars($resto['deskripsi'] ?? '')
                ?></textarea>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Gambar 1</label>
                    <img src="<?= htmlspecialchars($resto['image_1'] ?? '/project_sanggar/public/assets/images/restoran_1.png') ?>"
                         class="img-thumbnail mb-2 d-block" style="max-height: 150px;">
                    <input type="file" class="form-control" name="resto_image_1" accept="image/*">
                </div>
                <div class="col-md-6">
                    <label class="form-label">Gambar 2</label>
                    <img src="<?= htmlspecialchars($resto['image_2'] ?? '/project_sanggar/public/assets/images/restoran_2.png') ?>"
                         class="img-thumbnail mb-2 d-block" style="max-height: 150px;">
                    <input type="file" class="form-control" name="resto_image_2" accept="image/*">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Harga per Pax</label>
                <input type="text" class="form-control" name="resto_harga"
                       value="<?= htmlspecialchars($resto['harga_per_pax'] ?? '50k') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Include Text</label>
                <input type="text" class="form-control" name="resto_include"
                       value="<?= htmlspecialchars($resto['include_text'] ?? 'Include Minuman, Jajanan Basah, dan berbagai opsi tambahan.') ?>">
            </div>
            <div class="mb-3">
                <label class="form-label">Link Info Lebih Lanjut</label>
                <input type="url" class="form-control" name="resto_link"
                       value="<?= htmlspecialchars($resto['link_info'] ?? 'https://wa.me/6289682008271') ?>">
            </div>

            <button type="submit" class="btn btn-danger fw-bold">
                <i class="bi bi-save"></i> Simpan Restoran
            </button>
        </form>
    </div>
</div>