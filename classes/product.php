<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class product {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_product($data, $files) {
            
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $danhmuc = mysqli_real_escape_string($this->db->link, $data['danhmuc']);
            $thuonghieu = mysqli_real_escape_string($this->db->link, $data['thuonghieu']);
            $moTa = mysqli_real_escape_string($this->db->link, $data['moTa']);
            $gia = mysqli_real_escape_string($this->db->link, $data['gia']);
            $noibat = mysqli_real_escape_string($this->db->link, $data['noibat']);

            // ktra image va lay hinh anh cho vao folder upload
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['hinhanh']['name'];
            $file_size = $_FILES['hinhanh']['size'];
            $file_temp = $_FILES['hinhanh']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10). '.' .$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($productName=="" || $danhmuc=="" || $thuonghieu=="" || $moTa=="" || $gia=="" || $noibat=="" || $file_name=="") {
                $alert = "<span class='error'>Không được để trống</span>";
                return $alert;
            } else {
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_product(productName, catId, brandId, moTa, Gia, hinhAnh, sanpham_noibat) 
                            VALUES('$productName', '$danhmuc', '$thuonghieu', '$moTa', '$gia', '$unique_image', '$noibat')";
                $result = $this->db->insert($query);
                if($result) {
                    $alert = "<span class='success'>Thêm sản phẩm thành công</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Thêm sản phẩm không thành công</span>";
                    return $alert;
                }
            }
        }

        public function show_product() {
            // $query = "SELECT * FROM tbl_product ORDER BY productId desc";
            $query = "SELECT tbl_product.*, tbl_cartegory.catName, tbl_brand.brandName
                    FROM tbl_product INNER JOIN tbl_cartegory ON tbl_product.catId = tbl_cartegory.catId
                    INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
                    ORDER BY tbl_product.productId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproductbyId($id) {
            $query = "SELECT * FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_product($data, $files, $id){
            $productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $danhmuc = mysqli_real_escape_string($this->db->link, $data['danhmuc']);
            $thuonghieu = mysqli_real_escape_string($this->db->link, $data['thuonghieu']);
            $moTa = mysqli_real_escape_string($this->db->link, $data['moTa']);
            $gia = mysqli_real_escape_string($this->db->link, $data['gia']);
            $noibat = mysqli_real_escape_string($this->db->link, $data['noibat']);

            // ktra image va lay hinh anh cho vao folder upload
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['hinhanh']['name'];
            $file_size = $_FILES['hinhanh']['size'];
            $file_temp = $_FILES['hinhanh']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10). '.' .$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($productName=="" || $danhmuc=="" || $thuonghieu=="" || $moTa=="" || $gia=="" || $noibat=="") {
                $alert = "<span class='error'>Không được để trống</span>";
                return $alert;
            } else {
                if(!empty($file_name)) {
                    // nếu người dùng chọn ảnh
                    if($file_size > 204800) {
                        $alert = "<span class='success'>Kích thước ảnh nên nhỏ hơn 2MB</span>";
                        return $alert;
                    } else if(in_array($file_ext, $permited) === false) {
                        $alert = "<span class='success'>Bạn chỉ có thể upload: ".implode(', ', $permited)."</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "UPDATE tbl_product 
                    SET productName = '$productName',
                        catId = '$danhmuc',
                        brandId = '$thuonghieu',
                        moTa = '$moTa',
                        Gia = '$gia',
                        hinhAnh = '$unique_image',
                        sanpham_noibat = '$noibat' 
                    WHERE productId = '$id'";
                } else {
                    // nếu người dùng không chọn ảnh
                    $query = "UPDATE tbl_product 
                    SET productName = '$productName',
                        catId = '$danhmuc',
                        brandId = '$thuonghieu',
                        moTa = '$moTa',
                        Gia = '$gia',
                        sanpham_noibat = '$noibat' 
                    WHERE productId = '$id'";
                }
            }
                $result = $this->db->update($query);
                if($result) {
                    $alert = "<span class='success'>Sửa sản phẩm thành công</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Sửa sản phẩm không thành công</span>";
                    return $alert;
                }
            
        }

        public function delete_product($id) {
            $query = "DELETE FROM tbl_product WHERE productId = '$id'";
            $result = $this->db->delete($query);
            if($result) {
                $alert = "<span class='success'>Xóa sản phẩm thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Xóa sản phẩm không thành công</span>";
                return $alert;
            }
        }
        // end backend

        // /////
        

        public function product_add_iphone() {
            $sp_tungtrang = 4;
            if(!isset($_GET['trang_apple'])) {
                $trang = 1;
            } else {
                $trang = $_GET['trang_apple'];
            }
            $tung_trang = ($trang - 1)* $sp_tungtrang;
            $query = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId desc LIMIT $tung_trang, $sp_tungtrang";
            $result = $this->db->select($query);
            return $result;
        }

        public function product_add_sumsung() {
            $sp_tungtrang = 4;
            if(!isset($_GET['trang_samsung'])) {
                $trang = 1;
            } else {
                $trang = $_GET['trang_samsung'];
            }
            $tung_trang = ($trang - 1)* $sp_tungtrang;
            $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId desc LIMIT $tung_trang, $sp_tungtrang";
            $result = $this->db->select($query);
            return $result;
        }

        public function product_add_dell() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '1'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getproduct_new() {
            $sp_tungtrang = 4;
            if(!isset($_GET['trang'])) {
                $trang = 1;
            } else {
                $trang = $_GET['trang'];
            }
            $tung_trang = ($trang - 1)* $sp_tungtrang;
            $query = "SELECT * FROM tbl_product ORDER BY productId desc LIMIT $tung_trang, $sp_tungtrang";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function get_all_product() {
            $query = "SELECT * FROM tbl_product";
            $result = $this->db->select($query);
            return $result;
        }
        
        public function getproduct_feathered() {
            $sp_moitrang = 4;
            if(!isset($_GET['trang_noibat'])) {
                $trang = 1;
            } else {
                $trang = $_GET['trang_noibat'];
            }
            $moi_trang = ($trang - 1)* $sp_moitrang;
            $query = "SELECT * FROM tbl_product WHERE sanpham_noibat = '0' ORDER BY productId desc LIMIT $moi_trang, $sp_moitrang";
            $result = $this->db->select($query);
            return $result;
        }


        public function get_product_outstanding() {
            $query = "SELECT * FROM tbl_product WHERE sanpham_noibat = '0' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_apple() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '4' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_samsung() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '2' ";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_brand_apple() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '4'";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_details($id) {
            $query = "SELECT tbl_product.*, tbl_cartegory.catName, tbl_brand.brandName
                    FROM tbl_product INNER JOIN tbl_cartegory ON tbl_product.catId = tbl_cartegory.catId
                    INNER JOIN tbl_brand ON tbl_product.brandId = tbl_brand.brandId
                    WHERE tbl_product.productId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastestDell() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '1' ORDER BY productId desc LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastestApple() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '4' ORDER BY productId desc LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastestSamsung() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '2' ORDER BY productId desc LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        public function getLastestOppo() {
            $query = "SELECT * FROM tbl_product WHERE brandId = '5' ORDER BY productId desc LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }

        // lấy dữ liệu sản phẩm bằng customer_id
        public function get_compare($customer_id) {
            $query = "SELECT * FROM tbl_compare WHERE customer_id = '$customer_id' ORDER BY id desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_wishlist($customer_id) {
            $query = "SELECT * FROM tbl_wishlist WHERE customer_id = '$customer_id' ORDER BY id desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function insertCompare($productid, $customer_id) {

            $productid = mysqli_real_escape_string($this->db->link, $productid);
            $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

            $query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result['productName'];
            $Gia = $result['Gia'];
            $hinhAnh = $result['hinhAnh'];

            // ktra trung san pham
            $check_compare = "SELECT * FROM tbl_compare WHERE productId = '$productid' AND customer_id = '$customer_id'";
            $result_check_compare = $this->db->select($check_compare);
            if($result_check_compare) {
                $msg = "<span class='error' style='color:red; font-size:18px'>Sản phẩm đã được thêm</span>";
                return $msg;
            } else {
                $query_insert = "INSERT INTO tbl_compare(productId, Gia, hinhAnh, customer_id, productName) VALUES('$productid', '$Gia', '$hinhAnh', '$customer_id', '$productName')";
                $insert_compare = $this->db->insert($query_insert);
                if($insert_compare) {
                    $msg = "<span class='error' style='color:green; font-size:18px'>Thêm sản phẩm so sánh thành công</span>";
                return $msg;
                } else {
                    $msg = "<span class='error' style='color:red; font-size:18px'>Thêm sản phẩm so sánh không thành công</span>";
                    return $msg;
                }
            }
        }

        public function insertWishlist($productid, $customer_id) {
            $productid = mysqli_real_escape_string($this->db->link, $productid);
            $customer_id = mysqli_real_escape_string($this->db->link, $customer_id);

            $query = "SELECT * FROM tbl_product WHERE productId = '$productid'";
            $result = $this->db->select($query)->fetch_assoc();

            $productName = $result['productName'];
            $Gia = $result['Gia'];
            $hinhAnh = $result['hinhAnh'];

            // ktra trung san pham
            $check_wishlist = "SELECT * FROM tbl_wishlist WHERE productId = '$productid' AND customer_id = '$customer_id'";
            $result_check_wishlist = $this->db->select($check_wishlist);
            if($result_check_wishlist) {
                $msg = "<span class='error' style='color:red; font-size:18px'>Sản phẩm đã được thêm vào yêu thích</span>";
                return $msg;
            } else {
                $query_insert = "INSERT INTO tbl_wishlist(productId, Gia, hinhAnh, customer_id, productName) VALUES('$productid', '$Gia', '$hinhAnh', '$customer_id', '$productName')";
                $insert_wishlist = $this->db->insert($query_insert);
                if($insert_wishlist) {
                    $msg = "<span class='error' style='color:green; font-size:18px'>Thêm sản phẩm yêu thích thành công</span>";
                return $msg;
                } else {
                    $msg = "<span class='error' style='color:red; font-size:18px'>Thêm sản phẩm yêu thích không thành công</span>";
                    return $msg;
                }
            }
        }

        public function delete_wishlist($proid, $customer_id) {
            $query = "DELETE FROM tbl_wishlist WHERE productId = '$proid' AND customer_id = '$customer_id'";
            $result = $this->db->delete($query);
            return $result;
        }

        public function insertSlider($data, $files) {
            $sliderName = mysqli_real_escape_string($this->db->link, $data['sliderName']);
            $type = mysqli_real_escape_string($this->db->link, $data['type']);
            

            // ktra image va lay hinh anh cho vao folder upload
            $permited = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10). '.' .$file_ext;
            $uploaded_image = "uploads/".$unique_image;

            if($sliderName=="" || $type=="") {
                $alert = "<span class='error'>Không được để trống</span>";
                return $alert;
            } else {
                if(!empty($file_name)) {
                    // nếu người dùng chọn ảnh
                    if($file_size > 204800) {
                        $alert = "<span class='success'>Kích thước ảnh nên nhỏ hơn 2MB</span>";
                        return $alert;
                    } else if(in_array($file_ext, $permited) === false) {
                        $alert = "<span class='success'>Bạn chỉ có thể upload: ".implode(', ', $permited)."</span>";
                        return $alert;
                    }
                    move_uploaded_file($file_temp, $uploaded_image);
                    $query = "INSERT INTO tbl_slider(sliderName, sliderImage, Type) 
                            VALUES('$sliderName', '$unique_image', '$type')";
                    $result = $this->db->insert($query);
                    if($result) {
                        $alert = "<span class='success'>Thêm slider thành công</span>";
                        return $alert;
                    } else {
                        $alert = "<span class='error'>Thêm slider không thành công</span>";
                        return $alert;
                    }
                } 
            }
        }

        public function show_slider() {
            $query = "SELECT * FROM tbl_slider WHERE type = '1' ORDER BY sliderId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function show_slider_list() {
            $query = "SELECT * FROM tbl_slider ORDER BY sliderId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_type_slider($id, $type) {
            $type = mysqli_real_escape_string($this->db->link, $type);
            $query = "UPDATE tbl_slider SET type = '$type' WHERE sliderId = '$id'";
            $result = $this->db->update($query);
            return $result;
        }

        public function delete_slider($id) {
            $query = "DELETE FROM tbl_slider WHERE sliderId = '$id'";
            $result = $this->db->delete($query);
            return $result;
        }

        // hàm tìm kiếm sản phẩm
        public function search_product($tukhoa) {
            $tukhoa = $this->fm->validation($tukhoa); // ktra xem tu khoa có tồn tại không
            $query = "SELECT * FROM tbl_product WHERE productName LIKE '%$tukhoa%'";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>