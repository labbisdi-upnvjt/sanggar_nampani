<?php
require_once BASE_PATH . '/app/models/Homestay.php';
$homestay = Homestay::get();
if (!$homestay) {
    echo '<div class="container"><p class="text-center">Data homestay belum tersedia.</p></div>';
    return;
}
$fasilitas = array_map('trim', explode(',', $homestay['fasilitas'] ?? ''));
?>
<section class="py-4">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="section-title">Homestay</h2>
            <p class="section-description">Tersedia berbagai pilihan akomodasi untuk menikmati keindahan alam Banyuwangi, dengan akses dekat dari berbagai destinasi wisata dan kuliner khas Osing.</p>
        </div>

        <div class="homestay-card mb-4">
            <div class="row g-0">
                <div class="col-lg-4">
                    <img src="<?= $homestay['gambar_utama'] ?>" class="homestay-image" alt="<?= htmlspecialchars($homestay['nama']) ?>">
                </div>
                <div class="col-lg-8">
                    <div class="p-4">
                        <h3 class="fw-bold"><?= htmlspecialchars($homestay['nama']) ?></h3>
                        <p class="text-muted"><?= nl2br(htmlspecialchars($homestay['deskripsi'])) ?></p>
                        <div class="row">
                            <div class="col-md-4">
                                <small>Mulai Harga :</small>
                                <h1 class="harga-homestay">Rp. <?= number_format($homestay['harga'], 0, ',', '.') ?>,-</h1>
                            </div>
                            <div class="col-md-5">
                                <strong>Included</strong>
                                <ul class="list-unstyled mt-2">
                                    <?php foreach ($fasilitas as $item): ?>
                                        <li><?= htmlspecialchars($item) ?></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <a href="<?= htmlspecialchars($homestay['link_booking']) ?>" target="_blank" class="btn-booking">Booking Sekarang</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>