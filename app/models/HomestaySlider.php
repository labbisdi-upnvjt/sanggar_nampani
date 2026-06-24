<?php
class HomestaySlider {
    public static function getAll() {
        global $db;
        $stmt = $db->query("SELECT * FROM homestay_slider ORDER BY sort_order ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function update($id, $data) {
        global $db;
        $stmt = $db->prepare("UPDATE homestay_slider SET gambar=?, caption=? WHERE id=?");
        return $stmt->execute([$data['gambar'], $data['caption'], $id]);
    }
}
?>