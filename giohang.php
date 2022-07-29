<?php 
	include("connect.php");
	session_start();
	if (isset($_SESSION['ten_kh'])) {
		// echo $_SESSION['ten_kh'];
		// echo $_SESSION['id_khachhang'];
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="assets/img/minion-1297944_1920 (1).jpg">
	<!-- google font -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet">
	<!-- fontawesome -->
	<link rel="stylesheet" href="assets/css/all.min.css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
	<!-- owl carousel -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">
	<!-- magnific popup -->
	<link rel="stylesheet" href="assets/css/magnific-popup.css">
	<!-- animate css -->
	<link rel="stylesheet" href="assets/css/animate.css">
	<!-- mean menu css -->
	<link rel="stylesheet" href="assets/css/meanmenu.min.css">
	<!-- main style -->
	<link rel="stylesheet" href="assets/css/main.css">
	<!-- responsive -->
	<link rel="stylesheet" href="assets/css/responsive.css">
	<link rel="stylesheet" href="assets/css/giaodien.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

	<!--nguồn animation https://michalsnik.github.io/aos/ -->
	<!-- tạo animation cho web dùng aos animation -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<!-- js--aos animation -->
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<title>Giỏ hàng</title>
</head>
<body>
	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->
	<!-- header -->
	<div class="top-header-area" id="sticker">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 text-center">
					<div class="main-menu-wrap">
						<!-- logo -->
						<div class="site-logo">
							<a href="index.php">
								<img style="width: 80px;border-radius: 50px;" src="assets/img/snack house.png" alt="">
							</a>
						</div>
						<!-- logo -->

						<!-- menu start -->
						<nav class="main-menu">
							<ul>
								<li class="current-list-item"><a href="index.php">Trang chủ</a></li>
								<li><a href="gioithieu.php">Giới thiệu</a></li>
								<li><a href="#">Sản phẩm</a>
									<ul class="sub-menu">
										<?php 
										$query_dm = mysqli_query($conn,"SELECT * FROM danhmuc_sanpham");
										while($row_dm = mysqli_fetch_array($query_dm)){
										 ?>
										<li><a href="sanpham.php?id_dm=<?php echo $row_dm['id_danhmuc'] ?>"><?php echo $row_dm['tendanhmuc'] ?></a></li>
										<?php } ?>
										
									</ul>
								</li>
								<li><a href="tintuc.php">Tin tức</a></li>
								<li><a href="lienhe.php">Liên hệ</a></li>
								<li><a href="giohang.php">Giỏ hàng</a></li>
								<?php 
									if (isset($_SESSION['ten_kh'])) {
								?>
								<li><a href="lichsudonhangnguoidung.php">Lịch sử đơn hàng</a></li>
								<?php } ?>
								<li>
									<div class="header-icons">
										<?php 
											if (isset($_SESSION['ten_kh'])) {
										?>
											<a href="doimatkhau.php"data-toggle="tooltip" title="Đổi thông tin"><i class="fa-solid fa-circle-info" ></i></a>
											<a href="dangxuatnguoidung.php"data-toggle="tooltip" title="Đăng xuất"><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
										<?php }else{ ?>
											<a href="dangky.php"data-toggle="tooltip" title="Đăng nhập"><i class="fa-solid fa-user"></i></a>
										<?php } ?>

										<?php 
											if (isset($_SESSION['cart'])) {
												$tongtien = 0;
												$tongsanpham = 0;
											foreach($_SESSION['cart'] as $cart_item){	
											$thanhtien = $cart_item['soluong'] * $cart_item['gia_sp'];
											$tongsanpham = $tongsanpham + $cart_item['soluong'];
											$tongtien = $tongtien + $thanhtien;
										 ?>
										<?php } ?>
										<a class="shopping-cart" href="giohang.php">
											<i class="fas fa-shopping-cart"></i>
											<?php echo $tongsanpham ?>
										</a>
										<?php }else{ ?>
							
										<?php } ?>
										<a class="mobile-hide search-bar-icon" href="#"><i class="fas fa-search"></i></a>
									</div>
								</li>
							</ul>
						</nav>
						<a class="mobile-show search-bar-icon" href="#"><i class="fas fa-search"></i></a>
						<div class="mobile-menu"></div>
						<!-- menu end -->
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- end header -->

	<!-- search area -->
	<div class="search-area">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<span class="close-btn"><i class="fas fa-window-close"></i></span>
					<div class="search-bar">
						<div class="search-bar-tablecell">
							<h3>Tìm kiếm:</h3>
							<form action="timkiem.php" method="post">
								<input type="text" name="tukhoa" placeholder="Nhập kí tự">
								<button type="submit" name="timkiem">Tìm kiếm<i class="fas fa-search"></i></button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<section class="image">
		<div class="image-content" data-aos="fade-up" data-aos-duration="1500">
			<h2>Snack-House</h2>
			<p>Cửa hàng đồ ăn vặt uy tín</p>
			<button class="btn" style="margin-top: 10px;">Menu</button>
		</div>
	</section>
	<!-- end breadcrumb section -->
		<section class="cart">
			<div class="container ">
				<form action="" method="post">
					<div class="cart-top-wrap">
						<div class="cart-top">
							<div class="cart-top-cart cart-top-item">
								<i class="fa-solid fa-cart-shopping"></i>
							</div>
							<div class="cart-top-adress cart-top-item">
								<i class="fa-solid fa-location-dot"></i>
							</div>
							<div class="cart-top-belevery cart-top-item">
								<i class="fa-solid fa-money-check-dollar"></i>
							</div>
						</div>
				</div>
			</div>
		<div class="container">
			<div class="cart-content row">
				<div class="cart-content-left">
					<table>
						<tr>
							<th>Mã Sản phẩm</th>
							<th>Sản phẩm</th>
							<th>Tên sản phẩm</th>
							<th>Giá sản phẩm</th>
							<th>Số lượng</th>
							<th>Thành tiền</th>
							<th>Chức năng</th>
						</tr>
						<?php 
							if (isset($_SESSION['cart'])) {
							$i=0;	
							foreach($_SESSION['cart'] as $cart_item){
							$i++;
							$thanhtien = $cart_item['soluong'] * $cart_item['gia_sp']; 
						 ?>
						<tr>
							<td><?php echo $cart_item['ma_sp'] ?></td>
							<td><img src="admin/anh/<?php echo $cart_item['hinhanh_sp'];?>" alt=""></td>
							<td><p><?php echo $cart_item['ten_sp'];?></p></td>
							<td><p><?php echo number_format($cart_item['gia_sp'],0,'.','.').'VNĐ';?></p></td>
							<td>
								<p>
									<a href="themgiohang.php?tru=<?php echo $cart_item['id_sp'] ?>"><i class="fa-solid fa-circle-minus"></i></a>
										<?php echo $cart_item['soluong'] ?>
									<a href="themgiohang.php?cong=<?php echo $cart_item['id_sp'] ?>"><i class="fa-solid fa-circle-plus"></i></a>
								</p>
							</td>
							<td><p><?php echo number_format($thanhtien,0,'.','.').'VNĐ' ?></p></td>
							<td><p><a href="themgiohang.php?xoa=<?php echo $cart_item['id_sp'] ?>">X</a></p></td>
						</tr>
						<?php } }else{ ?>
								<tr>
									<td colspan="7">
										<p style="font-size: 16px;color: red;">
											<i class="fas fa-shopping-cart"></i> Hiện tại giỏ hàng trống!!!!!!
										</p>
									</td>
								</tr>
						<?php } ?>
					</table>
				</div>
				<div class="cart-content-right">
				<form action="">
						<table>
							
							<tr>
								<th colspan="2">TỔNG TIỀN GIỎ HÀNG</th>
							</tr>
							<?php 
								if (isset($_SESSION['cart'])) {
								$tongtien = 0;
								$tongsanpham = 0;
								foreach($_SESSION['cart'] as $cart_item){	
								$thanhtien = $cart_item['soluong'] * $cart_item['gia_sp'];
								$tongsanpham = $tongsanpham + $cart_item['soluong'];
								$tongtien = $tongtien + $thanhtien;
							 ?>
							<?php } ?>
							<tr>
								<td>Tổng sản phẩm: </td>
								<td><span><?php echo $tongsanpham ?></span></td>
							</tr>
							<tr>
								<td>Tổng tiền hàng:</td>
								<td><?php echo number_format($tongtien,0,'.','.') ?><sup>đ</sup></td>
							</tr>
							<tr>
								<td><p><a style="
								color: black;
								font-size: 14px;
								text-decoration: none;
								font-family: times;
								" href="themgiohang.php?xoatatca=1">
								<i class="fa-solid fa-trash-can"></i> Xóa tất cả giỏ hàng</a></p></td>			
							</tr>
							 <?php }else{ ?>
							
							<?php } ?>
						</table>
						<div class="cart-content-right-button">
								<button>
									<a href="">Tiếp tục mua sắm</a>
								</button>
								<?php if (isset($_SESSION['ten_kh'])){ ?>
								<button>
									<a href="chuyenhang.php">Hình thức thanh toán</a>
								</button>
								<?php }else{ ?>
									<button>
									<a href="dangky.php">Đăng ký đặt hàng</a>
								</button>
								<?php } ?>
						</div>
				</form>
				</div>
				
			</div>				
		</div>																					
	</section>
	<!-- ---------------------------------chân trang-------------------------------------------------- -->
	<section class="footer">
		<div class="footer-bg"></div>
		<div class="container">
			<div class="row justify-content">
				<div class="footer-item">
					<h2>Địa chỉ</h2>
					<p><i class="fa-solid fa-location-dot"></i>Kiến hưng,Hà đông,Hà nội</p>
				</div>
				<div class="footer-item">
					<h2>Giờ mở cửa</h2>
					<p><i class="fa-solid fa-clock"></i>8:30 - 22:00 <br> Tất cả các ngày</p>
				</div>
				<div class="footer-item">
					<h2>Hình thức thanh toán</h2>
					<p><i class="fa-solid fa-money-check-dollar"></i>Chuyển khoản</p>
					<p><i class="fa-solid fa-money-check-dollar"></i>Ví VNPAY</p>
					<p><i class="fa-solid fa-money-check-dollar"></i>Ví MOMO</p>
					<p><i class="fa-solid fa-money-bill"></i>Thanh toán khi nhận hàng</p>
				</div>
				<div class="footer-item">
					<h2>Liên hệ</h2>
					<p><i class="fa-solid fa-mobile-button"></i>035xxx8870</p>
					<p><i class="fa-solid fa-envelope"></i>domanh011020@gmail.com</p>
					<div class="footer-social">
						<i class="fa-brands fa-facebook"></i>
						<i class="fa-brands fa-instagram"></i>
						<i class="fa-brands fa-tiktok"></i>
						<i class="fa-brands fa-youtube"></i>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="footer-copyright">
			© Copyright 2022.toàn bộ bản quyền thuộc về Snack-House
			</div>
		</div> 
	</section>
	<script>AOS.init();</script>
	<script>
	$(document).ready(function(){
	 $('[data-toggle="tooltip"]').tooltip();   
		});
	</script>

	<script type="text/javascript" src="assets/js/script.js"></script>
	<!-- jquery -->
	<script src="assets/js/jquery-1.11.3.min.js"></script>
	<!-- bootstrap -->
	<script src="assets/bootstrap/js/bootstrap.min.js"></script>
	<!-- count down -->
	<script src="assets/js/jquery.countdown.js"></script>
	<!-- isotope -->
	<script src="assets/js/jquery.isotope-3.0.6.min.js"></script>
	<!-- waypoints -->
	<script src="assets/js/waypoints.js"></script>
	<!-- owl carousel -->
	<script src="assets/js/owl.carousel.min.js"></script>
	<!-- magnific popup -->
	<script src="assets/js/jquery.magnific-popup.min.js"></script>
	<!-- mean menu -->
	<script src="assets/js/jquery.meanmenu.min.js"></script>
	<!-- sticker js -->
	<script src="assets/js/sticker.js"></script>
	<!-- main js -->
	<script src="assets/js/main.js"></script>
</body>
</html>