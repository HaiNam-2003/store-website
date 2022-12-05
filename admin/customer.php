<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../classes/customer.php');
	include_once ($filepath.'/../helpers/format.php');
?>

<?php
    $customer = new customer();
	if(isset($_GET['customerid'])) {
        $id = $_GET['customerid'];
    }
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Xem Khách Hàng</h2>
        <div class="block copyblock">

            <?php
        $get_customer = $customer->show_customer($id);
        if($get_customer) {
            while($result = $get_customer->fetch_assoc()) {
        ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>Tên khách hàng</td>
                        <td>:</td>
                        <td>
                            <input readonly value="<?php echo $result['name'] ?>" type="text" name="name"
                                class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>Địa chỉ</td>
                        <td>:</td>
                        <td>
                            <input readonly value="<?php echo $result['address'] ?>" type="text" name="address"
                                class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>Số ĐT</td>
                        <td>:</td>
                        <td>
                            <input readonly value="<?php echo $result['phone'] ?>" type="text" name="phone"
                                class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>Thành phố</td>
                        <td>:</td>
                        <td>
                            <input readonly value="<?php echo $result['city'] ?>" type="text" name="city"
                                class="medium" />
                        </td>
                    </tr>
                </table>
            </form>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php include 'inc/footer.php';?>