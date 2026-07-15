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
    $ek_veri1 = $parcalar[0] ?? "";
    $ek_veri2 = $parcalar[1] ?? "";
    $ek_veri3 = $parcalar[2] ?? "";

    $sablonlar = array(
        // Şifre İşlemleri
        "sifre_sifirlama_baslik" => "Password Reset Request",
        "sifre_sifirlama_icerik" => "Your new password was sent to your e-mail address! New Password: " . $ek_veri,
        
        // Makale Kabul / Proof İşlemleri
        "proof_correction_baslik" => "Proof Correction",
        
        // Makale Başvuru (Submission) İşlemleri
        "makale_basvurusu_yazar" => "Dear Author,<br><br>The M&S titled as " . $ek_veri . " has been submitted to Natural and Engineering Sciences (NESciences) successfully.<br><br>You can track the reviewing process by logging to NESciences (http://www.nesciences.com/login.php).<br><br>Thanks for choosing NESciences.<br><br>Yours sincerely,<br><br>Dr. Cemal Turan<br>Editor in Chief ",
        
        "makale_basvurusu_ortak_yazar" => "Dear Co-Author,<br><br>The M&S titled as " . $makale_baslik . " has been submitted to Natural and Engineering Sciences (NESciences) by corresponding author " . $ana_yazar . "<br><br>Thanks for choosing NESciences.<br><br>Yours sincerely,<br><br>Dr. Cemal Turan<br>Editor in Chief",
        
        // Hakem Davet İşlemleri Link Şablonu
        "hakem_kabul_linki" => "<br><a href='http://" . $ek_veri1 . "/index.php?page=login'>Click to indicate an answer for reviewing this paper</a><br>
<br> Attention: If the link is not working please copy the below address and paste to the browsers adress bar in order to access the page
<br>https://" . $ek_veri1 . "/index.php?page=login
<br><br><font color=\'red\'>Your Username: " . $ek_veri2 . "</font>
<br>If you forget or don't know your password you can use the Reset Password form.</br>
<br><a href='https://" . $ek_veri1 . "/index.php?page=reset_pass'>Click to access the Reset Password form</a><br>
<br> Attention: If the link is not working please copy the below address and paste to the browsers adress bar in order to access the page
<br>https://" . $ek_veri1 . "/index.php?page=reset_pass",

        // Editör İmza Şablonu
        "editor_imza" => "<br /> Sincerely,<br /> Editor<br /><br /><br /><br /><br /><br /><br />
<p>_______________________________________________________________________</p>
<p><strong>" . $ek_veri1 . "</strong><br />(<a href='http://" . $ek_veri2 . "'>" . $ek_veri2 . "</a>)</p>",

        // Makale Değerlendirme (Decision)
        "editor_decision_baslik" => " Editor decision of the manuscript  numbered  " . $ek_veri . ":",
        
        // Hakem Revizyon Talebi
        "hakem_revizyon_talebi" => "Dear " . $ek_veri1 . " ,<br>
Since you have requested to see the revision of the MS titled as " . $ek_veri2 . " for a possible publication in " . $ek_veri3 . " (" . ($parcalar[3] ?? "") . "), we are sending you the revised MS by author and author’s correction list and file.<br> 
Please send us your decision within 4 days,<br>

Please go to " . ($parcalar[3] ?? "") . " Editorial System :<a href='" . ($parcalar[4] ?? "") . "'> " . ($parcalar[3] ?? "") . "</a> and login as Reviewer to check the MS and send us your decision within 4 days,<br>
Sincerely,<br>
" . ($parcalar[5] ?? "") . "<br>
Editor "
    );

    return isset($sablonlar[$sablon_kodu]) ? $sablonlar[$sablon_kodu] : "";
}
?>