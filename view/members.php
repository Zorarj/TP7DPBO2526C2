<?php
$editMember = null;
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $editMember = $member->getMemberById($_GET['id']);
}
?>

<h3><?= $editMember ? 'Edit Data Member' : '+ Tambah Member Baru' ?></h3>
<form method="POST" action="index.php">
    <?php if ($editMember): ?>
        <input type="hidden" name="id" value="<?= $editMember['id'] ?>">
    <?php endif; ?>
    
    <div style="margin-bottom: 10px;">
        <label>Nickname:</label><br>
        <input type="text" name="nickname" value="<?= $editMember ? $editMember['nickname'] : '' ?>" required>
    </div>
    <div style="margin-bottom: 10px;">
        <label>Email:</label><br>
        <input type="email" name="email" value="<?= $editMember ? $editMember['email'] : '' ?>" required>
    </div>
    <div style="margin-bottom: 15px;">
        <label>No. HP:</label><br>
        <input type="text" name="phone" value="<?= $editMember ? $editMember['phone'] : '' ?>" required>
    </div>
    
    <?php if ($editMember): ?>
        <button type="submit" name="update_member">Simpan Perubahan</button>
        <a href="?page=members" style="margin-left: 10px; color: red; text-decoration: none;">Batal</a>
    <?php else: ?>
        <button type="submit" name="add_member">Tambah Member</button>
    <?php endif; ?>
</form>

<hr style="margin: 30px 0; border: 1px solid #ddd;">

<h3>Daftar Member</h3>
<table>
    <tr>
        <th>ID</th>
        <th>Nickname</th>
        <th>Email</th>
        <th>No. HP</th>
        <th>Aksi</th>
    </tr>
    <?php foreach ($member->getAllMembers() as $m): ?>
    <tr>
        <td><?= $m['id'] ?></td>
        <td><?= $m['nickname'] ?></td>
        <td><?= $m['email'] ?></td>
        <td><?= $m['phone'] ?></td>
        <td>
            <a href="?page=members&action=edit&id=<?= $m['id'] ?>" style="text-decoration:none;">Edit</a> | 
            <a href="?del_member=<?= $m['id'] ?>" style="text-decoration:none; color:red;" onclick="return confirm('Yakin hapus member ini?')">Hapus</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>