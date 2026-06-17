<!-- Category Start -->
<div class="container-xxl py-5">
<div class="container">
<h1 class="text-center mb-5 wow fadeInUp">- Editor-in-Chief -</h1>
<div class="row g-4 justify-content-center">

<?php

$title = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM options "))->journalName;

if ($query = mysqli_query($baglanti,'SELECT * FROM `editor_list` WHERE `goster`=1 AND `role`="editorchief" ORDER BY `name_lastname`')) {
    while ($data = mysqli_fetch_array($query)) {
        $name = $data["name_lastname"];
        $kurum = $data["affilation"];
        $email = $data["mail"];
        $country = $data["country"];

        echo '
        <div class="col-lg-4 col-sm-6 wow fadeInUp">
            <a class="cat-item border rounded-pill p-4 text-center text-white">
                <h6 class="text-white mb-3">Dr. '.$name.'</h6>
                <p class="mb-0">'.$kurum.'</p>
                <p class="mb-0">e-mail: '.$email.'</p>
                <p class="mb-0">'.$country.'</p>
            </a>
        </div>';
    }
   
} echo "---";
?>
</div>
</div>
</div>
<!-- Category End -->


<!-- Category Start -->
<div class="container-xxl py-5">
<div class="container">
<h1 class="text-center mb-5 wow fadeInUp">Managing Editor</h1>
<div class="row g-4 justify-content-center">

<?php

$title = mysqli_fetch_object(mysqli_query($baglanti,"SELECT * FROM options "))->journalName;


if ($query = mysqli_query($baglanti,'SELECT * FROM `editor_list` WHERE `goster`=1 AND `role`="managereditor" ORDER BY `name_lastname`')) {
    while ($data = mysqli_fetch_array($query)) {
        $name = $data["name_lastname"];
        $kurum = $data["affilation"];
        $email = $data["mail"];
        $country = $data["country"];

        echo '
        <div class="col-lg-4 col-sm-6 wow fadeInUp">
            <a class="cat-item border rounded-pill p-4 text-center text-white">
                <h6 class="text-white mb-3">Dr. '.$name.'</h6>
                <p class="mb-0">'.$kurum.'</p>
                <p class="mb-0">e-mail: '.$email.'</p>
                <p class="mb-0">'.$country.'</p>
            </a>
        </div>';
    }
}
?>
</div>
</div>
</div>
<!-- Category End -->


<!-- Category Start -->
<div class="container-xxl py-5">
<div class="container">
<h1 class="text-center mb-5 wow fadeInUp">Editor</h1>
<div class="row g-4 justify-content-center">

<?php
if ($query = mysqli_query($baglanti,'SELECT * FROM `editor_list` WHERE `goster`=1 AND `role`="subjecteditor" ORDER BY `name_lastname`')) {
    while ($data = mysqli_fetch_array($query)) {
        $name = $data["name_lastname"];
        $kurum = $data["affilation"];
        $email = $data["mail"];
        $country = $data["country"];

        echo '
        <div class="col-lg-4 col-sm-6 wow fadeInUp">
            <a class="cat-item border rounded-pill p-4 text-center text-white">
                <h6 class="text-white mb-3">Dr. '.$name.'</h6>
                <p class="mb-0">'.$kurum.'</p>
                <p class="mb-0">e-mail: '.$email.'</p>
                <p class="mb-0">'.$country.'</p>
            </a>
        </div>';
    }
}
?>
</div>
</div>
</div>
<!-- Category End -->


<!-- Category Start -->
<div class="container-xxl py-5">
<div class="container">
<h2 class="text-center mb-5 wow fadeInUp">Editor Board</h2>
</div>
</div>
<!-- Category End -->


<!-- Category Start -->
<div class="container-xxl py-5">
<div class="container">
<div class="row g-4 justify-content-center">

<?php
if ($query = mysqli_query($baglanti,'SELECT * FROM `editor_list` WHERE `goster`=1 AND `role`="editor" ORDER BY `name_lastname`')) {
    while ($data = mysqli_fetch_array($query)) {
        $name = $data["name_lastname"];
        $kurum = $data["affilation"];
        $email = $data["mail"];
        $country = $data["country"];

        echo '
        <div class="col-lg-4 col-sm-6 wow fadeInUp">
            <a class="cat-item border rounded-pill p-4 text-center text-white">
                <h6 class="text-white mb-3">Dr. '.$name.'</h6>
                <p class="mb-0">'.$kurum.'</p>
                <p class="mb-0">e-mail: '.$email.'</p>
                <p class="mb-0">'.$country.'</p>
            </a>
        </div>';
    }
}
?>
</div>
</div>
</div>
<!-- Category End -->


<p>&nbsp;</p>
<p>&nbsp;</p>

<p style="text-align: center;">
    <span style="color: #0000ff; font-size: medium;"><strong>Publication Ethics Consultant</strong></span>
</p>
<p style="text-align: center;">
    <strong><a href="https://www.dogavebilim.com/?lang=en">Nature and Science Society</a></strong>
</p>
