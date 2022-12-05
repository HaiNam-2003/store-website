<?php
include "include/header.php";

?>
<?php
    if(isset($_GET['orderid']) && $_GET['orderid'] == 'order') {
        $customer_id = Session::get('customer_id');
        $insert_order = $cart -> insert_order($customer_id);
        $delCart = $cart ->del_all_data_cart();
        header('location: success.php');
    }

?>

<style>
h2.success_order {
    text-align: center;
    color: red;
    font-size: 40px;
}

p.success_note {
    text-align: center;
    padding: 10px;
    font-size: 18px;
}
</style>
<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <h2 class="success_order">ĐẶT HÀNG THÀNH CÔNG</h2>
                <?php
                $customer_id = Session::get('customer_id');
                $get_amount = $cart->getAmountPrice($customer_id);
                if($get_amount) {
                    $amount = 0;
                    while($result = $get_amount->fetch_assoc()) {
                        $Gia = $result['Gia'];
                        $amount += $Gia;
                    }
                }
                ?>
                <p class="success_note">Tổng Tiền Mà Bạn Đã Mua Từ Cửa Hàng Chúng Tôi :
                    <?php $total = ($amount * 0.1) + $amount; echo $fm->format_currency($total). " ". "VNĐ" ?>
                </p>
                <p class="success_note">Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất, Vui lòng xem lại đơn hàng
                    của bạn
                    <a href="orderdetails.php">ở đây</a>
                </p>
            </div>
        </div>
</form>
<?php
include "include/footer.php";

?>