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
.box_left {
    width: 50%;
    border: 1px solid #ddd;
    float: left;
    padding: 4px;
}

.box_right {
    width: 46%;
    border: 1px solid #ddd;
    float: right;
    padding: 4px;
}

a.a_order {
    margin-top: -13px;
    padding: 10px 70px;
    background: black;
    color: white;
    cursor: pointer;
    border: none;
    border-radius: 5px;
    font-size: 18px;
}
</style>
<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>THANH TOÁN GIÁN TIẾP</h3>
                </div>
                <div class="clear"></div>
                <div class="box_left">
                    <div class="cartpage">
                        <table class="tblone">
                            <tr>
                                <th width="5%%">ID</th>
                                <th width="15%%">Tên sản phẩm</th>
                                <th width="15%">Giá</th>
                                <th width="25%">Số lượng</th>
                                <th width="20%">Tổng giá</th>
                            </tr>
                            <?php
                    $get_product_cart = $cart->get_product_cart();
                    if($get_product_cart) {
                        $i = 0;
                        $subtotal = 0;
                        $soluong= 0;
                        while($result = $get_product_cart->fetch_assoc()) {
                            $i++;
                    ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td><span><?php echo $fm->format_currency($result['Gia']). " ". "VNĐ"?></span></td>
                                <td>
                                    <?php echo $result['soLuong'] ?>
                                </td>

                                <td><?php
                                $total = $result['Gia'] * $result['soLuong'];
                                echo $fm->format_currency($total). " ". "VNĐ";
                                ?></span>
                                </td>
                            </tr>
                            <?php
                        $subtotal += $total;
                        $soluong = $soluong + $result['soLuong'];
                        }
                    }               
                    ?>
                        </table>
                        <?php
                    $check = $cart -> check_cart_product();
                    if($check) {
                ?>
                        <table style="float:right;text-align:left; border: 1px solid #333;margin: 5px" width="40%">
                            <tr>
                                <th>Giá : </th>
                                <td><?php 
                            echo $fm->format_currency($subtotal). " ". "VNĐ"; 
                            Session::set('sum', $subtotal);
                            Session::set('sluong', $soluong);
                        ?></td>
                            </tr>
                            <tr>
                                <th>Thuế(VAT) : </th>
                                <td>10% (<?php echo $fm->format_currency($vat = $subtotal * 0.1)?>)</td>
                            </tr>
                            <tr>
                                <th>Giá tổng :</th>
                                <td>
                                    <?php
                            $vat = $subtotal * 0.1;
                            $gtotal = $subtotal + $vat;
                            echo $fm->format_currency($gtotal). " ". "VNĐ";
                            ?>
                                </td>
                            </tr>
                        </table>
                        <?php
                } else {
                    echo '<span style="color:red; font-size:18px">Giỏ hàng của bạn trống ! Vui lòng mua sản phẩm</span>';
                }
                ?>
                    </div>
                </div>
                <div class="box_right">
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
                        <!-- <tr>
                    <td>Thành phố</td>
                    <td>:</td>
                    <td><?php echo $resul['city'] ?></td>
                </tr> -->
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
            <br>
            <center><a href="?orderid=order" class="a_order">Đặt Hàng</a></center>
        </div>
</form>
<?php
include "include/footer.php";

?>