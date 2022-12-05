<?php
include "include/header.php";
// include "include/slider.php";

?>

<?php
    $login_check = Session::get('customer_login');
    if($login_check) {
        header('location: order.php');
    }
?>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit'])) {

    $insert_customer = $customer -> insert_customer($_POST);
}
?>

<?php
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {

    $login_customer = $customer -> login_customer($_POST);
}
?>

<div class="main">
    <div class="content">
        <div class="login_panel">
            <h3>Khách Hàng</h3>
            <p>Đăng nhập bằng mẫu dưới đây.</p>
            <?php
            if(isset($login_customer)) {
                echo $login_customer;
            }
            ?>
            <form action="" method="POST">
                <input type="text" name="email" class="field" placeholder="Email...">
                <input type="password" name="password" class="field" placeholder="**********">
                <p class="note">Nếu bạn quên mật khẩu, chỉ cần nhập email của bạn và nhấp <a href="#">ở đây</a></p>
                <div class="buttons">
                    <div><input style=" font-size: 20px;
                                        background: white;
                                        border: outset;
                                        outline: none;
                                        cursor: pointer;
                                        padding: 10px;" type="submit" name="login" class="grey" value="Đăng Nhập">
                    </div>
                </div>
            </form>
        </div>
        <?php
        
        ?>
        <div class="register_account">
            <h3>Đăng Kí Tài Khoản Mới</h3>
            <?php
            if(isset($insert_customer)) {
                echo $insert_customer;
            }
            ?>
            <form action="" method="POST">
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <div>
                                    <input type="text" name="name" placeholder="Nhập tên...">
                                </div>

                                <div>
                                    <input type="text" name="city" placeholder="Nhập thành phố...">
                                </div>

                                <div>
                                    <input type="text" name="zipcode" placeholder="Nhập mã Zip...">
                                </div>
                                <div>
                                    <input type="text" name="email" placeholder="Nhập Email...">
                                </div>
                            </td>
                            <td>
                                <div>
                                    <input type="text" name="address" placeholder="Nhập địa chỉ...">
                                </div>
                                <div>
                                    <select id="country" name="country" onchange="change_country(this.value)"
                                        class="frm-field required">
                                        <option value="null">Select a Country</option>
                                        <option value="DN">Đà Nẵng</option>
                                        <option value="SG">Sài Gòn</option>
                                        <option value="HN">Hà Nội</option>
                                        <option value="HP">Hải Phòng</option>
                                    </select>
                                </div>

                                <div>
                                    <input type="text" name="phone" placeholder="Nhập SĐT...">
                                </div>

                                <div>
                                    <input type="text" name="password" placeholder="Nhập Pass...">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class="search">
                    <div><input style=" font-size: 20px;
                                        background: white;
                                        border: outset;
                                        outline: none;
                                        cursor: pointer;
                                        padding: 10px;" type="submit" name="submit" class="grey" value="Tạo Tài Khoản">
                    </div>
                </div>
                <p class="terms">Bằng cách nhấp vào 'Tạo tài khoản', bạn đồng ý với <a href="#">Điều khoản &amp; Điều
                        kiện</a>.
                </p>
                <div class="clear"></div>
            </form>
        </div>
        <div class="clear"></div>
    </div>
    <?php
include "include/footer.php";

?>