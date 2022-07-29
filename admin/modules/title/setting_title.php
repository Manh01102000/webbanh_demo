<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
?>
<style>
    #toolbar ul {
        padding: 0;
    }
    #toolbar ul li {
        list-style: none;
    }
</style>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Cấu hình Title Website</li>
        </ol>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách cấu hình Title</h1>
        </div>
    </div>
    <!--/.row-->
    <div id="toolbar" class="btn-group">
        <ul>
            <li>
                <a href="index.php?page_layout=add_title" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Thêm mới Title</a>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">
                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name" data-sortable="true">Title trang chủ</th>
                                <th data-field="price" data-sortable="true">Title trang tìm kiếm</th>
                                <th>Title Giỏ hàng </th>
                                <th>Title mua hàng thành công</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT*FROM title";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php if (isset($row['trang_chu'])) {echo $row['trang_chu'];} else {echo '<span style="background: #fb2442" class="badge badge-danger">Chưa cấu hình Title trang chu</span>';} ?></td>
                                    <td><?php if (isset($row['search'])) {echo $row['search'];} else {echo '<span style="background: #fb2442" class="badge badge-danger">Chưa cấu hình Title trang tìm kiếm</span>';} ?></td>
                                    <td><?php if (isset($row['cart'])) {echo $row['cart'];} else {echo '<span style="background: #fb2442" class="badge badge-danger">Chưa cấu hình Title trang giỏ hàng</span>';} ?></td>
                                    <td><?php if (isset($row['success'])) {echo $row['success'];} else {echo '<span style="background: #fb2442" class="badge badge-danger">Chưa cấu hình Title trang mua hàng thanh công</span>';} ?></td>
                                    <td class="form-group">
                                        <a href="index.php?page_layout=edit_title&id=<?php echo $row['id']; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="delete_title.php?id=<?php echo $row['id']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
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