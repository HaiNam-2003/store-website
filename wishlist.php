<?php
include "include/header.php";
// include "include/slider.php";

?>

<?php
    if(isset($_GET['proid'])) {
        $proid = $_GET['proid'];
        $customer_id = Session::get('customer_id');
        $delete_wishlist = $product -> delete_wishlist($proid, $customer_id);
    }
?>

<div class="main">
    <div class="content">
        <div class="cartoption">
            <div class="cartpage">
                <h2 style="width: 500px">SẢN PHẨM YÊU THÍCH</h2>
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
                    $get_wishlist = $product->get_wishlist($customer_id);
                    if($get_wishlist) {
                        $i = 0;
                        while($result = $get_wishlist->fetch_assoc()) {
                            $i++;
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['productName'] ?></td>
                        <td><img src="admin/uploads/<?php echo $result['hinhAnh'] ?>" width="120px" alt="" /></td>
                        <td><span><?php echo $fm->format_currency($result['Gia']). " ". "VNĐ"?></span></td>

                        <td>
                            <a href="?proid=<?php echo $result['productId'] ?>">Xóa</a> ||
                            <a href="details.php?proid=<?php echo $result['productId'] ?>">Mua</a>
                        </td>
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