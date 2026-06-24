<section class="pb-5">
    <div class="container">
        <div class="row g-4">
            <!-- UMKM -->
            <div class="col-lg-6">
                <div class="umkm-panel">
                    <h2 class="umkm-panel-title">UMKM</h2>
                    <?php if (empty($umkmList)): ?>
                        <p class="text-center text-muted">Belum ada data UMKM.</p>
                    <?php else: ?>
                        <?php foreach ($umkmList as $item): ?>
                            <div class="umkm-item">
                                <img
                                    src="/project_sanggar/public/assets/images/<?= htmlspecialchars($item['gambar'] ?: 'default.png') ?>"
                                    alt="<?= htmlspecialchars($item['nama']) ?>"
                                    class="umkm-image"
                                >
                                <div class="umkm-content">
                                    <h3><?= htmlspecialchars($item['nama']) ?></h3>
                                    <p><?= htmlspecialchars($item['deskripsi']) ?></p>
                                    <h4>Rp <?= number_format($item['harga'], 0, ',', '.') ?></h4>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- PAKET WISATA -->
            <div class="col-lg-6">
                <div class="umkm-panel">
                    <h2 class="umkm-panel-title">Paket Wisata</h2>
                    <?php if (empty($wisataList)): ?>
                        <p class="text-center text-muted">Belum ada paket wisata.</p>
                    <?php else: ?>
                        <?php foreach ($wisataList as $item): ?>
                            <div class="wisata-item">
                                <!-- Satu gambar per paket (lebar penuh) -->
                                <div class="row g-3">
                                    <div class="col-12">
                                        <img
                                            src="/project_sanggar/public/assets/images/<?= htmlspecialchars($item['gambar'] ?: 'default.png') ?>"
                                            class="wisata-image w-100"
                                            alt="<?= htmlspecialchars($item['nama']) ?>"
                                        >
                                    </div>
                                </div>
                                <h3 class="wisata-title"><?= htmlspecialchars($item['nama']) ?></h3>
                                <p class="wisata-location"><?= htmlspecialchars($item['lokasi']) ?></p>
                                <!-- Harga tidak ditampilkan sesuai desain awal, 
                                     tetapi bisa ditambahkan jika diperlukan -->
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>