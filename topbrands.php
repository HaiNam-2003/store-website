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
                <h3>Apple</h3>
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
                $get_brand_apple = $product->get_brand_apple();
                $product_count_brand_apple = mysqli_num_rows($get_brand_apple);
                $product_button_brand_apple = ceil($product_count_brand_apple / 4); // 4 sp /trang
                
                echo '<p>Trang: </p>';
                for($i = 1; $i <= $product_button_brand_apple; $i++) {
                    echo '<a style= "margin: 0 10px;;" href="topbrands.php?trang_apple='.$i.'">'.$i.'</a>';

                }
            ?>
        </div>

        <!-- samsung -->
        <div class="content_bottom">
            <div class="heading">
                <h3>Samsung</h3>
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

        <!-- dell -->
        <div class="content_bottom">
            <div class="heading">
                <h3>Dell</h3>
            </div>
            <div class="clear"></div>
        </div>
        <div class="section group row">
            <?php
                $product_add_dell = $product->product_add_dell();
                if($product_add_dell) {
                    while($result_dell = $product_add_dell->fetch_assoc()) {
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details.php?proid=<?php echo $result_dell['productId'] ?>"><img
                        src="admin/uploads/<?php echo $result_dell['hinhAnh'] ?>" alt="" /></a>
                <h2><?php echo $result_dell['productName'] ?> </h2>
                <p><?php echo $fm->textShorten($result_dell['moTa'], 40) ?></p>
                <p><span class="price"><?php echo $fm->format_currency($result_dell['Gia']). " ". "VNĐ" ?></span></p>
                <div class="button"><span><a href="details.php?proid=<?php echo $result_dell['productId'] ?>"
                            class="details">Thông tin</a></span></div>
            </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<?php
include "include/footer.php";

?>