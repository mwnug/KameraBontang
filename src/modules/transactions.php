if (isset($_GET['confirm'])) {
    $id = $_GET['confirm'];
    $conn->query("UPDATE transactions SET status='active' WHERE id=$id");
    header('Location: transactions.php');
    exit;
}
<a href="?confirm=<?= $row['id'] ?>" class="btn btn-primary btn-sm">Konfirmasi</a>
