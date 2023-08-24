<!DOCTYPE html>
<html>

<head>
    <title>Laporan Transaksi Laundry</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h1>Laporan <?= $judul_laporan ?> Laundry</h1>
    <h3>Tahun: <?= $tahun ?>, Bulan: <?= $bulan ?></h3>
    <table>
        <thead>
            <tr>
                <th>Tanggal Transaksi</th>
                <?php if (strtolower($judul_laporan) != 'pengeluaran') { ?>
                <!-- <th>Member</th> -->
                <?php } ?>
                <th>Pembayaran</th>
                <th>Harga</th>
            </tr>
        </thead>
        <?php if($laporans): ?>
            <?php $total_harga = 0; ?>
            <?php foreach($laporans as $key => $laporan): ?>
                <tbody>
                    <tr>
                        <td><?= date('d/m/Y', strtotime($laporan['waktu_transaksi'])) ?></td>
                        <?php if (strtolower($judul_laporan) != 'pengeluaran') { ?>
                        <!-- <td><?= $laporan['member'] ?></td> -->
                        <?php } ?>
                        <td><?= $laporan['pembayaran'] ?></td>
                        <td><?= $laporan['harga_rupiah'] ?></td>
                    </tr>
                </tbody>
                <?php $total_harga += $laporan['harga']; ?>
            <?php endforeach; ?>
            <tfoot>
                <tr>
                    <th <?php if (strtolower($judul_laporan) != 'pengeluaran') { ?>colspan="2"<?php } else { ?>colspan="2"<?php } ?> style="text-align: right;">Total :</th>
                    <th>Rp.<?= number_format($total_harga,2,',','.') ?></th>
                </tr>
            </tfoot>
        <?php else: ?>
            <tbody>
                <tr>
                    <td colspan="3">Tidak ada Laporan</td>
                </tr>
            </tbody>
        <?php endif; ?>
        <!-- Isi tabel dengan data transaksi sesuai kebutuhan -->
    </table>
</body>

</html>
<script>
    // Fungsi untuk melakukan auto print saat halaman selesai diload
    window.onload = function() {
        window.print();
    };
</script>
