<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
$id_sp = $_GET['id'];
if (isset($_POST['suasanpham'])) {
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
    $update_sp = mysqli_query($conn,
        "UPDATE sanpham_sp SET 
                    ten_sp = '$ten_sp',
                    id_admin_sp ='$id_admin_sp',
                    ten_admin_sp ='$tenadmin',
                    ma_sp = '$ma_sp',
                    gia_sp = '$gia_sp',
                    soluong_sp = '$soluong_sp',
                    id_danhmuc = '$id_danhmuc',
                    noidung_sp = '$noidung_sp',
                    hinhanh_sp = '$hinhanh_sp'
        WHERE id_sp = '$id_sp';
        "
    );
    header('location:index.php?page_layout=product');
}
$Select_sp = mysqli_query($conn,"SELECT * FROM sanpham_sp,danhmuc_sanpham WHERE sanpham_sp.id_danhmuc=danhmuc_sanpham.id_danhmuc AND sanpham_sp.id_sp = '$id_sp' ORDER BY id_sp LIMIT 1");
 while($row_sp = mysqli_fetch_array($Select_sp)){
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="index.php?page_layout=dashboard"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="index.php?page_layout=product">Quản lý sản phẩm</a></li>
            <li class="active"><?php echo $row_sp['ten_sp'];?></li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sản phẩm: <?php echo $row_sp['ten_sp'];?></h1>
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
                                <input required name="ten_sp" value="<?php echo $row_sp['ten_sp'] ?>" class="form-control" placeholder="">
                            </div>
                            <div class="form-group">
                                <label>Tên nhân viên thêm</label>
                                <input required name="tenadmin" type="text" value="<?php echo $row_sp['tenadmin'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mã nhân viên</label>
                                <input required name="id_admin_sp" value="<?php echo $row_sp['id_admin_sp'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Mã sản phẩm</label>
                                <input required name="ma_sp" type="text" value="<?php echo $row_sp['ma_sp'] ?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Giá sản phẩm</label>
                                <input required name="gia_sp" value="<?php echo $row_sp['gia_sp'] ?>" type="number" min="0" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Số lượng</label>
                                <input name="soluong_sp" value="<?php echo $row_sp['soluong_sp'] ?>" type="text" class="form-control">
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
                                <img style="width: 100px" src="anh/<?php echo $row_sp['hinhanh_sp'] ?>">
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
                                <textarea name="noidung_sp" id="" cols="30" rows="10"><?php echo $row_sp['noidung_sp'] ?></textarea>
                            </div>
                        
                        <button name="suasanpham" type="submit" class="btn btn-success">Cập Nhập</button>
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