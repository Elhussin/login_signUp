<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>EDIT USER</title>
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


        <?php
session_start();
if(isset($_SESSION['user'])){
if($_SESSION['user']->ROEL === "ADMIN"){
    require_once '../datapass.php';
if(isset( $_SESSION['userid'])){
  $edituser = $databass->prepare("SELECT * FROM users WHERE ID = :id");
$edituser->bindParam('id', $_SESSION['userid']);
$edituser->execute();
$edituser=$edituser->fetchObject();



echo '<form method="POST">

<a class=" w-100 btn btn-outline-danger mt-3" href="index.php">الرئيسيه</a>
<a class=" w-100 btn btn-outline-danger mt-3" href="search.php">بحث</a>

<div class="p-3 alert-info shadow">   NAME:  </div>
<input  class="form-control mb-1"   type="text" name="NAME" value="'.$edituser->NAME.'"required>
<div class="p-3 alert-info shadow">  AGE:  </div>
<input  class="form-control mb-1"  type="date" name="AGE" value="'.$edituser->AGE.'"required >
<div class="p-3 alert-info shadow">  EMAIL </div>

<input  class="form-control mb-1"  type="EMAIL" name="EMAIL" value="'.$edituser->EMAIL.'"required >';


echo '<select class="form-control mb-3" name="activated" required > ';
if($edituser->ACTIEV === "1"){
    echo ' <option value="' .$edituser->ACTIVATED.' ">حساب مفعل</option>';
}else{
    echo ' <option value="' .$edituser->ACTIVATED.' ">حساب غير مفعل</option>';
}
echo '
<option value="0">الغاء تفعيل</option>
<option value="1">تفعيل</option>
</select>

<button class=" w-100 btn btn-outline-info mt-3" type="submit" name="updat" value="'.$edituser->ID.'" >تحديث</button>';
echo '</form>';
}



if(isset($_POST['updat'])){
    $updateuser =$databass->prepare("UPDATE users SET NAME=:NAME ,
    AGE=:AGE ,ACTIEV=:ACTIEV1, EMAIL=:EMAIL WHERE ID=:USERID");
    $updateuser->bindParam('USERID',$_SESSION['userid']);
    $updateuser->bindParam('NAME',$_POST['NAME']);
    $updateuser->bindParam('AGE',$_POST['AGE']);
    $updateuser->bindParam('EMAIL',$_POST['EMAIL']);
    $updateuser->bindParam('ACTIEV1',$_POST['activated']);
     if($updateuser->execute()){
        echo "تم تحديث ";
        // var_dump($updateuser->errorInfo());

        header("location:edituser.php");}
        else{
            echo "فشل التحديث ";
            
          }

      
    }
    
        echo "<form> <button class='btn btn-danger w-100' type='submit' name='logout'>تسجيل خروج</button></form>";
    }else{
        header("http://new-worled.eb2a.com/out/login.php",true); 
        die("");
      }
}else{
        header("http://new-worled.eb2a.com/out/login.php",true); 
        die(""); 

      }
      



if(isset($_GET['logout'])){
    session_unset();
    session_destroy();
    header("http://new-worled.eb2a.com/out/login.php",true); 
}

    ?>
    </main>
</body>

</html>