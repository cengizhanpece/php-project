<?php
    session_start();
    // Mongodb modulunu yükle
    require 'vendor/autoload.php';
    //Mongodb access string ile yeni bir mongodb client oluştur
    $client = new MongoDB\Client("mongodb+srv://Cengizhan:Cengiz53@cengizhan-qpwns.mongodb.net/test?retryWrites=true&w=majority");
    //Client içindeki databaseyi ve tabloları getir
    $db = $client->php;
    $articles = $db->Article;
    //Eğer kullanıcı daha önce giriş yapmışsa tekrardan form sorgulama
    if(empty($_SESSION["kullaniciAdi"]) && empty($_SESSION["kullaniciSifresi"])){
        header("Location: adminLogin.php");
        exit;
    }

    $articles->insertOne(["name" => "Article", "photo" => $_POST["articlePhoto"], "title" => $_POST["articleTitle"], "content" => $_POST["articleContent"]]);
    header("Location: dashboard.php");
?>