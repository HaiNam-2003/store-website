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

<style>
.wrapper_method {
    text-align: center;
    width: 550px;
    margin: 0 auto;
    border: 1px solid #666;
    padding: 20px;
    background: #ffe4e6;
}

.payment {
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    text-decoration: underline;
}

.wrapper_method a {
    padding: 10px;
    background: #f43f5e;
    color: white;
}

.wrapper_method h3 {
    margin-bottom: 20px;
}
</style>

<div class="main">
    <div class="content">
        <div class="section group">
            <div class="content_top">
                <div class="heading">
                    <h3>PHƯƠNG THỨC THANH TOÁN</h3>
                </div>
                <div class="clear"></div>
                <div class="wrapper_method">
                    <h3 class="payment">Chọn phương thức thanh toán</h3>
                    <a class="payment_href" href="offlinepayment.php">Thanh toán gián tiếp</a>
                    <a href="onlinepayment.php">Thanh toán trực tiếp</a></p>
                </div>
            </div>

        </div>
    </div>
    <?php
include "include/footer.php";

?>