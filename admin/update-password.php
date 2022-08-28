<?php include('partials/menu.php');  ?>
<div class="main-content">
    <div class="wrapper">
        <h1>Нууц үг солих</h1>
        <br><br>

        <?php
        if(isset($_GET['id']))
        {
            $id=$_GET['id'];
        }
        ?>
        <form action="" method="POST">

        <table class="tbl-30">
            <tr>
                <td>Хуучин нууц үг</td>
                <td>
                    <input type="password" name="current_password" placeholder="хуучин нууц үг"> 
                </td>
            </tr>

            <tr>
                <td>Шинэ нууц үг: </td>
                <td>
                    <input type="password" name="new_password" placeholder="Шинэ нууц үг">
                </td>
            </tr>

            <tr>
                <td>Нууц үгээ баталах: </td>
                <td>
                    <input type="password" name="confirm_password" placeholder="Нууц үгээ баталгаажуулах">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                    <input type="submit" name="submit" value="Нууц үг солих" class="btn-secondary">
                </td>
            </tr>
        </table>
        </form>

    </div>
</div>

<?php 
if(isset($_POST['submit']))
{
    //echo "Clicked";

    $id=$_POST['id'];
    $current_password = md5($_POST['current_password']);
    $new_password = md5($_POST['new_password']);
    $confirm_password = md5($_POST['confirm_password']);

    $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password=' $current_password'";

    $res= mysqli_query($conn, $sql);

    if($res==true)
    {
        $count=mysqli_num_rows($res);

        if($count==1)
        {
            //echo "User found";
            if($new_password==$confirm_password)
            {
                //update the password
                //echo "Password match";
                $sql2 = "UPDATE tbl_admin SET password='$new_password' WHERE id=$id";

                $res2 = mysqli_query($conn, $sql2);

                if($res2==true)
                {
                    //display
                    $_SESSION['change-pwd'] = "<div class='success'>Нууц үг амжилттай өөрчлөгдсөн. </div>";
                 header('location:'.SITEURL.'admin/manage-admin.php');
                }
                else
                {
                    //display not
                    $_SESSION['change-pwd'] = "<div class='error'>Нууц үгийг өөрчилж чадсангүй. </div>";
                 header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                 //manage admin
                 $_SESSION['pwd-not-match'] = "<div class='error'>нууц үг засварлаагүй. </div>";
                 header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
        else
        {
            $_SESSION['user-not-found'] = "<div class='error'>Хэрэглэгч олдсонгүй. </div>";
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
    }
}
 ?>

<?php include('partials/footer.php'); ?>