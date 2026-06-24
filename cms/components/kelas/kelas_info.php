<?php
// Variabel $prestasi dan $pengajar sudah diambil dari kelas.php
?>

<!-- Bagian Prestasi -->
<div class="card mb-4 border-0 shadow-sm">
    <div class="card-header bg-info text-white fw-bold">
        <i class="bi bi-trophy"></i> Prestasi & Penghargaan
    </div>
    <div class="card-body">
        <?php if ($prestasi): ?>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save_prestasi">
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Judul</label>
                    <input type="text" class="form-control" name="prestasi_judul"
                           value="<?= htmlspecialchars($prestasi['judul']) ?>" required>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Deskripsi</label>
                    <textarea class="form-control" name="prestasi_deskripsi" rows="5" required><?=
                        htmlspecialchars($prestasi['deskripsi'])
                    ?></textarea>
                </div>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Gambar Prestasi</label>
                    <?php if (!empty($prestasi['gambar'])): ?>
                        <div class="mb-2">
                            <img src="<?= htmlspecialchars($prestasi['gambar']) ?>" 
                                 class="img-thumbnail" style="max-height: 150px;">
                        </div>
                    <?php endif; ?>
                    <input type="file" class="form-control" name="prestasi_gambar" accept="image/*">
                    <small class="text-muted">Upload gambar baru untuk mengganti yang lama</small>
                </div>
                
                <button type="submit" class="btn btn-info text-white fw-bold">
                    <i class="bi bi-save"></i> Simpan Prestasi
                </button>
            </form>
        <?php else: ?>
            <div class="alert alert-warning">Data prestasi belum tersedia.</div>
        <?php endif; ?>
    </div>
</div>

<!-- Bagian Pengajar -->
<div class="card mb-4 border-0 shadow-sm">
    <div class="card-header bg-primary text-white fw-bold">
        <i class="bi bi-people"></i> Profil Pengajar & Tim
    </div>
    <div class="card-body">
        <?php if (!empty($pengajar)): ?>
            <form method="POST" enctype="multipart/form-data">
                <input type="hidden" name="action" value="save_pengajar">
                
                <?php foreach ($pengajar as $index => $p): ?>
                    <div class="row mb-3 align-items-end border-bottom pb-3">
                        <div class="col-md-4">
                            <label class="form-label fw-bold">Nama Pengajar</label>
                            <input type="text" class="form-control" name="nama_pengajar[]"
                                   value="<?= htmlspecialchars($p['nama_pengajar']) ?>" required>
                        </div>
                        <div class="col-md-5">
                            <label class="form-label fw-bold">Role / Prestasi</label>
                            <input type="text" class="form-control" name="role_pengajar[]"
                                   value="<?= htmlspecialchars($p['role_pengajar']) ?>" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold">Foto (opsional)</label>
                            <input type="file" class="form-control" name="foto_pengajar[]" accept="image/*">
                        </div>
                        <input type="hidden" name="id_pengajar[]" value="<?= $p['id'] ?>">
                    </div>
                <?php endforeach; ?>
                
                <button type="submit" class="btn btn-primary fw-bold">
                    <i class="bi bi-save"></i> Simpan Pengajar
                </button>
            </form>
        <?php else: ?>
            <div class="alert alert-warning">Data pengajar belum tersedia.</div>
        <?php endif; ?>
    </div>
</div>