<?php

/*
|--------------------------------------------------------------------------
| CMS Content Dispatcher
|--------------------------------------------------------------------------
|
| Seluruh proses POST CMS dipusatkan di file ini.
| Setiap halaman hanya bertugas menampilkan form.
|
*/

// Hanya proses POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    return;
}

$page = $_GET['page'] ?? 'dashboard';

// Jangan proses POST untuk halaman login
if ($page === 'login') {
    return;
}

// Helper function for uploading images (untuk dashboard)
function handleCMSUpload(string $key): ?string
{
    if (isset($_FILES[$key]) && $_FILES[$key]['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES[$key]['tmp_name'];
        $fileName = $_FILES[$key]['name'];
        
        $cleanFileName = time() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $fileName);
        
        $uploadFileDir = BASE_PATH . '/public/assets/images/';
        
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }
        
        $dest_path = $uploadFileDir . $cleanFileName;
        
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            return '/project_sanggar/public/assets/images/' . $cleanFileName;
        }
    }
    return null;
}

// Helper untuk upload gambar dengan path lengkap (khusus homestay)
function uploadGambarHomestay($file, $existing = null) {
    if ($file['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $namaBaru = time() . '_' . uniqid() . '.' . $ext;
        $target = BASE_PATH . '/public/assets/images/' . $namaBaru;
        if (move_uploaded_file($file['tmp_name'], $target)) {
            if ($existing && file_exists(BASE_PATH . '/public/assets/images/' . $existing)) {
                unlink(BASE_PATH . '/public/assets/images/' . $existing);
            }
            return '/project_sanggar/public/assets/images/' . $namaBaru;
        }
    }
    return $existing;
}

// ============================================================
// DISPATCH BERDASARKAN PAGE
// ============================================================
switch ($page) {

    // ========================================
    // DASHBOARD
    // ========================================
    case 'dashboard':
        global $db;
        $action = $_POST['action'] ?? '';

        if ($action === 'save_hero') {
            try {
                $stmt = $db->query("SELECT * FROM hero_slides ORDER BY sort_order ASC");
                $slides = $stmt->fetchAll(PDO::FETCH_ASSOC);

                for ($i = 1; $i <= 3; $i++) {
                    $title = trim($_POST['hero_title_' . $i] ?? '');
                    $subtitle = trim($_POST['hero_subtitle_' . $i] ?? '');
                    
                    $uploadedPath = handleCMSUpload('hero_image_' . $i);
                    
                    $image = $uploadedPath;
                    if ($image === null) {
                        $image = $slides[$i - 1]['image'] ?? "/project_sanggar/public/assets/images/dashboard_{$i}.png";
                    }

                    if (isset($slides[$i - 1]['id'])) {
                        $id = $slides[$i - 1]['id'];
                        $stmtUpdate = $db->prepare("UPDATE hero_slides SET title = ?, subtitle = ?, image = ? WHERE id = ?");
                        $stmtUpdate->execute([$title, $subtitle, $image, $id]);
                    } else {
                        $stmtInsert = $db->prepare("INSERT INTO hero_slides (title, subtitle, image, sort_order, is_active) VALUES (?, ?, ?, ?, ?)");
                        $stmtInsert->execute([$title, $subtitle, $image, $i, 1]);
                    }
                }

                $_SESSION['flash_success'] = 'Hero Slider berhasil diperbarui!';
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Gagal menyimpan Hero Slider: ' . $e->getMessage();
            }

        } elseif ($action === 'save_about') {
            try {
                $title = trim($_POST['about_title'] ?? '');
                $description = trim($_POST['about_description'] ?? '');
                
                $stat_1_num = trim($_POST['stat_1_num'] ?? '');
                $stat_1_label = trim($_POST['stat_1_label'] ?? '');
                $stat_2_num = trim($_POST['stat_2_num'] ?? '');
                $stat_2_label = trim($_POST['stat_2_label'] ?? '');

                $stmt = $db->query("SELECT * FROM about LIMIT 1");
                $about = $stmt->fetch(PDO::FETCH_ASSOC);

                $uploadedPath = handleCMSUpload('about_image');
                
                $image = $uploadedPath;
                if ($image === null) {
                    $image = $about['image'] ?? "/project_sanggar/public/assets/images/dashboard_foto_sanggar.png";
                }

                $statistics = json_encode([
                    ['number' => $stat_1_num, 'label' => $stat_1_label],
                    ['number' => $stat_2_num, 'label' => $stat_2_label]
                ]);

                if ($about) {
                    $stmtUpdate = $db->prepare("UPDATE about SET title = ?, description = ?, image = ?, statistics = ? WHERE id = ?");
                    $stmtUpdate->execute([$title, $description, $image, $statistics, $about['id']]);
                } else {
                    $stmtInsert = $db->prepare("INSERT INTO about (title, description, image, statistics) VALUES (?, ?, ?, ?)");
                    $stmtInsert->execute([$title, $description, $image, $statistics]);
                }

                $_SESSION['flash_success'] = 'Komponen Tentang Sanggar berhasil diperbarui!';
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Gagal menyimpan Tentang Sanggar: ' . $e->getMessage();
            }

        } elseif ($action === 'save_sejarah') {
            try {
                $stmt = $db->query("SELECT * FROM timeline ORDER BY sort_order ASC");
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

                for ($i = 1; $i <= 3; $i++) {
                    $year        = trim($_POST['timeline_year_' . $i]        ?? '');
                    $title       = trim($_POST['timeline_title_' . $i]       ?? '');
                    $description = trim($_POST['timeline_description_' . $i] ?? '');

                    $uploadedPath = handleCMSUpload('timeline_image_' . $i);
                    $image = $uploadedPath ?? ($rows[$i - 1]['image'] ?? '');

                    if (isset($rows[$i - 1]['id'])) {
                        $id = $rows[$i - 1]['id'];
                        $stmtU = $db->prepare(
                            "UPDATE timeline SET year = ?, title = ?, description = ?, image = ? WHERE id = ?"
                        );
                        $stmtU->execute([$year, $title, $description, $image, $id]);
                    } else {
                        $stmtI = $db->prepare(
                            "INSERT INTO timeline (year, title, description, image, sort_order, is_active) VALUES (?,?,?,?,?,1)"
                        );
                        $stmtI->execute([$year, $title, $description, $image, $i]);
                    }
                }

                $_SESSION['flash_success'] = 'Sejarah / Timeline berhasil diperbarui!';
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Gagal menyimpan Sejarah: ' . $e->getMessage();
            }

        } elseif ($action === 'save_visi_misi') {
            try {
                $vm_title       = trim($_POST['visi_misi_title']     ?? '');
                $vision_title   = trim($_POST['vision_title']         ?? '');
                $vision_desc    = trim($_POST['vision_description']   ?? '');
                $mission_title  = trim($_POST['mission_title']        ?? '');
                $mission_desc   = trim($_POST['mission_description']  ?? '');

                $stmt = $db->query("SELECT id FROM visi_misi LIMIT 1");
                $existing = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($existing) {
                    $stmtU = $db->prepare(
                        "UPDATE visi_misi SET title = ?, vision_title = ?, visi = ?, mission_title = ?, misi = ? WHERE id = ?"
                    );
                    $stmtU->execute([$vm_title, $vision_title, $vision_desc, $mission_title, $mission_desc, $existing['id']]);
                } else {
                    $stmtI = $db->prepare(
                        "INSERT INTO visi_misi (title, vision_title, visi, mission_title, misi) VALUES (?,?,?,?,?)"
                    );
                    $stmtI->execute([$vm_title, $vision_title, $vision_desc, $mission_title, $mission_desc]);
                }

                $_SESSION['flash_success'] = 'Visi & Misi berhasil diperbarui!';
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Gagal menyimpan Visi & Misi: ' . $e->getMessage();
            }
        }
        break; // AKHIR DASHBOARD

    // ========================================
    // HOMESTAY
    // ========================================
    case 'homestay':
        global $db;
        $action = $_POST['action'] ?? '';

        // --- UPDATE HOMESTAY ---
        if ($action === 'save_homestay') {
            try {
                $id = $_POST['id_homestay'];
                $gambarUtama = uploadGambarHomestay($_FILES['gambar_utama'], $_POST['gambar_utama_existing']);
                $data = [
                    'id' => $id,
                    'nama' => $_POST['nama'],
                    'deskripsi' => $_POST['deskripsi'],
                    'harga' => $_POST['harga'],
                    'gambar_utama' => $gambarUtama,
                    'fasilitas' => $_POST['fasilitas'],
                    'link_booking' => $_POST['link_booking']
                ];
                
                $stmt = $db->prepare("UPDATE homestay SET nama=?, deskripsi=?, harga=?, gambar_utama=?, fasilitas=?, link_booking=? WHERE id=?");
                $result = $stmt->execute([$data['nama'], $data['deskripsi'], $data['harga'], $data['gambar_utama'], $data['fasilitas'], $data['link_booking'], $data['id']]);
                if ($result) {
                    $_SESSION['flash_success'] = 'Homestay berhasil diperbarui!';
                } else {
                    $_SESSION['flash_error'] = 'Gagal memperbarui Homestay.';
                }
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Error: ' . $e->getMessage();
            }
        }

        // --- UPDATE SLIDER ---
        if ($action === 'save_slider') {
            try {
                $ids = $_POST['id_slider'] ?? [];
                $captions = $_POST['caption'] ?? [];
                $gambars = $_FILES['gambar_slider'] ?? [];

                for ($i = 0; $i < count($ids); $i++) {
                    $existing = $_POST['gambar_slider_existing'][$i] ?? null;
                    $gambarBaru = uploadGambarHomestay([
                        'name' => $gambars['name'][$i] ?? '',
                        'tmp_name' => $gambars['tmp_name'][$i] ?? '',
                        'error' => $gambars['error'][$i] ?? UPLOAD_ERR_NO_FILE
                    ], $existing);
                    
                    $stmt = $db->prepare("UPDATE homestay_slider SET gambar=?, caption=? WHERE id=?");
                    $stmt->execute([$gambarBaru, $captions[$i], $ids[$i]]);
                }
                $_SESSION['flash_success'] = 'Slider berhasil diperbarui!';
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Gagal memperbarui slider: ' . $e->getMessage();
            }
        }

        // --- UPDATE RESTORAN ---
        if ($action === 'save_restoran') {
            try {
                $id = $_POST['id_restoran'];
                $gambar1 = uploadGambarHomestay($_FILES['gambar_1'], $_POST['gambar_1_existing']);
                $gambar2 = uploadGambarHomestay($_FILES['gambar_2'], $_POST['gambar_2_existing']);
                $data = [
                    'id' => $id,
                    'deskripsi' => $_POST['deskripsi_resto'],
                    'harga_per_pax' => $_POST['harga_per_pax'],
                    'include_text' => $_POST['include_text'],
                    'gambar_1' => $gambar1,
                    'gambar_2' => $gambar2,
                    'link_info' => $_POST['link_info']
                ];
                
                $stmt = $db->prepare("UPDATE restoran SET deskripsi=?, harga_per_pax=?, include_text=?, gambar_1=?, gambar_2=?, link_info=? WHERE id=?");
                $result = $stmt->execute([$data['deskripsi'], $data['harga_per_pax'], $data['include_text'], $data['gambar_1'], $data['gambar_2'], $data['link_info'], $data['id']]);
                if ($result) {
                    $_SESSION['flash_success'] = 'Restoran berhasil diperbarui!';
                } else {
                    $_SESSION['flash_error'] = 'Gagal memperbarui Restoran.';
                }
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Error: ' . $e->getMessage();
            }
        }
        break; // AKHIR HOMESTAY

    // ========================================
    // KELAS
    // ========================================
    case 'kelas':
        global $db;
        $action = $_POST['action'] ?? '';

        // Fungsi bantu untuk upload file (hanya untuk kelas)
        function uploadKelasFile($fileArray, $prefix = '') {
            if (isset($fileArray['tmp_name']) && $fileArray['error'] === UPLOAD_ERR_OK && !empty($fileArray['tmp_name'])) {
                $ext = pathinfo($fileArray['name'], PATHINFO_EXTENSION);
                $namaBaru = $prefix . '_' . time() . '_' . uniqid() . '.' . $ext;
                $target = BASE_PATH . '/public/assets/images/' . $namaBaru;
                if (move_uploaded_file($fileArray['tmp_name'], $target)) {
                    return '/project_sanggar/public/assets/images/' . $namaBaru;
                }
            }
            return null;
        }

        if ($action === 'save_kelas_hero') {
            try {
                $title = trim($_POST['hero_title'] ?? '');
                $tagline = trim($_POST['hero_tagline'] ?? '');

                $stmt = $db->query("SELECT * FROM kelas_hero LIMIT 1");
                $existing = $stmt->fetch(PDO::FETCH_ASSOC);

                $images = [];
                for ($i = 1; $i <= 4; $i++) {
                    $uploaded = handleCMSUpload('hero_image_' . $i);
                    if ($uploaded) {
                        $images["image_$i"] = $uploaded;
                    } else {
                        $images["image_$i"] = $existing["image_$i"] ?? "/project_sanggar/public/assets/images/bg_hero_kelas_{$i}.png";
                    }
                }

                if ($existing) {
                    $stmt = $db->prepare("UPDATE kelas_hero SET title=?, tagline=?, image_1=?, image_2=?, image_3=?, image_4=? WHERE id=?");
                    $stmt->execute([$title, $tagline, $images['image_1'], $images['image_2'], $images['image_3'], $images['image_4'], $existing['id']]);
                } else {
                    $stmt = $db->prepare("INSERT INTO kelas_hero (title, tagline, image_1, image_2, image_3, image_4) VALUES (?,?,?,?,?,?)");
                    $stmt->execute([$title, $tagline, $images['image_1'], $images['image_2'], $images['image_3'], $images['image_4']]);
                }

                $_SESSION['flash_success'] = 'Hero slider kelas berhasil diperbarui!';
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Gagal menyimpan hero slider: ' . $e->getMessage();
            }

        } elseif ($action === 'save_kelas_list') {
            try {
                $ids = $_POST['id_kelas'] ?? [];
                $namas = $_POST['nama_kelas'] ?? [];
                $jadwal_hari = $_POST['jadwal_hari'] ?? [];
                $jadwal_jam = $_POST['jadwal_jam'] ?? [];
                $links = $_POST['link_daftar'] ?? [];
                $gambars = $_FILES['gambar_kelas'] ?? [];

                $stmt = $db->prepare("UPDATE kelas_list SET nama=?, gambar=?, jadwal_hari=?, jadwal_jam=?, link_daftar=? WHERE id=?");

                for ($i = 0; $i < count($ids); $i++) {
                    $id = $ids[$i];
                    $gambarBaru = null;
                    // Ambil file per indeks
                    $file = [
                        'name' => $gambars['name'][$i] ?? '',
                        'tmp_name' => $gambars['tmp_name'][$i] ?? '',
                        'error' => $gambars['error'][$i] ?? UPLOAD_ERR_NO_FILE
                    ];
                    $uploaded = uploadKelasFile($file, 'kelas_' . $id);
                    if ($uploaded) {
                        $gambarBaru = $uploaded;
                    } else {
                        $stmtOld = $db->prepare("SELECT gambar FROM kelas_list WHERE id=?");
                        $stmtOld->execute([$id]);
                        $gambarBaru = $stmtOld->fetchColumn();
                    }

                    $stmt->execute([$namas[$i], $gambarBaru, $jadwal_hari[$i], $jadwal_jam[$i], $links[$i], $id]);
                }
                $_SESSION['flash_success'] = 'Daftar kelas berhasil diperbarui!';
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Gagal menyimpan daftar kelas: ' . $e->getMessage();
            }

        } elseif ($action === 'save_prestasi') {
            try {
                $judul = $_POST['prestasi_judul'] ?? '';
                $deskripsi = $_POST['prestasi_deskripsi'] ?? '';
                $gambarBaru = null;
                // Upload gambar prestasi
                $uploaded = uploadKelasFile($_FILES['prestasi_gambar'], 'prestasi');
                if ($uploaded) {
                    $gambarBaru = $uploaded;
                }
                $stmt = $db->query("SELECT id, gambar FROM kelas_info WHERE section='prestasi' LIMIT 1");
                $existing = $stmt->fetch(PDO::FETCH_ASSOC);
                if (!$gambarBaru && $existing) {
                    $gambarBaru = $existing['gambar'];
                }

                if ($existing) {
                    $stmtU = $db->prepare("UPDATE kelas_info SET judul=?, deskripsi=?, gambar=? WHERE id=?");
                    $stmtU->execute([$judul, $deskripsi, $gambarBaru, $existing['id']]);
                } else {
                    $stmtI = $db->prepare("INSERT INTO kelas_info (section, judul, deskripsi, gambar) VALUES ('prestasi',?,?,?)");
                    $stmtI->execute([$judul, $deskripsi, $gambarBaru]);
                }
                $_SESSION['flash_success'] = 'Prestasi berhasil diperbarui!';
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Gagal menyimpan prestasi: ' . $e->getMessage();
            }

        } elseif ($action === 'save_pengajar') {
            try {
                $ids = $_POST['id_pengajar'] ?? [];
                $namas = $_POST['nama_pengajar'] ?? [];
                $roles = $_POST['role_pengajar'] ?? [];
                // Proses upload foto pengajar (array)
                $uploadedFiles = [];
                if (isset($_FILES['foto_pengajar'])) {
                    foreach ($_FILES['foto_pengajar']['tmp_name'] as $idx => $tmpName) {
                        if ($_FILES['foto_pengajar']['error'][$idx] === UPLOAD_ERR_OK && !empty($tmpName)) {
                            $file = [
                                'name' => $_FILES['foto_pengajar']['name'][$idx],
                                'tmp_name' => $tmpName,
                                'error' => $_FILES['foto_pengajar']['error'][$idx]
                            ];
                            $uploaded = uploadKelasFile($file, 'pengajar_' . $ids[$idx]);
                            if ($uploaded) {
                                $uploadedFiles[$idx] = $uploaded;
                            }
                        }
                    }
                }

                $stmt = $db->prepare("UPDATE kelas_info SET nama_pengajar=?, role_pengajar=? WHERE id=? AND section='pengajar'");

                for ($i = 0; $i < count($ids); $i++) {
                    // Jika ada file upload, update gambar
                    if (isset($uploadedFiles[$i])) {
                        $stmtFoto = $db->prepare("UPDATE kelas_info SET gambar=? WHERE id=?");
                        $stmtFoto->execute([$uploadedFiles[$i], $ids[$i]]);
                    }
                    $stmt->execute([$namas[$i], $roles[$i], $ids[$i]]);
                }
                $_SESSION['flash_success'] = 'Profil pengajar berhasil diperbarui!';
            } catch (Exception $e) {
                $_SESSION['flash_error'] = 'Gagal menyimpan pengajar: ' . $e->getMessage();
            }
        }
        break; // AKHIR KELAS
    
    // ========================================
    // UMKM & PAKET WISATA
    // ========================================
    case 'umkm':
        require_once BASE_PATH . '/app/models/UMKM.php';
        require_once BASE_PATH . '/app/models/PaketWisata.php';
        global $db;
        $action = $_POST['action'] ?? '';

        // Fungsi upload gambar (kembalikan hanya nama file)
        function uploadUmkmGambar($file, $existing = null) {
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
            return $existing; // jika gagal, pakai gambar lama
        }

        // --- TAMBAH UMKM ---
        if ($action === 'tambah_umkm') {
            $gambar = uploadUmkmGambar($_FILES['gambar_umkm']);
            $data = [
                'nama'      => $_POST['nama_umkm'],
                'deskripsi' => $_POST['deskripsi_umkm'],
                'harga'     => $_POST['harga_umkm'],
                'kategori'  => $_POST['kategori_umkm'],
                'gambar'    => $gambar
            ];
            if (UMKM::insert($data)) {
                $_SESSION['flash_success'] = 'UMKM berhasil ditambahkan.';
            } else {
                $_SESSION['flash_error'] = 'Gagal menambahkan UMKM.';
            }
        }

        // ... (lanjutkan dengan edit, hapus, wisata seperti sebelumnya)

        break; // AKHIR UMKM
    

    // HALAMAN LAIN (hanya list halaman yang tidak ada POST)
    case 'profil':
    case 'pengaturan':
        break;

    default:
        break;
}

/*
|--------------------------------------------------------------------------
| Redirect
|--------------------------------------------------------------------------
*/
$_SESSION['last_page'] = $page;
header('Location: index.php?page=' . $page);
exit;