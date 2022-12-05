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
        <!-- iphone -->
        <div class="content_top">
            <div class="heading">
                <h3>Mới nhất từ apple</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group row">
            <?php
                $product_add_iphone = $product->product_add_iphone();
                if($product_add_iphone) {
                    while($result = $product_add_iphone->fetch_assoc()) {
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
                $get_product_apple = $product->get_product_apple();
                $product_count_apple = mysqli_num_rows($get_product_apple);
                $product_button_apple = ceil($product_count_apple / 4); // 4 sp /trang
                
                echo '<p>Trang: </p>';
                for($i = 1; $i <= $product_button_apple; $i++) {
                    echo '<a style= "margin: 0 10px;;" href="products.php?trang_apple='.$i.'">'.$i.'</a>';

                }
            ?>
        </div>

        <!-- samsung -->
        <div class="content_bottom">
            <div class="heading">
                <h3>Mới nhất từ sammsung</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group row">
            <?php
                $product_add_sumsung = $product->product_add_sumsung();
                if($product_add_sumsung) {
                    while($result_new = $product_add_sumsung->fetch_assoc()) {
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
                $get_product_samsung = $product->get_product_samsung();
                $product_count_samsung = mysqli_num_rows($get_product_samsung);
                $product_button_samsung = ceil($product_count_samsung / 4); // 4 sp /trang
                
                echo '<p>Trang: </p>';
                for($i = 1; $i <= $product_button_samsung; $i++) {
                    echo '<a style= "margin: 0 10px;;" href="products.php?trang_samsung='.$i.'">'.$i.'</a>';

                }
            ?>
        </div>
    </div>
</div>
<?php
include "include/footer.php";

?>