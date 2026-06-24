<?php
class Restoran {
    public static function get() {
        global $db;
        $stmt = $db->query("SELECT * FROM restoran LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function update($data) {
        global $db;
        $stmt = $db->prepare("UPDATE restoran SET deskripsi=?, harga_per_pax=?, include_text=?, gambar_1=?, gambar_2=?, link_info=? WHERE id=?");
        return $stmt->execute([$data['deskripsi'], $data['harga_per_pax'], $data['include_text'], $data['gambar_1'], $data['gambar_2'], $data['link_info'], $data['id']]);
    }
}
?>