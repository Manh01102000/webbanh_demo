<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
include_once("connect.php");
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg>
                </a>
            </li>
            <li class="active">Danh sách sản phẩm</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách sản phẩm</h1>
        </div>
    </div>
    <!--/.row-->
    <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_product" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm sản phẩm
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <?php
                    $sql = "SELECT * FROM user WHERE user_mail='$mail' AND user_pass='$pass'";
                    $query = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_array($query);
                    if (isset($_SESSION['mail']) && isset($_SESSION['pass']) && isset($_SESSION['tenadmin']) && isset($_SESSION['id'])) {
                        $mail = $_SESSION['mail'];
                        $pass = $_SESSION['pass'];
                        $id = $_SESSION['id'];
                        if ($row['user_level'] == 1) {
                            header('location: index.php?page_layout=edit_product&id=' . $id . '');
                            unset($_SESSION['id']);
                        } else {
                            $erorr = '<div class="alert alert-danger">Ban khong co quyen truy cap sua sam pham nay !</div>';
                            unset($_SESSION['id']);
                        }
                    }
                    if (isset($_SESSION['mail']) && isset($_SESSION['pass']) && isset($_SESSION['id_del']) && isset($_SESSION['name_del']) && isset($_SESSION['img'])) {
                        $id_delete = $_SESSION['id_del'];
                        $name_delete = $_SESSION['name_del'];
                        $img = $_SESSION['img'];
                        if ($row['user_level'] == 1) {
                            header('location: del_product.php?id=' . $id_delete . '&name=' . $name_delete . '&img=' . $img . '');
                            unset($_SESSION['id_del']);
                            unset($_SESSION['name_del']);
                        } else {
                            $erorr_del = '<div class="alert alert-danger">Ban khong co quyen truy cap xoa san pham ' . $_SESSION['name_del'] . ' nay !</div>';
                            unset($_SESSION['id_del']);
                            unset($_SESSION['name_del']);
                        }
                    }
                    if (isset($erorr)) {
                        echo $erorr;
                    }
                    if (isset($erorr_del)) {
                        echo $erorr_del;
                    }
                    ?>
                    <form method="POST">
                        <table data-toolbar="#toolbar" data-toggle="table">
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th>Mã nhân viên</th>
                                    <th>Mã sản phẩm</th>
                                    <th data-field="name" data-sortable="true">Tên sản phẩm</th>
                                    <th>Tên nhân viên</th>
                                    <th data-field="price" data-sortable="true">Giá</th>
                                    <th>Nội dung</th>
                                    <th>Ảnh sản phẩm</th>
                                    <th>Danh mục</th>
                                    <th>Số lượng</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($_GET["page"])) {
                                    $page = $_GET["page"];
                                } else {
                                    $page = 1;
                                }
                                $row_per_page = 5;
                                $per_rows = $page * $row_per_page - $row_per_page;
                                $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM sanpham_sp"));
                                $total_pages = ceil($total_rows / $row_per_page);
                                $list_page = " ";
                                $page_prev = $page - 1;
                                if ($page_prev <= 1) {
                                    $page_prev = 1;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $page_prev . '">&laquo;</a></li>';
                                // for ($i = 1; $i <= $total_pages; $i++) {
                                //     $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $i . '">' . $i . '</a></li>';
                                // }
                                // in dam so trang hien tai
                                if (!isset($_GET['page'])) {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == 1) {
                                            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=product&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        for ($i = 2; $i <= $total_pages; $i++) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                } else {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == $_GET['page']) {
                                            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=product&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        if ($i != $_GET['page']) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                }
                                //page next
                                $page_next = $page + 1;
                                if ($page_next > $total_pages) {
                                    $page_next = $total_pages;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $page_next . '">&raquo;</a></li>';
                                // echo $list_page;
                                $sql = "SELECT * FROM sanpham_sp,danhmuc_sanpham WHERE sanpham_sp.id_danhmuc = danhmuc_sanpham.id_danhmuc ORDER BY id_sp ASC LIMIT $per_rows, $row_per_page ";
                                $query = mysqli_query($conn, $sql);
                                // mysqli_fetch_array($query);
                                while ($row = mysqli_fetch_array($query)) { ?>
                                    <tr>
                                        <td style=""><?php echo $row['id_sp'] ?></td>
                                        <td style=""><?php echo $row['id_admin_sp'] ?></td>
                                        <td style=""><?php echo $row['ma_sp'] ?></td>
                                        <td style=""><?php echo $row['ten_sp'] ?></td>
                                        <td style=""><?php echo $row['ten_admin_sp'] ?></td>
                                        <td style=""><?php echo number_format($row['gia_sp']).'VNĐ' ?></td>
                                        <td style=""><?php echo $row['noidung_sp'] ?></td>
                                        <td style="text-align: center"><img width="130" height="180" src="anh/<?php echo $row['hinhanh_sp']; ?>"/></td>
                                        <td><?php echo $row['tendanhmuc'];?></td>
                                        <td style=""><?php echo $row['soluong_sp'];?></td>

                                        <td class="form-group">
                                            <a style="padding: 10px;" href="check_account.php?id=<?php echo $row['id_sp'];?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <!-- Button trigger modal -->
                                            <a style="padding: 10px;"  onclick="$('#dialog-example_<?php echo $row['id_sp'];?>').modal('show');" href="#" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal"><i class="glyphicon glyphicon-remove"></i></a>
                                        </td>
                                        <!-- Modal -->
                                        <div id="dialog-example_<?php echo $row['id_sp']?>" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" id="dialog-example_<?php echo $row['id_sp'];?>">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Bạn thực sự muốn xóa sản phẩm <?php echo $row['ten_sp'] . ' ' . 'có ID:' . $row['id_sp'];?> này!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#dialog-example_<?php echo $row['id_sp'] ?>').modal('hide');">Hủy</button>
                                                        <a href="check_account.php?id_del=<?php echo $row['id_sp']; ?>&name_del=<?php echo $row['ten_sp'];?>&img=<?php echo $row['hinhanh_sp'];?>" class="btn btn-danger" style="color: #fff;"> Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </form>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php echo $list_page; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->
</div>
<!--/.main-->
<script>
    CKEDITOR.replace( 'tomtat' );
    CKEDITOR.replace( 'noidung' );
    CKEDITOR.replace( 'noidung_sp' );
</script>
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>