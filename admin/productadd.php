<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/brand.php';?>
<?php include '../classes/cartegory.php';?>
<?php include '../classes/product.php';?>

<?php
    $product = new product();
	if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

		$insert_product = $product -> insert_product($_POST, $_FILES);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Thêm sản phẩm</h2>
        <div class="block">
            <?php
        if(isset($insert_product)) {
            echo $insert_product;
        }
        ?>
            <form action="productadd.php" method="post" enctype="multipart/form-data">
                <table class="form">

                    <tr>
                        <td>
                            <label>Tên sản phẩm</label>
                        </td>
                        <td>
                            <input type="text" name="productName" placeholder="Nhập tên sản phẩm..." class="medium" />
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
                                <option value="<?php echo $result['catId'] ?>"><?php echo $result['catName'] ?></option>
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
                                <option value="<?php echo $result['brandId'] ?>"><?php echo $result['brandName'] ?>
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
                            <textarea name="moTa" class="tinymce"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Giá cả</label>
                        </td>
                        <td>
                            <input name="gia" type="text" placeholder="Giá..." class="medium" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Hình ảnh</label>
                        </td>
                        <td>
                            <input type="file" name="hinhanh" />
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Sản phẩm nổi bật</label>
                        </td>
                        <td>
                            <select id="select" name="noibat">
                                <option>--Chọn--</option>
                                <option value="1">Nổi bật</option>
                                <option value="0">Không nổi bật</option>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" name="submit" Value="Save" />
                        </td>
                    </tr>
                </table>
            </form>
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