<?php
// Tüm sistem mesajlarının merkezi olarak yönetildiği fonksiyon
function sistem_mesaji($mesaj_kodu, $ek_veri = "") {
    
    // Mesaj havuzumuz
    $mesajlar = array(
        "giris_basarili" => "Your Session Is Start ... [OK]",
        "kullanici_bulunamadi" => "The user is not registered.!",
        "cikis_yapildi" => "Your Session Is Close",
        "sifre_uyusmuyor" => "Check Your Password!!!",
        "email_kayitli" => "This email address is already registered. Please request new password.",
        "kayit_basarili" => "Congratulations... Your registration has been completed.",
        "kayit_hatasi" => "Error: Your registration has not been completed.",
        "kayit_hatasi_detayli" => "<b> !!! Error ..... </b> Your registration has not been completed. !!!",
        "sifre_sifirlama_basarili" => "Your new password was sent to your e-mail address!",
        "mail_bulunamadi" => "There is not a user with this e-mail address!",
        "mesaj_gonderildi" => "Thank you. Your message has been sent.",
        "veritabani_hatasi" => "Error Database. " . $ek_veri,
        "sifre_kontrol" => "Şifrelerinizi Kontrol Ediniz!!!",
        "bilgiler_guncellendi" => "Bilgileriniz Güncellendi",
        "bilgi_kontrol" => "Bilgilerinizi Kontrol Ediniz!!!",
        "kullanici_adi_alinmis" => "Bu Kullanıcı Adı Başka Bir Kullanıcı Tarafından Kullanılmaktadır!!!",
        "hatali_dogrulama_kodu" => "Incorrect code, please try again!"
    );

    // İstenilen kod havuzda varsa onu al, yoksa varsayılan hata göster
    $mesaj_metni = isset($mesajlar[$mesaj_kodu]) ? $mesajlar[$mesaj_kodu] : "Bilinmeyen Sistem Hatası!";

    // Orijinal sistemdeki message.php dosyasını çağırıp $message değişkenini ekrana basıyoruz
    $message = $mesaj_metni;
    include("message.php");
}

// Mail şablonlarını tek bir merkezden yöneten fonksiyon
function mail_sablonu($sablon_kodu, $ek_veri = "") {
    
    // PHP 8 Uyumluluğu: Ortak yazar mailinde başlık ve yazar adını güvenli ayırmak için
    $parcalar = explode('||', $ek_veri);
    $makale_baslik = $parcalar[0] ?? "";
    $ana_yazar = $parcalar[1] ?? "";

    $sablonlar = array(
        // Şifre İşlemleri
        "sifre_sifirlama_baslik" => "Password Reset Request",
        "sifre_sifirlama_icerik" => "Your new password was sent to your e-mail address! New Password: " . $ek_veri,
        
        // Makale Kabul / Proof İşlemleri
        "proof_correction_baslik" => "Proof Correction",
        
        // Makale Başvuru (Submission) İşlemleri
        "makale_basvurusu_yazar" => "Dear Author,<br><br>The M&S titled as " . $ek_veri . " has been submitted to Natural and Engineering Sciences (NESciences) successfully.<br><br>You can track the reviewing process by logging to NESciences (http://www.nesciences.com/login.php).<br><br>Thanks for choosing NESciences.<br><br>Yours sincerely,<br><br>Dr. Cemal Turan<br>Editor in Chief ",
        
        "makale_basvurusu_ortak_yazar" => "Dear Co-Author,<br><br>The M&S titled as " . $makale_baslik . " has been submitted to Natural and Engineering Sciences (NESciences) by corresponding author " . $ana_yazar . "<br><br>Thanks for choosing NESciences.<br><br>Yours sincerely,<br><br>Dr. Cemal Turan<br>Editor in Chief"
    );

    return isset($sablonlar[$sablon_kodu]) ? $sablonlar[$sablon_kodu] : "";
}
?>