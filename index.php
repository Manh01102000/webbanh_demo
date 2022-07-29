<?php 
	include("connect.php");
	session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="assets/css/giaodien.css">
	<!--nguồn animation https://michalsnik.github.io/aos/ -->
	<!-- tạo animation cho web dùng aos animation -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<!-- js--aos animation -->
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
	<link rel="stylesheet" href="assets/css/res.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
	<link rel="shortcut icon" type="image/png" href="assets/img/minion-1297944_1920 (1).jpg">
	<title>Trang chủ</title>
</head>
<body>
	<!-- ----------------------------section-top------------------------------------ -->
	<section class="top">
		<div class="container">
			<div class="row justify-content">
				<div class="logo">
					<img src="assets/img/snack house.png" alt="">
				</div>
				<div class="menu-bar">
					<ul>
						<li>
							<a href="index.php">Trang chủ</a>
						</li>
						<li>
							<a href="">Sản phẩm</a>
								<div class="menu-bar-item">
									<ul>
										<?php 
										$query_dm = mysqli_query($conn,"SELECT * FROM danhmuc_sanpham");
										while($row_dm = mysqli_fetch_array($query_dm)){
										 ?>
										<li><a href="sanpham.php?id_dm=<?php echo $row_dm['id_danhmuc'] ?>"><?php echo $row_dm['tendanhmuc'] ?></a></li>
										<?php } ?>
										
									</ul>
								</div>
						</li>
						<li>
							<a href="gioithieu.php">Giới thiệu</a>
						</li>
						<li>
							<a href="tintuc.php">Tin tức</a>
						</li>
						<li>
							<a href="lienhe.php">Liên hệ</a>
						</li>
						<li>
							<a href="giohang.php">Giỏ hàng</a>
						</li>
						<?php if (isset($_SESSION['ten_kh'])){ ?>
						<li>
							<a href="lichsudonhangnguoidung.php">Lịch sử đơn hàng</a>
						</li>
						<?php 
							if (isset($_SESSION['email_kh'])){
								$email_kh = $_SESSION['email_kh'];
							}
							$query_kh = mysqli_query($conn,"SELECT * FROM dangky_sp WHERE email_kh = '$email_kh'");
							$row_kh = mysqli_fetch_array($query_kh); 
						 ?>
											
						<li>
							<a href="doimatkhau.php?id_kh=<?php echo $row_kh['id_dangky'] ?>"data-toggle="tooltip" title="Đổi thông tin"><i class="fa-solid fa-circle-info" ></i></a>
						</li>
						<li>
							<a href="dangxuatnguoidung.php"data-toggle="tooltip" title="Đăng xuất"><i class="fa-solid fa-arrow-right-to-bracket"></i></a>
						</li>
						<?php } else { ?>
							<li>
								<a href="dangky.php">Đăng nhập</a>
							</li>					
						<?php } ?>
						
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!-- ----------------------------kết thúc section-top------------------------------------------- -->
	<section class="image">
		<div class="image-content" data-aos="fade-up" data-aos-duration="1500">
			<h2>Snack-House</h2>
			<p>Cửa hàng đồ ăn vặt uy tín</p>
			<button class="btn" style="margin-top: 10px;">Menu</button>
		</div>
	</section>
	<!-- ------------------------------------------kết thúc section image------------------------- -->
		
	<!-- -----------------------section giới thiệu------------------------------- -->
	<section class="about section-padding">
		<div class="container">
			<div class="row">
				<div class="section-title" data-aos="fade-up" data-aos-duration="1500">
					<h2 data-title="Câu chuyện">Về chúng tôi</h2>
				</div>
			</div>
			<div class="row">
					<div class="about-item" data-aos="fade-right" data-aos-duration="1500">
						<h2>Chào mừng đến với Snack-House</h2>
						<p>Snack-House là một trang web bán đồ ăn nhanh. Snack-House chuyên cung cấp đồ ăn nhanh và giới thiệu với mọi người về các sản phẩm ăn nhanh. Đó là những mặt hàng như bánh mì, trà sữa, sữa chua,....mà doanh nghiệp đang cung cấp ra thị trường.</p>
						<button class="btn" style="margin-top: 10px;">
							Giới thiệu
						</button>
					</div>
					<div class="about-item" data-aos="fade-left" data-aos-duration="1500">
						<div class="about-item-img">
							<span> Hơn 1 năm kinh nghiệm</span>
							<img src="assets/img/minion-1297944_1920 (1).jpg" alt="">
						</div>
					</div>
			</div>
		</div>
	</section>
	<!-- --------------------------kết thúc section-about-------------------------------- -->
	<!-- --------------------------catagory-------------------------------- -->
	<section class="catagory section-padding">
		<div class="container">
			<div class="row ">
				<div class="section-title" data-aos="fade-up" data-aos-duration="1500">
					<h2 data-title="Danh mục">Sản phẩm</h2>
				</div>
			</div>
			<div class="row">
				<?php 
					$query_dm = mysqli_query($conn,"SELECT * FROM danhmuc_sanpham");
					while($row_dm = mysqli_fetch_array($query_dm)){
				 ?>
					<div class="catagory-item">
						<a href="sanpham.php?id_dm=<?php echo $row_dm['id_danhmuc'] ?>"><img src="admin/anh/<?php echo $row_dm['hinhanh_dm'] ?>" alt=""></a>
						<div class="catagory-item-text">
							<a href="sanpham.php?id_dm=<?php echo $row_dm['id_danhmuc'] ?>"><span><?php echo $row_dm['tendanhmuc'] ?></span></a>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>
	<!-- ----------------------------sản phẩm bán chạy---------------------------------- -->
	<section class="topsanpham">
		<div class="container">
			<div class="row">
				<div class="section-title" data-aos="fade-up" data-aos-duration="1500">
					<h2 data-title="Sản phẩm">Bán chạy</h2>
				</div>
			</div>
			
				<div class="row">
					<?php 
					// đưa ra sản phẩm có số lượng bán ra nhiều nhất và dùng distinct không bị trùng lặp sản phẩm
					// SELECT DISTINCT id_sp,tendanhmuc,ten_sp,gia_sp,soluong,hinhanh_sp FROM sanpham_sp,chitietdonhang_sp,danhmuc_sanpham WHERE sanpham_sp.id_sp=chitietdonhang_sp.id_sanpham AND chitietdonhang_sp.soluong=(SELECT DISTINCT MAX(soluong) FROM chitietdonhang_sp) AND sanpham_sp.id_danhmuc=danhmuc_sanpham.id_danhmuc LIMIT 5

					$sql_spbc = mysqli_query($conn,"SELECT DISTINCT id_sp,tendanhmuc,ten_sp,gia_sp,soluong,hinhanh_sp,ma_sp FROM sanpham_sp,chitietdonhang_sp,danhmuc_sanpham WHERE sanpham_sp.id_sp=chitietdonhang_sp.id_sanpham AND chitietdonhang_sp.soluong=(SELECT DISTINCT MAX(soluong) FROM chitietdonhang_sp) AND sanpham_sp.id_danhmuc=danhmuc_sanpham.id_danhmuc LIMIT 5");
					while($row_spbc=mysqli_fetch_array($sql_spbc)){
		 			?>
					<div class="topsanpham-item">
						<a href="chitietsanpham.php?id_sp=<?php echo $row_spbc['id_sp'] ?>"><img src="admin/anh/<?php echo $row_spbc['hinhanh_sp'] ?>" alt=""></a>
						<form action="themgiohang.php?id_sp=<?php echo $row_spbc['id_sp']?>" method="post">
							<div class="topsanpham-items">
								<p>Mã sản phẩm: <?php echo $row_spbc['ma_sp'] ?></p>
								<p>Tên sản phẩm: <?php echo $row_spbc['ten_sp'] ?></p>
								<p>Giá sản phẩm:<?php echo number_format($row_spbc['gia_sp'],0,'.','.') ?><sup>đ</sup></p>
								<p>Danh mục sản phẩm: <?php echo $row_spbc['tendanhmuc'] ?></p><br>
								<button name="themsanphamindex">
								Thêm giỏ hàng
								</button>
							</div>
						</form>
					</div>
					<?php } ?>
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
	

	<script type="text/javascript" src="assets/js/script.js"></script>
	<script>AOS.init();</script>
</body>
</html>