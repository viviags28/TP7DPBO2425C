<h2>Genre List</h2>
<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>ID</th>
    <th>Nama Genre</th>
    <th>Aksi</th>
  </tr>

  <?php if (!empty($genreList)): ?>
    <?php foreach ($genreList as $g): ?>
      <tr>
        <td><?= htmlspecialchars($g['id']) ?></td>
        <td><?= htmlspecialchars($g['nama']) ?></td>
        <td>
          <a href="?page=genre&edit=<?= $g['id'] ?>" class="btn-edit">Edit</a>
          <a href="?page=genre&hapus=<?= $g['id'] ?>" class="btn-delete" onclick="return confirm('Yakin nih mau hapus o(╥﹏╥)?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr><td colspan="3">Belum ada data genre.</td></tr>
  <?php endif; ?>
</table>

<hr>
<h3><?= isset($_GET['edit']) ? 'Edit Genre' : 'Tambah Genre Baru' ?></h3>

<?php
// Proses CRUD
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];

    if (!empty($_POST['id'])) {
        $genreObj->updateGenre($_POST['id'], $nama);
    } else {
        $genreObj->tambahGenre($nama);
    }

    header("Location: ?page=genre");
    exit;
}

if (isset($_GET['hapus'])) {
    $genreObj->deleteGenre($_GET['hapus']);
    header("Location: ?page=genre");
    exit;
}

$editData = null;
if (isset($_GET['edit'])) {
    $editData = $genreObj->getGenreById($_GET['edit']);
}
?>

<form method="post">
  <input type="hidden" name="id" value="<?= htmlspecialchars($editData['id'] ?? '') ?>">

  <label>Nama Genre:</label><br>
  <input type="text" name="nama" value="<?= htmlspecialchars($editData['nama'] ?? '') ?>" required><br><br>

  <button type="submit" name="simpan">Simpan</button>
</form>
