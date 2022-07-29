<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Danh sách thành viên</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách thành viên</h1>
        </div>
    </div>
    <!--/.row-->
    <div id="toolbar" class="btn-group">
        <a href="index.php?page_layout=add_user" class="btn btn-success">
            <i class="glyphicon glyphicon-plus"></i> Thêm thành viên
        </a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">

                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name" data-sortable="true">Họ & Tên</th>
                                <th data-field="price" data-sortable="true">Email</th>
                                <th>Quyền</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if(isset($_GET['page'])){
                                $page=$_GET['page'];
                            }else{$page=1;}
                            $row_per_page=3;
                            $per_page=$page*$row_per_page-$row_per_page;
                            $total_page=mysqli_num_rows(mysqli_query($conn,"SELECT*FROM user"));
                            $total_row=ceil($total_page/$row_per_page);
                            // declare variable
                            $list_page=" ";
                            // previous page
                            $row_prv=$page-1;
                            if($row_prv<1){
                                $row_prv=1;
                            }
                            $list_page='<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page='.$row_prv.'"">&laquo;</a></li>';
                            // for($i=1;$i<=$total_row;$i++){
                            //     $list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page='.$i.'">'.$i.'</a></li>';
                            // }
                            // in dam so trang hien tai
							if (!isset($_GET['page'])) {
								for ($i = 1; $i <= $total_row; $i++) {
									if ($i == 1) {
										$list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=user&page='.$i.'">'.$i.'</a></li>';
									}
									for ($i = 2; $i <= $total_row; $i++) {
										$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page='.$i.'">'.$i.'</a></li>';
									}
								}
							} else {
								for ($i = 1; $i <= $total_row; $i++) {
									if ($i == $_GET['page']) {
										$list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=user&page='.$i.'">'.$i.'</a></li>';
									}
									if ($i != $_GET['page']) {
										$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page='.$i.'">'.$i.'</a></li>';
									}
								}
							}
                            // next page
                            $row_next=$page+1;
                            if($row_next>$total_row){
                                $row_next=$total_row;
                            }
                            $list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=user&page='.$row_next.'">&raquo;</a></li>';

                            $sql = "SELECT*FROM user LIMIT $per_page,$row_per_page";
                            $query = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_array($query)) { ?>
                                <tr>
                                    <td style=""><?php echo $row['user_id'];?></td>
                                    <td style=""><?php echo $row['user_full'];?></td>
                                    <td style=""><?php echo $row['user_mail'];?></td>
                                    <td><span class="label label-<?php if($row['user_level']==1){echo "danger";}else{echo 'success';}?>"><?php if($row['user_level']==1){echo 'Admin';}else{echo 'khach hang';}?></span></td>
                                    <td class="form-group">
                                        <a href="index.php?page_layout=edit_user&id=<?php echo $row['user_id'];?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                                        <a href="del_user.php?id=<?php echo $row['user_id'];?>" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                                    </td>
                                </tr>
                            <?php }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            
                            <?php echo $list_page;?>
                            
                        </ul>
                    </nav>
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