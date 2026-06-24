<?php
// Ambil data untuk ditampilkan
require_once BASE_PATH . '/app/models/UMKM.php';
require_once BASE_PATH . '/app/models/PaketWisata.php';

$umkmList = UMKM::getAll();
$wisataList = PaketWisata::getAll();

$editUmkm = null;
if (isset($_GET['edit_umkm'])) {
    $editUmkm = UMKM::getById($_GET['edit_umkm']);
}
$editWisata = null;
if (isset($_GET['edit_wisata'])) {
    $editWisata = PaketWisata::getById($_GET['edit_wisata']);
}
?>
<div class="container-fluid mt-4">
    <h2 class="mb-4">🏪 Kelola UMKM & Paket Wisata</h2>

    <?php if ($flash = flash('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?= $flash ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if ($flash = flash('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <?= $flash ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <!-- ============================================================ -->
    <!-- TABEL UMKM -->
    <!-- ============================================================ -->
    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-warning text-dark fw-bold d-flex justify-content-between align-items-center">
            <span>UMKM</span>
            <button class="btn btn-sm btn-dark" data-bs-toggle="collapse" data-bs-target="#formUmkmCollapse" aria-expanded="false">
                <?= $editUmkm ? '✏️ Edit UMKM' : '➕ Tambah UMKM' ?>
            </button>
        </div>
        <div class="card-body">
            <!-- Form Tambah/Edit UMKM -->
            <div class="collapse <?= $editUmkm ? 'show' : '' ?>" id="formUmkmCollapse">
                <form method="POST" enctype="multipart/form-data" class="mb-4 border p-3 rounded bg-light">
                    <input type="hidden" name="action" value="<?= $editUmkm ? 'edit_umkm' : 'tambah_umkm' ?>">
                    <?php if ($editUmkm): ?>
                        <input type="hidden" name="id_umkm" value="<?= $editUmkm['id'] ?>">
                    <?php endif; ?>
                    <div class="row g-3">
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Nama UMKM</label>
                            <input type="text" name="nama_umkm" class="form-control" required value="<?= htmlspecialchars($editUmkm['nama'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Kategori</label>
                            <input type="text" name="kategori_umkm" class="form-control" value="<?= htmlspecialchars($editUmkm['kategori'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Harga</label>
                            <input type="text" name="harga_umkm" class="form-control" value="<?= htmlspecialchars($editUmkm['harga'] ?? '') ?>">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi_umkm" class="form-control" rows="2"><?= htmlspecialchars($editUmkm['deskripsi'] ?? '') ?></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Gambar</label>
                            <input type="file" name="gambar_umkm" class="form-control" accept="image/*">
                            <?php if ($editUmkm && $editUmkm['gambar']): ?>
                                <div class="mt-2">
                                    <img src="/project_sanggar/public/assets/images/<?= $editUmkm['gambar'] ?>" alt="gambar" style="max-height:60px;">
                                    <small class="d-block text-muted">Kosongkan jika tidak ingin mengganti</small>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-warning fw-bold">
                                <?= $editUmkm ? 'Update UMKM' : 'Simpan UMKM' ?>
                            </button>
                            <?php if ($editUmkm): ?>
                                <a href="?page=umkm" class="btn btn-secondary">Batal</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Daftar UMKM -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($umkmList)): ?>
                            <tr><td colspan="7" class="text-center">Belum ada data UMKM.</td></tr>
                        <?php else: ?>
                            <?php foreach ($umkmList as $idx => $item): ?>
                                <tr>
                                    <td><?= $idx + 1 ?></td>
                                    <td>
                                        <?php if ($item['gambar']): ?>
                                            <img src="/project_sanggar/public/assets/images/<?= $item['gambar'] ?>" style="max-height:50px;" alt="gambar">
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($item['nama']) ?></td>
                                    <td><?= htmlspecialchars($item['kategori']) ?></td>
                                    <td><?= htmlspecialchars($item['harga']) ?></td>
                                    <td><?= nl2br(htmlspecialchars($item['deskripsi'])) ?></td>
                                    <td>
                                        <a href="?page=umkm&edit_umkm=<?= $item['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <form method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus?')">
                                            <input type="hidden" name="action" value="hapus_umkm">
                                            <input type="hidden" name="id_umkm" value="<?= $item['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- ============================================================ -->
    <!-- TABEL PAKET WISATA -->
    <!-- ============================================================ -->
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white fw-bold d-flex justify-content-between align-items-center">
            <span>Paket Wisata</span>
            <button class="btn btn-sm btn-light" data-bs-toggle="collapse" data-bs-target="#formWisataCollapse" aria-expanded="false">
                <?= $editWisata ? '✏️ Edit Wisata' : '➕ Tambah Wisata' ?>
            </button>
        </div>
        <div class="card-body">
            <!-- Form Tambah/Edit Wisata -->
            <div class="collapse <?= $editWisata ? 'show' : '' ?>" id="formWisataCollapse">
                <form method="POST" enctype="multipart/form-data" class="mb-4 border p-3 rounded bg-light">
                    <input type="hidden" name="action" value="<?= $editWisata ? 'edit_wisata' : 'tambah_wisata' ?>">
                    <?php if ($editWisata): ?>
                        <input type="hidden" name="id_wisata" value="<?= $editWisata['id'] ?>">
                    <?php endif; ?>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Nama Paket Wisata</label>
                            <input type="text" name="nama_wisata" class="form-control" required value="<?= htmlspecialchars($editWisata['nama'] ?? '') ?>">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Lokasi</label>
                            <input type="text" name="lokasi_wisata" class="form-control" value="<?= htmlspecialchars($editWisata['lokasi'] ?? '') ?>">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Harga</label>
                            <input type="text" name="harga_wisata" class="form-control" value="<?= htmlspecialchars($editWisata['harga'] ?? '') ?>">
                        </div>
                        <div class="col-md-8">
                            <label class="form-label fw-semibold">Deskripsi</label>
                            <textarea name="deskripsi_wisata" class="form-control" rows="2"><?= htmlspecialchars($editWisata['deskripsi'] ?? '') ?></textarea>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Gambar</label>
                            <input type="file" name="gambar_wisata" class="form-control" accept="image/*">
                            <?php if ($editWisata && $editWisata['gambar']): ?>
                                <div class="mt-2">
                                    <img src="/project_sanggar/public/assets/images/<?= $editWisata['gambar'] ?>" alt="gambar" style="max-height:60px;">
                                    <small class="d-block text-muted">Kosongkan jika tidak ingin mengganti</small>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-12 text-end">
                            <button type="submit" class="btn btn-success fw-bold">
                                <?= $editWisata ? 'Update Wisata' : 'Simpan Wisata' ?>
                            </button>
                            <?php if ($editWisata): ?>
                                <a href="?page=umkm" class="btn btn-secondary">Batal</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </form>
            </div>

            <!-- Daftar Wisata -->
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Gambar</th>
                            <th>Nama</th>
                            <th>Lokasi</th>
                            <th>Harga</th>
                            <th>Deskripsi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($wisataList)): ?>
                            <tr><td colspan="7" class="text-center">Belum ada data Paket Wisata.</td></tr>
                        <?php else: ?>
                            <?php foreach ($wisataList as $idx => $item): ?>
                                <tr>
                                    <td><?= $idx + 1 ?></td>
                                    <td>
                                        <?php if ($item['gambar']): ?>
                                            <img src="/project_sanggar/public/assets/images/<?= $item['gambar'] ?>" style="max-height:50px;" alt="gambar">
                                        <?php else: ?>
                                            <span class="text-muted">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= htmlspecialchars($item['nama']) ?></td>
                                    <td><?= htmlspecialchars($item['lokasi']) ?></td>
                                    <td><?= htmlspecialchars($item['harga']) ?></td>
                                    <td><?= nl2br(htmlspecialchars($item['deskripsi'])) ?></td>
                                    <td>
                                        <a href="?page=umkm&edit_wisata=<?= $item['id'] ?>" class="btn btn-sm btn-primary">Edit</a>
                                        <form method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin hapus?')">
                                            <input type="hidden" name="action" value="hapus_wisata">
                                            <input type="hidden" name="id_wisata" value="<?= $item['id'] ?>">
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>