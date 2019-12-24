<?php
    require 'vendor/autoload.php';
    $client = new MongoDB\Client(
        "mongodb+srv://Cengizhan:Cengiz53@cengizhan-qpwns.mongodb.net/test?retryWrites=true&w=majority"
    );
    $db = $client->php;
    $firstText = $db->firstText;
    $articles = $db->Article;
    $footer = $db->footer;

?>

<!DOCTYPE html>
<html lang="tr" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ROBOT TEKOLOJİLERİ</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <!-- CSS FİLES -->
    <link rel="stylesheet" type="text/css" href="container.css">
    <link rel="stylesheet" type="text/css" href="header.css">
    <link rel="stylesheet" type="text/css" href="footer.css">
    <link rel="stylesheet" type="text/css" href="first-content.css">
    <link rel="stylesheet" type="text/css" href="second-content.css">
    <link rel="stylesheet" type="text/css" href="slider.css">
    <link rel="stylesheet" type="text/css" href="slider-mobile.css">
    <link rel="shortcut icon" type="image/png" href="/favicon.png" />
    
    <!-- JS FİLES -->
    <script src="slider.js"></script>
    <script src="go-top-btn.js"></script>
    
</head>

<body>
    <div class="container">
        <div class="header">
            <!--HEADER-->
            <div class="logo">
                <!--logo-->
                Robot Teknolojileri
            </div>
            <div class="social">
                <!--socail-icons-->
                <div class="fa fa-facebook-square"></div>
                <div class="fa fa-twitter-square"></div>
                <div class="fa fa-instagram"></div>
                <div class="fa fa-info-circle"></div>
            </div>
        </div>


        <div class="first-content">
            <!--first-content-->
            <div class="first-content-text">
                <?php
                    $document = $firstText->findOne(["name" => "first-content-text"]);
                    echo "<h2>". $document->title ."</h2>";
                    echo "<p>". $document->content ."</p>";

                ?>
            </div>
            <div class="first-content-photo">
                <?php
                    $image = $firstText->findOne(["name" => "main-photo"]);
                    echo "<img src='$image->url' id='main-photo'>"
                ?>
            </div>
        </div>
        <!--first-content-end-->


        <div class="second-content">
            <div class="second-content-header">
                Articles
            </div>
            <?php
                $allArticles = $articles->find(["name" => "Article"]);
                $count = 0;
                $documentLength = $articles->count(["name" => "Article"]);
                foreach($allArticles as $article){
                    if($count % 2 == 0)
                    {
                        echo '<div class="second-inner-content">';
                    }
                    echo "
                    <div class='content-one'>
                        <div class='second-content-photo'>
                            <img src='$article->photo' />
                        </div>
                        <div class='second-content-text'>
                            <h4>$article->title</h4>
                            <p>$article->content</p>
                        </div>
                    </div>";
                    if($count % 2 != 0 || $count == $documentLength - 1)
                    {
                        echo '</div>';
                    }
                    $count++;
                }
            ?>
        </div>
    </div>
    <!--container-end-->
    <footer>

        <!-- FOOTER STARTS -->

        <!-- Footer photo and information-->

        <div class="footer-left-div">
            <?php
                $footerPhoto = $footer->findOne(["name" => "footer-photo"]);
                echo "<div class='footer-left-photo' style='background-image: url($footerPhoto->url);'></div>";
            ?>
            <div class="footer-left-information">
                <?php
                    $footerInformation = $footer->findOne(["name"=> "footer-information"]);
                    echo "<div class='footer-name'>$footerInformation->footerName</div>
                          <div class='footer-no'>$footerInformation->footerNo</div>
                          <div class='footer-mail'>$footerInformation->footerMail</div>";
                ?>
            </div>
        </div>
        <div class="back-to-top" id="backToTop" onclick="goTop()"><i class="fa fa-arrow-up"></i></div><!-- CSS properties in container.css-->
        <!-- Footer resume -->

        <div class="footer-right-div">
            <p class="footer-right-resume">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente ipsa perspiciatis quis mollitia deserunt. Consequatur repudiandae, corporis vel, ut nemo cum nobis ad hic suscipit accusamus! Laudantium, autem rerum sequi!Harum neque facilis ipsa, atque corrupti blanditiis sequi a eum eligendi, fugit id repudiandae. Suscipit perferendis maxime unde quas recusandae explicabo, pariatur, repellat sit voluptate, velit dignissimos. Et, odit quo.
            </p>
        </div>
    
     <div class="footer-right-div">
            <p class="footer-right-resume">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolorum dolore iure, minima aspernatur cumque optio accusantium, voluptates dolores natus quas consectetur sit obcaecati consequatur maxime doloribus blanditiis molestiae quibusdam. Officiis.
            </p>
        </div>
    </footer>
</body>

</html>