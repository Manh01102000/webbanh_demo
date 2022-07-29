<?php 
	include("connect.php");
	session_start();
	if (isset($_SESSION['email_kh'])) {
		
		$email_kh =$_SESSION['email_kh'];
		 // var_dump($_SESSION['id_khachhang']);
	}
	require('Carbon/autoload.php');
	use Carbon\Carbon;
	use Carbon\CarbonInterval;
	$now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
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
	<title>Chi tiết sản phẩm</title>
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
	<!-- ------------------------------------chitiet------------------------------------- -->
	<section class="detail-product section-padding">
		<div class="container">
				<div class="row">
					<div class="section-title" data-aos="fade-up" data-aos-duration="1500">
						<h2 data-title="Chi tiết">Sản phẩm</h2>
					</div>
				</div>
			
				<div class="product-content row">
					<?php 
						$id_sanpham = $_GET['id_sp'];
							$query_sp = mysqli_query($conn,
							 "SELECT * FROM sanpham_sp,danhmuc_sanpham WHERE sanpham_sp.id_danhmuc=danhmuc_sanpham.id_danhmuc AND sanpham_sp.id_sp='$id_sanpham' LIMIT 1"
							);
							while($row_sp = mysqli_fetch_array($query_sp)){
						 ?>
							<div class="product-content-left row" data-aos="fade-right" data-aos-duration="1500">
								<div class="product-content-left-big-img">
									<img src="admin/anh/<?php echo $row_sp['hinhanh_sp'] ?>" alt="">
								</div>
							</div>
							<div class="product-content-right" data-aos="fade-left" data-aos-duration="1500">
								<form action="themgiohang.php?id_sp=<?php echo $row_sp['id_sp']?>&id_dm_ct=<?php echo $row_sp['id_danhmuc']?> " method="post">
									<div class="product-content-right-product-name">
										<h2><?php echo $row_sp['ten_sp'] ?></h2>
										<p>Mã sản phẩm: <?php echo $row_sp['ma_sp'] ?></p>
									</div>
									<div class="product-content-right-product-price">
										<p>Giá: <?php echo number_format($row_sp['gia_sp'],0,'.','.').'VNĐ' ?></p>
									</div>
									<div class="product-content-right-product-button">
										<button name="themgiohangchitiet">
											<i class="fa-solid fa-cart-shopping"></i><p>Thêm giỏ hàng</p>
										</button>
									</div>
								</form>
								<?php } ?>
								<div class="product-content-right-bottom">
									<div class="product-content-right-bottom-top">
										&#8744
									</div>
									<div class="product-content-right-bottom-content-big">
										<div class="product-content-right-bottom-content-title row">
											<div class="product-content-right-bottom-content-title-item chitiet">
												<p>Chi tiết</p>
											</div>
											<div class="product-content-right-bottom-content-title-item comment">
												<p>Bình luận</p>
											</div>
										</div>

										<?php 
											$id_sanpham = $_GET['id_sp'];
											if (isset($_POST['gui'])) {
												$noidung_bl = $_POST['noidung_bl'];
												$id_kh_bl = $_POST['id_kh_bl'];
												$email_kh_bl = $_POST['email_kh_bl'];
												$insert_bl = mysqli_query($conn,
												"INSERT INTO binhluan_sp(id_sp_bl,id_kh_bl,email_kh_bl,noidung_bl,ngay_bl) 
												VALUES('$id_sanpham','$id_kh_bl','$email_kh_bl','$noidung_bl','$now')
											     "); 
											}
										 ?>
										
										<div class="product-content-right-bottom-content">
											<?php 
												$id_sanpham = $_GET['id_sp'];
													$query_bl_sp = mysqli_query($conn,"SELECT * FROM sanpham_sp WHERE id_sp = '$id_sanpham'");
													$row_bl_sp=mysqli_fetch_array($query_bl_sp);

											 ?>
											<div class="product-content-right-bottom-content-chitiet">
												<p><?php echo $row_bl_sp['noidung_sp'] ?></p>
											</div>
											<?php 
												$id_sanpham = $_GET['id_sp'];
												if (isset($_SESSION['id_khachhang'])) {
													$id_dangky = $_SESSION['id_khachhang'];
												}
												if (isset($_SESSION['email_kh'])) {
		
														$email_kh =$_SESSION['email_kh'];
														 // var_dump($_SESSION['id_khachhang']);
													}
											?>
											<div class="product-content-right-bottom-content-comment">
											<form action="chitietsanpham.php?id_sp=<?php echo $id_sanpham ?>" method="post">
												<input type="hidden" name="id_kh_bl" value="<?php echo $id_dangky ?>">
												<input type="hidden" name="email_kh_bl" value="<?php echo $email_kh ?>"><br>
												<textarea placeholder="Nhập nội dung bình luận" name="noidung_bl" cols="82" rows="5"></textarea><br>
												<input type="submit" name="gui" value="Gửi bình luận">
											</form>
											<?php 
												$id_sanpham = $_GET['id_sp'];
													$query_bl = mysqli_query($conn,"SELECT * FROM sanpham_sp a JOIN binhluan_sp b ON a.id_sp = b.id_sp_bl JOIN dangky_sp c ON c.id_dangky = b.id_kh_bl WHERE b.id_sp_bl = '$id_sanpham'");
												while($row_bl=mysqli_fetch_array($query_bl)){
											 ?>
												<div class="product-content-right-bottom-content-comment-items">
													<div class="product-content-right-bottom-content-comment-item-user">
													<img src="anhkh/<?php echo $row_bl['hinhanh_kh'] ?>" alt=""><p><?php echo $row_bl['ten_kh'] ?></p><span><?php echo $row_bl['ngay_bl'] ?></span>
													</div>
													<div class="product-content-right-bottom-content-comment-item">
														<p><?php echo $row_bl['noidung_bl'] ?></p>
														<?php if (isset($_SESSION['email_kh'])){ 
																$email_kh = $_SESSION['email_kh'];
															?>
															 <?php  if ($row_bl['email_kh_bl']==$email_kh){ ?>
															<a href="xoabinhluan.php?id_sp=<?php echo $id_sanpham ?>&id_bl=<?php echo $row_bl['id_bl'] ?>">
																<i class="fa-solid fa-trash-can"></i>
															</a>
																 <?php } ?>

														<?php } ?>
													</div>
													<?php if ($row_bl['ten_admin_bl']){ ?>
													<div class="product-content-right-bottom-content-comment-item-admin">
														<p>Admin:<?php echo $row_bl['ten_admin_bl'] ?></p>
														<span><?php echo $row_bl['noidung_traloi'] ?></span>
													</div>
													<?php } ?>
													
												</div>
											<?php } ?>
											</div>
										</div>
										
									</div>
								</div>

							</div>
				</div>
		</div>
	</section>
	<!-- -----------------------------------Sản phẩm liên quan----------------------------------------------- -->
	<section class="product-related">
			<div class="container">
				<div class="row">
					<div class="section-title" data-aos="fade-up" data-aos-duration="1500">
						<h2 data-title="Sản phẩm">Liên quan</h2>
					</div>
				</div>
			<div class="related-content row">
				<?php 
					$query=mysqli_query($conn,"SELECT * FROM sanpham_sp,danhmuc_sanpham WHERE sanpham_sp.id_danhmuc=danhmuc_sanpham.id_danhmuc LIMIT 5");
					while($row=mysqli_fetch_array($query)){
				 ?>
				<div class="product-related-item">
					<a href="chitietsanpham.php?id_sp=<?php echo $row['id_sp'] ?>"><img src="admin/anh/<?php echo $row['hinhanh_sp'] ?>" alt=""></a>
					<h2><?php echo $row['ten_sp'] ?></h2>
					<p><?php echo $row['tendanhmuc'] ?></p>
					<p><?php echo number_format($row['gia_sp'],0,'.','.') ?><sup>đ</sup></p>
				</div>
			<?php } ?>
			</div>
			</div>
	</section>
	<!-- ---------------------------------------------chân trang----------------------- -->
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