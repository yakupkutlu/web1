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
?>