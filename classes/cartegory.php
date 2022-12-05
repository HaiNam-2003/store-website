<?php
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath.'/../lib/database.php');
    include_once ($filepath.'/../helpers/format.php');
?>

<?php
    class cartegory {
        private $db;
        private $fm;

        public function __construct() {
            $this->db = new Database();
            $this->fm = new Format();
        }

        public function insert_cartegory($catName) {
            $catName = $this->fm->validation($catName);
            
            $catName = mysqli_real_escape_string($this->db->link, $catName);

            if(empty($catName)) {
                $alert = "<span class='error'>Danh mục không được để trống</span>";
                return $alert;
            } else {
                $query = "INSERT INTO tbl_cartegory(catName) VALUES('$catName')";
                $result = $this->db->insert($query);
                if($result) {
                    $alert = "<span class='success'>Thêm danh mục thành công</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Thêm danh mục không thành công</span>";
                    return $alert;
                }
            }
        }

        public function show_cartegory() {
            $query = "SELECT * FROM tbl_cartegory ORDER BY catId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function getcatbyId($id) {
            $query = "SELECT * FROM tbl_cartegory WHERE catId = '$id'";
            $result = $this->db->select($query);
            return $result;
        }

        public function update_cartegory($catName, $id){
            $catName = $this->fm->validation($catName);
            
            $catName = mysqli_real_escape_string($this->db->link, $catName);
            $id = mysqli_real_escape_string($this->db->link, $id);

            if(empty($catName)) {
                $alert = "<span class='error'>Danh mục không được để trống</span>";
                return $alert;
            } else {
                $query = "UPDATE tbl_cartegory SET catName = '$catName' WHERE catId = '$id'";
                $result = $this->db->update($query);
                if($result) {
                    $alert = "<span class='success'>Sửa danh mục thành công</span>";
                    return $alert;
                } else {
                    $alert = "<span class='error'>Sửa danh mục không thành công</span>";
                    return $alert;
                }
            }
        }

        public function delete_cartegory($id) {
            $query = "DELETE FROM tbl_cartegory WHERE catId = '$id'";
            $result = $this->db->delete($query);
            if($result) {
                $alert = "<span class='success'>Xóa danh mục thành công</span>";
                return $alert;
            } else {
                $alert = "<span class='error'>Xóa danh mục không thành công</span>";
                return $alert;
            }
        }

        public function show_cartegory_fontend() {
            $query = "SELECT * FROM tbl_cartegory ORDER BY catId desc";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_product_by_cat($id) {
            $query = "SELECT * FROM tbl_product WHERE catId = '$id' ORDER BY catId desc LIMIT 8";
            $result = $this->db->select($query);
            return $result;
        }

        public function get_name_by_cat($id) {
            $query = "SELECT tbl_product.*, tbl_cartegory.catName, tbl_cartegory.catId 
            FROM tbl_product, tbl_cartegory 
            WHERE tbl_product.catId = tbl_cartegory.catId AND tbl_product.catId = '$id' LIMIT 1";
            $result = $this->db->select($query);
            return $result;
        }
    }
?>