<?php
include('app/connect.php');
include('system.php');

// Güvenlik: ID'yi integer'a çevir
$gelen_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($gelen_id <= 0) {
    die("Geçersiz ID");
}

// İndirme sayısını artır (Prepared statement)
$accept_str = "UPDATE submission_list SET download = download+1 WHERE id = ?";
$stmt = mysqli_prepare($baglanti, $accept_str);
mysqli_stmt_bind_param($stmt, "i", $gelen_id);
mysqli_stmt_execute($stmt);
mysqli_stmt_close($stmt);

// Dosya bilgisini çek
$download_str = "SELECT paperfile1 FROM submission_list WHERE id = ?";
$stmt = mysqli_prepare($baglanti, $download_str);
mysqli_stmt_bind_param($stmt, "i", $gelen_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if ($row = mysqli_fetch_assoc($result)) {
    $downloadlink = $row["paperfile1"];
} else {
    die("Dosya bulunamadı");
}
mysqli_stmt_close($stmt);

// Buradan sonrası PDF'i sayfaya gömer
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>PDF Görüntüleyici</title>
    <style>
        body, html {
            margin: 0;
            padding: 0;
            height: 100%;
            overflow: hidden; /* Sayfa kaydırmayı engeller, sadece frame kayar */
        }
        .pdf-frame {
            width: 100%;
            height: 100vh; /* Ekran yüksekliğinin tamamı */
            border: none;
        }
    </style>
</head>
<body>

    <object 
        data="<?php echo htmlspecialchars($downloadlink); ?>" 
        type="application/pdf" 
        class="pdf-frame">
        
        <iframe src="<?php echo htmlspecialchars($downloadlink); ?>" class="pdf-frame">
            Tarayıcınız PDF görüntülemeyi desteklemiyor. 
            <a href="<?php echo htmlspecialchars($downloadlink); ?>">Buraya tıklayarak indirebilirsiniz.</a>
        </iframe>
    </object>

</body>
</html>