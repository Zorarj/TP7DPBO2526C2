<h3>Data Transaksi Sewa</h3>
<table>
    <tr>
        <th>ID Sewa</th>
        <th>Judul Game</th>
        <th>Penyewa (Member)</th>
        <th>Tanggal Sewa</th>
        <th>Tanggal Kembali</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($rental->getAllRental() as $r): ?>
    <tr>
        <td><?= $r['id'] ?></td>
        <td><?= $r['title'] ?></td>
        <td><?= $r['nickname'] ?></td>
        <td><?= $r['rent_date'] ?></td>
        <td><?= $r['return_date'] ?? '<span style="color:red;">Belum Kembali</span>' ?></td>
        <td>
            <?php if (!$r['return_date']): ?>
                <!-- Tombol ini akan mengarah ke index.php?return=ID -->
                <a href="?return=<?= $r['id'] ?>" style="color: blue; text-decoration: none;">Kembalikan</a>
            <?php else: ?>
                <span style="color: green;">Selesai</span>
            <?php endif; ?>
            <a href="?del_rental=<?= $r['id'] ?>" style="text-decoration:none; color:red;" onclick="return confirm('Yakin hapus data sewa ini? Jika belum dikembalikan, stok otomatis akan bertambah kembali.')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

<h3>Sewa Game Baru</h3>
<form method="POST" action="index.php">
    <div style="margin-bottom: 10px;">
        <label>Pilih Game:</label><br>
        <select name="game_id" required>
            <option value="">-- Pilih Game --</option>
            <?php foreach ($game->getAllGames() as $g): ?>
                <?php if ($g['stock'] > 0): // Hanya tampilkan yang stoknya ada ?>
                    <option value="<?= $g['id'] ?>"><?= $g['title'] ?> (Stok: <?= $g['stock'] ?>)</option>
                <?php endif; ?>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div style="margin-bottom: 10px;">
        <label>Pilih Member:</label><br>
        <select name="member_id" required>
            <option value="">-- Pilih Member --</option>
            <?php foreach ($member->getAllMembers() as $m): ?>
                <option value="<?= $m['id'] ?>"><?= $m['nickname'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <button type="submit" name="rent" style="padding: 5px 15px; cursor: pointer;">Sewa Sekarang</button>
</form>