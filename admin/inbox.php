<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/cart.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
	$cart = new cart();
	if(isset($_GET['shiftid'])) {
		$id = $_GET['shiftid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$shifted = $cart->shifted($id, $time, $price);
	}

	if(isset($_GET['delid'])) {
		$id = $_GET['delid'];
		$time = $_GET['time'];
		$price = $_GET['price'];
		$del_shifted = $cart->del_shifted($id, $time, $price);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <div class="block">
            <?php
		if(isset($del_shifted)) {
			echo $del_shifted;
		}
		?>

            <?php
		if(isset($shifted)) {
			echo $shifted;
		}
		?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Thời gian đặt</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Customer_Id</th>
                        <th>Khách hàng</th>
                        <th>Tình trạng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					$cart = new cart();
					$fm = new Format();
					$get_inbox_cart = $cart->get_inbox_cart();
					if($get_inbox_cart) {
						$i = 0;
						while($result = $get_inbox_cart->fetch_assoc()) {
							$i++;
					?>
                    <tr class="odd gradeX">
                        <td><?php echo $i ?></td>
                        <td><?php echo $fm->formatDate($result['date_order']) ?></td>
                        <td><?php echo $result['productName'] ?></td>
                        <td><?php echo $result['soLuong'] ?></td>
                        <td><?php echo $result['Gia']. " ". "VNĐ" ?></td>
                        <td><?php echo $result['customer_id'] ?></td>
                        <td><a href="customer.php?customerid=<?php echo $result['customer_id'] ?>">Xem khách hàng</a>
                        </td>
                        <td>
                            <?php
							if($result['status'] == 0) {
							?>
                            <a
                                href="?shiftid=<?php echo $result['id'] ?>&price=<?php echo $result['Gia'] ?>&time=<?php echo $result['date_order'] ?>">Đang
                                xử lí
                            </a>

                            <?php
							} else if($result['status'] == 1) {
							?>

                            <?php echo 'Đang vận chuyển...' ?>

                            <?php
							} else if($result['status'] == 2) {
							?>

                            <a
                                href="?delid=<?php echo $result['id'] ?>&price=<?php echo $result['Gia'] ?>&time=<?php echo $result['date_order'] ?>">Xóa
                            </a>

                            <?php
							}
							?>
                        </td>
                    </tr>
                    <?php
						}
					}
					?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    setupLeftMenu();

    $('.datatable').dataTable();
    setSidebarHeight();
});
</script>
<?php include 'inc/footer.php';?>