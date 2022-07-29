<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
  if (isset($_SESSION['tenadmin'])) {
    $ten_admin_bv = $_SESSION['tenadmin'];   
}
include("connect.php");
$id_admin_bv = $_GET['id_admin'];

if(isset($_POST['sbm'])){
   $ten_danhmuc_bv = $_POST['ten_danhmuc_bv'];
   $thutu_bv = $_POST['thutu_bv'];
   //  xử lý hình ảnh//
    $hinhanh_bv = $_FILES['hinhanh_bv']['name'];
    $hinhanh_bv_tmp = $_FILES['hinhanh_bv']['tmp_name'];
    $hinhanh_bv = time().'_'.$hinhanh_bv;
    move_uploaded_file($hinhanh_bv_tmp,'anh/'.$hinhanh_bv);
    // -----------------------------

    $query_insert = mysqli_query($conn,
    "INSERT INTO
    danhmucbaiviet_sp(id_admin_bv,ten_danhmuc_bv,ten_admin_bv,thutu_bv,hinhanh_bv) 
    VALUES('$id_admin_bv','$ten_danhmuc_bv','$ten_admin_bv','$thutu_bv','$hinhanh_bv')");
    header('location:index.php?page_layout=category_content');
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Quản lý danh mục</a></li>
            <li class="active">Thêm danh mục</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm danh mục</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                   <form role="form" method="post" enctype="multipart/form-data">
                        <div class="col-md-8">
                           <!--  <div class="alert alert-danger">Danh mục đã tồn tại !</div> -->
                            <div class="form-group">
                                <label>Mã nhân viên:</label>
                                <input type="text" name="id_admin_bv" value="<?php echo $id_admin_bv  ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input type="text" name="ten_danhmuc_bv"  placeholder="Tên danh mục..." class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tên quản trị thêm:</label>
                                <input type="text" name="ten_admin_bv" value="<?php echo $ten_admin_bv ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Thứ tự danh mục:</label>
                                <input type="text" name="thutu_bv"placeholder="thứ tự danh mục..." class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Ảnh danh mục:</label>
                                <input type="file" name="hinhanh_bv" class="form-control">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">Thêm mới</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div>
    <!--/.main-->