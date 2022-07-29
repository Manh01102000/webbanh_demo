<?php 
	session_start();
	include("connect.php");
	$id_danhmuc = $_GET['id_dm'];
	$id_danhmuc_ct = $_GET['id_dm_ct'];
	$id_sp=$_GET['id_sp'];
	// thêm số lượng
	if (isset($_SESSION['cart']) && isset($_GET['cong'])) {
		$id_sp=$_GET['cong'];
		foreach($_SESSION['cart'] as $cart_item){
			if ($cart_item['id_sp']!=$id_sp) {
				$product[] = array(
						'ten_sp'=>$cart_item['ten_sp'],
						'id_sp'=>$cart_item['id_sp'],
						'soluong'=>$cart_item['soluong'],
						'gia_sp'=>$cart_item['gia_sp'],
						'hinhanh_sp'=>$cart_item['hinhanh_sp'],
						'ma_sp'=>$cart_item['ma_sp']
						);
			$_SESSION['cart'] = $product;	
			}else{
				$tangsoluong = $cart_item['soluong']+1;
				if ($cart_item['soluong']<=9) {
					$product[] = array(
						'ten_sp'=>$cart_item['ten_sp'],
						'id_sp'=>$cart_item['id_sp'],
						'soluong'=>$tangsoluong,
						'gia_sp'=>$cart_item['gia_sp'],
						'hinhanh_sp'=>$cart_item['hinhanh_sp'],
						'ma_sp'=>$cart_item['ma_sp']
						);
				}else{
					$product[] = array(
						'ten_sp'=>$cart_item['ten_sp'],
						'id_sp'=>$cart_item['id_sp'],
						'soluong'=>$cart_item['soluong'],
						'gia_sp'=>$cart_item['gia_sp'],
						'hinhanh_sp'=>$cart_item['hinhanh_sp'],
						'ma_sp'=>$cart_item['ma_sp']
						);
				}
				$_SESSION['cart'] = $product;
			}
		}
		header('location:giohang.php');

	}
	// trừ số lượng
	if (isset($_SESSION['cart']) && isset($_GET['tru'])) {
		$id_sp=$_GET['tru'];
		foreach($_SESSION['cart'] as $cart_item){
			if ($cart_item['id_sp']!=$id_sp) {
				$product[] = array(
						'ten_sp'=>$cart_item['ten_sp'],
						'id_sp'=>$cart_item['id_sp'],
						'soluong'=>$cart_item['soluong'],
						'gia_sp'=>$cart_item['gia_sp'],
						'hinhanh_sp'=>$cart_item['hinhanh_sp'],
						'ma_sp'=>$cart_item['ma_sp']
						);
			$_SESSION['cart'] = $product;	
			}else{
				$giamsoluong = $cart_item['soluong']-1;
				if ($cart_item['soluong']>1) {
					$product[] = array(
						'ten_sp'=>$cart_item['ten_sp'],
						'id_sp'=>$cart_item['id_sp'],
						'soluong'=>$giamsoluong,
						'gia_sp'=>$cart_item['gia_sp'],
						'hinhanh_sp'=>$cart_item['hinhanh_sp'],
						'ma_sp'=>$cart_item['ma_sp']
						);
				}else{
					$product[] = array(
						'ten_sp'=>$cart_item['ten_sp'],
						'id_sp'=>$cart_item['id_sp'],
						'soluong'=>$cart_item['soluong'],
						'gia_sp'=>$cart_item['gia_sp'],
						'hinhanh_sp'=>$cart_item['hinhanh_sp'],
						'ma_sp'=>$cart_item['ma_sp']
						);
				}
				$_SESSION['cart'] = $product;
			}
		}
		header('location:giohang.php');

	}
	// xóa sản phẩm
	if (isset($_SESSION['cart']) && isset($_GET['xoa'])) {
		$id_sp=$_GET['xoa'];
		foreach($_SESSION['cart'] as $cart_item){

		// nếu id_sp gửi qua mà khác với id_sp trong database thì sẽ duyệt mảng đến khi id_sp gửi qua = id_sp database và sẽ xóa id_sp mà trùng đó vd id_sp gửi qua là 9 mà trong database có id_sp là 8,9,10....n; thì nó duyệt mảng đưa các id_sp không trùng qua 1 bên và id_sp trùng đó qua 1 bên sau đó nó giữ lại id_sp không trùng và xóa id_sp trùng 
			if ($cart_item['id_sp']!=$id_sp) {
				$product[] = array(
						'ten_sp'=>$cart_item['ten_sp'],
						'id_sp'=>$cart_item['id_sp'],
						'soluong'=>$cart_item['soluong'],
						'gia_sp'=>$cart_item['gia_sp'],
						'hinhanh_sp'=>$cart_item['hinhanh_sp'],
						'ma_sp'=>$cart_item['ma_sp']
						);
			}
			$_SESSION['cart'] = $product;
			header('location:giohang.php');
		}
	}
	//xóa toàn bộ sản phẩm

	if (isset($_GET['xoatatca']) && $_GET['xoatatca']==1) {
		unset($_SESSION['cart']);
		header('location:giohang.php');
	}
	// thêm sản phẩm vào giỏ hàng từ trang sản phẩm
	
	if (isset($_POST['themgiohang'])) {
		// phá session dùng ss_destroy();
		// session_destroy();
		$id_sp=$_GET['id_sp'];
		$soluong=1;
		$sql_sanpham = "SELECT * FROM sanpham_sp WHERE id_sp='$id_sp'LIMIT 1";
		$query_sp=mysqli_query($conn,$sql_sanpham);
		$row_sp=mysqli_fetch_array($query_sp);
		if ($row_sp) {
			// mảng
			$new_product=array(array(
				'ten_sp'=>$row_sp['ten_sp'],
				'id_sp'=>$id_sp,
				'soluong'=>$soluong,
				'gia_sp'=>$row_sp['gia_sp'],
				'hinhanh_sp'=>$row_sp['hinhanh_sp'],
				'ma_sp'=>$row_sp['ma_sp']
			));
		
			// kiểm tra session giỏ hàng tồn tại nếu tồn tại session cart thì cộng thêm sản phẩm
			if (isset($_SESSION['cart'])) {
				$found = false;
				// lấy ra từng sản phẩm cho mỗi mảng
				foreach($_SESSION['cart'] as $cart_item){

					// nếu dữ liệu trùng thì cộng thêm
					if ($cart_item['id_sp']==$id_sp) {
						$product[] = array(
						'ten_sp'=>$cart_item['ten_sp'],
						'id_sp'=>$cart_item['id_sp'],
						'soluong'=>$cart_item['soluong']+1,
						'gia_sp'=>$cart_item['gia_sp'],
						'hinhanh_sp'=>$cart_item['hinhanh_sp'],
						'ma_sp'=>$cart_item['ma_sp']
						);
					$found = true;
					}else{
						// nếu dữ liệu k trùng thì thêm sản phẩm mới vào giỏ
						$product[] = array(
						'ten_sp'=>$cart_item['ten_sp'],
						'id_sp'=>$cart_item['id_sp'],
						'soluong'=>$cart_item['soluong'],
						'gia_sp'=>$cart_item['gia_sp'],
						'hinhanh_sp'=>$cart_item['hinhanh_sp'],
						'ma_sp'=>$cart_item['ma_sp']
						);
					}
				}
				if ($found == false) {
					// liên kết 2 mảng dữ liệu dùng array_merge
					$_SESSION['cart']=array_merge($product,$new_product);
				}else{
					$_SESSION['cart']=$product;
				}
			}else{
				// nếu không trùng thì sẽ tạo mới sản phẩm vào giỏ
				$_SESSION['cart']=$new_product;
			}
		}
		header("location:sanpham.php?id_dm=$id_danhmuc");
		// header('location:testgiohang.php');
		// print_r($_SESSION['cart']);
	}
	if (isset($_POST['themgiohangchitiet'])) {
		// phá session dùng ss_destroy();
		// session_destroy();
		$id_sp=$_GET['id_sp'];
		$soluong=1;
		$sql_sanpham = "SELECT * FROM sanpham_sp WHERE id_sp='$id_sp'LIMIT 1";
		$query_sp=mysqli_query($conn,$sql_sanpham);
		$row_sp=mysqli_fetch_array($query_sp);
		if ($row_sp) {
			// mảng
			$new_product=array(array(
				'ten_sp'=>$row_sp['ten_sp'],
				'id_sp'=>$id_sp,
				'soluong'=>$soluong,
				'gia_sp'=>$row_sp['gia_sp'],
				'hinhanh_sp'=>$row_sp['hinhanh_sp'],
				'ma_sp'=>$row_sp['ma_sp']
			));
		
			// kiểm tra session giỏ hàng tồn tại nếu tồn tại session cart thì cộng thêm sản phẩm
			if (isset($_SESSION['cart'])) {
				$found = false;
				// lấy ra từng sản phẩm cho mỗi mảng
				foreach($_SESSION['cart'] as $cart_item){

					// nếu dữ liệu trùng thì cộng thêm
					if ($cart_item['id_sp']==$id_sp) {
						$product[] = array(
						'ten_sp'=>$cart_item['ten_sp'],
						'id_sp'=>$cart_item['id_sp'],
						'soluong'=>$cart_item['soluong']+1,
						'gia_sp'=>$cart_item['gia_sp'],
						'hinhanh_sp'=>$cart_item['hinhanh_sp'],
						'ma_sp'=>$cart_item['ma_sp']
						);
					$found = true;
					}else{
						// nếu dữ liệu k trùng thì thêm sản phẩm mới vào giỏ
						$product[] = array(
						'ten_sp'=>$cart_item['ten_sp'],
						'id_sp'=>$cart_item['id_sp'],
						'soluong'=>$cart_item['soluong'],
						'gia_sp'=>$cart_item['gia_sp'],
						'hinhanh_sp'=>$cart_item['hinhanh_sp'],
						'ma_sp'=>$cart_item['ma_sp']
						);
					}
				}
				if ($found == false) {
					// liên kết 2 mảng dữ liệu dùng array_merge
					$_SESSION['cart']=array_merge($product,$new_product);
				}else{
					$_SESSION['cart']=$product;
				}
			}else{
				// nếu không trùng thì sẽ tạo mới sản phẩm vào giỏ
				$_SESSION['cart']=$new_product;
			}
		}
		header("location:chitietsanpham.php?id_sp=$id_sp");
		// header('location:testgiohang.php');
		// print_r($_SESSION['cart']);
	}
	if (isset($_POST['themsanphamindex'])) {
		// phá session dùng ss_destroy();
		// session_destroy();
		$id_sp=$_GET['id_sp'];
		$soluong=1;
		$sql_sanpham = "SELECT * FROM sanpham_sp WHERE id_sp='$id_sp'LIMIT 1";
		$query_sp=mysqli_query($conn,$sql_sanpham);
		$row_sp=mysqli_fetch_array($query_sp);
		if ($row_sp) {
			// mảng
			$new_product=array(array(
				'ten_sp'=>$row_sp['ten_sp'],
				'id_sp'=>$id_sp,
				'soluong'=>$soluong,
				'gia_sp'=>$row_sp['gia_sp'],
				'hinhanh_sp'=>$row_sp['hinhanh_sp'],
				'ma_sp'=>$row_sp['ma_sp']
			));
		
			// kiểm tra session giỏ hàng tồn tại nếu tồn tại session cart thì cộng thêm sản phẩm
			if (isset($_SESSION['cart'])) {
				$found = false;
				// lấy ra từng sản phẩm cho mỗi mảng
				foreach($_SESSION['cart'] as $cart_item){

					// nếu dữ liệu trùng thì cộng thêm
					if ($cart_item['id_sp']==$id_sp) {
						$product[] = array(
						'ten_sp'=>$cart_item['ten_sp'],
						'id_sp'=>$cart_item['id_sp'],
						'soluong'=>$cart_item['soluong']+1,
						'gia_sp'=>$cart_item['gia_sp'],
						'hinhanh_sp'=>$cart_item['hinhanh_sp'],
						'ma_sp'=>$cart_item['ma_sp']
						);
					$found = true;
					}else{
						// nếu dữ liệu k trùng thì thêm sản phẩm mới vào giỏ
						$product[] = array(
						'ten_sp'=>$cart_item['ten_sp'],
						'id_sp'=>$cart_item['id_sp'],
						'soluong'=>$cart_item['soluong'],
						'gia_sp'=>$cart_item['gia_sp'],
						'hinhanh_sp'=>$cart_item['hinhanh_sp'],
						'ma_sp'=>$cart_item['ma_sp']
						);
					}
				}
				if ($found == false) {
					// liên kết 2 mảng dữ liệu dùng array_merge
					$_SESSION['cart']=array_merge($product,$new_product);
				}else{
					$_SESSION['cart']=$product;
				}
			}else{
				// nếu không trùng thì sẽ tạo mới sản phẩm vào giỏ
				$_SESSION['cart']=$new_product;
			}
		}
		header("location:index.php");
		// header('location:testgiohang.php');
		// print_r($_SESSION['cart']);
	}
 ?> 