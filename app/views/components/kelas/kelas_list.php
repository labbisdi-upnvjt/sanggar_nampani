<?php
// Ambil data kelas dari database
global $db;
$stmt = $db->query("SELECT * FROM kelas_list ORDER BY sort_order ASC");
$kelasList = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Jika kosong, gunakan data default (agar tidak error)
if (empty($kelasList)) {
    $kelasList = [
        ['nama' => 'Anak-anak', 'gambar' => 'kelas_anak.png', 'jadwal_hari' => 'Setiap Minggu', 'jadwal_jam' => '16:00 WIB', 'link_daftar' => 'https://wa.me/6289682008271'],
        ['nama' => 'Remaja', 'gambar' => 'kelas_remaja.png', 'jadwal_hari' => 'Setiap Minggu', 'jadwal_jam' => '16:00 WIB', 'link_daftar' => 'https://wa.me/6289682008271'],
        ['nama' => 'Dewasa', 'gambar' => 'kelas_dewasa.png', 'jadwal_hari' => 'Setiap Minggu', 'jadwal_jam' => '16:00 WIB', 'link_daftar' => 'https://wa.me/6289682008271']
    ];
}
?>
<section class="py-4">
    <div class="container">
        <div class="row g-4">
            <?php foreach ($kelasList as $kelas): ?>
                <div class="col-lg-4">
                    <div class="kelas-card">
                        <div class="row g-0 align-items-center">
                            <div class="col-5">
                                <?php 
                                // Jika gambar sudah berupa path lengkap, gunakan langsung, jika tidak tambahkan prefix
                                $gambar = $kelas['gambar'];
                                if (strpos($gambar, 'http') === false && strpos($gambar, '/') !== 0) {
                                    $gambar = '/project_sanggar/public/assets/images/' . $gambar;
                                }
                                ?>
                                <img src="<?= htmlspecialchars($gambar) ?>" alt="<?= htmlspecialchars($kelas['nama']) ?>" class="kelas-card-image">
                            </div>
                            <div class="col-7">
                                <div class="kelas-card-content">
                                    <h2 class="kelas-card-title">Kelas<br><?= htmlspecialchars($kelas['nama']) ?></h2>
                                    <p class="kelas-card-schedule"><?= htmlspecialchars($kelas['jadwal_hari']) ?></p>
                                    <p class="kelas-card-time"><?= htmlspecialchars($kelas['jadwal_jam']) ?></p>
                                    <a href="<?= htmlspecialchars($kelas['link_daftar']) ?>" target="_blank" class="kelas-btn">
                                        Daftar Sekarang
                                        <img src="/project_sanggar/public/assets/images/vector.png" alt="Whatsapp" class="kelas-btn-icon" style="width: 30px; height: 30px;">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>