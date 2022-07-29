<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
 if (isset($_SESSION['tenadmin'])) {
 $tenadmin = $_SESSION['tenadmin']; 
 }
include_once("connect.php");
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
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
            <li class="active">Quản lý đơn hàng</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý đơn hàng</h1>
        </div>
    </div>
    <!--/.row-->
    <!-- <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm bài viết
        </a>
    </div>-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="POST">
                        <table data-toolbar="#toolbar" data-toggle="table">
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Tình trạng</th>
                                    <th>Ngày đặt</th>
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
                                $total_rows = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM giohang_sp,dangky_sp
                                WHERE giohang_sp.id_khachhang = dangky_sp.id_dangky  ORDER BY giohang_sp.id_giohang ASC"));
                                $total_pages = ceil($total_rows / $row_per_page);
                                $list_page = " ";
                                $page_prev = $page - 1;
                                if ($page_prev <= 1) {
                                    $page_prev = 1;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=quanlydonhang&page=' . $page_prev . '">&laquo;</a></li>';
                                // for ($i = 1; $i <= $total_pages; $i++) {
                                //     $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $i . '">' . $i . '</a></li>';
                                // }
                                // in dam so trang hien tai
                                if (!isset($_GET['page'])) {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == 1) {
                                            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=quanlydonhang&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        for ($i = 2; $i <= $total_pages; $i++) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=quanlydonhang&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                } else {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == $_GET['page']) {
                                            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=quanlydonhang&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        if ($i != $_GET['page']) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=quanlydonhang&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                }
                                //page next
                                $page_next = $page + 1;
                                if ($page_next > $total_pages) {
                                    $page_next = $total_pages;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=quanlydonhang&page=' . $page_next . '">&raquo;</a></li>';
                                // echo $list_page;
                                
                                   
                                $sql_lietke_donhang = "SELECT * FROM giohang_sp,dangky_sp
                                WHERE giohang_sp.id_khachhang = dangky_sp.id_dangky  ORDER BY giohang_sp.id_giohang DESC LIMIT $per_rows, $row_per_page ";
                                $query_lietke_donhang = mysqli_query($conn, $sql_lietke_donhang);
                                while ($row_lk_dh = mysqli_fetch_array($query_lietke_donhang)) { ?>
                                    <tr>
                                        <td style=""><?php echo $row_lk_dh['id_giohang'] ?></td>
                                        <td style=""><?php echo $row_lk_dh['magiohang'] ?></td>
                                        <td style=""><?php echo $row_lk_dh['ten_kh'] ?></td>
                                        <td style=""><?php echo $row_lk_dh['diachi_kh'] ?></td>
                                        <td style=""><?php echo $row_lk_dh['email_kh'] ?></td>
                                        <td style=""><?php echo $row_lk_dh['sodienthoai_kh']?></td>
                                        <td style="">
                                            <?php if ($row_lk_dh['trangthai_giohang']==1){
                                                echo'<a href="xulydonhang.php?trangthai_giohang=0&magiohang='.$row_lk_dh['magiohang'].'" style="color:red;text-decoration: none;">Đơn hàng mới</a>';
                                            }else{
                                                echo'<a href="#" style="color:skyblue;text-decoration: none;">Đã xem</a>';
                                            }
                                                 ?>
                                        </td>
                                        <td><?php echo $row_lk_dh['ngaydathang'] ?></td>
                                    <td class="form-group">
                                        <a style="padding: 10px" href="index.php?page_layout=xemdonhang&magiohang=<?php echo $row_lk_dh['magiohang'] ?>" class="btn btn-primary">
                                            <i class="fa-regular fa-eye"></i></a>
                                        <a style="padding: 10px" href="del_donhang.php?magiohang=<?php echo $row_lk_dh['magiohang'];?>" onclick="return confirm('Bạn thực sự muốn xóa')" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>                                        
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
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>