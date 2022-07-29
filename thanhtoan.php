<?php 
	session_start();
	include("connect.php");
	require('gmail/sendmail.php');
	require('Carbon/autoload.php');
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	$now = Carbon::now('Asia/Ho_Chi_Minh');

	$id_khachhang = $_SESSION['id_khachhang'];
	$ma_dathang = rand(0,9999);
	$insert_cart = mysqli_query($conn,"INSERT INTO giohang_sp(id_khachhang,magiohang,trangthai_giohang,ngaydathang) 
		VALUES('$id_khachhang','$ma_dathang',1,'$now')
	 	");
	// thêm giỏ hàng chi tiết
	if ($insert_cart) {
					foreach($_SESSION['cart'] AS $key => $value){
					$id_sanpham = $value['id_sp'];
					$soluong = $value['soluong'];
					$insert_chitietdonhang=mysqli_query($conn,"INSERT INTO chitietdonhang_sp(magiohang,id_sanpham,soluong) 
					VALUES('$ma_dathang','$id_sanpham','$soluong')"
					);
				}
		// gọi classnew

		$tieude = "Đặt hàng website Snack-house.com thành công";
		$noidung="
		 	<p style='color:  black;font-size: 16px;font-family: times;'>Cảm ơn quý khách đã đặt hàng của chúng tôi với mã đơn hàng: '$ma_dathang'</p>
			<p style='color:  black;font-size: 16px;font-family: times;'>Chúc quý khách sử dụng sản phẩm ngon miệng!!!!</p>
		";
		$noidung.="<h4>Đơn hàng của quý khách bao gồm:";
		foreach($_SESSION['cart'] as $key => $val){
			$noidung.="
				 <ul style='border: 1px solid skyblue;margin: 10px;'>
				 	<li style='color:  black;font-size: 16px;font-family: times;'>Tên sản phẩm: ".$val['ten_sp']."</li>
				 	<li style='color:  black;font-size: 16px;font-family: times;'>Giá sản phẩm: ".number_format($val['gia_sp'],0,'.','.').'VNĐ'."</li>
				 	<li style='color:  black;font-size: 16px;font-family: times;'>Số lượng: ".$val['soluong']."</li>
				 </ul>";
		}

		$maildathang = $_SESSION['email_kh'];
		$mail = new Mailer();
		$mail->dathangmail($tieude,$noidung,$maildathang);
	}
	// unset($_SESSION['cart']);
	header('location:camon.php');

 ?>
