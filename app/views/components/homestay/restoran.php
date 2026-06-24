<?php
require_once BASE_PATH . '/app/models/Restoran.php';
$restoran = Restoran::get();
if (!$restoran) {
    echo '<div class="container"><p class="text-center">Data restoran belum tersedia.</p></div>';
    return;
}
?>
<section class="pb-5">
    <div class="container">
        <div class="text-center mb-2">
            <h2 class="section-title">Restoran</h2>
            <p class="section-description"><?= nl2br(htmlspecialchars($restoran['deskripsi'])) ?></p>
        </div>
        <div class="row g-4 mb-4">
            <div class="col-md-6">
                <img src="<?= $restoran['gambar_1'] ?>" class="restoran-image" alt="Restoran">
            </div>
            <div class="col-md-6">
                <img src="<?= $restoran['gambar_2'] ?>" class="restoran-image" alt="Restoran">
            </div>
        </div>
        <div class="text-center">
            <div class="restoran-price-box">
                <small>Start From :</small>
                <h1><?= $restoran['harga_per_pax'] ?> / pax</h1>
                <p><?= nl2br(htmlspecialchars($restoran['include_text'])) ?></p>
            </div>
            <a href="<?= htmlspecialchars($restoran['link_info']) ?>" target="_blank" class="btn-booking mt-3">Info Lebih Lanjut</a>
        </div>
    </div>
</section>