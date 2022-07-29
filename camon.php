<?php 
	session_start();
	include("connect.php");
	require('gmail/sendmail.php');
	require('config_vnpay.php');
	require('Carbon/autoload.php');
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	$now = Carbon::now('Asia/Ho_Chi_Minh');
	// merchan
	// https://sandbox.vnpayment.vn/merchantv2/
	// taikhoan
	// Ngân hàng		NCB
	// Số thẻ			9704198526191432198
	// Tên chủ thẻ		NGUYEN VAN A
	// Ngày phát hành	07/15
	// Mật khẩu OTP		123456
	if (isset($_GET['vnp_Amount'])) {
		$vnp_Amount = $_GET['vnp_Amount'];
		$vnp_BankCode = $_GET['vnp_BankCode'];
		$vnp_BankTranNo = $_GET['vnp_BankTranNo'];
		$vnp_CardType = $_GET['vnp_CardType'];
		$vnp_OrderInfo = $_GET['vnp_OrderInfo'];
		$vnp_PayDate = $_GET['vnp_PayDate'];
		$vnp_TmnCode = $_GET['vnp_TmnCode'];
		$vnp_TransactionNo = $_GET['vnp_TransactionNo'];
		$magiohang = $_SESSION['magiohang'];

		// insert vào vnpay_sp
		$insert_vnpay ="INSERT INTO vnpay_sp(vnp_amount,vnp_bankcode,vnp_banktranno,vnp_cardtype,vnp_orderInfo,vnp_paydate,vnp_tmncode,vnp_transactionno,magiohang) 
			VALUES('$vnp_Amount','$vnp_BankCode','$vnp_BankTranNo','$vnp_CardType','$vnp_OrderInfo','$vnp_PayDate','$vnp_TmnCode','$vnp_TransactionNo','$magiohang')
			";
		$cart_query=mysqli_query($conn,$insert_vnpay);
		if ($cart_query) {
			echo'<script>alert("Thanh toán VNPAY thành công"),location="lichsudonhangnguoidung.php"</script>';
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
		}else{
			echo'<script>alert("Thanh toán VNPAY thất bại"),location="giohang.php"</script>';
		}
	}elseif (isset($_GET['partnerCode'])) {

// No	Tên	Số thẻ	  Hạn ghi trên thẻ	        OTP	  Trường hợp test      hạn mức 			OTP
// 1	NGUYEN VAN A	9704 0000 0000 0018 	03/07	OTP	Thành công    0919001000		OTP
		$magiohang = rand(0,9999);
		$partnerCode = $_GET['partnerCode'];
		$orderId = $_GET['orderId'];
		$amount = $_GET['amount'];
		$orderInfo = $_GET['orderInfo'];
		$orderType = $_GET['orderType'];
		$transId = $_GET['transId'];
		$payType = $_GET['payType'];
		$hinhthucthanhtoan='momo';
		// insert vào momo_sp
		$insert_momo ="INSERT INTO momo_sp(partnercode,orderid,amount,orderinfo,ordertype,transid,paytype,magiohang) 
			VALUES('$partnerCode','$orderId','$amount','$orderInfo','$orderType','$transId','$payType','$magiohang')
			";
		$cart_query=mysqli_query($conn,$insert_momo);

		if ($cart_query) {
			$id_khachhang = $_SESSION['id_khachhang'];
			$insert_cart = mysqli_query($conn,"INSERT INTO giohang_sp(id_khachhang,magiohang,trangthai_giohang,ngaydathang,hinhthucthanhtoan) 
					VALUES('$id_khachhang','$magiohang',1,'$now','$hinhthucthanhtoan')
				 	");
				foreach($_SESSION['cart'] AS $key => $value){
							$id_sanpham = $value['id_sp'];
							$soluong = $value['soluong'];
							$insert_chitietdonhang=mysqli_query($conn,"INSERT INTO chitietdonhang_sp(magiohang,id_sanpham,soluong) 
							VALUES('$magiohang','$id_sanpham','$soluong')"
							);
				}
			echo'<script>alert("Thanh toán MOMO thành công"),location="lichsudonhangnguoidung.php"</script>';
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
		}else{
			echo'<script>alert("Thanh toán MOMO thất bại"),location="giohang.php"</script>';
		}
	}

 ?>
 <?php 
 	echo'<script>alert("Thanh toán thành công!!!Cảm ơn quý khách đã mua hàng"),location="lichsudonhangnguoidung.php"</script>';
  ?>