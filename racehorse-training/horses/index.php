<?php
require '../includes/auth_check.php';
require '../config/db.php';
include '../includes/header.php';

$stmt = $pdo->query("
    SELECT h.*, 
           u1.username AS added_by_name,
           u2.username AS updated_by_name
    FROM horses h
    LEFT JOIN users u1 ON h.added_by = u1.id
    LEFT JOIN users u2 ON h.last_updated_by = u2.id
    ORDER BY h.id DESC
");
$horses = $stmt->fetchAll();
?>

<div class="container">
    <h2>All Racehorses </h2>
    <a href="create.php" class="btn">+ Register New Horse</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Owner</th>
            <th>Breed</th>
            <th>Age</th>
            <th>Added By</th>
            <th>Last Updated By</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($horses as $h): ?>
        <tr>
            <td><?= $h['id'] ?></td>
            <td><?= htmlspecialchars($h['name']) ?></td>
            <td><?= htmlspecialchars($h['owner_name']) ?></td>
            <td><?= htmlspecialchars($h['breed']) ?></td>
            <td><?= $h['age'] ?></td>
            <td><?= htmlspecialchars($h['added_by_name'] ?? '—') ?></td>
            <td><?= htmlspecialchars($h['updated_by_name'] ?? '—') ?></td>
            <td>
                <a href="view.php?id=<?= $h['id'] ?>">View Courses</a> |
                <a href="edit.php?id=<?= $h['id'] ?>">Edit</a> |
                <a href="delete.php?id=<?= $h['id'] ?>" onclick="return confirm('Delete this horse and all its courses?')">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>

<?php include '../includes/footer.php'; ?>