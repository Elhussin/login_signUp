<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Home</title>
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

<main class="container mt-3 "  style="max-width: 720px;">
<?php

session_start();

//  كود المل عن الحمايه لمنع الاختراق والتحقق قبل عند اعاده التوجيه 
if(isset($_SESSION['user'])){
    
    if($_SESSION['user']->ROEL=== "SUBADMIN"){// التحقق من نوع المستخدم
     echo 'wlcome'.$_SESSION['user']->NAME;
    
     //تسجيل الخروج
   echo  '<form >
   <button class="btn btn-outline-danger w-100 mt-3"  type="submit" name="logout">Sign Out</button>
</form>';
echo
'<a class="btn btn-outline-info  w-100  mt-3" href="profial.php">تحديث البيانات</a>
<a class="btn btn-outline-info  w-100  mt-3" href="todo.php">TO DO</a>';       
    }else{
        header("location:http://hussain22.eb2a.comp/login.php",true);

    }
}else{
    header("location:http://hussain22.eb2a.comp/login.ph",true);

}

if(isset($_GET['logout'])){
    session_unset();// حذف الجلسه وتدمير البيانات
    session_destroy();
    header("location:http://hussain22.eb2a.comp/login.ph",true);

}

// -----------------END--------------




?>
</main>


</body>
</html>

