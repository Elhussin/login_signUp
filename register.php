<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
</head>

<body>
    <?php require_once "nav.php";?>
    <div class="container">
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Name<SPAn style="color:red">*</SPAn></label>
                <input class="form-control" id="exampleInputEmail1" type="text" name="Name" required />

            </div>
            <div class="mb-3">
                <label class="form-label" required>Age <SPAn style="color:red">*</SPAn></label>
                <input type="date" name="Age" />
            </div>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email <SPAn style="color:red">*</SPAn></label>
                <input class="form-control" id="exampleInputEmail1" type="email" name="Email" required />
            </div>
            <div class="mb-3">
                <label class="form-label">Password<SPAn style="color:red">*</SPAn></label>
                <input class="form-control" type="password" name="Password" required />
            </div>
            <div class="mb-3">
                <button class="btn btn-primary" type="submit" name="signUP">signUP</button>

                <a class="btn btn-dark  " href="login.php">Log In </a>

            </div>
        </form>
    </div>

    <?php

use PHPMailer\PHPMailer\SMTP;
require_once 'datapass.php';


// التحقق من عدم وجود الايميل سابقا
if(isset($_POST['signUP'])){
$checkEmail =$databass->prepare("SELECT * FROM `users` WHERE EMAIL= :EMAIL1");
$Email=$_POST['Email'];
$checkEmail->bindParam('EMAIL1',$Email);
$checkEmail->execute();
if($checkEmail->rowCount()>0){
    echo '<div class="alert alert-danger" role="alert">
    This Email Is Use 
  </div>';


}
else{
    // البيانات المستقبله من العميل 
    $name=$_POST['Name'];
    $email=$_POST['Email'];
    $age=$_POST['Age'];
    $password=sha1($_POST['Password']); // لتشفير كلمه المرور ايضا يمكن استعمال md5
    $SECUERTY_COD=md5(date("h:i:s"));

    $register=$databass->prepare("INSERT INTO `users`(`NAME`, `EMAIL`, `AGE`, `PASSWORD` ,`SECUERTY_COD`,`ROEL`,`ACTIEV` ) 
    VALUES (:name,:email ,:age,:password ,:SECUERTY_COD,'USER' ,'0')");
    $register->bindParam('name',$name);
    $register->bindParam('email',$email);
    $register->bindParam('age',$age);
    
    $register->bindParam('password',$password);


    $register->bindParam('SECUERTY_COD', $SECUERTY_COD);  

    if($register->execute()){


   echo '<div class="alert alert-success" role="alert">
  "يرجي تفعيل حسابك من خلال الرابط المرسل الي الايميل الخاص بك"
</div>';

require_once "mail.php";
$mail->addAddress($email) ;

$mail->Subject = 'Confiarm Youer Mail';

$mail->Body    = 
'  يرجي تفعيل حسابك  اهلا وسهلا بك في عالمك الجديد'.
'<div>رابط التحقق </div>'.
'<a href="http://new-worled.eb2a.com/active.php?code='.$SECUERTY_COD.'">
http://new-worled.eb2a.com/active.php?code='.$SECUERTY_COD.'

</a>';


$mail->send();
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
    }
    else{
        echo '<div class="alert alert-danger" role="alert">
        cheak Youer informatian
      </div>';
    }
    //  var_dump($register->errorInfo());
}


}


?>
</body>

</html>