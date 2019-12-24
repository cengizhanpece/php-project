<?php
    session_start();
    // Mongodb modulunu yükle
    require 'vendor/autoload.php';
    //Mongodb access string ile yeni bir mongodb client oluştur
    $client = new MongoDB\Client("mongodb+srv://Cengizhan:Cengiz53@cengizhan-qpwns.mongodb.net/test?retryWrites=true&w=majority");
    //Client içindeki databaseyi ve tabloları getir
    $db = $client->php;
    $firstText = $db->firstText;
    //Eğer kullanıcı daha önce giriş yapmışsa tekrardan form sorgulama
    if(empty($_SESSION["kullaniciAdi"]) && empty($_SESSION["kullaniciSifresi"])){
        header("Location: adminLogin.php");
        exit;
    }

    $firstText->updateOne(["name" => "first-content-text"], ['$set' => ["title" => $_POST["firstTextTitle"], "content"=> $_POST["firstTextContent"]]]);
    $firstText->updateOne(["name" => "main-photo"], ['$set'=> ["url"=> $_POST["firstTextPhoto"]]]);
    header("Location: dashboard.php");
?>