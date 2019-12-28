<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="Style.css" rel="stylesheet">
    <title>Document</title>
    <?php
    $pdo = new PDO("mysql:host=localhost;dbname=Admin","admin","12345678");
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $query=$pdo->query("select * from `Calcator`");
    ?>
</head>
<body>
<form method="post" action="">
<div class="boxRegister">
    <h1>ثبت نام</h1>
        <input type="text" name="username" class="login" placeholder="نام کاربری">
        <input type="text" name="firstName" class="password" placeholder=" نام واقعی">
        <input type="text" name="password" class="password" placeholder="کلمه عبور">
        <input type="text" name="email" class="password" placeholder="ایمیل">
        <input type="submit" name="submit" class="submit" value="ارسال">


    <?php
    if (isset($_POST["submit"])) {
        $username = $_POST["username"];
        $firstName = $_POST["firstName"];
        $password = $_POST["password"];
        $email = $_POST["email"];

        $sql= "INSERT INTO `Calcator`(,`username`,`firstname`,`pass`,`email`) VALUES ( :username ,:firstname,:pass,:email)";
        $stmt = $pdo->prepare($sql);
        $stmt ->bindParam(":username" ,$_POST["username"]);
        $stmt ->bindParam(":firstname" ,$_POST["firstName"]);
        $stmt ->bindParam(":pass" ,$_POST["password"]);
        $stmt ->bindParam(":email" ,$_POST["email"]);
        $stmt -> execute();
        $count = $stmt->rowCount();
        if ($count == 1 ){
            $response = "ثبت نام موفقیت آمیز بود";
        }else{
            $response ="ثبت نام با خطا مواجه شد!";
        }
    }

    if (isset($response)){
        echo $response;
    }
    ?>
</div>
</form>
<?php
$query = $pdo->query('SELECT * FROM `Calcator-Users` ');

function UserNameValidation($username){
    if (preg_match("/$[a-zA-Z0-9_]*^]/",$username)){
        return true;
    }
    return false;
}
function firstNameValidation($firstName){
    if (preg_match("/$[A-Z][A-Za-z]*^]/",$firstName)){
        return true;
    }
    return false;
}
?>
</form>

</body>
</html>
