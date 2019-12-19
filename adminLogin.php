<!DOCTYPE html>
<html lang="tr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Slabo+27px" rel="stylesheet">
  <title>Login Page</title>

  <style>
  body{}
    #main{
      width: 100%;
      height: 500px;
      display: flex;
    }
    .container{
      justify-content: center;
      text-align: center;
      color: #000099;           /*#cc00cc;*/
      margin: auto;
      font-family: 'Indie Flower', cursive;
    }

    .flex-1{
      display: flex;
      flex-direction: row;
      justify-content: center;
    }

    .flex-2{
      margin-top: 5px;
      display: flex;
      flex-direction: row;
      justify-content: center;
    }

    .flex-3{
      margin-top: 10px;
      display: flex;
      flex-direction: row;
      justify-content: center;
    }
    .inputText{
      background-color: transparent;
      border: 1px solid #ccc;
      width: 300px;
      height: 25px;
      border-radius: 30px;
      outline: none;
      padding: 12px;
      font-size: 24px;
      transition: 0.4s;
      font-family: 'Slabo 27px', serif;
    }
    .inputText:focus{
      width: 350px;
      transition: 0.4s;
      border: 1px solid blue;
    }
    .button{
      background-color: transparent;
      border: 1px solid blue;
      width: 100px;
      height: 40px;
      cursor: pointer;
      color : #000099;
      transition: 0.4s;
      outline: none;
      border-radius: 30px;
    }

    .button:hover{
      background-color: #000099;
      border: 0px;
      color:white;
      transition: 0.4s;
    }

  </style>

</head>

<body>
    <form method="post" action="dashboard.php">
        <div id="main">
        <div class="container">
            <h1> Admin Login Page </h1>
            <div class="flex-1"> <input type="text" class="inputText" placeholder="Kullanıcı Adı" name="kullaniciAdi" /> </div>
            <div class="flex-2"> <input type="password" class="inputText" placeholder="Şifre" name="kullaniciSifresi" /> </div>
            <div class="flex-3"> <input type="submit" class="button" name="giris" value="Login" /> </div>
        </div>
    </form>
</div>


</body>

</html>
