<?php 
	session_start();
	include("connect.php");
	require('gmail/sendmail.php');
	require('Carbon/autoload.php');
	require('config_vnpay.php');

	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	$now = Carbon::now('Asia/Ho_Chi_Minh');
	$id_khachhang = $_SESSION['id_khachhang'];
	$ma_dathang = rand(0,9999);
	$hinhthucthanhtoan = $_POST['payment'];

	$tongtien=0;
	foreach($_SESSION['cart'] AS $key => $value){
			$thanhtien = $value['soluong']*$value['gia_sp'];
			$tongtien = $tongtien + $thanhtien;	
		}




	// thanh toan bằng tiền mặt và chuyển khoản
	if ($hinhthucthanhtoan =='tienmat'||$hinhthucthanhtoan=='chuyenkhoan') {
		
	$insert_cart = mysqli_query($conn,"INSERT INTO giohang_sp(id_khachhang,magiohang,trangthai_giohang,ngaydathang,hinhthucthanhtoan) 
		VALUES('$id_khachhang','$ma_dathang',1,'$now','$hinhthucthanhtoan')
	 	");
		// thêm giỏ hàng chi tiết
					foreach($_SESSION['cart'] AS $key => $value){
					$id_sanpham = $value['id_sp'];
					$soluong = $value['soluong'];
					$insert_chitietdonhang=mysqli_query($conn,"INSERT INTO chitietdonhang_sp(magiohang,id_sanpham,soluong) 
					VALUES('$ma_dathang','$id_sanpham','$soluong')"
					);
					}
		if ($insert_cart) {
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
				
				unset($_SESSION['cart']);
		header('location:camon.php');
		}else{
			header('location:giohang.php');
		}		
	}elseif($hinhthucthanhtoan =='vnpay'){
		// echo'thanh toan bang vnpay';
		//Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
		$vnp_TxnRef = $ma_dathang; 
		// nội dung 
		$vnp_OrderInfo = 'Thanh toán đơn hàng đặt tại web'; 
		// (billpayment thanh toán hóa đơn) mã hóa loại hàng hóa
		$vnp_OrderType = 'billpayment';
		// tổng tiền
		$vnp_Amount = $tongtien*100;
		// ngôn ngữ
		$vnp_Locale = 'vn';
		// $vnp_BankCode = $_POST['bank_code'];
		// chọn ngân hàng,ở đây cho test bằng ncb nên fix cứng là ncb
		$vnp_BankCode = 'NCB';
		// địa chỉ ip
		$vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
		// thời gian chờ
		$vnp_ExpireDate = $expire;

		$inputData = array(
		    "vnp_Version" => "2.1.0",
		    "vnp_TmnCode" => $vnp_TmnCode,
		    "vnp_Amount" => $vnp_Amount,
		    "vnp_Command" => "pay",
		    "vnp_CreateDate" => date('YmdHis'),
		    "vnp_CurrCode" => "VND",
		    "vnp_IpAddr" => $vnp_IpAddr,
		    "vnp_Locale" => $vnp_Locale,
		    "vnp_OrderInfo" => $vnp_OrderInfo,
		    "vnp_OrderType" => $vnp_OrderType,
		    "vnp_ReturnUrl" => $vnp_Returnurl,
		    "vnp_TxnRef" => $vnp_TxnRef,
		    "vnp_ExpireDate"=>$vnp_ExpireDate
		);

		if (isset($vnp_BankCode) && $vnp_BankCode != "") {
		    $inputData['vnp_BankCode'] = $vnp_BankCode;
		}
		// if (isset($vnp_Bill_State) && $vnp_Bill_State != "") {
		//     $inputData['vnp_Bill_State'] = $vnp_Bill_State;
		// }

		//var_dump($inputData);
		ksort($inputData);
		$query = "";
		$i = 0;
		$hashdata = "";
		foreach ($inputData as $key => $value) {
		    if ($i == 1) {
		        $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
		    } else {
		        $hashdata .= urlencode($key) . "=" . urlencode($value);
		        $i = 1;
		    }
		    $query .= urlencode($key) . "=" . urlencode($value) . '&';
		}

		$vnp_Url = $vnp_Url . "?" . $query;
		if (isset($vnp_HashSecret)) {
		    $vnpSecureHash =   hash_hmac('sha512', $hashdata, $vnp_HashSecret);//  
		    $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
		}
		$returnData = array('code' => '00'
		    , 'message' => 'success'
		    , 'data' => $vnp_Url);
		    if (isset($_POST['redirect'])) {
		    	$_SESSION['magiohang'] = $ma_dathang;
		    	$insert_cart = mysqli_query($conn,"INSERT INTO giohang_sp(id_khachhang,magiohang,trangthai_giohang,ngaydathang,hinhthucthanhtoan) 
					VALUES('$id_khachhang','$ma_dathang',1,'$now','$hinhthucthanhtoan')
				 	");
					// thêm giỏ hàng chi tiết
								foreach($_SESSION['cart'] AS $key => $value){
								$id_sanpham = $value['id_sp'];
								$soluong = $value['soluong'];
								$insert_chitietdonhang=mysqli_query($conn,"INSERT INTO chitietdonhang_sp(magiohang,id_sanpham,soluong) 
								VALUES('$ma_dathang','$id_sanpham','$soluong')"
								);
					}
		        header('Location: ' . $vnp_Url);
		        die();
		    } else {
		        echo json_encode($returnData);
		    }
			// vui lòng tham khảo thêm tại code demo

	}

 ?>
