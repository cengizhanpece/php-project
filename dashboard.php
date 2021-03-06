
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
        //Kullanıcı adı ve şifresi bulunmuşsa sessiona ekle 
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
        <div id="first-section-popup" class="popup" hidden>
            <form method="post" action="updateFirstSection.php" class="form">
                <div class="formInputs">
                    <?php 
                        $document = $firstText->findOne(["name" => "first-content-text"]);
                        $image = $firstText->findOne(["name" => "main-photo"]);
                    ?>
                    <h3>Main Text Title</h2> 
                    <input type="text" name="firstTextTitle" value="<?php echo $document->title ?>" class="input">
                    <h3>Main Text</h2>
                    <textarea name="firstTextContent" class="textareaInput"><?php echo $document->content ?></textarea>
                    <h3>Main Photo Url</h2> 
                    <input type="text" name="firstTextPhoto" value="<?php echo $image->url ?>" class="input">
                    <input type="submit" value="Update" class="button">
                </div>
            </form>
        </div>   
        <div id="add-article-popup" class="popup" hidden>
            <form method="post" action="addArticle.php" class="form">
                <div class="formInputs">
                    <h3> Article Title </h3>
                    <input type="text" name="articleTitle" class="input">
                    <h3>Article Content</h3>
                    <textarea name="articleContent" class="textareaInput"></textarea>
                    <h3>Article Photo Url</h3>
                    <input type="text" name="articlePhoto" class="input">
                    <input type="submit" value="Add Article" class="button">
                </div>
            </form>
        </div>
        <div id="delete-article-popup" class="popup" hidden>
            <?php
                $allArticles = $articles->find(["name" => "Article"]);
                foreach($allArticles as $article)
                {
                    echo "
                    <div class='articleContainer'>
                        <h4 class='articleTitle'> $article->title</h4>
                        <div class='articleContent'> $article->content</div>
                        <div class='articlePhoto'> $article->photo </div>
                        <div class='deleteArticleButton' onClick='deleteArticles(\"$article->_id\",this)'>Delete Article</div>
                    </div>";
                }
            ?>
        </div>
        <div id="footer-section-popup" class="popup" hidden>
            <?php 
                $document = $footer->findOne(["name" => "footer-information"]);
                $image = $footer->findOne(["name" => "footer-photo"]);
            ?>
            <form method="post" action="updateFooter.php" class="form">
                <div class="formInputs">
                    <h3> Name </h3>
                    <input type="text" name="name" class="input" value="<?php echo $document->footerName?>">
                    <h3>No</h3>
                    <input type="text" name="no" class="input" value="<?php echo $document->footerNo?>">
                    <h3>E-Mail</h3>
                    <input type="text" name="mail" class="input" value="<?php echo $document->footerMail?>">
                    <h3>Footer Photo Url</h3>
                    <input type="text" name="photo" class="input" value="<?php echo $image->url?>">
                    <input type="submit" value="Update Footer" class="button">
                </div>
            </form>
        </div>
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