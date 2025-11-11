<h2>Anime List</h2>
<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>ID</th>
    <th>Judul</th>
    <th>Deskripsi</th>
    <th>Studio</th>
    <th>Genre</th>
    <th>Tahun Rilis</th>
    <th>Aksi</th>
  </tr>

  <?php if (!empty($animeList)): ?>
    <?php foreach ($animeList as $anime): ?>
      <tr>
        <td><?= htmlspecialchars($anime['id']) ?></td>
        <td><?= htmlspecialchars($anime['judul']) ?></td>
        <td><?= htmlspecialchars($anime['deskripsi']) ?></td>
        <td><?= htmlspecialchars($anime['nama_studio'] ?? '-') ?></td>
        <td><?= htmlspecialchars($anime['genre'] ?? '-') ?></td>
        <td><?= htmlspecialchars($anime['tahun_rilis']) ?></td>
        <td>
  <a href="?page=anime&edit=<?= $anime['id'] ?>" class="btn-edit">Edit</a>
  <a href="?page=anime&hapus=<?= $anime['id'] ?>" class="btn-delete" onclick="return confirm('Yakin nih mau hapus o(╥﹏╥)?')">Hapus</a>
</td>

    <?php endforeach; ?>
  <?php else: ?>
    <tr><td colspan="7">Belum ada data anime.</td></tr>
  <?php endif; ?>
</table>

<hr>
<h3><?= isset($_GET['edit']) ? 'Edit Anime' : 'Tambah Anime Baru' ?></h3>

<?php
// logic CRUD
if (isset($_POST['simpan'])) {
    $judul = $_POST['judul'];
    $deskripsi = $_POST['deskripsi'];
    $tahun = $_POST['tahun_rilis'];
    $studio = $_POST['id_studio'] ?: null;
    $genres = $_POST['genre_ids'] ?? [];

    if (!empty($_POST['id'])) {
        $animeObj->updateAnime($_POST['id'], $judul, $deskripsi, $tahun, $studio, $genres);
    } else {
        $animeObj->tambahAnime($judul, $deskripsi, $tahun, $studio, $genres);
    }
    header("Location: ?page=anime");
    exit;
}

if (isset($_GET['hapus'])) {
    $animeObj->hapusAnime($_GET['hapus']);
    header("Location: ?page=anime");
    exit;
}

$editData = null;
if (isset($_GET['edit'])) {
    $editData = $animeObj->getAnimeById($_GET['edit']);
}
?>

<form method="post">
  <input type="hidden" name="id" value="<?= htmlspecialchars($editData['id'] ?? '') ?>">

  <label>Judul:</label><br>
  <input type="text" name="judul" value="<?= htmlspecialchars($editData['judul'] ?? '') ?>" required><br><br>

  <label>Deskripsi:</label><br>
  <textarea name="deskripsi" rows="3" cols="40"><?= htmlspecialchars($editData['deskripsi'] ?? '') ?></textarea><br><br>

  <label>Tahun Rilis:</label><br>
  <input type="number" name="tahun_rilis" value="<?= htmlspecialchars($editData['tahun_rilis'] ?? '') ?>" required><br><br>

  <label>Studio:</label><br>
  <select name="id_studio">
    <option value="">-- Pilih Studio --</option>
    <?php foreach ($studioList as $s): ?>
      <option value="<?= $s['id'] ?>" <?= isset($editData['id_studio']) && $editData['id_studio'] == $s['id'] ? 'selected' : '' ?>>
        <?= htmlspecialchars($s['nama']) ?>
      </option>
    <?php endforeach; ?>
  </select><br><br>

  <label>Genre:</label><br>
  <?php
  $selectedGenres = isset($editData['genres']) ? array_column($editData['genres'], 'id') : [];
  foreach ($genreList as $g):
  ?>
    <label>
      <input type="checkbox" name="genre_ids[]" value="<?= $g['id'] ?>"
        <?= in_array($g['id'], $selectedGenres) ? 'checked' : '' ?>>
      <?= htmlspecialchars($g['nama']) ?>
    </label><br>
  <?php endforeach; ?>

  <br>
  <button type="submit" name="simpan">Simpan</button>
</form>
