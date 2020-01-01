<?php
    session_start();
    //Eğer kullanıcı daha önce giriş yapmamışsa login sayfasına gönder
    if(empty($_SESSION["kullaniciAdi"]) && empty($_SESSION["kullaniciSifresi"])){
        header("Location: adminLogin.php");
        exit;
    }
    //url ile ulaşılmaya çalışılmışsa işlem yapma
    if(empty($_POST["firstTextTitle"]) || empty($_POST["firstTextContent"]) || empty($_POST["firstTextPhoto"]) ){
        header("Location: adminLogin.php");
        exit;
    }
    // Mongodb modulunu yükle
    require 'vendor/autoload.php';
    //Mongodb access string ile yeni bir mongodb client oluştur
    $client = new MongoDB\Client("mongodb+srv://Cengizhan:Cengiz53@cengizhan-qpwns.mongodb.net/test?retryWrites=true&w=majority");
    //Client içindeki databaseyi ve tabloları getir
    $db = $client->php;
    $firstText = $db->firstText;
    

    $firstText->updateOne(["name" => "first-content-text"], ['$set' => ["title" => $_POST["firstTextTitle"], "content"=> $_POST["firstTextContent"]]]);
    $firstText->updateOne(["name" => "main-photo"], ['$set'=> ["url"=> $_POST["firstTextPhoto"]]]);
    header("Location: dashboard.php");
?>