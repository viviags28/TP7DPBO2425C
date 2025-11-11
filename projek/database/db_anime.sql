CREATE DATABASE db_anime;
USE db_anime;

CREATE TABLE studio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(100) NOT NULL,
    negara VARCHAR(100),
    tahun_berdiri INT
);

-- ========================
-- Tabel Genre
-- ========================
CREATE TABLE genre (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nama VARCHAR(50) NOT NULL
);

-- ========================
-- Tabel Anime
-- ========================
CREATE TABLE anime (
    id INT AUTO_INCREMENT PRIMARY KEY,
    judul VARCHAR(255) NOT NULL,
    tahun_rilis INT,
    deskripsi TEXT,
    id_studio INT,
    FOREIGN KEY (id_studio) REFERENCES studio(id)
);

-- ========================
-- Tabel Relasi Anime ↔ Genre
-- ========================
CREATE TABLE anime_genre (
    id_anime INT NOT NULL,
    id_genre INT NOT NULL,
    PRIMARY KEY (id_anime, id_genre),
    FOREIGN KEY (id_anime) REFERENCES anime(id),
    FOREIGN KEY (id_genre) REFERENCES genre(id)
);

-- ========================
-- Data Awal Studio
-- ========================
INSERT INTO studio (nama, negara, tahun_berdiri) VALUES
('Ufotable', 'Jepang', 2000),
('MAPPA', 'Jepang', 2011),
('Wit Studio', 'Jepang', 2012);

-- ========================
-- Data Awal Genre
-- ========================
INSERT INTO genre (nama) VALUES
('Aksi'),
('Fantasi'),
('Drama'),
('Romansa'),
('Komedi');

-- ========================
-- Data Awal Anime
-- ========================
INSERT INTO anime (judul, tahun_rilis, deskripsi, id_studio) VALUES
('Kimetsu no Yaiba', 2019, 'Petualangan Tanjiro melawan iblis demi menyelamatkan adiknya Nezuko.', 1),
('Shingeki no Kyojin', 2013, 'Pertarungan manusia melawan para Titan untuk bertahan hidup.', 3),
('Jujutsu Kaisen', 2020, 'Yuji Itadori terlibat dunia sihir terkutuk setelah memakan jari Sukuna.', 2),
('Chainsaw Man', 2022, 'Denji, manusia dengan kekuatan gergaji mesin yang memburu iblis.', 2);

-- ========================
-- Data Relasi Anime ↔ Genre
-- ========================
INSERT INTO anime_genre (id_anime, id_genre) VALUES
(1, 1), (1, 2),
(2, 1), (2, 2), (2, 3),
(3, 1), (3, 2),
(4, 1), (4, 3);
