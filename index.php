<?php
include "include/header.php";
include "include/slider.php";

?>

<style>
.row {
    display: flex;
    flex-wrap: wrap;
}
</style>

<div class="main">
    <div class="content">
        <div class="content_top">
            <div class="heading">
                <h3>SẢN PHẨM NỔI BẬT</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group row">
            <?php
                $product_feathered = $product->getproduct_feathered();
                if($product_feathered) {
                    while($result = $product_feathered->fetch_assoc()) {
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?proid=<?php echo $result['productId'] ?>"><img
                        src="admin/uploads/<?php echo $result['hinhAnh'] ?>" alt="" /></a>
                <h2><?php echo $result['productName'] ?> </h2>
                <p><?php echo $fm->textShorten($result['moTa'], 40) ?></p>
                <p><span class="price"><?php echo $fm->format_currency($result['Gia']). " ". "VNĐ" ?></span></p>
                <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>"
                            class="details">Thông tin</a></span></div>
            </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="">
            <?php
                $get_product_outstanding = $product->get_product_outstanding();
                $product_count_outstanding = mysqli_num_rows($get_product_outstanding);
                $product_button_outstanding = ceil($product_count_outstanding / 4); // 4 sp /trang
                
                echo '<p>Trang: </p>';
                for($i = 1; $i <= $product_button_outstanding; $i++) {
                    echo '<a style= "margin: 0 10px;;" href="index.php?trang_noibat='.$i.'">'.$i.'</a>';

                }
            ?>
        </div>


        <!-- sản phẩm mới -->
        <div class="content_bottom">
            <div class="heading">
                <h3>SẢN PHẨM MỚI</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group row">
            <?php
                $product_new = $product->getproduct_new();
                if($product_new) {
                    while($result_new = $product_new->fetch_assoc()) {
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?proid=<?php echo $result_new['productId'] ?>"><img
                        src="admin/uploads/<?php echo $result_new['hinhAnh'] ?>" alt="" /></a>
                <h2><?php echo $result_new['productName'] ?> </h2>
                <p><?php echo $fm->textShorten($result_new['moTa'], 40) ?></p>
                <p><span class="price"><?php echo $fm->format_currency($result_new['Gia']). " ". "VNĐ" ?></span></p>
                <div class="button"><span><a href="details.php?proid=<?php echo $result_new['productId'] ?>"
                            class="details">Thông tin</a></span></div>
            </div>
            <?php
                }
            }
            ?>
        </div>
        <div class="">
            <?php
                $product_all = $product->get_all_product();
                $product_count = mysqli_num_rows($product_all);
                $product_button = ceil($product_count / 4); // 4 sp /trang
                
                echo '<p>Trang: </p>';
                for($i = 1; $i <= $product_button; $i++) {
                    echo '<a style= "margin: 0 10px;;" href="index.php?trang='.$i.'">'.$i.'</a>';

                }
            ?>
        </div>
    </div>
</div>

<?php
include "include/footer.php";

?>