<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
  if (isset($_SESSION['tenadmin'])) {
    $tenadmin = $_SESSION['tenadmin'];   
}
include("connect.php");
$id_admin = $_GET['id_admin'];

if(isset($_POST['sbm'])){
   $tendanhmuc = $_POST['tendanhmuc'];
   $thutu = $_POST['thutu'];
   //  xử lý hình ảnh//
    $hinhanh = $_FILES['hinhanh']['name'];
    $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
    $hinhanh = time().'_'.$hinhanh;
    move_uploaded_file($hinhanh_tmp,'anh/'.$hinhanh);
    // -----------------------------

    $query_insert = mysqli_query($conn,
    "INSERT INTO
    danhmuc_sanpham(id_admin,tendanhmuc,tenadmin,thutu,hinhanh_dm) 
    VALUES('$id_admin','$tendanhmuc','$tenadmin','$thutu','$hinhanh')");
    header('location:index.php?page_layout=category');
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
                                <input type="text" name="id_admin" value="<?php echo $id_admin  ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input type="text" name="tendanhmuc"  placeholder="Tên danh mục..." class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Tên quản trị thêm:</label>
                                <input type="text" name="tenadmin" value="<?php echo $tenadmin ?>" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Thứ tự danh mục:</label>
                                <input type="text" name="thutu"placeholder="thứ tự danh mục..." class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label>Ảnh danh mục:</label>
                                <input type="file" name="hinhanh" class="form-control">
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