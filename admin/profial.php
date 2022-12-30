<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Ubdate</title>
</head>

<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <?php
  echo  '<form >
     <button class="btn btn-outline-danger mt-3"  type="submit" name="logout">Sign Out</button>
 </form>'; ?>
            <a class="navbar-brand" href="#">

                Hussain
            </a>
            <img src="../img/logo.jpg" alt="" width="50" height="50" class="d-inline-block align-text-top">

        </div>
    </nav>



    <main class="container mt-3 " style=" max-width:720px; margin:outo;">
        <!-- "text-align:right; direction:ltr; -->

        <?php

session_start();
if(isset($_SESSION['user'])){


    if($_SESSION['user']->ROEL === "ADMIN"){
        
   

    // من اجل تحديد الوصول والحمايه

        echo '<form  method="POST" >
        <div class="p-3 shadow">   NAME:  </div>
        <input  class="form-control mb-1"   type="text" name="NAME" value="'.$_SESSION['user']->NAME.'"required>
      <div class="p-3 shadow">  AGE:  </div>
        <input  class="form-control mb-1"  type="date" name="AGE" value="'.$_SESSION['user']->AGE.'"required >
        <div class="p-3 shadow">   PASSWORD: </div>
        <input  class="form-control mb-1" type="password" name="PASSWORD" required>
     
        <button class=" w-100 btn btn-outline-info mt-3" type="submit" name="updat" value="'.$_SESSION['user']->ID.'" >تحديث</button>
        <a class=" w-100 btn btn-outline-danger mt-3" href="index.php">الرئيسيه</a>
        
        </form>';
        
  
  


if(isset($_POST['updat'])){
    require_once '../datapass.php';

    $updteUser=$databass->prepare("UPDATE `users` SET  NAME  =:NAME, AGE =:AGE  , PASSWORD=:PASSWORD Where ID =:id " );
$updteUser->bindParam('NAME',$_POST['NAME']);
$updteUser->bindParam('AGE',$_POST['AGE']);
// $updteUser->bindParam('PASSWORD',$_POST['PASSWORD']);
$password=sha1($_POST['PASSWORD']);
$updteUser->bindParam('PASSWORD',$password);
 $updteUser->bindParam('id',$_POST['updat']);
if($updteUser->execute()){
    echo '<div class="alert alert-info" role="alert">
    تم تحديث البيانات
</div>';

    // تحديث بيانات الجلسه
    $user=$databass->prepare("SELECT * FROM `users` WHERE ID=:id ");
    $user->bindParam('id',$_POST['updat']);
    
    $user->execute();
    $_SESSION['user']=$user->fetchObject();
    header("refresh:2;"); // تحديث الصفحه

}else{

    echo '<div class="alert alert-danger" role="alert">
    فشل تحديث البيانات
</div>';
    


    }

}



}else{

    session_unset();// حذف الجلسه وتدمير البيانات
    session_destroy();
    header("http://new-worled.eb2a.com/out/login.php",true);
}
    }
else{
    session_unset();// حذف الجلسه وتدمير البيانات
    session_destroy();
    header("location:http://new-worled.eb2a.com/out/login.php",true);


}



// تفعيل زر الانهاء 
if(isset($_GET['logout'])){
    session_unset();// حذف الجلسه وتدمير البيانات
    session_destroy();
    header("location:http://new-worled.eb2a.com/out/login.php",true);

}

   



?>
    </main>
</body>