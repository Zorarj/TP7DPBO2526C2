<?php
// Cek apakah user sedang menekan tombol edit
$editGame = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $editGame = $game->getGamebyId($_GET['id']);
}
?>

<!-- Form Tambah / Edit -->
<h3><?= $editGame ? 'Edit Data Game' : '+ Tambah Game Baru' ?></h3>
<form method="POST" action="index.php">
    <?php if ($editGame): ?>
        <input type="hidden" name="id" value="<?= $editGame['id'] ?>">
    <?php endif; ?>
    
    <div style="margin-bottom: 10px;">
        <label>Judul Game:</label><br>
        <input type="text" name="title" value="<?= $editGame ? $editGame['title'] : '' ?>" required>
    </div>
    <div style="margin-bottom: 10px;">
        <label>Platform:</label><br>
        <input type="text" name="platform" value="<?= $editGame ? $editGame['platform'] : '' ?>" required>
    </div>
    <div style="margin-bottom: 10px;">
        <label>Genre:</label><br>
        <input type="text" name="genre" value="<?= $editGame ? $editGame['genre'] : '' ?>" required>
    </div>
    <div style="margin-bottom: 15px;">
        <label>Stok:</label><br>
        <input type="number" name="stock" value="<?= $editGame ? $editGame['stock'] : '' ?>" required>
    </div>
    
    <?php if ($editGame): ?>
        <button type="submit" name="update_game">Simpan Perubahan</button>
        <a href="?page=games" style="margin-left: 10px; color: red; text-decoration: none;">Batal</a>
    <?php else: ?>
        <button type="submit" name="add_game">Tambah Game</button>
    <?php endif; ?>
</form>

<hr style="margin: 30px 0; border: 1px solid #ddd;">

<h3>Katalog Game Tersedia</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Judul Game</th>
        <th>Platform</th>
        <th>Genre</th>
        <th>Stok Tersedia</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($game->getAllGames() as $g): ?>
    <tr>
        <td><?= $g['id'] ?></td>
        <td><?= $g['title'] ?></td>
        <td><?= $g['platform'] ?></td>
        <td><?= $g['genre'] ?></td>
        <td>
            <?php if ($g['stock'] > 0): ?>
                <span style="color: green; font-weight: bold;"><?= $g['stock'] ?></span>
            <?php else: ?>
                <span style="color: red;">Habis</span>
            <?php endif; ?>
        </td>
        <td>
            <a href="?page=games&action=edit&id=<?= $g['id'] ?>" style="text-decoration:none;">Edit</a> | 
            <a href="?del_game=<?= $g['id'] ?>" style="text-decoration:none; color:red;" onclick="return confirm('Yakin hapus game ini?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>