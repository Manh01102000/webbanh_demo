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
            <li class="active">Danh sách bài viết</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách bài viết</h1>
        </div>
    </div>
    <!--/.row-->
    <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_content" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm bài viết
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="POST">
                        <table data-toolbar="#toolbar" data-toggle="table">
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th>Mã nhân viên</th>
                                    <th data-field="name" data-sortable="true">Tên bài viết</th>
                                    <th>Tên nhân viên</th>
                                    <th>Tóm tắt bài viết</th>
                                    <th>Nội dung bài viết</th>
                                    <th>Ảnh bài viết</th>
                                    <th>Danh mục bài viết</th>
                                    <th>Ngày viết bài</th>
                                    <th>Nguồn bài viết</th>
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
                                $row_per_page = 1;
                                $per_rows = $page * $row_per_page - $row_per_page;
                                $total_rows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM baiviet_sp"));
                                $total_pages = ceil($total_rows / $row_per_page);
                                $list_page = " ";
                                $page_prev = $page - 1;
                                if ($page_prev <= 1) {
                                    $page_prev = 1;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=content&page=' . $page_prev . '">&laquo;</a></li>';
                                // for ($i = 1; $i <= $total_pages; $i++) {
                                //     $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $i . '">' . $i . '</a></li>';
                                // }
                                // in dam so trang hien tai
                                if (!isset($_GET['page'])) {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == 1) {
                                            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=content&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        for ($i = 2; $i <= $total_pages; $i++) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=content&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                } else {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == $_GET['page']) {
                                            $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=content&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        if ($i != $_GET['page']) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=content&page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                }
                                //page next
                                $page_next = $page + 1;
                                if ($page_next > $total_pages) {
                                    $page_next = $total_pages;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=content&page=' . $page_next . '">&raquo;</a></li>';
                                // echo $list_page;
                                
                                   
                                $sql = "SELECT * FROM baiviet_sp,danhmucbaiviet_sp WHERE baiviet_sp.id_danhmuc_bv = danhmucbaiviet_sp.id_danhmuc_bv
                                AND ten_admin ='$tenadmin' ORDER BY id_bv ASC LIMIT $per_rows, $row_per_page ";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($query)) { ?>
                                    <tr>
                                        <td style=""><?php echo $row['id_bv'] ?></td>
                                        <td style=""><?php echo $row['id_admin_bv'] ?></td>
                                        <td style=""><?php echo $row['ten_bv'] ?></td>
                                        <td style=""><?php echo $row['ten_admin'] ?></td>
                                        <td style=""><?php echo $row['tomtat_bv'] ?></td>
                                        <td style=""><?php echo $row['noidung_bv'] ?></td>
                                        <td style="text-align: center"><img width="130" height="180" src="anh/<?php echo $row['anh_bv']; ?>"/></td>
                                        <td style=""><?php echo $row['ten_danhmuc_bv'] ?></td>
                                        <td style=""><?php echo $row['ngaytao_bv'];?></td>
                                        <td style=""><?php echo $row['nguon_bv'];?></td>
                                    <td class="form-group">
                                        <a style="padding: 10px" href="index.php?page_layout=edit_content&id=<?php echo $row['id_bv'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a style="padding: 10px" href="del_content.php?id=<?php echo $row['id_bv'];?>" onclick="return confirm('Bạn thực sự muốn xóa')" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
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