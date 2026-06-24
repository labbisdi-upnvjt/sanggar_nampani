<?php
// Variabel $listKelas sudah diambil dari kelas.php
if (empty($listKelas)) {
    echo '<div class="alert alert-warning">Belum ada data kelas. Silakan tambahkan melalui database.</div>';
    return;
}
?>

<div class="card mb-4 border-0 shadow-sm">
    <div class="card-header bg-success text-white fw-bold">
        <i class="bi bi-list-ul"></i> Daftar Kelas (3 Kategori)
    </div>
    <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
            <input type="hidden" name="action" value="save_kelas_list">

            <?php foreach ($listKelas as $index => $kelas): ?>
                <div class="row mb-4 align-items-end border-bottom pb-3">
                    <!-- Gambar -->
                    <div class="col-md-2 text-center">
                        <label class="form-label fw-bold">Gambar</label>
                        <img src="<?= htmlspecialchars($kelas['gambar']) ?>" 
                             class="img-thumbnail mb-2 d-block mx-auto" 
                             style="max-height: 100px; width: auto;">
                        <input type="file" class="form-control form-control-sm" 
                               name="gambar_kelas[]" accept="image/*">
                        <small class="text-muted">Biarkan kosong jika tidak diganti</small>
                    </div>
                    
                    <!-- Data -->
                    <div class="col-md-3">
                        <label class="form-label">Nama Kelas</label>
                        <input type="text" class="form-control" name="nama_kelas[]"
                               value="<?= htmlspecialchars($kelas['nama']) ?>" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Hari</label>
                        <input type="text" class="form-control" name="jadwal_hari[]"
                               value="<?= htmlspecialchars($kelas['jadwal_hari']) ?>" required>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Jam</label>
                        <input type="text" class="form-control" name="jadwal_jam[]"
                               value="<?= htmlspecialchars($kelas['jadwal_jam']) ?>" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Link Daftar (WA)</label>
                        <input type="url" class="form-control" name="link_daftar[]"
                               value="<?= htmlspecialchars($kelas['link_daftar']) ?>">
                    </div>
                    
                    <input type="hidden" name="id_kelas[]" value="<?= $kelas['id'] ?>">
                </div>
            <?php endforeach; ?>

            <button type="submit" class="btn btn-success fw-bold">
                <i class="bi bi-save"></i> Simpan Daftar Kelas
            </button>
        </form>
    </div>
</div>