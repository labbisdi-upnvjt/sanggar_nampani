<?php
class PaketWisata {
    public static function getAll() {
        global $db;
        $stmt = $db->query("SELECT * FROM paket_wisata ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM paket_wisata WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function insert($data) {
        global $db;
        $stmt = $db->prepare("INSERT INTO paket_wisata (nama, deskripsi, harga, gambar, lokasi) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$data['nama'], $data['deskripsi'], $data['harga'], $data['gambar'], $data['lokasi']]);
    }

    public static function update($id, $data) {
        global $db;
        $stmt = $db->prepare("UPDATE paket_wisata SET nama=?, deskripsi=?, harga=?, gambar=?, lokasi=? WHERE id=?");
        return $stmt->execute([$data['nama'], $data['deskripsi'], $data['harga'], $data['gambar'], $data['lokasi'], $id]);
    }

    public static function delete($id) {
        global $db;
        $stmt = $db->prepare("DELETE FROM paket_wisata WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>