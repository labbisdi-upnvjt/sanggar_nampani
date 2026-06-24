<?php
global $db;

// Ambil prestasi
$stmt = $db->query("SELECT * FROM kelas_info WHERE section='prestasi' LIMIT 1");
$prestasi = $stmt->fetch(PDO::FETCH_ASSOC);

// Ambil pengajar
$stmt = $db->query("SELECT * FROM kelas_info WHERE section='pengajar' ORDER BY sort_order ASC");
$pengajar = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Default jika kosong
if (!$prestasi) {
    $prestasi = [
        'judul' => 'Prestasi & Penghargaan',
        'deskripsi' => 'Sanggar Tari Nampani telah melahirkan berbagai penari berbakat yang berhasil meraih penghargaan pada tingkat daerah maupun nasional. Prestasi tersebut menjadi bukti komitmen sanggar dalam melestarikan budaya sekaligus mencetak generasi muda yang berkarakter.',
        'gambar' => '/project_sanggar/public/assets/images/prestasi_penghargaan.png'
    ];
}

if (empty($pengajar)) {
    $pengajar = [
        ['nama_pengajar' => 'Dicky Hadi Awokaw', 'role_pengajar' => 'Alumni FLS2N 2025, Medali Perak'],
        ['nama_pengajar' => 'Annisa Zahra\'', 'role_pengajar' => 'Remaja Penggiat Tarian Adat'],
        ['nama_pengajar' => 'Tonny Harjono', 'role_pengajar' => 'Sinden Senior']
    ];
}
?>
<section class="pb-5">
    <div class="container">
        <div class="row g-4">
            <!-- PRESTASI -->
            <div class="col-lg-6">
                <div class="info-card">
                    <div class="info-title-wrapper">
                        <h2 class="info-title"><?= htmlspecialchars($prestasi['judul']) ?></h2>
                    </div>
                    <div class="row align-items-center g-3">
                        <div class="col-md-6">
                            <img src="<?= htmlspecialchars($prestasi['gambar']) ?>" alt="Prestasi" class="prestasi-image">
                        </div>
                        <div class="col-md-6">
                            <p class="prestasi-text"><?= nl2br(htmlspecialchars($prestasi['deskripsi'])) ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PENGAJAR -->
            <div class="col-lg-6">
                <div class="info-card">
                    <div class="info-title-wrapper">
                        <h2 class="info-title">Profil Pengajar & Tim</h2>
                    </div>
                    <div class="row text-center">
                        <?php foreach ($pengajar as $p): ?>
                            <div class="col-4">
                                <?php if (!empty($p['gambar'])): ?>
                                    <img src="<?= htmlspecialchars($p['gambar']) ?>" 
                                        alt="<?= htmlspecialchars($p['nama_pengajar']) ?>" 
                                        class="mentor-photo" 
                                        style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; margin-bottom: 8px;">
                                <?php else: ?>
                                    <div class="mentor-photo" style="width: 80px; height: 80px; border-radius: 50%; background: #ccc; margin: 0 auto 8px;"></div>
                                <?php endif; ?>
                                <h6 class="mentor-name"><?= htmlspecialchars($p['nama_pengajar']) ?></h6>
                                <p class="mentor-role"><?= nl2br(htmlspecialchars($p['role_pengajar'])) ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
</section>