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
	<link href="admin/css/bootstrap.min.css" rel="stylesheet">
	<link href="admin/css/datepicker3.css" rel="stylesheet">
	<link href="admin/css/bootstrap-table.css" rel="stylesheet">
<!-- 	<link href="admin/css/giaodienadmin.css" rel="stylesheet"> -->
	<script src="admin/js/lumino.glyphs.js"></script>
	<script src="admin/js/jquery-1.11.1.min.js"></script>
<script src="admin/js/bootstrap.min.js"></script>
<script src="admin/js/bootstrap-table.js"></script>
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
	<div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <form method="POST">
                        <table data-toolbar="#toolbar" data-toggle="table">
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th>Mã đơn hàng</th>
                                    <th>Tên khách hàng</th>
                                    <th>Địa chỉ</th>
                                    <th>Email</th>
                                    <th>Số điện thoại</th>
                                    <th>Tình trạng</th>
                                    <th>Ngày đặt</th>
                                    <th>Hình thức thanh toán</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $id_khachhang=$_SESSION['id_khachhang'];
                                if (isset($_GET["page"])) {
                                    $page = $_GET["page"];
                                } else {
                                    $page = 1;
                                }
                                $row_per_page = 5;
                                $per_rows = $page * $row_per_page - $row_per_page;
                                $total_rows = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM giohang_sp,dangky_sp
                                WHERE giohang_sp.id_khachhang = '$id_khachhang' AND giohang_sp.id_khachhang=dangky_sp.id_dangky  ORDER BY giohang_sp.id_giohang ASC"));
                                $total_pages = ceil($total_rows / $row_per_page);
                                $list_page = " ";
                                $page_prev = $page - 1;
                                if ($page_prev <= 1) {
                                    $page_prev = 1;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="lichsudonhangnguoidung.php?page=' . $page_prev . '">&laquo;</a></li>';
                                // for ($i = 1; $i <= $total_pages; $i++) {
                                //     $list_page .= '<li class="page-item"><a class="page-link" href="index.php?page_layout=product&page=' . $i . '">' . $i . '</a></li>';
                                // }
                                // in dam so trang hien tai
                                if (!isset($_GET['page'])) {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == 1) {
                                            $list_page .= '<li class="active"><a class="page-link" href="lichsudonhangnguoidung?page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        for ($i = 2; $i <= $total_pages; $i++) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="lichsudonhangnguoidung.php?page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                } else {
                                    for ($i = 1; $i <= $total_pages; $i++) {
                                        if ($i == $_GET['page']) {
                                            $list_page .= '<li class="active"><a class="page-link" href="lichsudonhangnguoidung.php?page=' . $i . '">' . $i . '</a></li>';
                                        }
                                        if ($i != $_GET['page']) {
                                            $list_page .= '<li class="page-item"><a class="page-link" href="lichsudonhangnguoidung.php?page=' . $i . '">' . $i . '</a></li>';
                                        }
                                    }
                                }
                                //page next
                                $page_next = $page + 1;
                                if ($page_next > $total_pages) {
                                    $page_next = $total_pages;
                                }
                                $list_page .= '<li class="page-item"><a class="page-link" href="lichsudonhangnguoidung.php?page=' . $page_next . '">&raquo;</a></li>';
                                // echo $list_page;
                                
                                   
                                $sql_lietke_donhang = "SELECT * FROM giohang_sp,dangky_sp
                                WHERE giohang_sp.id_khachhang = '$id_khachhang'AND giohang_sp.id_khachhang=dangky_sp.id_dangky  ORDER BY giohang_sp.id_giohang DESC LIMIT $per_rows, $row_per_page ";
                                $query_lietke_donhang = mysqli_query($conn, $sql_lietke_donhang);
                                while ($row_lk_dh = mysqli_fetch_array($query_lietke_donhang)) { ?>
                                    <tr>
                                        <td style=""><?php echo $row_lk_dh['id_giohang'] ?></td>
                                        <td style=""><?php echo $row_lk_dh['magiohang'] ?></td>
                                        <td style=""><?php echo $row_lk_dh['ten_kh'] ?></td>
                                        <td style=""><?php echo $row_lk_dh['diachi_kh'] ?></td>
                                        <td style=""><?php echo $row_lk_dh['email_kh'] ?></td>
                                        <td style=""><?php echo $row_lk_dh['sodienthoai_kh']?></td>
                                        <td style="">
                                            <?php if ($row_lk_dh['trangthai_giohang']==1){
                                                echo'<a style="color:red;text-decoration: none;">Đơn hàng chưa được xử lý</a>';
                                            }else{
                                                echo'<a style="color:skyblue;text-decoration: none;">Đơn hàng đã được xử lý</a>';
                                            }
                                                 ?>
                                        </td>
                                        <td><?php echo $row_lk_dh['ngaydathang'] ?></td>
                                        <td>
                                        	<?php 
                                        	if ($row_lk_dh['hinhthucthanhtoan']=='vnpay'||$row_lk_dh['hinhthucthanhtoan']=='momo') {
                                        		?>
                                        		<a href="lichsudonhangnguoidung.php?congthanhtoan=<?php echo $row_lk_dh['hinhthucthanhtoan']?>&magiohang=<?php echo $row_lk_dh['magiohang'] ?>"><?php echo $row_lk_dh['hinhthucthanhtoan']?></a>
                                        	<?php }else{ ?>
                                        		<?php echo $row_lk_dh['hinhthucthanhtoan']?>
                                        	 <?php } ?>
                                        		
                                        	</td>
                                    <td class="form-group">
                                        <a style="padding-left: 10px;" href="xemdonhangnguoidung.php?magiohang=<?php echo $row_lk_dh['magiohang'] ?>">
                                        <i class="fa-regular fa-eye"></i></a>
                                        <a style="padding-left: 20px;" href=""><i class="fa-solid fa-print"></i></a>
                                        
                                    </td>                                        
                                    </tr>
                                <?php } ?>
                            </tbody>

                        </table>
                    </form>
                    <?php 
                    if (isset($_GET['congthanhtoan'])){
                    	$congthanhtoan = $_GET['congthanhtoan'];
                    	$magiohang=$_GET['magiohang'];
                    	echo"<h4>Cổng thanh toán: $congthanhtoan</h4>";
                    if ($congthanhtoan=='momo') {
                   	?>
                    <form method="POST">
                    	<?php 
                    		$query_momo=mysqli_query($conn,
                    			"SELECT * FROM momo_sp WHERE magiohang='$magiohang'LIMIT 1");
                    		$row_momo=mysqli_fetch_array($query_momo);
                    	 ?>
                        <table data-toolbar="#toolbar" data-toggle="table">
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th>Mã tài khoản doanh nghiệp</th>
                                    <th>Mã đặt hàng</th>
                                    <th>Tổng giá tiền đơn hàng</th>
                                    <th>Nội dung</th>
                                    <th>Loại đơn hàng</th>
                                    <th>Mã giao dịch</th>
                                    <th>Loại giao dịch</th>
               
                                </tr>
                            </thead>
                            <tbody>
                         
                                    <tr>
                                    	<td><?php echo $row_momo['id_momo'] ?></td>
                                        <td style=""><?php echo $row_momo['partnercode'] ?></td>
                                        <td style=""><?php echo $row_momo['orderid'] ?></td>
                                        <td style=""><?php echo number_format($row_momo['amount'],0,'.','.')?><sup>đ</sup></td>
                                        <td style=""><?php echo $row_momo['orderinfo'] ?></td>
                                        <td style=""><?php echo $row_momo['ordertype'] ?></td>
                                        <td style=""><?php echo $row_momo['transid'] ?></td>
                                        <td style=""><?php echo $row_momo['paytype'] ?></td>
                                       
                            </tbody>
                        </table>
                    </form>
                    <?php 
                    }elseif($congthanhtoan=='vnpay'){
                    ?>
                    <form method="POST">
                    	<?php 
                    		$query_vnpay=mysqli_query($conn,
                    			"SELECT * FROM vnpay_sp WHERE magiohang='$magiohang'LIMIT 1");
                    		$row_vnpay=mysqli_fetch_array($query_vnpay);
                    	 ?>
                        <table data-toolbar="#toolbar" data-toggle="table">
                            <thead>
                                <tr>
                                    <th data-field="id" data-sortable="true">ID</th>
                                    <th>Tổng tiền đơn hàng</th>
                                    <th>Mã ngân hàng</th>
                                    <th>Mã VNPay</th>
                                    <th>Loại thẻ</th>
                                    <th>Nội dung</th>
                                    <th>Ngày đặt hàng</th>
                                    <th>Mã TMN của website</th>
                                    <th>Mã giao dịch</th>
               
                                </tr>
                            </thead>
                            <tbody>
                         
                                    <tr>
                                    	<td><?php echo $row_vnpay['id_vnpay'] ?></td>
                                        <td style=""><?php echo number_format($row_vnpay['vnp_amount'],0,'.','.')?><sup>đ</sup></td>
                                        <td style=""><?php echo $row_vnpay['vnp_bankcode'] ?></td>
                                        <td style=""><?php echo $row_vnpay['vnp_banktranno'] ?></td>
                                        <td style=""><?php echo $row_vnpay['vnp_cardtype'] ?></td>
                                        <td style=""><?php echo $row_vnpay['vnp_orderInfo'] ?></td>
                                        <td style=""><?php echo $row_vnpay['vnp_paydate'] ?></td>
                                        <td style=""><?php echo $row_vnpay['vnp_tmncode'] ?></td>
                                        <td style=""><?php echo $row_vnpay['vnp_transactionno'] ?></td>
                                       
                            </tbody>
                        </table>
                    </form>
                    <?php 
                	} 
                	} 
                	?>
                </div>
                <div class="panel-footer">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <?php echo $list_page; ?>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
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