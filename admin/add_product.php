<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
include_once("connect.php");

if (isset($_SESSION['tenadmin'])) {
    $tenadmin = $_SESSION['tenadmin'];
    $query_nv = mysqli_query($conn,"SELECT * FROM user WHERE user_full = '$tenadmin'");
    $row_nv = mysqli_fetch_array($query_nv);
}

if (isset($_POST['themsanpham'])) {
    $ten_sp = $_POST['ten_sp'];
    $id_admin_sp = $_POST['id_admin_sp'];
    $tenadmin = $_POST['tenadmin'];
    $ma_sp = $_POST['ma_sp'];
    $gia_sp = $_POST['gia_sp'];
    $soluong_sp = $_POST['soluong_sp'];
    $id_danhmuc = $_POST['id_danhmuc'];
    $noidung_sp = $_POST['noidung_sp'];
    //  xử lý hình ảnh//
    $hinhanh_sp = $_FILES['hinhanh_sp']['name'];
    $hinhanh_sp_tmp = $_FILES['hinhanh_sp']['tmp_name'];
    $hinhanh_sp = time().'_'.$hinhanh_sp;
    move_uploaded_file($hinhanh_sp_tmp,'anh/'.$hinhanh_sp);
    // -----------------------------
    $insert_sp = mysqli_query($conn,
        "INSERT INTO sanpham_sp(id_admin_sp,id_danhmuc,ten_admin_sp,ten_sp,gia_sp,soluong_sp,noidung_sp,hinhanh_sp,ma_sp) 
        VALUES('$id_admin_sp','$id_danhmuc','$tenadmin','$ten_sp','$gia_sp', '$soluong_sp','$noidung_sp','$hinhanh_sp','$ma_sp')"
    );
    header('location:index.php?page_layout=product');
    
   
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=product">Quản lý sản phẩm</a></li>
            <li class="active">Thêm sản phẩm</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm sản phẩm</h1>
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
                                <label>Tên sản phẩm</label>
                                <?php
                                if (isset($error_name)) {
                                    echo $error_name;
                                }
                                ?>
                                <input required name="ten_sp" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Tên nhân viên thêm</label>
                                <input required name="tenadmin" type="text" value="<?php echo $row_nv['user_full'] ?>"class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mã nhân viên</label>
                                <input required name="id_admin_sp" value="<?php echo $row_nv['user_id'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mã sản phẩm</label>
                                <input required name="ma_sp" type="text" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input required name="gia_sp" type="number" min="0" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input name="soluong_sp" type="text" class="form-control">
                            </div>
                            <!-- <div class="form-group">
                            <label>Trạng thái</label>
                            <select name="tinhtrang_sp" class="form-control">
                                <option value=1 selected>Kích hoạt</option>
                                <option value=0>Ẩn</option>
                            </select>
                        </div> -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Ảnh sản phẩm</label>
                            <?php if (isset($error)) { echo $error;} ?>
                            <input required name="hinhanh_sp" type="file">
                            <br>
                            <div>
                                <img src="img/product/download.jpeg">
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Danh mục</label>
                            <select name="id_danhmuc" class="form-control">
                                <?php
                                $sql = "SELECT * FROM danhmuc_sanpham";
                                $query = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($query)) { ?>
                                    <option value=<?php echo $row['id_danhmuc'] ?>><?php echo $row['tendanhmuc']; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                                <label>Nội dung</label><br>
                                <textarea name="noidung_sp" id="" cols="30" rows="10"></textarea>
                            </div>
                        
                        <button name="themsanpham" type="submit" class="btn btn-success">Thêm mới</button>
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