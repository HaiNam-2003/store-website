<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    include '../classes/brand.php';
?>

<?php
    $brand = new brand();
	if(isset($_GET['brandid'])) {
        $id = $_GET['brandid'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$brandName = $_POST['brandName'];

		$update_brand = $brand -> update_brand($brandName, $id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa thương hiệu</h2>
        <div class="block copyblock">
            <?php
        if(isset($update_brand)) {
            echo $update_brand;
        }
        ?>
            <?php
        $get_brand_name = $brand->getbrandbyId($id);
        if($get_brand_name) {
            while($result = $get_brand_name->fetch_assoc()) {
        ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <input value="<?php echo $result['brandName'] ?>" type="text" name="brandName"
                                placeholder="Sửa thương hiệu sản phẩm..." class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <input type="submit" name="submit" Value="Sửa" />
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