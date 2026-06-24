<?php
class Homestay {
    public static function get() {
        global $db;
        $stmt = $db->query("SELECT * FROM homestay LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($data) {
        global $db;
        $stmt = $db->prepare("UPDATE homestay SET nama=?, deskripsi=?, harga=?, gambar_utama=?, fasilitas=?, link_booking=? WHERE id=?");
        return $stmt->execute([$data['nama'], $data['deskripsi'], $data['harga'], $data['gambar_utama'], $data['fasilitas'], $data['link_booking'], $data['id']]);
    }
}
?>