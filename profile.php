<?php
include "include/header.php";

?>

<?php
    $login_check = Session::get('customer_login');
    if($login_check == false) {
        header('location: login.php');
    }
?>

<?php
    // if(isset($_GET['proid'])) {
    //     $id = $_GET['proid'];
    // }

    // if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     $soluong = $_POST['soLuong'];
    //     $addToCart = $cart -> add_to_cart($soluong, $id);
    // }
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>THÔNG TIN KHÁCH HÀNG</h3>
                </div>
                <div class="clear"></div>
            </div>
            <table class="tblone">
                <?php
                $id = Session::get('customer_id');
                $get_customers = $customer->show_customer($id);
                if($get_customers) {
                    while($resul = $get_customers->fetch_assoc()) {
                ?>
                <tr>
                    <td>Tên</td>
                    <td>:</td>
                    <td><?php echo $resul['name'] ?></td>
                </tr>
                <tr>
                    <td>Số điện thoại</td>
                    <td>:</td>
                    <td><?php echo $resul['phone'] ?></td>
                </tr>
                <tr>
                    <td>Thành phố</td>
                    <td>:</td>
                    <td><?php echo $resul['city'] ?></td>
                </tr>
                <tr>
                    <td>Địa chỉ</td>
                    <td>:</td>
                    <td><?php echo $resul['address'] ?></td>
                </tr>
                <!-- <tr>
                    <td>Quốc gia</td>
                    <td>:</td>
                    <td><?php echo $resul['country'] ?></td>
                </tr> -->
                <tr>
                    <td>Zip Code</td>
                    <td>:</td>
                    <td><?php echo $resul['zipcode'] ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?php echo $resul['email'] ?></td>
                </tr>
                <tr>
                    <td colspan="3"><a href="editprofile.php">Cập nhập</a></td>
                </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
    <?php
include "include/footer.php";

?>