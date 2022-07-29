<?php 
require('../Carbon/autoload.php');
use Carbon\Carbon;
use Carbon\CarbonInterval;
$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
include_once('connect.php');

	if (isset($_GET['trangthai_giohang'])&&isset($_GET['magiohang'])) {
		$trangthai_giohang = $_GET['trangthai_giohang'];
		$magiohang = $_GET['magiohang'];

		$upadte_giohang =mysqli_query($conn,
			"UPDATE giohang_sp SET trangthai_giohang='$trangthai_giohang' WHERE  magiohang='$magiohang'");

		// thống kê doanh thu
		$sql_lietke_donhang = "SELECT * FROM chitietdonhang_sp,sanpham_sp WHERE chitietdonhang_sp.id_sanpham = sanpham_sp.id_sp AND chitietdonhang_sp.magiohang='$magiohang'  ORDER BY chitietdonhang_sp.id_chitietdonhang DESC";
		$query_lietke_donhang = mysqli_query($conn,$sql_lietke_donhang);
		// 
		$sql_thongke = "SELECT * FROM thongke_sp WHERE ngaydathang='$now'";
		$query_thongke =mysqli_query($conn,$sql_thongke);
		// tổng số lượng mua(số lượng bán ra) và doanh thu
		$soluongmua = 0;
		$doanhthu = 0;

		while($row_lk_dh = mysqli_fetch_array($query_lietke_donhang)){
			$soluongmua = $soluongmua+$row_lk_dh['soluong'];
			$doanhthu = $doanhthu+$row_lk_dh['gia_sp'];
		}
		if (mysqli_num_rows($query_thongke)==0) {
			$soluongban = $soluongmua;
			$doanhthu =$doanhthu;
			$donhang=1;
			$sql_insert_thongke = mysqli_query($conn,
				"INSERT INTO thongke_sp(ngaydathang,donhang,doanhthu,soluong) VALUES('$now','$donhang','$doanhthu','$soluongban')");
		}elseif (mysqli_num_rows($query_thongke)!=0) {
			while($row_tk=mysqli_fetch_array($query_thongke)){
				$soluongban = $soluongban + $row_tk['soluong'];
				$doanhthu = $doanhthu + $row_tk['doanhthu'];
				$donhang = $row_tk['donhang']+1;
				$sql_update_thongke	= mysqli_query($conn,
					"UPDATE thongke_sp SET  donhang = '$donhang',
											doanhthu = '$doanhthu',
											soluong = '$soluongban'
											WHERE ngaydathang = '$now';
					 "
				);		
			}
		}




		header('location:index.php?page_layout=quanlydonhang');	
	}

 ?>