<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>

<?php
    include '../classes/cartegory.php';
?>

<?php
    $cat = new cartegory();
    if(isset($_GET['deteleid'])) {
        $id = $_GET['deteleid'];
        $delete_cat = $cat -> delete_cartegory($id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <div class="block">
            <?php
        if(isset($delete_cat)) {
            echo $delete_cat;
        }
        ?>
            <table class="data display datatable" id="example">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tên danh mục</th>
                        <th>Tùy chỉnh</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $show_cat = $cat->show_cartegory();
                    if($show_cat) {
                        $i = 0;
                        while($result = $show_cat->fetch_assoc()) {
                            $i++;
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $i ?></td>
                        <td><?php echo $result['catName'] ?></td>
                        <td><a href="catedit.php?catid=<?php echo $result['catId'] ?>">Edit</a> ||
                            <a onclick="return confirm('Bạn có chắc là muốn xóa?')"
                                href="?deteleid=<?php echo $result['catId'] ?>">Delete</a>
                        </td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    setupLeftMenu();

    $('.datatable').dataTable();
    setSidebarHeight();
});
</script>
<?php include 'inc/footer.php';?>