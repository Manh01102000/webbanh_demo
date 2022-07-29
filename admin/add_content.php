<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
include_once("connect.php");

if (isset($_SESSION['tenadmin'])) {
    $ten_admin = $_SESSION['tenadmin'];
    $query_nv = mysqli_query($conn,"SELECT * FROM user WHERE user_full = '$ten_admin'");
    $row_nv = mysqli_fetch_array($query_nv);
}

if (isset($_POST['thembaiviet'])) {
    $ten_bv = $_POST['ten_bv'];
    $id_admin_bv = $_POST['id_admin_bv'];
    $ten_admin = $_POST['ten_admin'];
    $ngaytao_bv = $_POST['ngaytao_bv'];
    $id_danhmuc_bv = $_POST['id_danhmuc_bv'];
    $tomtat = $_POST['tomtat'];
    $noidung = $_POST['noidung'];
    $nguon_bv=$_POST['nguon_bv'];
    //  xử lý hình ảnh//
    $anh_bv = $_FILES['anh_bv']['name'];
    $anh_bv_tmp = $_FILES['anh_bv']['tmp_name'];
    $anh_bv = time().'_'.$anh_bv;
    move_uploaded_file($anh_bv_tmp,'anh/'.$anh_bv);
    // -----------------------------
    $insert_sp = mysqli_query($conn,
        "INSERT INTO baiviet_sp (ten_bv,id_danhmuc_bv,id_admin_bv,ten_admin,tomtat_bv,noidung_bv,ngaytao_bv,anh_bv,nguon_bv) 
        VALUES('$ten_bv','$id_danhmuc_bv','$id_admin_bv','$ten_admin','$tomtat', '$noidung','$ngaytao_bv','$anh_bv','$nguon_bv')"
    );
    header('location:index.php?page_layout=content');
    
   
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=content">Quản lý bài viết</a></li>
            <li class="active">Thêm bài viết</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm bài viết</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form role="form" method="post" enctype="multipart/form-data">
                    <div class="col-md-6">
                            <div class="form-group">
                                <label>Tên bài viết</label>
                                <?php
                                if (isset($error_name)) {
                                    echo $error_name;
                                }
                                ?>
                                <input required name="ten_bv" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Tên nhân viên thêm</label>
                                <input required name="ten_admin" type="text" value="<?php echo $row_nv['user_full'] ?>"class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mã nhân viên</label>
                                <input required name="id_admin_bv" value="<?php echo $row_nv['user_id'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Ngày viết bài</label>
                                <input required name="ngaytao_bv" type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nguồn bài viết</label>
                                <input required name="nguon_bv" type="text" class="form-control">
                            </div>

                            <div class="form-group">
                                <label>Danh mục</label>
                                <select name="id_danhmuc_bv" class="form-control">
                                    <?php
                                    $sql = "SELECT * FROM danhmucbaiviet_sp";
                                    $query = mysqli_query($conn, $sql);
                                    while ($row = mysqli_fetch_array($query)) { ?>
                                        <option value=<?php echo $row['id_danhmuc_bv'] ?>><?php echo $row['ten_danhmuc_bv']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Ảnh bài viết</label>
                                <?php if (isset($error)) { echo $error;} ?>
                                <input required name="anh_bv" type="file">
                                <br>
                                <div>
                                    <img src="img/product/download.jpeg">
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6">
                         <div class="form-group">
                              <label for="" style="width: 100%;">Tóm tắt bài viết </label> 
                              <textarea name="tomtat" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-group">
                              <label for="" style="width: 100%;">Nội dung </label> 
                              <textarea name="noidung" id="" cols="30" rows="10"></textarea>
                        </div>
                        <button name="thembaiviet" type="submit" class="btn btn-success">Thêm mới</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div>
<!--/.main-->
<script>
    CKEDITOR.replace( 'tomtat' );
    CKEDITOR.replace( 'noidung' );
    CKEDITOR.replace( 'noidung_sp' );
</script>