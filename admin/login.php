<?php include('../config/constants.php'); ?>


<html>
    <head>
           <title>Нэвтрэх</title>
           <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
    <div id="bg-img">
        <div class="login">
            <h1 class="text-center">Нэвтрэх</h1>
            <br><br>

            <?php 
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
            ?>
            <form action="" method="POST" class="text-center">
                Нэвтрэх нэр:
                <br>
                <input type="text" name="username" placeholder="Нэвтрэх нэр"><br><br>
                Нууц үг: <br>
                <input type="password" name="password" placeholder="Нууц үг"><br><br>

                <input type="submit" name="submit" value="Нэвтрэх" class="btn-primary-1">

                <p class="text-center">  <a href="www.batka.batuuk@gmail.com"></a></p>
        </div>
        </div>
    </body>
</html>

<?php 
if(isset($_POST['submit']))
{
     $username = $_POST['username'];
     $password = md5($_POST['password']);

     $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

     $res = mysqli_query($conn,$sql);

     $count = mysqli_num_rows($res);

     if($count==1)
     {
        $_SESSION['login']= "<div class='success'> Амжилттай нэвтэрлэ.</div>";
        $_SESSION['user'] = $username;

        header('location:'.SITEURL.'admin/');
     }
     else
     {
        $_SESSION['login'] = "<div class='error'>Хэрэглэгчийн нэр эсвэл нууц үг буруу байна. </div>";
        header('location:'.SITEURL.'admin/login.php');
     }

}
?>