<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

</head>
<body>
<?php require_once "nav.php";?>
<?php  require_once 'datapass.php'; ?>

<main class="contanier m-auto" style=" text-align:center; max-width :720px; margin-top:50px !important">


<?php
if(isset($_GET['code'])){   
    // echo'<form method="post">

    // Email:
    // <input type="email" name="email">
    
    // <button name="reset" type="submit">تحقق</button>
    
    // </form>   ';
    echo 
    '<form method="POST">
    
    <div class="p-3 shadow mb-3">كلمه المرور الجديده   <div>
    <input class="form-control" type="password" name="password" required />
    <button class="btn btn-info mt-3 w-100" type="submit" name="pasupdat" >تغيير كلمه المرور</button>
    </form>';


}else if(isset($_GET['email']) ){
    //&& isset($_GET['code']
    echo 
    '<form method="POST">
    
    <div class="p-3 shadow mb-3">كلمه المرور الجديده   <div>
    <input class="form-control"  type="password" name="password" required/>
    <button class="btn btn-info mt-3 w-100 " type="submit" name="pasupdat" >تغيير كلمه المرور</button>
    </form>';


}else{
  echo'  <form method="post">

<div class="p-3 shadow mb-3"> User Email
</div>
<input class="form-control" type="email" name="email">

<button class="btn mt-3 btn-info mt-3 w-100 " name="reset" type="submit"> التحقق من اميل المتخدم </button>

</form>  ';
}
if(isset($_POST['reset'])){
    

$reset= $databass->prepare("SELECT EMAIL ,SECUERTY_COD FROM `users` WHERE EMAIL=:EMAIL " )  ;
$reset->bindParam('EMAIL',$_POST['email']);
$reset->execute();
if($reset->rowCount()>0){
    
    echo '<div class="alert alert-danger mt-3">تم تحقق من الايميل;</div>'.'<br>';

    header("refresh:2;");
require_once "mail.php";
$user=$reset->fetchObject();
$mail->addAddress($_POST['email']) ;

$mail->Subject = 'Reset Email';

$mail->Body    = 
' لتعيين كلمه المرور 
<br>'.
'<div>اضغط علي الرابط التالي</div>'.
'<a href="http://hussain22.eb2a.com/reset.php?email='.$_POST['email'].'
& code='.$user->SECUERTY_COD.'">

http://hussain22.eb2a.com/reset.php?email='.$_POST['email'].'
& code='.$user->SECUERTY_COD.'"
</a>';

$mail->setFrom("taha2282015@gmail.com","hussain");
$mail->send();
echo '<div class="alert alert-danger mt-3">

 تم ارسال رابط اعاده التعيين ال ايميل الخاص بك
 </div>';
    }
    else{
        echo '<div class="alert alert-danger" >
        this email not avilbeal
      </div>';
    }
    // var_dump($register->errorInfo());
}




?>

<?php


if(isset($_POST['pasupdat'])){
    


    $resetPassword= $databass->prepare("UPDATE `users` SET PASSWORD=:PASSWORD  WHERE EMAIL=:EMAIL " )  ;
    $password=sha1($_POST['password']);
    $resetPassword->bindParam('PASSWORD',$password);
    // $resetPassword->bindParam('PASSWORD',$_POST['password']);
$resetPassword->bindParam('EMAIL',$_GET['email']);  // الايميل المرسل من الرابط


if($resetPassword->execute()){
    echo '<div class="alert alert-danger" role="alert">

    
  تم تغيير كلمه المرو بنجاح </div>';




  

}else{
    echo '<div class="alert alert-danger" role="alert">

    
    خطاء في تعيين كلمه المرور </div>';
  
}



}

?>

</main>

</body>
</html>