<?php

//hide warning of header
ob_start();

include('partials/amenu.php'); ?>

<div class="main-content">
    <div class="wrapper">
        <h1>Change User Password</h1>
        <br><br>

        <?php
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
        }
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Current Password: </td>
                    <td>
                        <input type="password" name="current_password" placeholder="Current Password">
                    </td>
                </tr>

                <tr>
                    <td>New Password:</td>
                    <td>
                        <input type="password" name="new_password" placeholder="New Password">
                    </td>
                </tr>

                <tr>
                    <td>Confirm Password: </td>
                    <td>
                        <input type="password" name="confirm_password" placeholder="Confirm Password">
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="change_pass" value="Change password" class="btn-secondary">
                    </td>
                </tr>

            </table>

        </form>

    </div>
</div>

<?php

if (isset($_POST['change_pass'])) {

    $id = $_POST['id'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];


    $sql = "SELECT * FROM tbl_user WHERE cid='$id' AND password='$current_password'";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $count = mysqli_num_rows($res);
        if ($count == 1) {
            if ($new_password == $confirm_password) {
                $sql2 = "UPDATE tbl_user SET 
                                password='$new_password' 
                                WHERE cid='$id'
                            ";

                $res2 = mysqli_query($conn, $sql2);
                if ($res2 == true) {
                    $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully. </div>";
                    header('location:' . $SITEURL . 'admin/manage-user.php?id=4');
                } else {
                    $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password. </div>";
                    header('location:' . $SITEURL . 'admin/manage-user.php?id=4');
                }
            } else {
                $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Patch. </div>";
                header('location:' . $SITEURL . 'admin/manage-user.php?id=4');
            }
        } else {
            $_SESSION['user-not-found'] = "<div class='error'>User Not Found. </div>";
            header('location:' . $SITEURL . 'admin/manage-user.php?id=4');
        }
    }
}

?>


<?php include('partials/footer.php');

//hide warning of header
ob_flush();

?>