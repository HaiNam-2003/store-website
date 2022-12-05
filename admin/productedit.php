<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/brand.php';?>
<?php include '../classes/cartegory.php';?>
<?php include '../classes/product.php';?>

<?php
    $product = new product();
	if(isset($_GET['productid'])) {
        $id = $_GET['productid'];
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

		$update_product = $product -> update_product($_POST, $_FILES, $id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Sửa sản phẩm</h2>
        <div class="block">
            <?php
        if(isset($update_product)) {
            echo $update_product;
        }
        ?>
            <?php
            $get_product_by_id = $product->getproductbyId($id);
            if($get_product_by_id) {
                while($result_Product = $get_product_by_id->fetch_assoc()) {
        ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Tên sản phẩm</label>
                        </td>
                        <td>
                            <input type="text" name="productName" value="<?php echo $result_Product['productName'] ?>"
                                class="medium" />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Danh mục</label>
                        </td>
                        <td>
                            <select id="select" name="danhmuc">
                                <option>--Chọn danh mục--</option>
                                <?php
                                $cat = new cartegory();
                                $catlist = $cat -> show_cartegory();
                                if($catlist) {
                                    while($result = $catlist->fetch_assoc()){
                                ?>
                                <option <?php
                                if($result['catId'] == $result_Product['catId']) { echo 'Selected'; }
                                ?> value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Thương hiệu</label>
                        </td>
                        <td>
                            <select id="select" name="thuonghieu">
                                <option>--Chọn thương hiệu--</option>
                                <?php
                                $brand = new brand();
                                $brandlist = $brand -> show_brand();
                                if($brandlist) {
                                    while($result = $brandlist->fetch_assoc()){
                                ?>
                                <option <?php
                                if($result['brandId'] == $result_Product['brandId']) { echo 'Selected'; }
                                ?> value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?>
                                </option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Mô tả</label>
                        </td>
                        <td>
                            <textarea name="moTa" class="tinymce"><?php echo $result_Product['moTa'] ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Giá cả</label>
                        </td>
                        <td>
                            <input name="gia" type="text" value="<?php echo $result_Product['Gia'] ?>" class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Hình ảnh</label>
                        </td>
                        <td>
                            <img src="uploads/<?php echo $result_Product['hinhAnh'] ?>" width="100"><br>
                            <input type="file" name="hinhanh" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Sản phẩm nổi bật</label>
                        </td>
                        <td>
                            <select name="noibat">
                                <option>--Chọn--</option>
                                <?php
                                if($result_Product['sanpham_noibat'] == 0) {

                                ?>
                                <option selected value="0">Nổi bật</option>
                                <option value="1">Không nổi bật</option>
                                <?php
                                } else {
                                ?>
                                <option value="0">Nổi bật</option>
                                <option selected value="1">Không nổi bật</option>
                                <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
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
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function() {
    setupTinyMCE();
    setDatePicker('date-picker');
    $('input[type="checkbox"]').fancybutton();
    $('input[type="radio"]').fancybutton();
});
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>