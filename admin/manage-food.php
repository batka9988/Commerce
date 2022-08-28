<?php include('partials/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Manage Food</h1>
        <br /><br />
        <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Хоол нэмнэ</a>
        <br /><br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if(isset($_SESSION['unauthorize']))
        {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        ?>
        <table class="tbl-full">
            <tr>
                <th>№</th>
                <th>Бүтэн нэр</th>
                <th>Үнэ</th>
                <th>Зураг</th>
                <th>Онцолох</th>
                <th>Идэвхитэй</th>
                <th>Үйлдлүүд</th>
            </tr>

            <?php
            //бүх хоолыг авахын тулд sql query үүсгэнэ
            $sql = "SELECT * FROM tbl_food";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn=1;

            if ($count > 0)
             {
                while ($row = mysqli_fetch_assoc($res))
                 {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>

                    <tr>
                        
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td>₮.<?php echo $price; ?></td>
                        <td>
                            <?php 

                            if( $image_name=="")
                            {
                                echo "<div class='error'>Зураг нэмээгүй </div>";
                            }
                            else
                            {
                                ?>
                                <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" width="50px">
                                <?php
                            }
                             ?>
                        </td>
                        <td><?php echo $featured; ?></td>
                        <td><?php echo $active; ?></td>

                        <td>
                            <a href="<?php echo SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-secondary">шинэчлэх</a>
                            <a href="<?php echo SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">устгах</a>
                        </td>
                    </tr>

            <?php
                }
            } else {
                echo "<tr> <td colsapn='7' class='error'>хараахан нэмээгүй</td></tr>";
            }
            ?>

        </table>
    </div>
</div>
<?php include('partials/footer.php'); ?>