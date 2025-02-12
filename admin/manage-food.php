<?php
if (isset($_GET['id'])) {
     include('partials/amenu.php'); 
}
?>
<div class="main-content" id="6">
    <div class="wrapper">
        <h1 class="text-center">Manage Food</h1>

        <br /><br />

        <!-- Button to Add Admin -->
        <a href="<?php echo $SITEURL; ?>admin/add-food.php" class="btn btn-outline-secondary m-1">Add Food</a>

        <br /><br /><br />

        <?php
        if (isset($_SESSION['add'])) {
            echo $_SESSION['add'];
            unset($_SESSION['add']);
        }

        if (isset($_SESSION['delete'])) {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if (isset($_SESSION['upload'])) {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }

        if (isset($_SESSION['unauthorize'])) {
            echo $_SESSION['unauthorize'];
            unset($_SESSION['unauthorize']);
        }

        if (isset($_SESSION['update'])) {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        ?>

        <table class="tbl-full">
            <tr>
                <th>S.N.</th>
                <th>Title</th>
                <th>Price</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
            $sql = "SELECT * FROM tbl_food";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            $sn = 1;

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $image_name = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];
            ?>

            <tr>
                <td><?php echo $sn++; ?>. </td>
                <td><?php echo $title; ?></td>
                <td>&#8377; <?php echo $price; ?> </td>
                <td>
                    <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not Added.</div>";
                            } else {
                            ?>
                    <img src="<?php echo $SITEURL; ?>images/food/<?php echo $image_name; ?>" width="100px"
                        style="height: 20%; width:25%;border-radius:100px;">
                    <?php
                            }
                            ?>
                </td>
                <td><?php echo $featured; ?></td>
                <td><?php echo $active; ?></td>
                <td>
                    <a href="<?php echo $SITEURL; ?>admin/update-food.php?id=<?php echo $id; ?>"
                        class="btn btn-outline-secondary m-1">Update Food</a>
                    <a href="<?php echo $SITEURL; ?>admin/delete-food.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"
                        class="btn btn-outline-secondary m-1">Delete Food</a>
                </td>
            </tr>

            <?php
                }
            } else {
                //Food not Added in Database
                echo "<tr> <td colspan='7' class='error'> Food not Added Yet. </td> </tr>";
            }

            ?>


        </table>
    </div>

</div>

<?php include('partials/footer.php'); ?>