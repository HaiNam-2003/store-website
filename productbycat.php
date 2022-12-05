<?php
include "include/header.php";
// include "include/slider.php";

?>

<?php
if(isset($_GET['catid'])) {
    $id = $_GET['catid'];
}

// if($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $catName = $_POST['catName'];

//     $update_cat = $cat -> update_cartegory($catName, $id);
// }
?>

<style>
.row {
    display: flex;
    flex-wrap: wrap;
}
</style>

<div class="main">
    <div class="content">
        <?php
        $name_cat = $cat->get_name_by_cat($id);
        if($name_cat) {
            while($result_name = $name_cat->fetch_assoc()){
        ?>
        <div class="content_top">
            <div class="heading">
                <h3>Danh mục: <?php echo $result_name['catName'] ?></h3>
            </div>
            <div class="clear"></div>
        </div>
        <?php
            }
        }
        ?>
        <div class="section group row">
            <?php
            $productbycat = $cat->get_product_by_cat($id);
            if($productbycat) {
                while($result = $productbycat->fetch_assoc()){
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
                echo '<span style="color: red; font-size: 18px">Danh mục không có sản phẩm</span>';
             }
            ?>
        </div>



    </div>
    <?php
include "include/footer.php";

?>