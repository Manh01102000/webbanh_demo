
<?php
include("connect.php");
if (isset($_SESSION['tenadmin'])) {
	$tenadmin = $_SESSION['tenadmin'];
}
require('../Carbon/autoload.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;

if(isset($_POST['from_date'])){
		$from_date = $_POST['from_date'];
	}
	if(isset($_POST['to_date'])){
		$to_date = $_POST['to_date'];
	}
	if(isset($_POST['_token'])){
		$_token = $_POST['_token'];
	}

	$sql_thongke = "SELECT * FROM thongke_sp WHERE ngaydathang BETWEEN '$from_date' AND '$to_date' ORDER BY ngaydathang ASC ";
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
