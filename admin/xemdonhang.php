<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
 if (isset($_SESSION['tenadmin'])) {
 $tenadmin = $_SESSION['tenadmin']; 
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
            <li class="active">Xem đơn hàng</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Xem đơn hàng</h1>
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
                                    <th>Tên sản phẩm</th>
                                    <th>Giá sản phẩm</th>
                                    <th>Số lượng</th>
                                    <th>Hình ảnh</th>
                                    <th>Thành tiền</th>
                                    <!-- <th>Hành động</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $magiohang = $_GET['magiohang'];
                                if (isset($_GET["page"])) {
                                    $page = $_GET["page"];
                                } else {
                                    $page = 1;
                                }
                                $row_per_page = 5;
                                $per_rows = $page * $row_per_page - $row_per_page;
                                $total_rows = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM chitietdonhang_sp,sanpham_sp
                                WHERE chitietdonhang_sp.id_sanpham = sanpham_sp.id_sp AND chitietdonhang_sp.magiohang='$magiohang'  ORDER BY chitietdonhang_sp.id_chitietdonhang ASC"));
                                $total_pages = ceil($total_rows / $row_per_page);
                                $list_page = " ";
                                $page_prev = $page - 1;
                                if ($page_prev <= 1) {
                                    $page_prev = 1;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=xemdonhang&page=' . $page_prev . '">&laquo;</a></li>';
                                // for ($i = 1; $i <= $total_pages; $i++) {
                                //     $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $i . '">' . $i . '</a></li>';
                                // }
                                // in dam so trang hien tai
                                if (!isset($_GET['page'])) {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == 1) {
                                            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=xemdonhang&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        for ($i = 2; $i <= $total_pages; $i++) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=xemdonhang&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                } else {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == $_GET['page']) {
                                            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=xemdonhang&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        if ($i != $_GET['page']) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=xemdonhang&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                }
                                //page next
                                $page_next = $page + 1;
                                if ($page_next > $total_pages) {
                                    $page_next = $total_pages;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=xemdonhang&page=' . $page_next . '">&raquo;</a></li>';
                                // echo $list_page;
                                
                                 
                                $sql_chitiet_donhang = "SELECT * FROM chitietdonhang_sp,sanpham_sp
                                WHERE chitietdonhang_sp.id_sanpham = sanpham_sp.id_sp AND chitietdonhang_sp.magiohang='$magiohang'  ORDER BY chitietdonhang_sp.id_chitietdonhang ASC LIMIT $per_rows, $row_per_page ";
                                $query_chitiet_donhang = mysqli_query($conn, $sql_chitiet_donhang);
                                    $tongtien = 0;
                                while ($row_ct_dh = mysqli_fetch_array($query_chitiet_donhang)) { 
                                    $tongtien =$tongtien+($row_ct_dh['gia_sp']*$row_ct_dh['soluong']);
                                    ?>
                                    <tr>
                                        <td style=""><?php echo $row_ct_dh['id_chitietdonhang'] ?></td>
                                        <td style=""><?php echo $row_ct_dh['magiohang'] ?></td>
                                        <td style=""><?php echo $row_ct_dh['ten_sp'] ?></td>
                                        <td style=""><?php echo number_format($row_ct_dh['gia_sp'],0,'.','.').'VNĐ' ?></td>
                                        <td style=""><?php echo $row_ct_dh['soluong'] ?></td>
                                        <td style=""><img style="width: 100px;" src="anh/<?php echo $row_ct_dh['hinhanh_sp'] ?>" alt=""></td>
                                        <td><?php echo number_format(($row_ct_dh['gia_sp']*$row_ct_dh['soluong']),0,'.','.').'VNĐ'?></td>
                                        
                                    <!-- <td class="form-group"> -->
                                        <!-- <a style="padding: 10px" href="index.php?page_layout=xemdonhang&magiohang=<?php echo $row_ct_dh['magiohang'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a style="padding: 10px" href="del_content.php?magiohang=<?php echo $row_ct_dh['magiohang'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a> -->
                                    <!-- </td>  -->                                       
                                    </tr>
                                <?php } ?>
                                     <p style="text-align: right;margin-right: 10px;">Tổng tiền:   <?php echo number_format($tongtien,0,'.','.').'VNĐ' ?></p>
                                 
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