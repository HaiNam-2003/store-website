<?php
include "include/header.php";
// include "include/slider.php";

?>
<?php
    // if(isset($_GET['cartid'])) {
    //     $cartid = $_GET['cartid'];
    //     $delete_cart = $cart -> delete_cart($cartid);
    // }

    // if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     $cartId = $_POST['cartId'];
    //     $soluong = $_POST['soLuong'];
    //     $update_quatity_cart = $cart -> update_quantity_cart($soluong, $cartId);

    //     if($soluong <= 0) {
    //         $delete_cart = $cart -> delete_cart($cartId);
    //     }
    // }
?>

<?php
    // if(!isset($_GET['id'])) {
    //     echo "<meta http-equiv='refresh' content= '0;URL=?id=live'>";
    // }
?>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2 style="width: 500px">SO SÁNH SẢN PHẨM</h2>
                <table class="tblone">
                    <tr>
                        <th width="10%">ID</th>
                        <th width="20%">Tên sản phẩm</th>
                        <th width="25%">Hình ảnh</th>
                        <th width="15%">Giá</th>
                        <th width="20%">Tùy chỉnh</th>
                    </tr>
                    <?php
                    $customer_id = Session::get('customer_id');
                    $get_compare = $product->get_compare($customer_id);
                    if($get_compare) {
                        $i = 0;
                        while($result = $get_compare->fetch_assoc()) {
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['productName'] ?></td>
                        <td><img src="admin/uploads/<?php echo $result['hinhAnh'] ?>" width="120px" alt="" /></td>
                        <td><span><?php echo $result['Gia']. " ". "VND"?></span></td>

                        <td><a href="details.php?proid=<?php echo $result['productId'] ?>">Xem</a></td>
                    </tr>
                    <?php
                        }
                    }               
                    ?>
                </table>

            </div>
            <div class="shopping">
                <div class="shopleft">
                    <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                </div>
            </div>
        </div>
        <div class="clear"></div>
    </div>
</div>

<?php
include "include/footer.php";

?>