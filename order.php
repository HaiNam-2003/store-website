<?php
include "include/header.php";
// include "include/slider.php";

?>

<?php
    $login_check = Session::get('customer_login');
    if($login_check == false) {
        header('location: login.php');
    }
?>

<style>
.order_page {
    font-size: 30px;
    font-weight: bold;
    color: red;
}
</style>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <div class="order_page">
                    <h3>Order Page</h3>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php
include "include/footer.php";

?>