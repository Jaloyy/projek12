<?php
    include "koneksi.php";
    
    // Fungsi sanitasi
    function bersih($data){
        return htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    }
    
    // Ambil data dari form
    $id             = bersih($_POST['id'] ?? '');
    $xnim           = bersih($_POST['nim'] ?? '');
    $xnama          = bersih($_POST['nama'] ?? '');
    $xtempatLahir   = bersih($_POST['tempatLahir'] ?? '');
    $xtanggalLahir  = bersih($_POST['tanggalLahir'] ?? '');
    $xtglLahir      = date("m/d/Y", strtotime($xtanggalLahir));
    $xjmlSaudara    = bersih($_POST['jmlSaudara'] ?? '');
    $xalamat        = bersih($_POST['alamat'] ?? '');
    $xkota          = bersih($_POST['kota'] ?? '');
    $xjk            = bersih($_POST['jk'] ?? '');
    $xstatusKeluarga = bersih($_POST['statusKeluarga'] ?? '');
    $xhobi          = isset($_POST['hobi']) ? implode(", ", $_POST['hobi']) : "";
    $xemail         = bersih($_POST['email'] ?? '');
    $xraw_password  = bersih($_POST['password'] ?? '');
    
    // Cek apakah password diisi (ingin diubah)
    if (!empty($xraw_password)) {
        // Validasi password baru
        if (strlen($xraw_password) < 10) {
            die("Password minimal 10 karakter. <br><a href='koreksiMhs.php?kode=$id'>Kembali</a>");
        }
        
        // Hash password baru
        $hashed_password = password_hash($xraw_password, PASSWORD_BCRYPT);
        
        // Query UPDATE dengan password
        $sql = "UPDATE mhs SET 
                nim = ?,
                nama = ?,
                tempatLahir = ?,
                tanggalLahir = ?,
                jmlSaudara = ?,
                alamat = ?,
                kota = ?,
                jenisKelamin = ?,
                statusKeluarga = ?,
                hobi = ?,
                email = ?,
                pass = ?
                WHERE id = ?";
        
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("ssssssssssssi", 
            $xnim, $xnama, $xtempatLahir, $xtglLahir, $xjmlSaudara, 
            $xalamat, $xkota, $xjk, $xstatusKeluarga, $xhobi, $xemail, 
            $hashed_password, $id
        );
    } else {
        // Query UPDATE tanpa password (password tidak diubah)
        $sql = "UPDATE mhs SET 
                nim = ?,
                nama = ?,
                tempatLahir = ?,
                tanggalLahir = ?,
                jmlSaudara = ?,
                alamat = ?,
                kota = ?,
                jenisKelamin = ?,
                statusKeluarga = ?,
                hobi = ?,
                email = ?
                WHERE id = ?";
        
        $stmt = $koneksi->prepare($sql);
        $stmt->bind_param("sssssssssssi", 
            $xnim, $xnama, $xtempatLahir, $xtglLahir, $xjmlSaudara, 
            $xalamat, $xkota, $xjk, $xstatusKeluarga, $xhobi, $xemail, $id
        );
    }
    
    // Eksekusi query
    if ($stmt->execute()) {
        echo "Data berhasil diupdate! <br>";
        echo "<a href='tampilDataMhs.php'>Lihat Data</a>";
    } else {
        echo "Error: " . $stmt->error . "<br>";
        echo "<a href='koreksiMhs.php?kode=$id'>Kembali</a>";
    }
    
    $stmt->close();
    $koneksi->close();
?>