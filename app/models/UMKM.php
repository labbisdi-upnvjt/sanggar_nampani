<?php
class UMKM {
    public static function getAll() {
        global $db;
        $stmt = $db->query("SELECT * FROM umkm ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getById($id) {
        global $db;
        $stmt = $db->prepare("SELECT * FROM umkm WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function insert($data) {
        global $db;
        $stmt = $db->prepare("INSERT INTO umkm (nama, deskripsi, harga, gambar, kategori) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$data['nama'], $data['deskripsi'], $data['harga'], $data['gambar'], $data['kategori']]);
    }

    public static function update($id, $data) {
        global $db;
        $stmt = $db->prepare("UPDATE umkm SET nama=?, deskripsi=?, harga=?, gambar=?, kategori=? WHERE id=?");
        return $stmt->execute([$data['nama'], $data['deskripsi'], $data['harga'], $data['gambar'], $data['kategori'], $id]);
    }

    public static function delete($id) {
        global $db;
        $stmt = $db->prepare("DELETE FROM umkm WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>