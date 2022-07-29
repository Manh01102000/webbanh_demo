<?php
if (!defined('hang')) {
	die('ban truy cap sai cach');
}
$sql="SELECT * FROM ";

require('../Carbon/autoload.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;
// printf("Now: %s",Carbon::now('Asia/Ho_Chi_Minh'));
// printf("1 day: %s", CarbonInterval::day()->forHumans());
?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
	<link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
	<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
	<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
	<div class="row">
		<ol class="breadcrumb">
			<li><a href="#"><svg class="glyph stroked home">
						<use xlink:href="#stroked-home"></use>
					</svg></a></li>
			<li class="active">Trang chủ quản trị</li>
		</ol>
	</div>
	<!--/.row-->

	<div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">Trang chủ quản trị</h1>
		</div>
	</div>
	<!--/.row-->
	<div class="row">
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-blue panel-widget ">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked bag">
							<use xlink:href="#stroked-bag"></use>
						</svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large"><?php echo mysqli_num_rows(mysqli_query($conn, $sql."sanpham_sp"))?></div>
						<div class="text-muted">Sản Phẩm</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-orange panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked empty-message">
							<use xlink:href="#stroked-empty-message"></use>
						</svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large"><?php echo mysqli_num_rows(mysqli_query($conn, $sql."binhluan_sp"))?></div>
						<div class="text-muted">Bình Luận</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-teal panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked male-user">
							<use xlink:href="#stroked-male-user"></use>
						</svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large"><?php echo mysqli_num_rows(mysqli_query($conn, $sql."user"))?></div>
						<div class="text-muted">Thành Viên</div>
					</div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-md-6 col-lg-3">
			<div class="panel panel-red panel-widget">
				<div class="row no-padding">
					<div class="col-sm-3 col-lg-5 widget-left">
						<svg class="glyph stroked app-window-with-content">
							<use xlink:href="#stroked-app-window-with-content"></use>
						</svg>
					</div>
					<div class="col-sm-9 col-lg-7 widget-right">
						<div class="large"><?php echo mysqli_num_rows(mysqli_query($conn, $sql."baiviet_sp"))?></div>
						<div class="text-muted">Bài viết</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Quản lý thống kê</h1>
			</div>
		</div>
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-body">
					<style>
						.thongke{
							width: 100%;
							display: flex;
							flex-wrap: wrap;
						}
						.thongketheonam{
							width: 30%;
						}
						.thongketungay p{
							font-family: times;
							font-size: 16px;
						}
						.thongkedenngay{
							margin-left: 20px;
						}
						.thongkedenngay p{
							font-family: times;
							font-size: 16px;
						}
					</style>
					<form autocomplete="off">
								<div class="thongke">
									<div class="thongketheonam">
										<p>Thống kê đơn hàng theo: <Span id="text-date"></Span></p>
										<p>
											<select name="" class="select-date">
												<option value="7ngayqua">7 ngày qua</option>
												<option value="28ngayqua">28 ngày qua</option>
												<option value="90ngayqua">90 ngày qua</option>
												<option value="365ngayqua">365 ngày qua</option>
											</select>
										</p>
									</div>
									<div class="thongketungay">
										<p>Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
										<input style="font-family: times;font-size: 16px;" id="locketqua" type="button" class="btn btn-primary" value="Lọc kết quả">
									</div>
									<div class="thongkedenngay">
										<p>Đến ngày: <input type="text" id="datepicker1" class="form-control"></p>
									</div>
								</div>
								<input type="reset" value="Xóa" 
								style="font-family: times;
								font-size: 16px;
								width: 100px;
								height: 35px;
								margin-left: 535px;
								margin-top: -35px;
								 " class="btn btn-primary">

					</form>
					<div id="myfirstchart" style="height: 250px;"></div>
					<!-- biểu đồ morrischart dùng element để hiển thị bđ theo id -->
					<script type="text/javascript">
						$(document).ready(function(){ 
							thongke();
						var char = new Morris.Area({
	
							element: 'myfirstchart',

							  lineColors: ['#30D5C8','#FF0000','#ADFF2F','#F4A460'],

							  xkey: 'ngaydathang',

							  ykeys: ['donhang','doanhthu','soluong'],

							  labels: ['Đơn hàng','Doanh thu','Số lượng bán ra']
							});
						$('.select-date').change(function(){
							// lấy cái giá trị của select-option bên trên đẩy vào biến thờigian
							var thoigian =$(this).val();
							if (thoigian=='7ngayqua') {
								var text = '7 ngày qua';
							}else if(thoigian=='28ngayqua'){
								var text = '28 ngày qua';
							}else if(thoigian=='90ngayqua'){
								var text = '90 ngày qua';
							}else if(thoigian=='365ngayqua'){
								var text = '365 ngày qua';
							}
							$.ajax({
								url:'xulythongke.php',
								// phương thức truyền là POST
								method:"POST",
								// dữ liệu trả về mang kiểu json
								dataType:"JSON",
								data:{thoigian:thoigian},
								success:function(data)
								{
									char.setData(data);
									$('#text-date').text(text);
								}
							});
						});
						function thongke(){
							var text ='365 ngày qua';
							// $('#text-date').text(text);
							$.ajax({
								url:'xulythongke.php',
								// phương thức truyền là POST
								method:"POST",
								// dữ liệu trả về mang kiểu json
								dataType:"JSON",
								success:function(data)
								{
									char.setData(data);
									$('#text-date').text(text);
								}
							});
						}
						$('#locketqua').click(function(){
							var _token = $('input[name="_token"]').val();
							var from_date = $('#datepicker').val();
							var to_date =$('#datepicker1').val();
							// test lấy giá trị
							// alert(from_date);
							// alert(to_date);
							$.ajax({
								url:'thongke.php',
								// phương thức truyền là POST
								method:"POST",
								// dữ liệu trả về mang kiểu json
								dataType:"JSON",
								data:{from_date:from_date,to_date:to_date,_token:_token},

								success:function(data)
								{
									char.setData(data);
									// $('#text-date').text(text);
								}
							});

						});

					});
					</script>
					<script type="text/javascript">
							$( function() {
								$( "#datepicker" ).datepicker({
								prevText:"Tháng trước",
								nextText:"Tháng sau",
								dateFormat:"yy-mm-dd",
								dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
								duration:"Slow"
								});
								$( "#datepicker1" ).datepicker({
								prevText:"Tháng trước",
								nextText:"Tháng sau",
								dateFormat:"yy-mm-dd",
								dayNamesMin:["Thứ 2","Thứ 3","Thứ 4","Thứ 5","Thứ 6","Thứ 7","Chủ nhật"],
								duration:"Slow"
								});
							} );
					</script>
					
				</div>
			</div>
		</div>
	</div>
	<!--/.row-->

</div>
<!--/.main-->
<script src="js/bootstrap.min.js"></script>