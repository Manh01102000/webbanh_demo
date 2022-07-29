<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
$id_bv = $_GET['id'];
if (isset($_POST['suabaiviet'])) {
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
    // ----------------------------
    $update_bv = mysqli_query($conn,
        "UPDATE baiviet_sp SET 
                    ten_bv = '$ten_bv',
                    id_admin_bv ='$id_admin_bv',
                    ten_admin ='$ten_admin',
                    ngaytao_bv = '$ngaytao_bv',
                    id_danhmuc_bv = '$id_danhmuc_bv',
                    tomtat_bv = '$tomtat',
                    noidung_bv = '$noidung',
                    anh_bv = '$anh_bv',
                    nguon_bv='$nguon_bv'
        WHERE id_bv = '$id_bv'
        ");
    header('location:index.php?page_layout=content');
}
$Select_bv = mysqli_query($conn,"SELECT * FROM baiviet_sp,danhmucbaiviet_sp WHERE baiviet_sp.id_danhmuc_bv=danhmucbaiviet_sp.id_danhmuc_bv AND 
    baiviet_sp.id_bv = '$id_bv' ORDER BY id_bv LIMIT 1");
 while($row_bv = mysqli_fetch_array($Select_bv)){
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php?page_layout=dashboard"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=content">Quản lý bài viết</a></li>
            <li class="active"><?php echo $row_bv['ten_bv'];?></li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Bài viết: <?php echo $row_bv['ten_bv'];?></h1>
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
                                <input required name="ten_bv" value="<?php echo $row_bv['ten_bv'] ?>" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Tên nhân viên thêm</label>
                                <input required name="ten_admin" type="text" value="<?php echo $row_bv['ten_admin'] ?>"class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mã nhân viên</label>
                                <input required name="id_admin_bv" value="<?php echo $row_bv['id_admin_bv'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Ngày viết bài</label>
                                <input required name="ngaytao_bv" value="<?php echo $row_bv['ngaytao_bv'] ?>" type="date" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nguồn bài viết</label>
                                <input required name="nguon_bv" value="<?php echo $row_bv['nguon_bv'] ?>" type="text" class="form-control">
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
                                    <img style="width: 100px;" src="anh/<?php echo $row_bv['anh_bv'] ?>">
                                </div>
                            </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                                <label>Tóm tắt bài viết</label><br>
                                <textarea name="tomtat" id="" cols="30" rows="10"><?php echo $row_bv['tomtat_bv'] ?></textarea>
                            </div>
                        <div class="form-group">
                                <label>Nội dung bài viết</label><br>
                                <textarea name="noidung" id="" cols="30" rows="10"><?php echo $row_bv['noidung_bv'] ?></textarea>
                            </div>
                        
                        <button name="suabaiviet" type="submit" class="btn btn-success">Sửa bài viết</button>
                        <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    </form>
                        
                </div>
            </div>
        </div>
        <!-- /.col-->
    </div>
    <!-- /.row -->

</div>
<!--/.main-->
<?php } ?>
<script>
    CKEDITOR.replace( 'tomtat' );
    CKEDITOR.replace( 'noidung' );
    CKEDITOR.replace( 'noidung_sp' );
</script>