
<?php
    session_start();
    // Mongodb modulunu yükle
    require 'vendor/autoload.php';
    //Mongodb access string ile yeni bir mongodb client oluştur
    $client = new MongoDB\Client("mongodb+srv://Cengizhan:Cengiz53@cengizhan-qpwns.mongodb.net/test?retryWrites=true&w=majority");
    //Client içindeki databaseyi ve tabloları getir
    $db = $client->php;
    $firstText = $db->firstText;
    $articles = $db->Article;
    $footer = $db->footer;
    $user = $db->user;
    
    //Eğer kullanıcı daha önce giriş yapmışsa tekrardan form sorgulama
    if(empty($_SESSION["kullaniciAdi"]) && empty($_SESSION["kullaniciSifresi"])){
        // Kullanıcı formu göndermeden sadece url ile ulaşmaya çalışmışsa login sayfasına geri gönder ve programı exitle
        if(empty($_POST["kullaniciAdi"]) && empty($_POST["kullaniciSifresi"]))
        {
            header("Location: adminLogin.php");
            exit;
        }
        // Database içinde formdan gelen kullanıcı adını ve şifreyi getir (eğer eşleşme yoksa empty döner)
        $loggedUser = $user->findOne(["id"=> $_POST["kullaniciAdi"], "password" => $_POST["kullaniciSifresi"]]);
        // Logged user empty döndüyse eşleşme yoktur ve login sayfasına geri gönderip programı exitle
        if(empty($loggedUser)){
            header("Location: adminLogin.php");
            exit;
        }
        $_SESSION["kullaniciAdi"] = $loggedUser->id;
        $_SESSION["kullaniciSifresi"] = $loggedUser->password;
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Dashboard</title>
        <link rel="stylesheet" type="text/css" href="dashboard.css">
    </head>
    <body>
        <div id="overlay" hidden></div>
        <div id="first-section-popup" class="popup" hidden></div>   
        <div id="add-article-popup" class="popup" hidden>fff</div>
        <div id="delete-article-popup" class="popup" hidden>aa</div>
        <div id="footer-section-popup" class="popup" hidden>bb</div>
        <div class="container">
            <h2>Select The Change You Want To Make</h2>
            <div id="first-section" class="button">First Section</div>
            <div id="add-article" class="button">Add Article</div>
            <div id="delete-article"class="delete-article button">Delete Article</div>
            <div id="footer-section" class="footer-section button">Footer Section</div>
        </div>
        <script src="dashboard.js"></script>
    </body>
</html>