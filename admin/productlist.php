<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php include '../classes/brand.php';?>
<?php include '../classes/cartegory.php';?>
<?php include '../classes/product.php';?>
<?php include_once '../helpers/format.php';?>

<?php
$product = new product();
$format = new Format();

if(isset($_GET['productid'])) {
	$id = $_GET['productid'];
	$delete_product = $product -> delete_product($id);
}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Danh sách sản phẩm</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Thương hiệu</th>
                        <th>Mô tả</th>
                        <th>Giá</th>
                        <th>Ảnh sản phẩm</th>
                        <th>Sản phẩm nổi bật</th>
                        <th>Tùy chỉnh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					$productlist = $product->show_product();
					if($productlist) {
						$i = 0;
						while($result = $productlist->fetch_assoc()) {
							$i++;
					?>
                    <tr class="odd gradeX">
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['productName'] ?></td>
                        <td><?php echo $result['catName'] ?></td>
                        <td><?php echo $result['brandName'] ?></td>
                        <td><?php echo $format->textShorten($result['moTa'], 50)?></td>
                        <td><?php echo $result['Gia'] ?></td>
                        <td><img src="uploads/<?php echo $result['hinhAnh'] ?>" width="80"></td>
                        <td class="center"><?php
							if($result['sanpham_noibat'] == 0){
								echo 'Nổi bật';
							} else {
								echo 'Không nổi bật';
							}
						?></td>
                        <td><a href="productedit.php?productid=<?php echo $result['productId'] ?>">Sửa</a> ||
                            <a href="?productid=<?php echo $result['productId'] ?>">Xóa</a>
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