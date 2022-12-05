<?php
include "include/header.php";

?>

<?php
    $login_check = Session::get('customer_login');
    if($login_check == false){
        header('location: login.php');
    }

    $cart = new cart();
    if(isset($_GET['confirmid'])) {
		$id = $_GET['confirmid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$shifted_confirm = $cart->shifted_confirm($id, $time, $price);
	}
?>

<style>
.box_left {
    width: 100%;
    border: 1px solid #ddd;
    padding: 4px;
}
</style>
<form action="" method="POST">
    <div class="main">
        <div class="content">
            <div class="section group">
                <div class="heading">
                    <h3>ĐƠN HÀNG CỦA BẠN</h3>
                </div>
                <div class="clear"></div>
                <div class="box_left">
                    <div class="cartpage">
                        <table class="tblone">
                            <tr>
                                <th width="5%%">ID</th>
                                <th width="15%%">Tên sản phẩm</th>
                                <th width="10%%">Hình ảnh</th>
                                <th width="15%">Giá</th>
                                <th width="10%">Số lượng</th>
                                <th width="15%">Ngày đặt</th>
                                <th width="15%">Tổng giá</th>
                                <th width="15%">Trạng thái</th>
                                <th width="30%">Chỉnh</th>
                            </tr>
                            <?php
                                $customer_id = Session::get('customer_id');
                                $get_cart_ordered = $cart->get_cart_ordered($customer_id);
                                if($get_cart_ordered) {
                                    $i = 0;
                                    while($result = $get_cart_ordered->fetch_assoc()) {
                                        $i++;
                            ?>
                            <tr>
                                <td><?php echo $i ?></td>
                                <td><?php echo $result['productName'] ?></td>
                                <td><img src="admin/uploads/<?php echo $result['hinhAnh'] ?>" alt="" /></td>
                                <td><span><?php echo $fm->format_currency($result['Gia']). " ". "VNĐ"?></span></td>
                                <td>
                                    <?php echo $result['soLuong'] ?>
                                </td>

                                <td><?php echo $fm->formatDate($result['date_order']) ?></td>

                                <td><?php
                                $total = $result['Gia']* $result['soLuong'];
                                echo $fm->format_currency($total). " ". "VNĐ";
                                ?></span>
                                </td>

                                <td>
                                    <?php
                                    if($result['status'] == '0') {
                                        echo 'Đang xử lí';
                                    } else if($result['status'] == '1') {
                                    ?>
                                    <span>Đã vận chuyển</span>

                                    <?php
                                    } else if($result['status'] == '2') {
                                        echo 'Đã nhận hàng';
                                    }
                                    ?>
                                </td>

                                <?php
                                if($result['status'] == '0') {
                                    
                                ?>
                                <td><?php echo 'N/A' ?></td>
                                <?php
                                } else if($result['status'] == '1') {
                                ?>
                                <td>
                                    <a
                                        href="?confirmid=<?php echo $customer_id ?>&price=<?php echo $result['Gia'] ?>&time=<?php echo $result['date_order'] ?>">Xác
                                        nhận
                                    </a>
                                </td>
                                <?php
                                } else {
                                ?>

                                <td><?php echo 'Đã nhận' ?></td>

                                <?php
                                }   
                                ?>
                            </tr>
                            <?php
                        
                                    }
                            }               
                            ?>
                        </table>

                    </div>
                </div>
                <div class="shopping">
                    <div class="shopleft">
                        <a href="index.php"> <img src="images/shop.png" alt="" /></a>
                    </div>
                </div>
            </div>
        </div>
</form>
<?php
include "include/footer.php";

?>