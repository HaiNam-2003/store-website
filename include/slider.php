	<div class="header_bottom">
	    <div class="header_bottom_left">
	        <div class="section group">
	            <?php
				$getLastestDell = $product->getLastestDell();
				if($getLastestDell) {
					while($resultDell = $getLastestDell->fetch_assoc()) {
				?>
	            <div class="listview_1_of_2 images_1_of_2">
	                <div class="listimg listimg_2_of_1">
	                    <a href="details.php"> <img src="admin/uploads/<?php echo $resultDell['hinhAnh'] ?>" alt="" /></a>
	                </div>
	                <div class="text list_2_of_1">
	                    <h2>Dell</h2>
	                    <p><?php echo $resultDell['productName'] ?></p>
	                    <div class="button"><span><a
	                                href="details.php?proid=<?php echo $resultDell['productId'] ?>">Thêm</a></span></div>
	                </div>
	            </div>
	            <?php
					}
				}
				?>

	            <?php
				$getLastestApple = $product->getLastestApple();
				if($getLastestApple) {
					while($resultApple = $getLastestApple->fetch_assoc()) {
				?>
	            <div class="listview_1_of_2 images_1_of_2">
	                <div class="listimg listimg_2_of_1">
	                    <a href="details.php"><img src="admin/uploads/<?php echo $resultApple['hinhAnh'] ?>" alt="" /></a>
	                </div>
	                <div class="text list_2_of_1">
	                    <h2>Apple</h2>
	                    <p><?php echo $resultApple['productName'] ?></p>
	                    <div class="button"><span><a
	                                href="details.php?proid=<?php echo $resultApple['productId'] ?>">Thêm</a></span></div>
	                </div>
	            </div>
	            <?php
					}
				}
				?>
	        </div>
	        <div class="section group">
	            <?php
				$getLastestSamsung = $product->getLastestSamsung();
				if($getLastestSamsung) {
					while($resultSamsung = $getLastestSamsung->fetch_assoc()) {
				?>
	            <div class="listview_1_of_2 images_1_of_2">
	                <div class="listimg listimg_2_of_1">
	                    <a href="details.php"> <img src="admin/uploads/<?php echo $resultSamsung['hinhAnh'] ?>"
	                            alt="" /></a>
	                </div>
	                <div class="text list_2_of_1">
	                    <h2>Samsung</h2>
	                    <p><?php echo $resultSamsung['productName'] ?></p>
	                    <div class="button"><span><a
	                                href="details.php?proid=<?php echo $resultSamsung['productId'] ?>">Thêm</a></span>
	                    </div>
	                </div>
	            </div>
	            <?php
					}
				}
				?>

	            <?php
				$getLastestOppo = $product->getLastestOppo();
				if($getLastestOppo) {
					while($resultOppo = $getLastestOppo->fetch_assoc()) {
				?>
	            <div class="listview_1_of_2 images_1_of_2">
	                <div class="listimg listimg_2_of_1">
	                    <a href="details.php"><img src="admin/uploads/<?php echo $resultOppo['hinhAnh'] ?>" alt="" /></a>
	                </div>
	                <div class="text list_2_of_1">
	                    <h2>Oppo</h2>
	                    <p><?php echo $resultOppo['productName'] ?></p>
	                    <div class="button"><span><a
	                                href="details.php?proid=<?php echo $resultOppo['productId'] ?>">Thêm</a></span></div>
	                </div>
	            </div>
	            <?php
					}
				}
				?>
	        </div>
	        <div class="clear"></div>
	    </div>
	    <div class="header_bottom_right_images">
	        <!-- FlexSlider -->

	        <section class="slider">
	            <div class="flexslider">
	                <ul class="slides">
	                    <?php
						$get_slider = $product -> show_slider();
						if($get_slider) {
							while($result_slider = $get_slider->fetch_assoc()) {
						?>
	                    <li><img src="admin/uploads/<?php echo $result_slider['sliderImage'] ?>" alt="" /></li>
	                    <?php
							}
						}
						?>
	                </ul>
	            </div>
	        </section>
	        <!-- FlexSlider -->
	    </div>
	    <div class="clear"></div>
	</div>