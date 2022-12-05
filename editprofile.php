<?php
include "include/header.php";

?>

<?php
// khong login thi ve trang login
    $login_check = Session::get('customer_login');
    if($login_check == false) {
        header('location: login.php');
    }
?>

<?php
    // if(isset($_GET['proid'])) {
    //     $id = $_GET['proid'];
    // }
    $id = Session::get('customer_id');
    if($_SERVER['REQUEST_METHOD'] === 'POST'  && isset($_POST['save'])) {
        
        $update_customer = $customer -> update_customer($_POST, $id);
    }
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>CẬP NHẬP THÔNG TIN KHÁCH HÀNG</h3>
                </div>
                <div class="clear"></div>
            </div>
            <form action="" method="POST">
                <table class="tblone">
                    <tr>
                        <?php
                            if(isset($update_customer)) {
                                echo '<td colspan="3">'.$update_customer.'</td>';
                            }
                            ?>
                    </tr>
                    <?php
                $id = Session::get('customer_id');
                $get_customers = $customer->show_customer($id);
                if($get_customers) {
                    while($resul = $get_customers->fetch_assoc()) {
                ?>
                    <tr>
                        <td>Tên</td>
                        <td>:</td>
                        <td><input type="text" name="name" value="<?php echo $resul['name'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Số điện thoại</td>
                        <td>:</td>
                        <td><input type="text" name="phone" value="<?php echo $resul['phone'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Địa chỉ</td>
                        <td>:</td>
                        <td><input type="text" name="address" value="<?php echo $resul['address'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Zip Code</td>
                        <td>:</td>
                        <td><input type="text" name="zipcode" value="<?php echo $resul['zipcode'] ?>"></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>:</td>
                        <td><input type="text" name="email" value="<?php echo $resul['email'] ?>"></td>
                    </tr>
                    <tr>
                        <td colspan="3"><input style="padding:10px" type="submit" name="save" value="Cập nhập"></td>
                    </tr>
                    <?php
                    }
                }
                ?>
                </table>
            </form>
        </div>
    </div>
    <?php
include "include/footer.php";

?>