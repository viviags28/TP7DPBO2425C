<?php
require_once 'config/db.php';

class Anime {
    private $db;

    public function __construct() {
        $this->db = (new Database())->conn;
    }

    // Ambil semua anime beserta nama studio dan daftar genre (gabungan)
    public function getAllAnime() {
        $query = "
            SELECT 
                a.id,
                a.judul,
                a.deskripsi,
                a.tahun_rilis,
                s.nama AS nama_studio,
                GROUP_CONCAT(g.nama SEPARATOR ', ') AS genre
            FROM anime a
            LEFT JOIN studio s ON a.id_studio = s.id
            LEFT JOIN anime_genre ag ON a.id = ag.id_anime
            LEFT JOIN genre g ON ag.id_genre = g.id
            GROUP BY a.id, a.judul, a.deskripsi, a.tahun_rilis, s.nama
            ORDER BY a.id ASC
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Tambah anime.
    public function tambahAnime($judul, $deskripsi, $tahun_rilis, $id_studio = null, $genre_ids = []) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("INSERT INTO anime (judul, deskripsi, tahun_rilis, id_studio) VALUES (?, ?, ?, ?)");
            $stmt->execute([$judul, $deskripsi, $tahun_rilis, $id_studio]);
            $anime_id = $this->db->lastInsertId();

            if (!empty($genre_ids)) {
                $stmtRel = $this->db->prepare("INSERT INTO anime_genre (id_anime, id_genre) VALUES (?, ?)");
                foreach ($genre_ids as $gid) {
                    $stmtRel->execute([$anime_id, $gid]);
                }
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

    //Ambil anime by id
    public function getAnimeById($id) {
        $stmt = $this->db->prepare("SELECT * FROM anime WHERE id = ?");
        $stmt->execute([$id]);
        $anime = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($anime) {
            // ambil genre list sebagai array
            $stmt2 = $this->db->prepare("SELECT g.id, g.nama FROM genre g JOIN anime_genre ag ON g.id = ag.id_genre WHERE ag.id_anime = ?");
            $stmt2->execute([$id]);
            $anime['genres'] = $stmt2->fetchAll(PDO::FETCH_ASSOC);
        }
        return $anime;
    }

    // Update anime dan relasi genre (genre_ids boleh array kosong)

    public function updateAnime($id, $judul, $deskripsi, $tahun_rilis, $id_studio = null, $genre_ids = []) {
        try {
            $this->db->beginTransaction();

            $stmt = $this->db->prepare("UPDATE anime SET judul = ?, deskripsi = ?, tahun_rilis = ?, id_studio = ? WHERE id = ?");
            $stmt->execute([$judul, $deskripsi, $tahun_rilis, $id_studio, $id]);

            // update relasi genre: hapus dulu semua lalu insert ulang
            $del = $this->db->prepare("DELETE FROM anime_genre WHERE id_anime = ?");
            $del->execute([$id]);

            if (!empty($genre_ids)) {
                $ins = $this->db->prepare("INSERT INTO anime_genre (id_anime, id_genre) VALUES (?, ?)");
                foreach ($genre_ids as $gid) {
                    $ins->execute([$id, $gid]);
                }
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }

   // Hapus anime beserta relasi
    public function hapusAnime($id) {
        try {
            $this->db->beginTransaction();
            $stmt1 = $this->db->prepare("DELETE FROM anime_genre WHERE id_anime = ?");
            $stmt1->execute([$id]);

            $stmt2 = $this->db->prepare("DELETE FROM anime WHERE id = ?");
            $res = $stmt2->execute([$id]);

            $this->db->commit();
            return $res;
        } catch (Exception $e) {
            $this->db->rollBack();
            return false;
        }
    }
}
?>
