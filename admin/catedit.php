<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php
    include '../classes/cartegory.php';
?>

<?php
    $cat = new cartegory();
	if(isset($_GET['catid'])) {
        $id = $_GET['catid'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
		$catName = $_POST['catName'];

		$update_cat = $cat -> update_cartegory($catName, $id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa danh mục</h2>
        <div class="block copyblock">
            <?php
        if(isset($update_cat)) {
            echo $update_cat;
        }
        ?>
            <?php
        $get_cat_name = $cat->getcatbyId($id);
        if($get_cat_name) {
            while($result = $get_cat_name->fetch_assoc()) {
        ?>
            <form action="" method="POST">
                <table class="form">
                    <tr>
                        <td>
                            <input value="<?php echo $result['catName'] ?>" type="text" name="catName"
                                placeholder="Sửa danh mục sản phẩm..." class="medium" />
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