<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1> Ангилал нэмэх</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset ($_SESSION['add']);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset ($_SESSION['upload']);
        }
        ?>
        <form action="" method="POST" enctype="multipart/form-data">

        <table class="tbl-30">
            <tr>
                <td>Нэр:</td>
                <td>
                    <input type="text" name="title" placeholder="Ангиллын Нэр">
                </td>
            </tr>

            <tr>
                <td>Зураг сонгох</td>
                <td> 
                    <input type="file" name="image">;
                </td>
            </tr>

            <tr>
                <td>Онцолох:</td>
                <td>
                    <input type="radio" name="featured" value="Тийм"> Тийм
                    <input type="radio" name="featured" value="Үгүй"> Үгүй
                </td>
            </tr>

            <tr>
                <td>Идэвхтэй:</td>
                <td>
                    <input type="radio" name="active" value="Тийм"> Тийм
                    <input type="radio" name="active" value="Үгүй"> Үгүй
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Ангилал нэмэх"  class=" btn-secondary">
                </td>
            </tr>

        </table>
    </form>

    <?php 

    if(isset($_POST['submit']))
    {
        //echo "clicked";
        $title = $_POST['title'];

        if(isset($_POST['featured']))
        {
            $featured = $_POST['featured'];
        }
        else
        {
            $featured = "No";
        }

        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            $active = "No";
        }

        //print_r($_FILES['image']);

        //die();

        if(isset($_FILES['image']['name']))
        {
            $image_name = $_FILES['image']['name'];
            if($image_name !="")
            {

            

               $ext = end(explode('.',$image_name));

               $image_name = "food_category_".rand(000, 999).'.'.$ext;


               $source_path = $_FILES['image']['tmp_name'];

                $destination_path = "../images/category/".$image_name;
            
                $upload = move_uploaded_file($source_path,$destination_path);

                 if($upload==false)
                {
                  $_SESSION['upload'] = "<div class='error'>Зураг байршуулж чадсангүй.</div>";
                  header('location:'.SITEURL.'admin/add-category.php');

                  die();
                }
            }
        }
        else
        {
            $image_name="";
        }
        $sql = "INSERT INTO tbl_category SET
        title='$title',
        image_name='$image_name',
        featured='$featured',
        active='$active'
        ";

        $res = mysqli_query($conn, $sql);

        if($res==true)
        {
            $_SESSION['add'] = "<div class='success'> Амжилттай нэмсэн. </div>";
            header('location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            $_SESSION['add'] = "<div class='error'>Ангилал нэмж чадсангүй. </div>";
            header('location:'.SITEURL. 'admin/add-category.php');
        }
    }
    ?>

    </div>
</div>

<?php ('partials/footer.php'); ?> 