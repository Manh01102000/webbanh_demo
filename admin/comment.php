<?php
if (!defined('hang')) {
	die('ban truy cap sai cach');
	
}
include("connect.php");
if (isset($_SESSION['tenadmin'])) {
	$ten_admin_bl = $_SESSION['tenadmin'];
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="index.php"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Quản lý bình luận</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Quản lý bình luận</h1>
		</div>
	</div>
	<!--/.row-->
	<div id="toolbar" class="btn-group">
		<!-- <?php 
		$query_bl = mysqli_query($conn,"SELECT * FROM binhluan_sp");
		$row_bl = mysqli_fetch_array($query_bl); ?>
		<a href="index.php?page_layout=edit_comment&id=<?php echo $row_bl['id_bl']?>" class="btn btn-success">
			<i class="glyphicon glyphicon-plus"></i> Trả lời bình luận
		</a> -->
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<table data-toolbar="#toolbar" data-toggle="table">
						<thead>
							<tr>
								<th data-field="id" data-sortable="true">ID</th>
								<th>Tên khách hàng</th>
								<th>Nội dung bình luận</th>
								<th>Tên nhân viên</th>
								<th>Nội dung trả lời</th>
								<th>Ngày bình luận</th>
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
							$total_row=mysqli_num_rows(mysqli_query($conn,"SELECT * FROM binhluan_sp"));
							$total_page=ceil($total_row/$row_per_page);
							$list_page=" ";
							//// previous page
							$prv_page=$page-1;
							if($prv_page<1){
								$prv_page=1;
							}
							$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=comment&page='.$prv_page.'">&laquo;</a></li>';
							// for($i=1;$i<=$total_page;$i++){
							// 	$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=category&page='.$i.'">'.$i.'</a></li>';
							// }
							// in dam so trang hien tai
							if (!isset($_GET['page'])) {
								for ($i = 1; $i <= $total_page; $i++) {
									if ($i == 1) {
										$list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=comment&page='.$i.'">'.$i.'</a></li>';
									}
									for ($i = 2; $i <= $total_page; $i++) {
										$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=comment&page='.$i.'">'.$i.'</a></li>';
									}
								}
							} else {
								for ($i = 1; $i <= $total_page; $i++) {
									if ($i == $_GET['page']) {
										$list_page .= '<li class="active"><a class="page-link" href="index.php?page_layout=comment&page='.$i.'">'.$i.'</a></li>';
									}
									if ($i != $_GET['page']) {
										$list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=comment&page='.$i.'">'.$i.'</a></li>';
									}
								}
							}
							//page next
							$next_page=$page+1;
							if($next_page>$total_page){
								$next_page=$total_page;
							}
							$list_page.='<li class="page-item"><a class="page-link" href="index.php?page_layout=comment&page='.$next_page.'">&raquo;</a></li>';
							$query = mysqli_query($conn, "SELECT * FROM 
							binhluan_sp a join sanpham_sp b on a.id_sp_bl = b.id_sp
							join dangky_sp c on a.id_kh_bl=c.id_dangky LIMIT $per_page,$row_per_page");
							while ($row=mysqli_fetch_array($query)) { ?>
								<tr>
									<td style=""><?php echo $row['id_bl'];?></td>
									<td style=""><?php echo $row['ten_kh'];?></td>
									<td style=""><?php echo $row['noidung_bl'];?></td>
									<td><?php echo $row['ten_admin_bl']?></td>
									<td><?php echo $row['noidung_traloi'] ?></td>
									<td><?php echo $row['ngay_bl'] ?></td>
									<td class="form-group">
										<a style="padding: 10px;"href="index.php?page_layout=edit_comment&id=<?php echo $row['id_bl']?>"class="btn btn-danger">
											<i class="fa-regular fa-comment"></i>
										</a>
										<a style="padding: 10px" href="del_comment.php?id=<?php echo $row['id_bl'];?>" onclick="return confirm('Bạn thực sự muốn xóa')" class="btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
									</td>
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