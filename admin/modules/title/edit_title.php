<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
$title_id=$_GET['id'];
$sql="SELECT*FROM title WHERE id=$title_id";
$query=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($query);
if (isset($_POST['sbm'])) {
    $trang_chu = $_POST['trang_chu'];
    $search = $_POST['search'];
    $cart = $_POST['cart'];
    $success = $_POST['success'];
    $sql_add = "UPDATE title SET 
    trang_chu ='$trang_chu',
    search='$search',
    cart='$cart',
    success='$success'
    WHERE id='$title_id'";
    mysqli_query($conn, $sql_add);
    header("location: index.php?page_layout=setting");
}
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
            <li><a href="index.php?page_layout=product">Quản lý title websise</a></li>
            <li class="active">Sửa title</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sửa title</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-12">
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Title trang chủ</label>
                                <input required name="trang_chu" type="text" class="form-control" value="<?php echo $row['trang_chu']?>">
                            </div>
                            <div class="form-group">
                                <label>Title trang tìm kiếm</label>
                                <input required name="search" type="text" class="form-control" value="<?php echo $row['search']?>">
                            </div>
                            <div class="form-group">
                                <label>Title trang giỏ hàng</label>
                                <input required name="cart" type="text" class="form-control" value="<?php echo $row['cart']?>">
                            </div>
                            <div class="form-group">
                                <label>Title trang mua hàng thành công</label>
                                <input required name="success" type="text" value="<?php echo $row['success']?>" class="form-control">
                            </div>
                            <button name="sbm" type="submit" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->

</div>
<!--/.main-->