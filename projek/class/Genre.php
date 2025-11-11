<?php
require_once 'config/db.php';

class Genre {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Ambil semua genre
    public function getAllGenre() {
        $stmt = $this->db->prepare("SELECT * FROM genre ORDER BY id ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ambil 1 genre berdasarkan ID
    public function getGenreById($id) {
        $stmt = $this->db->prepare("SELECT * FROM genre WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tambah genre baru
    public function tambahGenre($nama) {
        $stmt = $this->db->prepare("INSERT INTO genre (nama) VALUES (?)");
        return $stmt->execute([$nama]);
    }

    // Update genre
    public function updateGenre($id, $nama) {
        $stmt = $this->db->prepare("UPDATE genre SET nama = ? WHERE id = ?");
        return $stmt->execute([$nama, $id]);
    }

    // Hapus genre
    public function deleteGenre($id) {
        $stmt = $this->db->prepare("DELETE FROM genre WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
?>
