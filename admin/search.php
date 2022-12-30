<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Search</title>
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
        <a class=" w-100 btn btn-outline-danger mt-3" href="index.php">الرئيسيه</a>
        <?php

session_start();

    require_once '../datapass.php';
if(isset($_SESSION['user'])){


    if($_SESSION['user']->ROEL === "ADMIN"){
        echo'
        <form >


<input class=" form-control" type="text" name="searchv" placholder="بحث">
<button class="btn btn-outline-danger w-100 mt-3" type="submit" name="search">بحث</button>

</form>';


        
if(isset($_GET['search'])){

    $search=$databass->prepare("SELECT * FROM  users WHERE  NAME LIKE :VALUE1 or EMAIL LIKE :email");  // or EMAIL LIKE :email
    $searchValue="%".$_GET['searchv'] ."%";

    $search->bindParam('email',$searchValue);
    $search->bindParam('VALUE1',$searchValue);
    $search->execute();


// طريقع عرض TABLE
echo '<table class="table">';
echo   " <tr>";
echo    "<th> ID NO</th>";
echo    "<th> NAME</th>";
echo    "<th> EMAIL</th>";
echo    "<th> DELET</th>";
echo    "<th> DELET</th>";


 echo   "</tr>";
 


foreach($search AS $view){
 
 echo   " <tr>";
 echo    "<td >".$view['ID']."</td>";

 echo   "  <td >".$view['NAME']. "</td>";
 echo    " <td >".$view['EMAIL']."</td>";
 echo '<td> 
 <form method="POST">
<button type="submit" class="btn btn-danger" name="remove"  value="'.$view['ID'].'">Remove</button>

</form> <td> ';
echo '<td> 
 <form method="POST">
<button type="submit" class="btn btn-warning" name="edit"  value="'.$view['ID'].'">Edit</button>

</form> <td> ';
 
    
  echo   '</tr>';
  

    }
  echo ' </table>';


}



// زر الحذف
//  اولا حذف البيانات المترابطه
if(isset($_POST['remove'])){
    
 //$removeItems =  $database->prepare("DELETE FROM todolist WHERE ID = :id");

    $removiteam=$databass->prepare("DELETE FROM `todo` WHERE USERID=:userid");
    $removiteam->bindParam('userid',$_POST['remove']);
    $removiteam->execute();
    //   echo $removiteam->errorInfo();
    // حذ ف  المستخدم
    $removuser=$databass->prepare("DELETE FROM `users` WHERE ID=:id");
    $removuser->bindParam('id',$_POST['remove']);
    if($removuser->execute()){
        echo  '<div class="alert alert-info">تم الحذف</div>';
        header("Refresh:2; url=search.php");
       
    }}

// زر التعديل  المستخدم
if(isset($_POST['edit'])){
  session_start();
 $_SESSION['userid']=$_POST['edit'];  // لتخزين البيانات
 header("location:edituser.php");

}



//  END TABLE VIEW 
}else{

    session_unset();// حذف الجلسه وتدمير البيانات
    session_destroy();
    header("location:http://new-worled.eb2a.com/login.php",true);
}
    }
else{
    session_unset();// حذف الجلسه وتدمير البيانات
    session_destroy();
    header("location:http://new-worled.eb2a.com/login.php",true);


}







if(isset($_GET['logout'])){
    session_unset();// حذف الجلسه وتدمير البيانات
    session_destroy();
    header("location:http://new-worled.eb2a.com/login.php",true);

}

   



?>
    </main>




</body>