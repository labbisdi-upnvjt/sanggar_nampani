<?php
require BASE_PATH . '/app/views/components/navbar.php';

// Load model
require_once BASE_PATH . '/app/models/UMKM.php';
require_once BASE_PATH . '/app/models/PaketWisata.php';

// Ambil semua data dari database
$umkmList   = UMKM::getAll();
$wisataList = PaketWisata::getAll();

// Hero tetap statis
require BASE_PATH . '/app/views/components/umkm/hero.php';

// Catalog menggunakan data dari database
require BASE_PATH . '/app/views/components/umkm/catalog.php';
?>