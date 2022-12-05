<?php
include "include/header.php";
// include "include/slider.php";

?>
<div class="main">
    <div class="content">
        <?php
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $tukhoa = $_POST['tukhoa'];
            $search_product = $product -> search_product($tukhoa);
        }
        ?>
        <div class="content_top">
            <div class="heading">
                <h3>Từ khóa tìm kiếm: <?php echo $tukhoa  ?></h3>
            </div>
            <div class="clear"></div>
        </div>

        <div class="section group">
            <?php
            if($search_product) {
                while($result = $search_product->fetch_assoc()){
            ?>
            <div class="grid_1_of_4 images_1_of_4">
                <a href="details-3.php"><img src="admin/uploads/<?php echo $result['hinhAnh'] ?>" width="150px"
                        alt="" /></a>
                <h2><?php echo $result['productName'] ?></h2>
                <p><?php echo $fm->textShorten($result['moTa'], 40)?></p>
                <p><span class="price"><?php echo $fm->format_currency($result['Gia']). " ". "VNĐ"?></span></p>
                <div class="button"><span><a href="details.php?proid=<?php echo $result['productId'] ?>"
                            class="details">Thông tin</a></span></div>
            </div>
            <?php
                 }
            } else {
                echo '<span style="color: red; font-size: 18px">Không có sản phẩm</span>';
             }
            ?>
        </div>



    </div>
    <?php
include "include/footer.php";

?>