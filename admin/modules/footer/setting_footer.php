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
            <li class="active">Cấu hình Website</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách cấu hình</h1>
        </div>
    </div>
    <!--/.row-->
    <div id="toolbar" class="btn-group">
        <ul>
            <li>
                <a href="index.php?page_layout=add_footer1" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Thêm chân trang 1</a>
            </li>
            <li>
                <a href="index.php?page_layuot=add_footer2" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Thêm chân trang 2</a>
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
                                <th data-field="name" data-sortable="true">Logo website</th>
                                <th data-field="price" data-sortable="true">Content logo</th>
                                <th>Địa chỉ</th>
                                <th>Nội dung địa chỉ</th>
                                <th>Dịch vụ</th>
                                <th>Nội dung dịch vụ</th>
                                <th>Hotline</th>
                                <th>Nội dung Hotline</th>
                                <th>Tác vụ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM footer";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td><?php echo $row['id']; ?></td>
                                    <td><?php if(isset($row['logo'])){?><img class="img-fluid" src="img/footer/<?php echo $row['logo'];?>" alt=""><?php }else{ echo '<span style="background: #fb2442" class="badge badge-danger">Chua dat logo</span>';}?></td>
                                    <td><?php if(isset($row['content_logo'])){ echo $row['content_logo'];}else{ echo '<span style="background: #fb2442" class="badge badge-danger">Chua dat noi dung logo</span>';} ?></td>
                                    <td><?php if(isset($row['Address'])){ echo $row['Address'];}else{ echo '<span style="background: #fb2442" class="badge badge-danger">Chua dat dia chi</span>';} ?></td>
                                    <td><?php if(isset($row['content_Address'])){ echo $row['content_Address'];}else{ echo '<span style="background: #fb2442" class="badge badge-danger">Chua dat noi dung dia chi</span>';} ?></td>
                                    <td><?php if(isset($row['service'])){ echo $row['service'];}else{ echo '<span style="background: #fb2442" class="badge badge-danger">Chua dat dich vu</span>';} ?></td>
                                    <td><?php if(isset($row['content_service'])){ echo $row['content_service'];}else{ echo '<span style="background: #fb2442" class="badge badge-danger">Chua dat noi dung dich vu</span>';} ?></td>
                                    <td><?php if(isset($row['hotline'])){ echo $row['hotline'];}else{ echo '<span style="background: #fb2442" class="badge badge-danger">Chua dat hotline</span>';} ?></td>
                                    <td><?php if(isset($row['content_hotline'])){ echo $row['content_hotline'];}else{ echo '<span style="background: #fb2442" class="badge badge-danger">Chua dat hotline</span>';} ?></td>
                                    <td class="form-group">
                                        <?php 
                                        if(isset($row['logo']) && isset($row['content_logo']) && isset($row['Address']) && isset($row['content_Address']) && isset($row['service']) && isset($row['hotline']) && isset($row['content_hotline'])){?>
                                            <a href="index.php?page_layout=edit_footer1&id=<?php echo $row['id'];?>&name=<?php echo $row['logo']; ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                            <a href="delete_footer1.php?id=<?php echo $row['id']; ?>&name=<?php echo $row['logo']; ?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                        <?php }?>
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