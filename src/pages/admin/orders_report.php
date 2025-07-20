<?php
session_start();
if (!isset($_SESSION['admin'])) {
    header("Location: /src/pages/auth/admin_login.php");
    exit();
}
require_once __DIR__ . '/../../config/db.php';
require_once __DIR__ . '/../../includes/header.php';

$result = $conn->query("SELECT o.*, u.username AS user_name, i.nama_barang 
                        FROM orders o 
                        JOIN users u ON o.user_id = u.id 
                        JOIN items i ON o.item_id = i.id 
                        ORDER BY o.created_at DESC");
?>

<div class="container mt-5">
    <h2 class="mb-4">Laporan Penyewaan</h2>
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama Pengguna</th>
                <th>Barang</th>
                <th>Tanggal Sewa</th>
                <th>Lama Sewa (hari)</th>
                <th>Total Bayar</th>
                <th>Waktu Pesan</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            while ($row = $result->fetch_assoc()) :
            ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['user_name']) ?></td>
                    <td><?= htmlspecialchars($row['nama_barang']) ?></td>
                    <td><?= htmlspecialchars($row['tanggal_sewa']) ?></td>
                    <td><?= $row['lama_sewa'] ?></td>
                    <td>Rp<?= number_format($row['total_bayar'], 0, ',', '.') ?></td>
                    <td><?= $row['created_at'] ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php require_once __DIR__ . '/../../includes/footer.php'; ?>
