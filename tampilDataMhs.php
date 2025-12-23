<?php
    include "koneksi.php";
    $data = mysqli_query($koneksi, "SELECT * FROM mhs ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Data Mahasiswa</title>
</head>
<body>
    <h2>Daftar Data Mahasiswa</h2>
        <a href="tambahDataMhs.php">Tambah Data Baru</a>
        <br><br>
        <table border="1" cellpadding="8">
            <tr>
                <th>ID</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Tempat Lahir</th>
                <th>Tanggal Lahir</th>
                <th>Jml Sdr</th>
                <th>Alamat</th>
                <th>Kota</th>
                <th>JK</th>
                <th>Status</th>
                <th>Hobi</th>
                <th>Email</th>
                <th colspan="2">Aksi</th>
            </tr>

<?php while ($row = mysqli_fetch_assoc($data)) : ?>
    <tr>
        <td><?= $row['id'] ?></td>
        <td><?= $row['nim'] ?></td>
        <td><?= $row['nama'] ?></td>
        <td><?= $row['tempatLahir'] ?></td>
        <td><?= $row['tanggalLahir'] ?></td>
        <td><?= $row['jmlSaudara'] ?></td>
        <td><?= $row['alamat'] ?></td>
        <td><?= $row['kota'] ?></td>
        <td><?= $row['jenisKelamin'] ?></td>
        <td><?= $row['statusKeluarga'] ?></td>
        <td><?= $row['hobi'] ?></td>
        <td><?= $row['email'] ?></td>
        <td><a href="koreksiMhs.php?kode=<?php echo $row['id']?>">Edit</a>
<td><a href="hapusDataMhs.php?kode=<?php echo $row["id"]?>"onclick="return confirm('Yakin dihapus nih?')">Hapus</a></td>
    </tr>
<?php
endwhile;
?>
</body>
</html>