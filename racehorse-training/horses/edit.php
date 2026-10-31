<?php
require '../includes/auth_check.php';
require '../config/db.php';

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM horses WHERE id = ?");
$stmt->execute([$id]);
$horse = $stmt->fetch();
if (!$horse) { die("Horse not found"); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("UPDATE horses
        SET name=?, owner_name=?, breed=?, age=?, last_updated_by=?, last_updated=NOW()
        WHERE id=?");
    $stmt->execute([
        $_POST['name'], $_POST['owner_name'], $_POST['breed'], $_POST['age'],
        $_SESSION['user_id'], $id
    ]);
    header("Location: index.php");
    exit;
}

include '../includes/header.php';
?>
<div class="container">
    <h2>Edit Racehorse</h2>
    <form method="post">
        <label>Horse Name</label>
        <input type="text" name="name" value="<?= htmlspecialchars($horse['name']) ?>" required>
        <label>Owner Name</label>
        <input type="text" name="owner_name" value="<?= htmlspecialchars($horse['owner_name']) ?>" required>
        <label>Breed</label>
        <input type="text" name="breed" value="<?= htmlspecialchars($horse['breed']) ?>">
        <label>Age</label>
        <input type="number" name="age" value="<?= $horse['age'] ?>" min="1">
        <button type="submit">Update Horse</button>
        <a href="index.php">Cancel</a>
    </form>
</div>
<?php include '../includes/footer.php'; ?>