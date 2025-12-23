<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Input Data Mahasiswa</title>
</head>
<body>
    <h2>Nama : Jalu Adi Saputra</h2>
    <h2>Nim  : A12.2024.07173</h2>
</body>
<body>
<h2>Form Input Mahasiswa</h2>
<link rel="stylesheet" href="style.css">
<form action="simpanDataMhs.php" method="POST">
    NIM : <input type="text" name="nim" required><br><br>
    NAMA : <input type="text" name="nama" required><br><br>
    Tempat Lahir : <input type="textarea" name="tempatLahir" required><br><br>
    Tanggal Lahir : <input type="date" name="tanggalLahir" required><br><br>
    Jumlah Saudara : <input type="number" name="jmlSaudara" required><br><br>
    Alamat : <br>
        <textarea rows="5" cols="50" name="alamat"></textarea><br/>
    Kota :
    <select name="kota">
        <option>Semarang</option>
        <option>Solo</option>
        <option>Brebes</option>
        <option>Kudus</option>
        <option>Demak</option>
        <option>Salatiga</option>
</select>
<br><br>
Jenis kelamin :
<input type="radio" name="jk" value="L" required> Laki laki
<input type="radio" name="jk" value="P" required> Perempuan
<br><br>
Status :
<input type="radio" name="statusKeluarga" value="K" required> Kawin
<input type="radio" name="statusKeluarga" value="B" required> Belum Kawin
<br><br>
Hobi (boleh lebih dari satu) :<br>
<input type="checkbox" name="hobi[]" value="Membaca"> Membaca <br>
<input type="checkbox" name="hobi[]" value="Olahraga"> Olahraga <br>
<input type="checkbox" name="hobi[]" value="Musik"> Musik <br>
<input type="checkbox" name="hobi[]" value="Traveling"> Traveling <br><br>
Email : <input type="email" name="email" required><br><br>
Password : <input type="password" name="password" required>
<input type="submit" value="Simpan">
</form>

</body>
</html>