<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Админ нэмэх</h1>

        <br><br>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }
        ?>
        <form action="" method="POST">
            <table class="tbl-30">
                <tr>
                    <td>Бүтэн нэр:</td>
                    <td><input type="text" name="full_name" placeholder="Нэвтрэх нэр"></td>
                </tr>
                <tr>
                    <td>Хэрэглэгч:</td>
                    <td>
                        <input type="text" name="username" placeholder="Username">
                    </td>
                </tr>
                <tr>
                    <td>Нууц үг</td>
                    <td>
                        <input type="password" name="password" placeholder="Нууц үг">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Админ нэмэх" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>

<?php include('partials/footer.php'); ?>


<?php
if(isset($_POST['submit']))
{
    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "INSERT INTO tbl_admin SET
    full_name='$full_name',
    username='$username',
    password='$password'
    ";

    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    if($res==TRUE)
    {
        //echo "Data inserted";
        $_SESSION['add'] = "Админ амжилттай";
        //Redirect Page
        header("location:".SITEURL.'admin/manage-admin.php');
    }
    else
    {
        //echo "Faile to insert Data";
         //echo "Data inserted";
         $_SESSION['add'] = "Админыг нэмж чадсангүй";
         //Redirect Page
         header("location:".SITEURL.'admin/add-admin.php');
    }
}
?>