<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    include '../classes/product.php';
?>

<?php
	$product = new product();
	if(isset($_GET['type_slier']) && isset($_GET['type'])) {
		$id = $_GET['type_slier'];
		$type = $_GET['type'];

		$update_type_slider = $product->update_type_slider($id, $type);
	}

	if(isset($_GET['delete_sliderr'])) {
		$id = $_GET['delete_sliderr'];

		$delete_slider = $product->delete_slider($id);
	}
?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên Slider</th>
                        <th>Ảnh Slider</th>
                        <th>Type</th>
                        <th>Tùy Chỉnh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
					$product = new product();
					$get_slider = $product -> show_slider_list();
					if($get_slider) {
						$i = 0;
						while($result_slider = $get_slider->fetch_assoc()) {
							$i++;
					?>
                    <tr class="odd gradeX">
                        <td><?php echo $i ?></td>
                        <td><?php echo $result_slider['sliderName'] ?></td>
                        <td><img src="uploads/<?php echo $result_slider['sliderImage'] ?>" height="120px"
                                width="200px" />
                        </td>
                        <td>
                            <?php
								if($result_slider['Type'] == 1) {
							?>

                            <a href="?type_slider=<?php echo $result_slider['sliderId'] ?>&type=0">Off</a>

                            <?php
							} else {
							?>

                            <a href="?type_slier=<?php echo $result_slider['sliderId'] ?>&type=1">On</a>

                            <?php
							}
							?>
                        </td>
                        <td>
                            <a href="?delete_sliderr=<?php echo $result_slider['sliderId'] ?>"
                                onclick="return confirm('Are you sure to Delete!');">Delete</a>
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