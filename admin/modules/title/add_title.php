<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
if (isset($_POST['sbm'])) {
    $trang_chu = $_POST['trang_chu'];
    $search = $_POST['search'];
    $cart = $_POST['cart'];
    $success = $_POST['success'];

    $sql_check = "SELECT*FROM title";
    $query_check = mysqli_query($conn, $sql_check);
    $row_check = mysqli_fetch_array($query_check);
    if (isset($row_check['id'])) {
        $id = $row_check['id'];
        $dell = "DELETE FROM title";
        mysqli_query($conn, $dell);
        $insert = "INSERT INTO title (id) VALUES (1)";
        mysqli_query($conn, $insert);
        $sql_add = "UPDATE title SET 
        trang_chu ='$trang_chu',
        search='$search',
        cart='$cart',
        success='$success'
        WHERE id='$id'";
        mysqli_query($conn, $sql_add);
        header("location: index.php?page_layout=setting_title");
    } else {
        $insert = "INSERT INTO title (id) VALUES (1)";
        mysqli_query($conn, $insert);
        $sql = "SELECT*FROM title";
        $query = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($query);
        if (isset($row['id'])) {
            $id = $row['id'];
            $sql_add = "UPDATE title SET 
            trang_chu ='$trang_chu',
            search='$search',
            cart='$cart',
            success='$success'
            WHERE id='$id'";
        mysqli_query($conn, $sql_add);
        header("location: index.php?page_layout=setting_title");
        }
    }
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li><a href="">Thêm title trang chủ</a></li>
            <li class="active">Thêm title trang chủ</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thêm title trang chủ</h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="col-md-8">
                        <div class="alert alert-danger">Title trang chủ đã tồn tại !</div>
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Title Trang chủ:</label>
                                <input required type="text" name="trang_chu" class="form-control" placeholder="Title trang chủ...">
                            </div>
                            <div class="form-group">
                                <label>Title trang tìm kiếm:</label>
                                <input required type="text" name="search" class="form-control" placeholder="Title trang tìm kiếm...">
                            </div>
                            <div class="form-group">
                                <label>Title trang giỏ hàng:</label>
                                <input required type="text" name="cart" class="form-control" placeholder="Title trang giỏ hàng...">
                            </div>
                            <div class="form-group">
                                <label>Title trang mua hàng thành công:</label>
                                <input required type="text" name="success" class="form-control" placeholder="Title trang mua hàng thành công...">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-success">Thêm mới</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                    </div>
                    </form>
                </div>
            </div>
        </div><!-- /.col-->
    </div>
    <!--/.main-->