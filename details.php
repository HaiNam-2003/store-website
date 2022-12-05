<?php
include "include/header.php";

?>
<?php
    if(isset($_GET['proid'])) {
        $id = $_GET['proid'];
    }
    

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

        $soLuong = $_POST['soLuong'];
        $addToCart = $cart -> add_to_cart($soLuong, $id);
    }

    $customer_id = Session::get('customer_id');
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['compare'])) {

        $productid = $_POST['productid'];
        $insertCompare = $product -> insertCompare($productid, $customer_id);
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['wishlist'])) {

        $productid = $_POST['productid'];
        $insertWishlist= $product -> insertWishlist($productid, $customer_id);
    }
?>
<div class="main">
    <div class="content">
        <div class="section group">
            <?php
        $get_product_details = $product ->get_details($id);
        if($get_product_details) {
            while($result_deatails = $get_product_details->fetch_assoc()) {
        ?>
            <div class="cont-desc span_1_of_2">
                <div class="grid images_3_of_2">
                    <img src="admin/uploads/<?php echo $result_deatails['hinhAnh'] ?>" alt="" />
                </div>
                <div class="desc span_3_of_2">
                    <h2><?php echo $result_deatails['productName'] ?></h2>
                    <p><?php echo $fm->textShorten($result_deatails['moTa'], 40) ?></p>
                    <div class="price">
                        <p>Giá: <span><?php echo $fm->format_currency($result_deatails['Gia']). " ". "VNĐ" ?></span></p>
                        <p>Danh Mục: <span><?php echo $result_deatails['catName'] ?></span></p>
                        <p>Thương Hiệu: <span><?php echo $result_deatails['brandName'] ?></span></p>
                    </div>
                    <div class="add-cart">
                        <form action="" method="post">
                            <input type="number" class="buyfield" name="soLuong" value="1" min="1" />
                            <input type="submit" class="buysubmit" name="submit" value="Mua" />
                        </form>
                        <?php
                            if(isset($addToCart)) {
                                echo '<span style="color:red; font-size:18px">Sản phẩm đã có trong giỏ hàng</span>';
                            }
                            ?>
                    </div>

                    <div class="add-cart">
                        <!-- Yêu thích -->
                        <form action="" method="POST">
                            <!-- <a href="?wlist=<?php echo $result_deatails['productId'] ?>" class="buysubmit">Lưu vào danh sách
                            ưu thích</a> -->
                            <!-- <a href="?compare=<?php echo $result_deatails['productId'] ?>" class="buysubmit">So sánh sản
                                phẩm</a> -->
                            <input type="hidden" name="productid" value="<?php echo $result_deatails['productId'] ?>" />

                            <?php
                                $login_check = Session::get('customer_login');
                                if($login_check == false) {
                                    echo '';
                                } else {
                                    echo '<input type="submit" class="buysubmit" name="wishlist" value="Yêu Thích" />';
                                }
                            ?>
                            <?php
                            if(isset($insertWishlist)) {
                                echo $insertWishlist;
                            }
                            ?>
                        </form>
                    </div>
                </div>
                <div class="product-desc">
                    <h2>THÔNG TIN SẢN PHẨM CHI TIẾT</h2>
                    <p><?php echo $result_deatails['moTa'] ?></p>

                </div>

            </div>
            <?php
                }
            }
            ?>
            <div class="rightsidebar span_3_of_1">
                <h2>CATEGORIES</h2>
                <ul>
                    <?php
                    $getall_catergory = $cat->show_cartegory_fontend();
                    if($getall_catergory) {
                        while($result_allcat = $getall_catergory->fetch_assoc()) {

                    ?>
                    <li><a
                            href="productbycat.php?catid=<?php echo $result_allcat['catId'] ?>"><?php echo $result_allcat['catName'] ?></a>
                    </li>
                    <?php
                        }
                    }
                    ?>
                </ul>

            </div>
        </div>
    </div>
    <?php
include "include/footer.php";

?>