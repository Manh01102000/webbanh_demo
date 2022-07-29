<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
    
}
include("connect.php");
if (isset($_SESSION['tenadmin'])) {
    $tenadmin = $_SESSION['tenadmin'];
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Quản lý danh mục</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Quản lý danh mục</h1>
        </div>
    </div>
    <!--/.row-->
    <div id="toolbar" class="btn-group">
        <?php 
        $query_dm = mysqli_query($conn,"SELECT * FROM user WHERE user_full='$tenadmin'");
        $row_dm = mysqli_fetch_array($query_dm); ?>
        <a href="index.php?page_layout=add_category_content&id_admin=<?php echo $row_dm['user_id'];?>" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm danh mục
        </a>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">
                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th>Mã nhân viên</th>
                                <th>Tên danh mục bài viết</th>
                                <th>Tên quản trị thêm</th>
                                <th>Thứ tự danh mục bài viết</th>
                                <th>Ảnh danh mục bài viết</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //
                            if(isset($_GET['page'])){
                                $page=$_GET['page'];
                            }else{$page=1;}
                            $row_per_page=4;
                            $per_page=$page*$row_per_page-$row_per_page;
                            //
                            $total_row=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM danhmucbaiviet_sp"));
                            $total_page=ceil($total_row/$row_per_page);
                            $list_page=" ";
                            //// previous page
                            $prv_page=$page-1;
                            if($prv_page<1){
                                $prv_page=1;
                            }
                            $list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=category_content&page='.$prv_page.'">&laquo;</a></li>';
                            // for($i=1;$i<=$total_page;$i++){
                            //  $list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$i.'">'.$i.'</a></li>';
                            // }
                            // in dam so trang hien tai
                            if (!isset($_GET['page'])) {
                                for ($i = 1; $i <= $total_page; $i++) {
                                    if ($i == 1) {
                                        $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=category_content&page='.$i.'">'.$i.'</a></li>';
                                    }
                                    for ($i = 2; $i <= $total_page; $i++) {
                                        $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category_content&page='.$i.'">'.$i.'</a></li>';
                                    }
                                }
                            } else {
                                for ($i = 1; $i <= $total_page; $i++) {
                                    if ($i == $_GET['page']) {
                                        $list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=category_content&page='.$i.'">'.$i.'</a></li>';
                                    }
                                    if ($i != $_GET['page']) {
                                        $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category_content&page='.$i.'">'.$i.'</a></li>';
                                    }
                                }
                            }
                            //page next
                            $next_page=$page+1;
                            if($next_page>$total_page){
                                $next_page=$total_page;
                            }
                            $list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=category_content&page='.$next_page.'">&raquo;</a></li>';
                            $query = mysqli_query($conn, "SELECT * FROM danhmucbaiviet_sp ORDER BY danhmucbaiviet_sp.thutu_bv ASC LIMIT $per_page,$row_per_page");
                            while ($row=mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td style=""><?php echo $row['id_danhmuc_bv'];?></td>
                                    <td><?php echo $row['id_admin_bv'] ?></td>
                                    <td style=""><?php echo $row['ten_danhmuc_bv'];?></td>
                                    <td><?php echo $row['ten_admin_bv']?></td>
                                    <td style=""><?php echo $row['thutu_bv'];?></td>
                                    <td><img style="width: 100px;height: 100px;" src="anh/<?php echo $row['hinhanh_bv'] ?>" alt=""></td>
                                    <td class="form-group">
                                        <a href="index.php?page_layout=edit_category_content&id=<?php echo $row['id_danhmuc_bv'];?>&id_admin_bv=<?php echo $row['id_admin_bv'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="delete_category_content.php?id=<?php echo $row['id_danhmuc_bv'];?>" onclick="return confirm('Bạn thực sự muốn xóa')" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            
                            <?php echo $list_page;?>
                            
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