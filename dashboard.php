<?php
    require 'vendor/autoload.php';
    $client = new MongoDB\Client("mongodb+srv://Cengizhan:Cengiz53@cengizhan-qpwns.mongodb.net/test?retryWrites=true&w=majority");
    $db = $client->php;
    $firstText = $db->firstText;
    $articles = $db->Article;
    $footer = $db->footer;
    $user = $db->user;

    if(empty($_POST["kullaniciAdi"]) && empty($_POST["kullaniciSifresi"]))
    {
        header("Location: adminLogin.php");
        exit;
    }
    $loggedUser = $user->findOne(["id"=> $_POST["kullaniciAdi"], "password" => $_POST["kullaniciSifresi"]]);
    
    if(empty($loggedUser)){
        header("Location: adminLogin.php");
        exit;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>
    </head>
    <body>

    </body>
</html>