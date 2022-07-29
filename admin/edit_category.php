
    <?php
    if(!defined('hang')){
        die('ban truy cap sai cach');
    }
    if (isset($_SESSION['tenadmin'])) {
    $tenadmin = $_SESSION['tenadmin'];
    }
    $id_admin = $_GET['id_admin'];
    $cat_id=$_GET['id'];
    $sql="SELECT * FROM danhmuc_sanpham WHERE id_danhmuc=$cat_id";
    $query=mysqli_query($conn, $sql);
    $row=mysqli_fetch_array($query);
    
    if(isset($_POST['sbm'])){
        $tendanhmuc=$_POST['tendanhmuc'];
        $thutu=$_POST['thutu'];
        //  xử lý hình ảnh//
        $hinhanh = $_FILES['hinhanh']['name'];
        $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        $hinhanh = time().'_'.$hinhanh;
        move_uploaded_file($hinhanh_tmp,'anh/'.$hinhanh);
        // -----------------------------
        $sql_UPDATE="UPDATE danhmuc_sanpham SET tendanhmuc='$tendanhmuc', thutu='$thutu',hinhanh_dm='$hinhanh' WHERE id_danhmuc='$cat_id'";
        mysqli_query($conn, $sql_UPDATE);
        header('location: index.php?page_layout=category');
    }
    ?>			
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="">Quản lý danh mục</a></li>
				<li class="active"><?php echo $row['tendanhmuc'];?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh mục:<?php echo $row['tendanhmuc'];?></h1>
			</div>
		</div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-8">
                            <!-- <div class="alert alert-danger">Danh mục đã tồn tại !</div> -->
                        <form role="form" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input type="text" name="tendanhmuc" required value="<?php echo $row['tendanhmuc'];?>" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <div class="form-group">
                                <label>Tên quản trị thêm:</label>
                                <input type="text" name="tenadmin" required value="<?php echo $tenadmin;?>" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <div class="form-group">
                                <label>Thứ tự danh mục:</label>
                                <input type="text" name="thutu" required value="<?php echo $row['thutu'];?>" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <div class="form-group">
                                <label>Mã nhân viên:</label>
                                <input type="text" name="manhanvien" required value="<?php echo $id_admin;?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Ảnh sản phẩm:</label>
                                <input type="file" name="hinhanh" required class="form-control">
                                <img style="width: 100px;height: 100px;" src="anh/<?php echo $row['hinhanh_dm']?>" alt="">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div><!-- /.col-->
	</div>	<!--/.main-->	

