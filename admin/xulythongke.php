<?php 
	include_once("connect.php");
	require('../Carbon/autoload.php');
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	
	// subdays(365) sẽ lấy ngày hiện tại - 365 ngày trước
	if(isset($_POST['thoigian'])){
		$thoigian = $_POST['thoigian'];
	}else{
		// nếu biến thời gian mà bằng rỗng thì mặc định chạy thống kê 365 ngày;
		$thoigian = "";
		$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
	}
	if ($thoigian=='7ngayqua') {
		$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->toDateString();
	}
	if ($thoigian=='28ngayqua') {
		$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(28)->toDateString();
	}
	if ($thoigian=='90ngayqua') {
		$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(90)->toDateString();
	}
	if ($thoigian=='365ngayqua') {
		$subdays = Carbon::now('Asia/Ho_Chi_Minh')->subdays(365)->toDateString();
	}

	
	$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

	$sql_thongke = "SELECT * FROM thongke_sp WHERE ngaydathang BETWEEN '$subdays' AND '$now' ORDER BY ngaydathang ASC ";
	$query_thongke =mysqli_query($conn,$sql_thongke);

	while($row_thongke = mysqli_fetch_array($query_thongke)){
		$chart_data[] = array(
			'ngaydathang'=>$row_thongke['ngaydathang'],
			'donhang'=>$row_thongke['donhang'],
			'doanhthu'=>$row_thongke['doanhthu'],
			'soluong'=>$row_thongke['soluong']
		);
	}
	// 
	// print_r($chart_data);
	echo $data = json_encode($chart_data);
 ?>