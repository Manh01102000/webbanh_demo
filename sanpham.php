<?php 
	include("connect.php");
	session_start();
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
	<!-- tạo animation cho web dùng aos animation -->
	<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
	<!-- js--aos animation -->
	<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

	<title>Sản phẩm</title>
</head>
<body>
	<!--PreLoader-->
    <!-- <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div> -->
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
	<section class="product section-padding">
		<div class="container">
			<div class="row">
				<div class="section-title" data-aos="fade-up" data-aos-duration="1500">
					<h2 data-title="Danh sách">Sản phẩm</h2>
				</div>
			</div>
			<div class="row product-product">
				<!--------------- côt 1------------ -->
				<div class="product-item-catagory" data-aos="fade-right" data-aos-duration="1500">
						<div class="product-item-catagory-title">
							<p>Danh mục sản phẩm</p>
						</div>
						<div class="product-item-catagorys" data-aos="fade-right" data-aos-duration="1500">
							<?php 
							$query_dm = mysqli_query($conn,"SELECT * FROM danhmuc_sanpham");
							while($row_dm = mysqli_fetch_array($query_dm)){
							 ?>
							<div class="product-catagory-item">
								<div class="product-catagory-item-text">
									<a href="sanpham.php?id_dm=<?php echo $row_dm['id_danhmuc'] ?>"><span><?php echo $row_dm['tendanhmuc'] ?></span></a>
								</div>
							</div>
							<?php } ?>
						</div>
						
					<!-- ----------------------------------------------------------------------------- -->
						<div class="product-item-catagory-title" data-aos="fade-right" data-aos-duration="1500">
							<p>Danh mục bài viết</p>
						</div>
						<div class="product-item-catagorys" data-aos="fade-right" data-aos-duration="1500">

							<?php 
							$query_dmbv = mysqli_query($conn,"SELECT * FROM danhmucbaiviet_sp");
							while($row_dmbv = mysqli_fetch_array($query_dmbv)){
							 ?>
							<div class="product-catagory-item">
								<div class="product-catagory-item-text">
									<a href="baiviet.php?id_dmbv=<?php echo $row_dmbv['id_danhmuc_bv'] ?>"><span><?php echo $row_dmbv['ten_danhmuc_bv'] ?></span></a>
								</div>
							</div>
							<?php } ?>
						
						</div>
				</div>

				<!-- --------------cột 2--------------- -->
				<div class="product-items" data-aos="fade-up" data-aos-duration="1500">
					<?php 
					if (isset($_GET['trang'])) {
						$trangsp = $_GET['trang'];
							$next = $trangsp +1;
							$prev = $trangsp-1;
						
					}else{
						$trangsp= 1;
					}

					if ($trangsp == ''||$trangsp==1) {
						$begin = 0;

					}else{
						$begin = ($trangsp * 6)-6;
					}
						$id_danhmuc = $_GET['id_dm'];
						$query_sp = mysqli_query($conn,
						 "SELECT * FROM sanpham_sp,danhmuc_sanpham WHERE sanpham_sp.id_danhmuc=danhmuc_sanpham.id_danhmuc AND sanpham_sp.id_danhmuc='$id_danhmuc' LIMIT $begin,6"
						);
						while($row_sp = mysqli_fetch_array($query_sp)){
					 ?>
					<form action="themgiohang.php?id_sp=<?php echo $row_sp['id_sp']?>&id_dm=<?php echo $row_sp['id_danhmuc']?> " method="post">
						<div class="product-item">
							<div class="product-item-img">
								<a href="chitietsanpham.php?id_sp=<?php echo $row_sp['id_sp']?>"><img src="admin/anh/<?php echo $row_sp['hinhanh_sp'] ?>" alt=""></a>
							</div>
							<div class="product-item-text">
								<p>Mã sản phẩm: <?php echo $row_sp['ma_sp'] ?></p>
								<h5 style="width: 200px;"><a style="text-decoration: none;" href="chitietsanpham.php?id_sp=<?php echo $row_sp['id_sp']?>">Tên sản phẩm: <?php echo $row_sp['ten_sp'] ?></a>
								</h5>
								<p style="color: red;">Giá: <?php echo number_format($row_sp['gia_sp'],0,'.','.')."VNĐ" ?></p>
								<p>Tên danh mục: <?php echo $row_sp['tendanhmuc'] ?></p>
								<button class="btn" name="themgiohang" style="font-size: 20px;">Thêm giỏ hàng</button>
							</div>
						</div>
					</form>
					<?php } ?>
				</div>
				<!-- ----------------------cột 3--------------------------- -->
				<!-- <div class="Top-product" data-aos="fade-left" data-aos-duration="1500">
							<p>Sản phẩm bán chạy</p>
					<div class="Top-product-item" data-aos="fade-left" data-aos-duration="1500">
								
							<div class="Top-product-item-img">
								<img src="assets/img/minion-1297944_1920 (1).jpg" alt="">
							</div>
							<div class="Top-product-item-text">
								<h2>Tên sản phẩm</h2>
								<p>Giá sản phẩm</p>
								<p>Danh mục sản phẩm</p>
							</div>
						</div>
				</div> -->
			</div>
			
		</div>
	</section>
	<style>
		.phantrang{
			width: 100%;
			margin-top: 80px;
			display: block;
		}
		.phantrang_items{
			display: flex;
			margin-left: 900px;
			flex-wrap: wrap;

		}
		.phantrang_items li{
			text-align: center;
			margin: 0px 4px;
			width: 40px;
			padding: 5px;
			border: 1px solid black;
			border-radius: 25px;
		}
		.phantrang_items li a{
			text-decoration: none;
			color: black;
		}
		.phantrang_items li:hover{
			background: black;
			
		}
		.phantrang_items li:hover a{
			color: wheat;
			
		}
	</style>
	<?php 
		$sql_trang = mysqli_query($conn,"SELECT * FROM sanpham_sp,danhmuc_sanpham WHERE sanpham_sp.id_danhmuc=danhmuc_sanpham.id_danhmuc AND sanpham_sp.id_danhmuc='$id_danhmuc'");
		$query_dm_trang=mysqli_fetch_array($sql_trang);
		$row_trang=mysqli_num_rows($sql_trang);
		$trang = ceil($row_trang/6); //hàm ceil làm tròn;
	 ?>
	<div class="phantrang">
		<ul class="phantrang_items">
			<?php if ($trangsp>1){ ?>
				<li><a href="sanpham.php?trang=<?php  echo $prev ?>&id_dm=<?php echo $query_dm_trang['id_danhmuc']?>"><</a></li>
			<?php }else{ ?>
				<li><a href="#"><</a></li>
			<?php } ?>
			<!-- ---------------------------------------------------- -->
			<?php 
				for ($i=1; $i <= $trang ; $i++) {
			 ?>
			<li><a href="sanpham.php?trang=<?php  echo $i ?>&id_dm=<?php echo $query_dm_trang['id_danhmuc']?>"><?php echo $i ?></a></li>
			<?php
			 } 
			?>
			<!-- ---------------------------------------------------- -->
			<?php if ($trangsp<$trang){ ?>
			<li><a href="sanpham.php?trang=<?php  echo $next ?>&id_dm=<?php echo $query_dm_trang['id_danhmuc']?>">></a></li>
			<?php }else{ ?>
				<li><a href="#">></a></li>
			<?php } ?>
		</ul>
	</div>
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