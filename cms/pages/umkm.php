<?php
// ============================================================
// Handle CRUD actions (POST)
// ============================================================
require_once BASE_PATH . '/app/models/UMKM.php';
require_once BASE_PATH . '/app/models/PaketWisata.php';

$message = '';
$messageType = '';

// --- Helper upload gambar ---
function uploadGambar($file, $existing = null) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $namaBaru = time() . '_' . uniqid() . '.' . $ext;
        $target = BASE_PATH . '/public/assets/images/' . $namaBaru;
        if (move_uploaded_file($file['tmp_name'], $target)) {
            // hapus gambar lama jika ada
            if ($existing && file_exists(BASE_PATH . '/public/assets/images/' . $existing)) {
                unlink(BASE_PATH . '/public/assets/images/' . $existing);
            }
            return $namaBaru;
        }
    }
    return $existing; // jika gagal upload, tetap pakai gambar lama
}

// --- Handle POST actions ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // --- TAMBAH UMKM ---
    if (isset($_POST['action']) && $_POST['action'] === 'tambah_umkm') {
        $gambar = uploadGambar($_FILES['gambar_umkm']);
        $data = [
            'nama'      => $_POST['nama_umkm'],
            'deskripsi' => $_POST['deskripsi_umkm'],
            'harga'     => $_POST['harga_umkm'],
            'kategori'  => $_POST['kategori_umkm'],
            'gambar'    => $gambar
        ];
        if (UMKM::insert($data)) {
            $message = 'UMKM berhasil ditambahkan.';
            $messageType = 'success';
        } else {
            $message = 'Gagal menambahkan UMKM.';
            $messageType = 'danger';
        }
    }

    // --- EDIT UMKM ---
    if (isset($_POST['action']) && $_POST['action'] === 'edit_umkm') {
        $id = $_POST['id_umkm'];
        $existing = UMKM::getById($id);
        $gambar = uploadGambar($_FILES['gambar_umkm'], $existing['gambar']);
        $data = [
            'nama'      => $_POST['nama_umkm'],
            'deskripsi' => $_POST['deskripsi_umkm'],
            'harga'     => $_POST['harga_umkm'],
            'kategori'  => $_POST['kategori_umkm'],
            'gambar'    => $gambar
        ];
        if (UMKM::update($id, $data)) {
            $message = 'UMKM berhasil diperbarui.';
            $messageType = 'success';
        } else {
            $message = 'Gagal memperbarui UMKM.';
            $messageType = 'danger';
        }
    }

    // --- HAPUS UMKM ---
    if (isset($_POST['action']) && $_POST['action'] === 'hapus_umkm') {
        $id = $_POST['id_umkm'];
        $existing = UMKM::getById($id);
        if (UMKM::delete($id)) {
            if ($existing['gambar'] && file_exists(BASE_PATH . '/public/assets/images/' . $existing['gambar'])) {
                unlink(BASE_PATH . '/public/assets/images/' . $existing['gambar']);
            }
            $message = 'UMKM berhasil dihapus.';
            $messageType = 'success';
        } else {
            $message = 'Gagal menghapus UMKM.';
            $messageType = 'danger';
        }
    }

    // --- TAMBAH PAKET WISATA ---
    if (isset($_POST['action']) && $_POST['action'] === 'tambah_wisata') {
        $gambar = uploadGambar($_FILES['gambar_wisata']);
        $data = [
            'nama'      => $_POST['nama_wisata'],
            'deskripsi' => $_POST['deskripsi_wisata'],
            'harga'     => $_POST['harga_wisata'],
            'lokasi'    => $_POST['lokasi_wisata'],
            'gambar'    => $gambar
        ];
        if (PaketWisata::insert($data)) {
            $message = 'Paket Wisata berhasil ditambahkan.';
            $messageType = 'success';
        } else {
            $message = 'Gagal menambahkan Paket Wisata.';
            $messageType = 'danger';
        }
    }

    // --- EDIT PAKET WISATA ---
    if (isset($_POST['action']) && $_POST['action'] === 'edit_wisata') {
        $id = $_POST['id_wisata'];
        $existing = PaketWisata::getById($id);
        $gambar = uploadGambar($_FILES['gambar_wisata'], $existing['gambar']);
        $data = [
            'nama'      => $_POST['nama_wisata'],
            'deskripsi' => $_POST['deskripsi_wisata'],
            'harga'     => $_POST['harga_wisata'],
            'lokasi'    => $_POST['lokasi_wisata'],
            'gambar'    => $gambar
        ];
        if (PaketWisata::update($id, $data)) {
            $message = 'Paket Wisata berhasil diperbarui.';
            $messageType = 'success';
        } else {
            $message = 'Gagal memperbarui Paket Wisata.';
            $messageType = 'danger';
        }
    }

    // --- HAPUS PAKET WISATA ---
    if (isset($_POST['action']) && $_POST['action'] === 'hapus_wisata') {
        $id = $_POST['id_wisata'];
        $existing = PaketWisata::getById($id);
        if (PaketWisata::delete($id)) {
            if ($existing['gambar'] && file_exists(BASE_PATH . '/public/assets/images/' . $existing['gambar'])) {
                unlink(BASE_PATH . '/public/assets/images/' . $existing['gambar']);
            }
            $message = 'Paket Wisata berhasil dihapus.';
            $messageType = 'success';
        } else {
            $message = 'Gagal menghapus Paket Wisata.';
            $messageType = 'danger';
        }
    }
}

// --- Ambil data untuk ditampilkan ---
$umkmList = UMKM::getAll();
$wisataList = PaketWisata::getAll();

// --- Untuk edit, kita cek parameter GET ---
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

    <?php if ($message): ?>
        <div class="alert alert-<?= $messageType ?> alert-dismissible fade show" role="alert">
            <?= $message ?>
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