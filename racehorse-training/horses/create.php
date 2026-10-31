<?php
require '../includes/auth_check.php';
require '../config/db.php';
include '../includes/header.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $stmt = $pdo->prepare("INSERT INTO horses (name, owner_name, breed, age, added_by, last_updated_by) 
                           VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_POST['name'],
        $_POST['owner_name'],
        $_POST['breed'],
        $_POST['age'],
        $_SESSION['user_id'],
        $_SESSION['user_id']
    ]);
    header("Location: index.php");
    exit;
}
?>

<div class="container">
    <h2>Register New Racehorse</h2>
    <form method="post">
        <label>Horse Name</label>
        <input type="text" name="name" required>

        <label>Owner Name</label>
        <input type="text" name="owner_name" required>

        <label>Breed</label>
        <input type="text" name="breed">

        <label>Age</label>
        <input type="number" name="age" min="1">

        <button type="submit">Register Horse</button>
        <a href="index.php">Cancel</a>
    </form>
</div>

<?php include '../includes/footer.php'; ?>