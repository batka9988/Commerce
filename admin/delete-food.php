<?php 
include('../config/constants.php');

//echo  "delete-food page";
if(isset($_GET['id']) && isset($_GET['image_name']))
{
    //echo "Process to delete";
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];
    if($image_name !="")
    {
        $path = "../images/food/".$image_name;

        $remove = unlink($path);
        if($remove==false)
        {
            $_SESSION['upload'] = "<div class=''error>Зургийг устгаж чадсангүй </div>";
            header('location' .SITEURL.'admin/manage-food.php');
            die();
        }
    }

    $sql = "DELETE FROM tbl_food WHERE id=$id";

    $res = mysqli_query($conn, $sql);

    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Хоолыг устгалаа</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
    else
    {
        $_SESSION['delete'] = "<div class='error'>Хоолыг устгаж чадсангүй</div>";
        header('location:'.SITEURL.'admin/manage-food.php');
    }
}
else
{
    //echo "Redrict";
    $_SESSION['unauthorize'] = "<div class='error'> зөвшөөрөлгүй хандалт</div>";
    header('location'.SITEURL.'admin/manage-food.php');
}
?>