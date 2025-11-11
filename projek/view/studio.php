<h2>Studio List</h2>
<table border="1" cellpadding="8" cellspacing="0">
  <tr>
    <th>ID</th>
    <th>Nama Studio</th>
    <th>Negara</th>
    <th>Tahun Berdiri</th>
    <th>Aksi</th>
  </tr>

  <?php if (!empty($studioList)): ?>
    <?php foreach ($studioList as $s): ?>
      <tr>
        <td><?= htmlspecialchars($s['id']) ?></td>
        <td><?= htmlspecialchars($s['nama']) ?></td>
        <td><?= htmlspecialchars($s['negara'] ?? '-') ?></td>
        <td><?= htmlspecialchars($s['tahun_berdiri'] ?? '-') ?></td>
        <td>
          <a href="?page=studio&edit=<?= $s['id'] ?>" class="btn-edit">Edit</a>
          <a href="?page=studio&hapus=<?= $s['id'] ?>" class="btn-delete" onclick="return confirm('Yakin nih mau hapus o(╥﹏╥)?')">Hapus</a>
        </td>
      </tr>
    <?php endforeach; ?>
  <?php else: ?>
    <tr><td colspan="5">Belum ada data studio.</td></tr>
  <?php endif; ?>
</table>

<hr>
<h3><?= isset($_GET['edit']) ? 'Edit Studio' : 'Tambah Studio Baru' ?></h3>

<?php
if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $negara = $_POST['negara'];
    $tahun = $_POST['tahun_berdiri'];

    if (!empty($_POST['id'])) {
        $studioObj->updateStudio($_POST['id'], $nama, $negara, $tahun);
    } else {
        $studioObj->tambahStudio($nama, $negara, $tahun);
    }
    header("Location: ?page=studio");
    exit;
}

if (isset($_GET['hapus'])) {
    $studioObj->hapusStudio($_GET['hapus']);
    header("Location: ?page=studio");
    exit;
}

$editData = null;
if (isset($_GET['edit'])) {
    $editData = $studioObj->getStudioById($_GET['edit']);
}
?>

<form method="post">
  <input type="hidden" name="id" value="<?= htmlspecialchars($editData['id'] ?? '') ?>">

  <label>Nama Studio:</label><br>
  <input type="text" name="nama" value="<?= htmlspecialchars($editData['nama'] ?? '') ?>" required><br><br>

  <label>Negara:</label><br>
  <input type="text" name="negara" value="<?= htmlspecialchars($editData['negara'] ?? '') ?>"><br><br>

  <label>Tahun Berdiri:</label><br>
  <input type="number" name="tahun_berdiri" value="<?= htmlspecialchars($editData['tahun_berdiri'] ?? '') ?>"><br><br>

  <button type="submit" name="simpan">Simpan</button>
</form>
