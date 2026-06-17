<?php
function change_str($str){
    $find=array("ü","ğ","ı","ş","ç","ö","Ü","Ğ","İ","Ş","Ç","Ö");
    $change=array("u","g","i","s","c","o","U","G","I","S","C","O");
    return str_replace($find,$change,$str);
}
$user=$_GET['user'];
include ("../app/connect.php");
$data=array();

if ($query = mysqli_query($baglanti,"SELECT * FROM users WHERE user_name= '$user'")) {
    while ($oku = mysqli_fetch_array($query)) {
        $name_surname=$oku['name_surname'];
        $user_name=$oku['user_name'];
        $email=$oku['email'];
        $adress=$oku['adress'];
        $instition=$oku['instition'];
        $phone=$oku['phone'];
        $unvan=$oku['unvan'];
        $work_area=$oku['work_area'];
    }
}



array_push($data,change_str($name_surname),change_str($user_name),change_str($email),change_str($adress),change_str($instition),
    change_str($phone),change_str($work_area),change_str($unvan));
echo json_encode($data);
?>