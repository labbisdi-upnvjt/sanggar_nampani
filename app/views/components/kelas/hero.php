<?php
// Ambil data hero dari database
global $db;
$stmt = $db->query("SELECT * FROM kelas_hero LIMIT 1");
$hero = $stmt->fetch(PDO::FETCH_ASSOC);

// Jika tidak ada data, gunakan default
if (!$hero) {
    $hero = [
        'title' => 'Kelas Tari Nampani',
        'tagline' => "Meregenerasi Masyarakat Melek Tradisi dan Budaya,\nMelahirkan ratusan insan tari nampani",
        'image_1' => '/project_sanggar/public/assets/images/bg_hero_kelas_1.png',
        'image_2' => '/project_sanggar/public/assets/images/bg_hero_kelas_2.png',
        'image_3' => '/project_sanggar/public/assets/images/bg_hero_kelas_3.png',
        'image_4' => '/project_sanggar/public/assets/images/bg_hero_kelas_4.png'
    ];
}

$images = [
    $hero['image_1'],
    $hero['image_2'],
    $hero['image_3'],
    $hero['image_4']
];
$taglines = explode("\n", $hero['tagline']);
?>
<section class="py-4">
    <div class="container">
        <!-- Tombol Kembali -->
        <div class="mb-3">
            <a href="?page=dashboard" class="btn btn-light rounded-pill px-4 py-2 border border-warning border-3 fw-semibold shadow">← Kembali</a>
        </div>

        <div id="kelasHeroSlider" class="carousel slide overflow-hidden position-relative" style="border: 8px solid #FFDD00; border-radius: 16px;" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($images as $index => $img): ?>
                    <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                        <div class="kelas-slide" style="background: linear-gradient(rgba(0,0,0,.40), rgba(0,0,0,.40)), url('<?= htmlspecialchars($img) ?>'); background-size: cover; background-position: center; height: 400px;">
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Overlay Text -->
            <div class="kelas-caption">
                <h1 class="kelas-title"><?= htmlspecialchars($hero['title']) ?></h1>
                <div class="kelas-tagline">
                    <?php foreach ($taglines as $line): ?>
                        <h3><?= htmlspecialchars(trim($line)) ?></h3>
                    <?php endforeach; ?>
                </div>
            </div>

            <!-- Navigation -->
            <button class="carousel-control-prev" type="button" data-bs-target="#kelasHeroSlider" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#kelasHeroSlider" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Pastikan Bootstrap Carousel diinisialisasi
        var carouselElement = document.querySelector('#kelasHeroSlider');
        if (carouselElement) {
            // Inisialisasi carousel jika belum
            var carousel = new bootstrap.Carousel(carouselElement, {
                interval: 5000,
                ride: 'carousel'
            });
            
            // Pastikan tombol berfungsi (fallback)
            var prevBtn = carouselElement.querySelector('.carousel-control-prev');
            var nextBtn = carouselElement.querySelector('.carousel-control-next');
            
            if (prevBtn && !prevBtn.hasAttribute('data-bs-slide')) {
                prevBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    carousel.prev();
                });
            }
            if (nextBtn && !nextBtn.hasAttribute('data-bs-slide')) {
                nextBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    carousel.next();
                });
            }
        }
    });
    </script>
    
</section>