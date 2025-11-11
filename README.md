# Janji 

Saya Vivi Agustina Suryana dengan NIM 2400456 mengerjakan Tugas Praktikum 7 dalam mata kuliah Desain dan Pemrograman Berorientasi Objek Untuk keberkahan-Nya, maka saya tidak melakukan kecurangan seperti yang telah dispesifikasikan.

# Deskripsi

Program ini adalah sistem katalog anime sederhana berbasis PHP Native dengan konsep Object-Oriented Programming (OOP). 
Program ini memungkinkan pengguna untuk mengelola data Anime, Studio, dan Genre melalui fitur CRUD (Create, Read, Update, Delete).

# Struktur Folder

<img width="556" height="410" alt="image" src="https://github.com/user-attachments/assets/24c70904-58f5-4050-9418-457ec97e67b7" />


# Erd

<img width="733" height="222" alt="2  ERD" src="https://github.com/user-attachments/assets/803b3dbe-d452-47fa-859e-92b6c6595bd2" />


# Fitur Utama

- Anime
  Tambah anime baru dengan studio dan beberapa genre
- Edit atau hapus data anime
  Tampilkan daftar anime lengkap dengan studio dan genre-nya
- Studio
  Tambah, edit, hapus, dan lihat daftar studio
- Genre
  Tambah, edit, hapus, dan lihat daftar genre

#  Flow Program
1. index.php menampilkan navigasi ke halaman Anime, Studio, dan Genre.
2. Tiap halaman memanggil class OOP sesuai entitasnya.
3. Database connection dilakukan lewat file config/db.php menggunakan PDO dan prepared statement.
4. Setiap aksi (Tambah/Edit/Hapus) dijalankan lewat form yang mengirim data ke file yang sama.
5. Setelah aksi berhasil, halaman akan otomatis refresh ke daftar data.

# Cara Menjalankan
1. Import file db_anime.sql ke phpMyAdmin.
2. Pastikan file config/db.php berisi konfigurasi database yang sesuai.
3. Jalankan server lokal (misal XAMPP / Laragon).
4. Buka browser dan akses index.php

# Dokumentasi


https://github.com/user-attachments/assets/d11731d6-04f7-444b-9cba-5425b13b7a2e





