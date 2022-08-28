<?php

include('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    //echo "Get value and delete";
    //echo "Delete page"; 
    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if($image_name !="")
    {
        $path = "../images/category/".$image_name;

        $remove = unlink($path);

        if($remove==false)
        {
            $_SESSION['remove'] = "<div class='error'>Зургийг ангилж чадсангүй.</div>";

            header('location:'.SITEURL.'admin/manage-category.php');

            die();
        }
    }
    $sql = "DELETE FROM tbl_category WHERE id=$id";

    $res = mysqli_query($conn, $sql);
    if($res==true)
    {
        $_SESSION['delete'] = "<div class='success'>Ангилал устгалаа.</div>";

        header('location:'.SITEURL.'admin/manage-category.php');

    }
    else
    {
        $_SESSION['delete'] = "<div class='error'> Ангилал устгаж чадсангүй</div>";
    }
}
else
{

    header('location:' .SITEURL.'admin/manage-category.php');
}

?>