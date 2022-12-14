<?php
    include 'lib/session.php';
    Session::init();
?>
<?php
    include_once 'lib/database.php';
    include_once 'helpers/format.php';

    spl_autoload_register(function($class){
        include_once "classes/".$class. ".php";

    });
    
    $db = new Database();
    $fm = new Format();
    $cart = new cart();
    $user = new user();
    $cat = new cartegory();
    $product = new product();
    $customer = new customer();
?>

<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>

<!DOCTYPE HTML>

<head>
    <title>Store Website</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link href="css/style.css" rel="stylesheet" type="text/css" />
    <link href="css/menu.css" rel="stylesheet" type="text/css" />
    <script src="js/jquerymain.js"></script>
    <script src="js/script.js" type="text/javascript"></script>
    <script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="js/nav.js"></script>
    <script type="text/javascript" src="js/move-top.js"></script>
    <script type="text/javascript" src="js/easing.js"></script>
    <script type="text/javascript" src="js/nav-hover.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Monda' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Doppio+One' rel='stylesheet' type='text/css'>
    <script type="text/javascript">
    $(document).ready(function($) {
        $('#dc_mega-menu-orange').dcMegaMenu({
            rowItems: '4',
            speed: 'fast',
            effect: 'fade'
        });
    });
    </script>
</head>


<body>
    <div class="wrap">
        <div class="header_top">
            <div class="logo">
                <a href="index.php"><img src="images/logo.png" alt="" /></a>
            </div>
            <div class="header_top_right">
                <div class="search_box">
                    <form action="search.php" method="POST">
                        <input type="text" placeholder="T??m ki???m s???n ph???m" name="tukhoa">
                        <input type="submit" name="search_product" value="T??M KI???M">
                    </form>
                </div>
                <div class="shopping_cart">
                    <div class="cart">
                        <a href="#" title="View my shopping cart" rel="nofollow">
                            <span class="cart_title">Cart</span>
                            <span class="no_product">
                                <?php
                                $check = $cart -> check_cart_product();
                                if($check) {
                                    $sum = Session::get("sum");
                                    echo $fm->format_currency($sum). ' ??';
                                } else {
                                    echo 'empty';
                                }
                                ?>
                            </span>
                        </a>
                    </div>
                </div>
                <!-- h???y ????ng nh???p -->
                <?php
                    if(isset($_GET['customer_id'])) {
                        $delCart = $cart ->del_all_data_cart();
                        
                        $customer_id = $_GET['customer_id'];
                        $delCompare = $cart ->del_all_data_compare($customer_id);
                        Session::destroy();
                    }
                ?>

                <div class="login">
                    <?php
                    $login_check = Session::get('customer_login');
                    if($login_check == false) {
                        echo '<a style="font-size:18px" href="login.php">????ng Nh???p</a>';
                    } else {
                        echo '<a href="?customer_id='.Session::get('customer_id').'">????ng Xu???t</a>';
                    }
                    ?>
                </div>
                <div class="clear"></div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="menu">
            <ul id="dc_mega-menu-orange" class="dc_mm-orange">
                <li><a href="index.php">Trang Ch???</a></li>
                <li><a href="products.php">S???n ph???m</a> </li>
                <li><a href="topbrands.php">Th????ng hi???u</a></li>

                <?php
                $check_cart = $cart->check_cart_product();
                if($check_cart == true) {
                    echo '<li><a href="cart.php">Gi??? H??ng</a></li>';
                } else {
                    echo '';
                }
                ?>

                <?php
                $customer_id = Session::get('customer_id');
                $check_order = $cart->check_order($customer_id );
                if($check_order == true) {
                    echo '<li><a href="orderdetails.php">????n ?????t h??ng</a></li>';
                } else {
                    echo '';
                }
                ?>

                <?php
                $login_check = Session::get('customer_login');
                if($login_check == false) {
                    echo '';
                } else {
                    echo '<li><a href="profile.php">Th??ng tin</a> </li>';
                }
                ?>


                <?php
                $login_check = Session::get('customer_login');
                if($login_check == false) {
                    echo '';
                } else {
                    echo '<li><a href="wishlist.php">Y??u Th??ch</a> </li>';
                }
                ?>

                <li><a href="contact.php">Li??n h???</a> </li>
                <div class="clear"></div>
            </ul>
        </div>