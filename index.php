<?php
require_once 'class/Games.php';
require_once 'class/Members.php';
require_once 'class/Rentals.php';

$game = new Games();
$member = new Members();
$rental = new Rentals();

// Proses aksi sewa dan kembali
if (isset($_POST['rent'])) {
    $rental->rentGame($_POST['member_id'], $_POST['game_id']);
    header("Location: ?page=rentals"); 
    exit;
}
if (isset($_GET['return'])) {
    $rental->returnGame($_GET['return']);
    header("Location: ?page=rentals");
    exit;
}
if (isset($_GET['del_rental'])) {
    $rental->delRental($_GET['del_rental']);
    header("Location: ?page=rentals"); exit;
}

if (isset($_POST['add_game'])) {
    $game->addGame($_POST['title'], $_POST['platform'], $_POST['genre'], $_POST['stock']);
    header("Location: ?page=games"); exit;
}
if (isset($_POST['update_game'])) {
    $game->updateGame($_POST['id'], $_POST['title'], $_POST['platform'], $_POST['genre'], $_POST['stock']);
    header("Location: ?page=games"); exit;
}
if (isset($_GET['del_game'])) {
    $game->delGame($_GET['del_game']);
    header("Location: ?page=games"); exit;
}

// --- PROSES CRUD MEMBERS ---
if (isset($_POST['add_member'])) {
    $member->addMember($_POST['nickname'], $_POST['email'], $_POST['phone']);
    header("Location: ?page=members"); exit;
}
if (isset($_POST['update_member'])) {
    $member->updateMember($_POST['id'], $_POST['nickname'], $_POST['email'], $_POST['phone']);
    header("Location: ?page=members"); exit;
}
if (isset($_GET['del_member'])) {
    $member->delMember($_GET['del_member']);
    header("Location: ?page=members"); exit;
}

// --- PROSES RENTALS ---
if (isset($_POST['rent'])) {
    $rental->rentGame($_POST['member_id'], $_POST['game_id']);
    header("Location: ?page=rentals"); exit;
}
if (isset($_GET['return'])) {
    $rental->returnGame($_GET['return']);
    header("Location: ?page=rentals"); exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Game Rental System</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Game Rental Management System</h1>
    </header>

    <main>
        <nav>
            <a href="?page=games">Katalog Game</a>
            <a href="?page=members">Daftar Member</a>
            <a href="?page=rentals">Transaksi Sewa</a>
        </nav>
        
        <?php
        $page = isset($_GET['page']) ? $_GET['page'] : 'games'; 
        
        if ($page == 'games') include 'view/games.php';
        elseif ($page == 'members') include 'view/members.php';
        elseif ($page == 'rentals') include 'view/rentals.php';
        ?>
    </main>

    <footer>
        <p>&copy; 2026 Game Rental System - Zora</p>
    </footer>
</body>
</html>