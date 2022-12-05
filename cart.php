<?php
include "include/header.php";
// include "include/slider.php";

?>
<?php
if(isset($_GET['cartid'])) {
	$cartid = $_GET['cartid'];
	$delete_cart = $cart -> delete_cart($cartid);
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cartId = $_POST['cartId'];
    $soluong = $_POST['soLuong'];
    $update_quatity_cart = $cart -> update_quantity_cart($soluong, $cartId);

    if($soluong <= 0) {
	    $delete_cart = $cart -> delete_cart($cartId);
    }
}
?>

<?php
if(!isset($_GET['id'])) {
    echo "<meta http-equiv='refresh' content= '0;URL=?id=live'>";
}
?>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2>Giỏ Hàng</h2>
                <table class="tblone">
                    <tr>
                        <th width="20%">Tên sản phẩm</th>
                        <th width="10%">Hình ảnh</th>
                        <th width="15%">Giá</th>
                        <th width="25%">Số lượng</th>
                        <th width="20%">Tổng giá</th>
                        <th width="10%">Tùy chỉnh</th>
                    </tr>
                    <?php
                    $get_product_cart = $cart->get_product_cart();
                    if($get_product_cart) {
                        $subtotal = 0;
                        $soluong= 0;
                        while($result = $get_product_cart->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?php echo $result['productName'] ?></td>
                        <td><img src="admin/uploads/<?php echo $result['hinhAnh'] ?>" alt="" /></td>
                        <td><span><?php echo $fm->format_currency($result['Gia']). " ". "VNĐ"?></span></td>
                        <td>
                            <form action="" method="post">
                                <input min="0" type="hidden" name="cartId" value="<?php echo $result['cartId'] ?>" />
                                <input min="0" type="number" name="soLuong" value="<?php echo $result['soLuong'] ?>" />
                                <input type="submit" name="submit" value="Update" />
                            </form>
                        </td>
                        <td><?php
                        $total = $result['Gia'] * $result['soLuong'];
                        echo $fm->format_currency($total). " ". "VND";
                        ?></span></td>
                        <td><a onclick="return confirm('Bạn có chắc là muốn xóa?')"
                                href="?cartid=<?php echo $result['cartId'] ?>">Xóa</a></td>
                    </tr>
                    <?php
                        $subtotal += $total;
                        }
                    }               
                    ?>
                </table>
                <?php
                    $check = $cart -> check_cart_product();
                    if($check) {
                ?>
                <table style="float:right;text-align:left;" width="40%">
                    <tr>
                        <th>Giá : </th>
                        <td><?php 
                            echo $fm->format_currency($subtotal). " ". "VND"; 
                            Session::set('sum', $subtotal);
                            Session::set('sluong', $soluong);
                        ?></td>
                    </tr>
                    <tr>
                        <th>Thuế(VAT) : </th>
                        <td>10%</td>
                    </tr>
                    <tr>
                        <th>Giá tổng :</th>
                        <td>
                            <?php
                            $vat = $subtotal * 0.1;
                            $gtotal = $subtotal + $vat;
                            echo $fm->format_currency($gtotal). " ". "VND";
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
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
                <div class="shopright">
                    <a href="payment.php"> <img src="images/check.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php
include "include/footer.php";

?>