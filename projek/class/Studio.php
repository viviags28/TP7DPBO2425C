<?php
require_once 'config/db.php';

class Studio {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Ambil semua studio
    public function getAllStudio() {
        $stmt = $this->db->prepare("SELECT * FROM studio ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tambah studio baru
    public function tambahStudio($nama, $negara = null, $tahun_berdiri = null) {
        $stmt = $this->db->prepare("INSERT INTO studio (nama, negara, tahun_berdiri) VALUES (?, ?, ?)");
        return $stmt->execute([$nama, $negara, $tahun_berdiri]);
    }
    // Ambil studio by ID
public function getStudioById($id) {
    $stmt = $this->db->prepare("SELECT * FROM studio WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Update studio
public function updateStudio($id, $nama, $negara, $tahun_berdiri) {
    $stmt = $this->db->prepare("UPDATE studio SET nama = ?, negara = ?, tahun_berdiri = ? WHERE id = ?");
    return $stmt->execute([$nama, $negara, $tahun_berdiri, $id]);
}

// Hapus studio
public function hapusStudio($id) {
    $stmt = $this->db->prepare("DELETE FROM studio WHERE id = ?");
    return $stmt->execute([$id]);
}

}
?>
