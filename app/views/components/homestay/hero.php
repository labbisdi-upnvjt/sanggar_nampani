<?php
require_once BASE_PATH . '/app/models/HomestaySlider.php';
$sliders = HomestaySlider::getAll();
?>
<section class="py-3">
    <div class="container">
        <div id="homestayHeroSlider" class="carousel slide overflow-hidden position-relative" style="border:4px solid #F1D400; border-radius:24px;" data-bs-ride="carousel">
            <!-- Tombol Kembali -->
            <div class="position-absolute top-0 start-0 m-3 z-3">
                <a href="?page=dashboard" class="btn btn-light rounded-pill px-4 border border-warning border-3 fw-semibold">← Kembali</a>
            </div>

            <div class="carousel-inner">
                <?php foreach ($sliders as $index => $slide): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="homestay-slide" style="background: linear-gradient(rgba(0,0,0,.30), rgba(0,0,0,.30)), url('<?= $slide['gambar'] ?>'); background-size: cover; background-position: center; background-repeat: no-repeat; height: 500px;">
                        </div>
                        <?php if (!empty($slide['caption'])): ?>
                            <div class="carousel-caption d-none d-md-block">
                                <h5><?= htmlspecialchars($slide['caption']) ?></h5>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#homestayHeroSlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#homestayHeroSlider" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
            <div class="homestay-caption">
                <h1 class="homestay-title">Homestay & Resto</h1>
                <p class="homestay-subtitle">By Sanggar Nampani</p>
            </div>
        </div>
    </div>
</section>