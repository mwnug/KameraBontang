<?php
include '../config/config.php';
include '../includes/navbar.php';

$report = $conn->query("
    SELECT t.id, c.name AS customer_name, t.total_price, t.rental_start, t.rental_end, t.status
    FROM transactions t
    JOIN customers c ON t.customer_id = c.id
    ORDER BY t.id DESC
");
?>

<div class="container">
    <h2>Laporan Transaksi</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID Transaksi</th>
                <th>Pelanggan</th>
                <th>Total Harga</th>
                <th>Tanggal Rental</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $report->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['customer_name'] ?></td>
                    <td><?= number_format($row['total_price']) ?></td>
                    <td><?= $row['rental_start'] ?> - <?= $row['rental_end'] ?></td>
                    <td><?= $row['status'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
