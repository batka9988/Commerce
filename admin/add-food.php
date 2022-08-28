<?php include('partials/menu.php'); ?>

 <div class="main-content">
      <div class="wrapper">
           <h1>Бараа нэмнэ</h1>

           <br><br>

           <?php 
           if(isset($_SESSION['upload']))
           {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
           }
           ?>
           
           <form action="" method="POST"    enctype="multipart/form-data">
            <table class="tbl-30">

            <tr>
                <td>Нэр:</td>
                <td>
                    <input type="text" name="title" placeholder="Барааны нэр">
                </td>
            </tr>


            <tr>
                <td>Тодорхойлолт:</td>
                <td>
                    <textarea name="description" cols="30" rows="5" placeholder="Барааны тайлбар." ></textarea>
                </td>
            </tr>

            <tr>
                <td>Үнэ:</td>
                <td>
                    <input type="number" name="price">
                </td>
            </tr>

            <tr>
                <td>Зураг сонгох:</td>
                <td>
                    <input type="file" name="image">
                </td>
            </tr>

            <tr>
                <td>Ангилал:</td>
                <td>
                    <select name="category">

                    <?php  
                    $sql = " SELECT * FROM tbl_category WHERE active='Үгүй'";

                    $res = mysqli_query($conn, $sql);

                    $count = mysqli_num_rows($res);

                    if($count>0)
                    {
                        
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //ангиллын дэлгэрэнгүй мэдээллийг авах
                            $id = $row['id'];
                            $title = $row['title'];
                            
                            ?>

                              <option value="<?php echo $id; ?>"><?php echo $title; ?></option>

                            <?php
                        }
                    }
                    else
                    {
                        ?>

                        <option value="0">Бараагүй</option> 
                        
                        <?php
                    }
                    ?>
                    </select>
                </td>
            </tr>

            <tr>
                <td>Онцолох:</td>
                <td>
                    <input type="radio" name="featured" value="Тийм">Тийм
                    <input type="radio" name="featured" value="Үгүй">Үгүй
                </td>
            </tr>

            <tr>
                <td>Идэвхитэй:</td>
                <td>
                    <input type="radio" name="active" value="Тийм">Тийм
                    <input type="radio" name="active" value="Үгүй">Үгүй
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Бараа нэмэх" class="btn-secondary">
                </td>
            </tr>
            </table>
          </form>

          <?php
           if(isset($_POST['submit']))
           {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $category = $_POST['category'];

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

            if(isset($_FILES['image']['name']))
            {
                $image_name = $_FILES['image']['name'];

                if($image_name !="")
                {
                    //зургийн ID сонгох
                    $ext = end(explode('.',$image_name));

                    $image_name = "Food-name-".rand(0000,9999). ".".$ext;

                    $src=$_FILES['image']['tmp_name'];

                    $dst = "../images/food/".$image_name;
                    $upload = move_uploaded_file($src, $dst);

                    if($upload==false)
                    {
        
                        $_SESSION['upload']= "<div class='error'>Зургийг байршуулж чадсангүй.</div>";
                        header('location:'.SITEURL.'admin/add-food.php');
                        die();
                    }
                }
            }
            else
            {
                $image_name = "";
            }
            //3.мэдээллийн санд оруулах
            //Хоолны хуудсыг удирдах sql асуулга үүсгэх
            $sql2 ="INSERT INTO tbl_food SET 
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = $category,
            featured = '$featured',
            active ='$active'
            ";

            $res2 = mysqli_query($conn, $sql2);

            if($res2 == true)
            {
                //data inserted 
                $_SESSION['add'] = "<div class='success'>Барааг амжилттай нэмсэн.</div>";
                header('location:' .SITEURL. 'admin/manage-food.php');
            }
            else
            {
                $_SESSION['add'] = "<div class='error'>Бараа нэмж чадсангүй.</div>";
                header('location:' .SITEURL. 'admin/manage-food.php');
            }
           }
          ?>
      </div>
 </div>


<?php include('partials/footer.php'); ?>