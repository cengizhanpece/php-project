<?php
    session_start();
    //Eğer kullanıcı daha önce giriş yapmamışsa login sayfasına gönder
    if(empty($_SESSION["kullaniciAdi"]) && empty($_SESSION["kullaniciSifresi"])){
        header("Location: adminLogin.php");
        exit;
    }
    //url ile ulaşılmaya çalışılmışsa işlem yapma
    if(empty($_POST["name"]) || empty($_POST["no"]) || empty($_POST["mail"]) || empty($_POST["photo"]) ){
        header("Location: adminLogin.php");
        exit;
    }
    // Mongodb modülünü yükle
    require 'vendor/autoload.php';
    //Mongodb access string ile yeni bir mongodb client oluştur
    $client = new MongoDB\Client("mongodb+srv://Cengizhan:Cengiz53@cengizhan-qpwns.mongodb.net/test?retryWrites=true&w=majority");
    //Client içindeki databaseyi ve tabloları getir
    $db = $client->php;
    $footer = $db->footer;
    

    $footer->updateOne(["name" => "footer-information"], ['$set' => ["footerName" => $_POST["name"], "footerNo"=> $_POST["no"], "footerMail" => $_POST["mail"]]]);
    $footer->updateOne(["name" => "footer-photo"], ['$set'=> ["url"=> $_POST["photo"]]]);
    header("Location: dashboard.php");
?>