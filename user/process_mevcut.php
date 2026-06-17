<?php
/*
function Yonlendirme($URL)
{
    header("Refresh:2;  URL = $URL ");
    die();
}
*/
/*
function MesajGoster($message)
{

    include("message.php");
}
*/
function delete_not_comp()
{
    include "../app/connect.php";
    $id = $_GET["id"];
    $sql = "delete from submission_list_temp where id='$id'";
    if (mysqli_query($baglanti,$sql)) {
        MesajGoster("Kaydınız Silindi ");
        Yonlendirme("index.php?page=not_completed&rnb=4");
    }
}

function send_review()
{

    include("../app/connect.php");
    $id = $_GET["id"];
    $pQuery = mysqli_query($baglanti,"SELECT title FROM submission_list WHERE id='$id'");
    $title = mysqli_fetch_object($pQuery)->title;
    $a = rand(1, 10);
    $b = rand(1, 100);
    $answer = $a + $b;
    $tQuery = mysqli_query($baglanti,"SELECT text FROM mail_text WHERE type='review'");
    $rText = mysqli_fetch_object($tQuery)->text;
    $rQuery = mysqli_query($baglanti,"SELECT * FROM users WHERE state=1 and (role=3 or role=2 or role=1)");
    $s = 0;
    $r = array(array());
    while ($tmp = mysqli_fetch_array($rQuery)) {
        $r[$s][0] = $tmp["user_name"]; // user_name
        $r[$s][1] = $tmp["name_surname"]; // adsoyad
        $r[$s][2] = $tmp["email"]; // email
        $s++;
    }

    for ($i = 1; $i <= 3; $i++) {
        $rSlc[$i] = "<select name='reviewer[$i]'><option value='-1'>--- Select Reviewer $i ---</option>";

        foreach ($r as $r1) {
            $rSlc[$i] .= "<option value='" . $r1[0] . "'>" . $r1[1] . " - " . $r1[2] . " </option>";
        }

        $rSlc[$i] .= "</select>";
    }

    echo '<div class="x_panel">
<div style="width: 60%;  margin-left: auto; margin-right: auto">
                 <form method="post" action="send_review_request.php">
                    <div class="mail">
                        <div class="mail-input-name-input" style="text-align: center;">
                            <p>
                                <b>' . $title . '</b>
                            </p>
                        </div>
                    </div>

                    <div class="mail">
                        <div class="mail-input-name"><p>Reviewer 1 Email Address</p></div>
                        <div class="mail-input-name-input">
                            <p>
                                ' . $rSlc[1] . '
                            </p>
                        </div>
                    </div>

                    <div class="mail">
                        <div class="mail-input-name"><p>Reviewer 2 Email Address</p></div>
                        <div class="mail-input-name-input">
                            <p>
                                ' . $rSlc[2] . '
                            </p>
                        </div>
                    </div>

                    <div class="mail">
                        <div class="mail-input-name"><p>Reviewer 3 Email Address</p></div>
                        <div class="mail-input-name-input">
                            <p>
                                ' . $rSlc[3] . '
                            </p>
                        </div>
                    </div>

                    <div class="mail">
                        <div class="mail-input-name"><p>Message</p></div>
                        <div class="mail-input-name-input" style="border: 1px solid; padding-left:5px; padding-right:5px;">
                                <p>
                               ' . $rText . '
                                </p>
                        </div>
                    </div>

                    <div class="mail">
                        <div class="mail-input-name"><p><br>Managing Editor\'s Name and Surname</p></div>
                        <div class="mail-input-name-input" style="padding-top:17px;"><p><input type="text" class="contact"  name="editor" value=""/></p>
                        </div>
                    </div>
                    <div class="answer"><p><br>Please enter the answer to this simple maths question (to prevent spam)</p></div>


                    <div class="mail">
                        <div class="mail-input-name"><p>Question: ' . $a . '+' . $b . ' = ?</p></div>
                        <div class="mail-input-name-input">
                            <p><input type="text" name="user_answer" class="contact"/>
                            <input type="hidden" name="answer" value="' . $answer . '"/>
                            <input type="hidden" name="id" value="' . $id . '"/></p>
                        </div>
                    </div>


                     <div class="button_div">

                        <div class="formBody">
                            <input type="submit" value="Send" name="contact_submitted" id="Send" class="button_dynamic"/>
                        </div>
                    </div>
			    </form>
			    </div>
              </div>  ';



}


$process = @$_GET['process'];
switch ($process) {

    case "delete_not_comp":
        delete_not_comp();
        break;

    case "send_review":
        send_review();
        break;


    default:

        break;
}