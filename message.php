<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title> </title>

    <!-- Bootstrap -->
    <link href="css/bootstrap/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="css/font-awesome/font-awesome.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="css/nprogress.css" rel="stylesheet">
    <!-- Animate.css -->
    <link href="css/animate/animate.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="css/custom.min.css" rel="stylesheet">

    <style>
        .ortala{
            text-align: center;
            margin-bottom: auto;
            margin-top: 15%;
            height:100%;
        }

        .message-info {
            color: #31708f;
            background-color: #d9edf7;
            border-color: #bce8f1;
        }
        .message {
            padding: 30px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
            font-size: 150%;
        }
    </style>

</head>

<body class="login">


<div class="ortala"  >

            <div class="message message-info" id="message">
                <strong> .....<?php echo $message ;  ?> </strong>
            </div>

</div>
<?php
echo '<script type="text/javascript">',
         'document.getElementById("message-info").innerHTML = "<br> -> Abstract image  file could not  be uploaded ..... X ERROR X";',
         '</script>';

?>
</body>
</html>
