<?php
    include "koneksi.php";
    
    // Ambil ID dari parameter URL
    $id = $_GET['kode'] ?? '';
    
    // Query untuk mengambil data mahasiswa berdasarkan ID
    $sql = "SELECT * FROM mhs WHERE id = ?";
    $stmt = $koneksi->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $data = $result->fetch_assoc();
    
    if (!$data) {
        die("Data tidak ditemukan!");
    }
    
    // Konversi tanggal dari format database ke format input date
    $tanggalLahir = date("Y-m-d", strtotime($data['tanggalLahir']));
    
    // Pisahkan hobi menjadi array
    $hobiArray = !empty($data['hobi']) ? explode(", ", $data['hobi']) : [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Koreksi Data Mahasiswa</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Form Koreksi Mahasiswa</h2>
        <form action="simpanKoreksiDataMhs.php" method="POST">
            
            <input type="hidden" name="id" value="<?= $data['id'] ?>">
            
            <div class="form-group">
                <label for="nim">NIM</label>
                <input type="text" id="nim" name="nim" value="<?= htmlspecialchars($data['nim']) ?>" required>
            </div>

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($data['nama']) ?>" required>
            </div>

            <div class="form-group">
                <label for="tempatLahir">Tempat Lahir</label>
                <input type="text" id="tempatLahir" name="tempatLahir" value="<?= htmlspecialchars($data['tempatLahir']) ?>" required>
            </div>

            <div class="form-group">
                <label for="tanggalLahir">Tanggal Lahir</label>
                <input type="date" id="tanggalLahir" name="tanggalLahir" value="<?= $tanggalLahir ?>" required>
            </div>

            <div class="form-group">
                <label for="jmlSaudara">Jumlah Saudara</label>
                <input type="number" id="jmlSaudara" name="jmlSaudara" min="0" value="<?= $data['jmlSaudara'] ?>" required>
            </div>

            <div class="form-group">
                <label for="alamat">Alamat</label>
                <textarea id="alamat" name="alamat" required><?= htmlspecialchars($data['alamat']) ?></textarea>
            </div>

            <div class="form-group">
                <label for="kota">Kota</label>
                <select id="kota" name="kota" required>
                    <option value="">-- Pilih Kota --</option>
                    <option value="Semarang" <?= $data['kota'] == 'Semarang' ? 'selected' : '' ?>>Semarang</option>
                    <option value="Solo" <?= $data['kota'] == 'Solo' ? 'selected' : '' ?>>Solo</option>
                    <option value="Brebes" <?= $data['kota'] == 'Brebes' ? 'selected' : '' ?>>Brebes</option>
                    <option value="Kudus" <?= $data['kota'] == 'Kudus' ? 'selected' : '' ?>>Kudus</option>
                    <option value="Demak" <?= $data['kota'] == 'Demak' ? 'selected' : '' ?>>Demak</option>
                    <option value="Salatiga" <?= $data['kota'] == 'Salatiga' ? 'selected' : '' ?>>Salatiga</option>
                </select>
            </div>

            <div class="form-group">
                <label>Jenis Kelamin</label>
                <div class="radio-group">
                    <div class="radio-item">
                        <input type="radio" id="laki" name="jk" value="L" <?= $data['jenisKelamin'] == 'L' ? 'checked' : '' ?> required>
                        <label for="laki">Laki-laki</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" id="perempuan" name="jk" value="P" <?= $data['jenisKelamin'] == 'P' ? 'checked' : '' ?> required>
                        <label for="perempuan">Perempuan</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Status Keluarga</label>
                <div class="radio-group">
                    <div class="radio-item">
                        <input type="radio" id="kawin" name="statusKeluarga" value="K" <?= $data['statusKeluarga'] == 'K' ? 'checked' : '' ?> required>
                        <label for="kawin">Kawin</label>
                    </div>
                    <div class="radio-item">
                        <input type="radio" id="belum" name="statusKeluarga" value="B" <?= $data['statusKeluarga'] == 'B' ? 'checked' : '' ?> required>
                        <label for="belum">Belum Kawin</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Hobi</label>
                <div class="checkbox-group">
                    <div class="checkbox-item">
                        <input type="checkbox" id="membaca" name="hobi[]" value="Membaca" <?= in_array('Membaca', $hobiArray) ? 'checked' : '' ?>>
                        <label for="membaca">Membaca</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="olahraga" name="hobi[]" value="Olahraga" <?= in_array('Olahraga', $hobiArray) ? 'checked' : '' ?>>
                        <label for="olahraga">Olahraga</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="musik" name="hobi[]" value="Musik" <?= in_array('Musik', $hobiArray) ? 'checked' : '' ?>>
                        <label for="musik">Musik</label>
                    </div>
                    <div class="checkbox-item">
                        <input type="checkbox" id="traveling" name="hobi[]" value="Traveling" <?= in_array('Traveling', $hobiArray) ? 'checked' : '' ?>>
                        <label for="traveling">Traveling</label>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['email']) ?>" required>
            </div>

            <div class="form-group">
                <label for="password">Password Baru (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" id="password" name="password" placeholder="Minimal 10 karakter">
                <small style="color: #666; font-size: 12px;">* Isi hanya jika ingin mengganti password</small>
            </div>

            <button type="submit" class="btn-submit">Update Data</button>
            <a href="tampilDataMhs.php" style="display: inline-block; text-align: center; margin-top: 10px; color: #666;">Batal</a>
        </form>
    </div>
</body>
</html>

<?php
    $stmt->close();
    $koneksi->close();
?>