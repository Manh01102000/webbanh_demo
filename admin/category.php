<?php
if (!defined('hang')) {
	die('ban truy cap sai cach');
	
}
include("connect.php");
if (isset($_SESSION['tenadmin'])) {
	$tenadmin = $_SESSION['tenadmin'];
}
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="index.php"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Quản lý danh mục</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Quản lý danh mục</h1>
		</div>
	</div>
	<!--/.row-->
	<div id="toolbar" class="btn-group">
		<?php 
		$query_dm = mysqli_query($conn,"SELECT * FROM user WHERE user_full='$tenadmin'");
		$row_dm = mysqli_fetch_array($query_dm); ?>
		<a href="index.php?page_layout=add_category&id_admin=<?php echo $row_dm['user_id'];?>" class="btn btn-success">
			<i class="glyphicon glyphicon-plus"></i> Thêm danh mục
		</a>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table data-toolbar="#toolbar" data-toggle="table">
						<thead>
							<tr>
								<th data-field="id" data-sortable="true">ID</th>
								<th>Tên danh mục</th>
								<th>Thứ tự</th>
								<th>Tên quản trị thêm</th>
								<th>Ảnh danh mục</th>
								<th>Hành động</th>
							</tr>
						</thead>
						<tbody>
							<?php
							//
							if(isset($_GET['page'])){
								$page=$_GET['page'];
							}else{$page=1;}
							$row_per_page=4;
							$per_page=$page*$row_per_page-$row_per_page;
							//
							$total_row=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM danhmuc_sanpham"));
							$total_page=ceil($total_row/$row_per_page);
							$list_page=" ";
							//// previous page
							$prv_page=$page-1;
							if($prv_page<1){
								$prv_page=1;
							}
							$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$prv_page.'">&laquo;</a></li>';
							// for($i=1;$i<=$total_page;$i++){
							// 	$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$i.'">'.$i.'</a></li>';
							// }
							// in dam so trang hien tai
							if (!isset($_GET['page'])) {
								for ($i = 1; $i <= $total_page; $i++) {
									if ($i == 1) {
										$list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=category&page='.$i.'">'.$i.'</a></li>';
									}
									for ($i = 2; $i <= $total_page; $i++) {
										$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$i.'">'.$i.'</a></li>';
									}
								}
							} else {
								for ($i = 1; $i <= $total_page; $i++) {
									if ($i == $_GET['page']) {
										$list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=category&page='.$i.'">'.$i.'</a></li>';
									}
									if ($i != $_GET['page']) {
										$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$i.'">'.$i.'</a></li>';
									}
								}
							}
							//page next
							$next_page=$page+1;
							if($next_page>$total_page){
								$next_page=$total_page;
							}
							$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$next_page.'">&raquo;</a></li>';
							$query = mysqli_query($conn, "SELECT * FROM danhmuc_sanpham ORDER BY danhmuc_sanpham.thutu ASC LIMIT $per_page,$row_per_page");
							while ($row=mysqli_fetch_array($query)) { ?>
								<tr>
									<td style=""><?php echo $row['id_danhmuc'];?></td>
									<td style=""><?php echo $row['tendanhmuc'];?></td>
									<td style=""><?php echo $row['thutu'];?></td>
									<td><?php echo $row['tenadmin']?></td>
									<td><img style="width: 100px;height: 100px;" src="anh/<?php echo $row['hinhanh_dm'] ?>" alt=""></td>
									<td class="form-group">
										<a href="index.php?page_layout=edit_category&id=<?php echo $row['id_danhmuc'];?>&id_admin=<?php echo $row['id_admin'] ?>" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
										<a href="#" onclick="$('#dialog-example_<?php echo $row['id_danhmuc'];?>').modal('show');" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
									</td>
									<div id="dialog-example_<?php echo $row['id_danhmuc']?>" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content" id="dialog-example_<?php echo $row['id_danhmuc'];?>">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Bạn thực sự muốn xóa danh mục <?php echo $row['tendanhmuc'] . ' ' . 'có ID:' . $row['id_danhmuc'];?> này!</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="$('#dialog-example_<?php echo $row['id_danhmuc'] ?>').modal('hide');">Hủy</button>
                                                        <a href="del_category.php?id=<?php echo $row['id_danhmuc'];?>" class="btn btn-danger" style="color: #fff;"> Xóa</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
								</tr>
							<?php } ?>
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