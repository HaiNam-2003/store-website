<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class cart {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function add_to_cart($soLuong, $id) {
            $soLuong = $this->fm->validation($soLuong);

            $soLuong = mysqli_real_escape_string($this->db->link, $soLuong);
            $id = mysqli_real_escape_string($this->db->link, $id);
            $sessionId = session_id();

            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query)->fetch_assoc();
            $hinhAnh = $result['hinhAnh'];
            $Gia = $result['Gia'];
            $productName = $result['productName'];

            // ktra trung san pham
            // $check_cart = "SELECT * FROM tbl_cart WHERE productId = '$id' AND sessionId = '$sessionId'";
            // if($check_cart) {
            //     $msg = "Sản phẩm đã có trong giỏ hàng";
            //     return $msg;
            // } else {
                $query_insert = "INSERT INTO tbl_cart(productId, sessionId, productName, Gia, soLuong, hinhAnh) VALUES('$id', '$sessionId', '$productName', '$Gia', '$soLuong', '$hinhAnh')";
                $insert_cart = $this->db->insert($query_insert);
                if($insert_cart) {
                    header('location: cart.php');
                } else {
                    header('location: details.php?proid=55');
                }
            // }
        }

        public function get_product_cart() {
            $sessionId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_cart_ordered($customer_id) {
            $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
            $get_cart_ordered = $this->db->select($query);
            return $get_cart_ordered;
        }

        public function update_quantity_cart($soluong, $cartId) {
            $soluong = mysqli_real_escape_string($this->db->link, $soluong);
            $cartId = mysqli_real_escape_string($this->db->link, $cartId);

            $query = "UPDATE tbl_cart SET soluong = '$soluong' WHERE cartId = '$cartId'";
            $result = $this->db->update($query);
            if($result) {
                header('location: cart.php');
            } else {
                $msg = "<span class='error' style='color:red; font-size:18px'>Số lượng sản phẩm chưa đã được update</span>";
                return $msg;
            }
        }

        public function delete_cart($cartid) {
            $cartid = mysqli_real_escape_string($this->db->link, $cartid);

            $query = "DELETE FROM tbl_cart WHERE cartid = '$cartid'";
            $result = $this->db->delete($query);

            if($result) {
                header('location: cart.php');
            } else {
                $msg = "<span class='error'style='color:red; font-size:18px'>Xóa sản phẩm không thành công</span>";
                return $msg;
            }
        }

        public function check_cart_product() {
            $sessionId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
            $result = $this->db->select($query);
            return $result;
        }

        public function check_order($customer_id ) {
            $query = "SELECT * FROM tbl_order WHERE customer_id = '$customer_id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function del_all_data_cart() {
            $sessionId = session_id();
            $query = "DELETE FROM tbl_cart WHERE sessionId = '$sessionId'";
            $result = $this->db->delete($query);
            return $result;
        }

        public function del_all_data_compare($customer_id) {
            $query = "DELETE FROM tbl_compare WHERE customer_id = '$customer_id'";
            $result = $this->db->delete($query);
            return $result;
        }

        public function insert_order($customer_id) {
            $sessionId = session_id();
            $query = "SELECT * FROM tbl_cart WHERE sessionId = '$sessionId'";
            $get_product = $this->db->select($query);
            if($get_product) {
                while($result = $get_product->fetch_assoc()) {
                    $productid = $result['productId'];
                    $productName = $result['productName'];
                    $soLuong = $result['soLuong'];
                    $Gia = $result['Gia']  * $soLuong;
                    $hinhAnh = $result['hinhAnh'];
                    $customer_id = $customer_id;

                    $query_order = "INSERT INTO tbl_order(productId, productName,  soLuong, Gia, hinhAnh, customer_id) 
                    VALUES('$productid', '$productName', '$soLuong', '$Gia', '$hinhAnh', '$customer_id')";
                    $insert_order = $this->db->insert($query_order);
                    
                }
            }
        }

        public function getAmountPrice($customer_id) {
            $query = "SELECT Gia FROM tbl_order WHERE customer_id = '$customer_id'";
            $get_price = $this->db->select($query);
            return $get_price;
        }

        public function get_inbox_cart(){
            $query = "SELECT * FROM tbl_order ORDER BY date_order";
            $get_inbox_cart = $this->db->select($query);
            return $get_inbox_cart;
        }

        public function shifted($id, $time, $price) {
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);

            $query = "UPDATE tbl_order SET status = '1' WHERE id = '$id' AND date_order ='$time' AND Gia = '$price'";
            $result = $this->db->update($query);
            if($result) {
                $msg = "<span class='error' style='color:green; font-size:18px'>Cập nhập đơn hàng thành công</span>";
                return $msg;
            } else {
                $msg = "<span class='error' style='color:red; font-size:18px'>Cập nhập đơn hàng không thành công</span>";
                return $msg;
            }
        }

        public function del_shifted($id, $time, $price) {
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);

            $query = "DELETE FROM tbl_order WHERE id = '$id' AND date_order ='$time' AND Gia = '$price'";
            $result = $this->db->delete($query);
            if($result) {
                $msg = "<span class='error' style='color:green; font-size:18px'>Xóa đơn hàng thành công</span>";
                return $msg;
            } else {
                $msg = "<span class='error' style='color:red; font-size:18px'>Xóa đơn hàng không thành công</span>";
                return $msg;
            }
        }

        public function shifted_confirm($id, $time, $price) {
            $id = mysqli_real_escape_string($this->db->link, $id);
            $time = mysqli_real_escape_string($this->db->link, $time);
            $price = mysqli_real_escape_string($this->db->link, $price);

            $query = "UPDATE tbl_order SET status = '2' WHERE customer_id = '$id' AND date_order ='$time' AND Gia = '$price'";
            $result = $this->db->update($query);
            return $result;
        }
    }
?>