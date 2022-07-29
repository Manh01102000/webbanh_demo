
    <?php
    if(!defined('hang')){
        die('ban truy cap sai cach');
    }
    if (isset($_SESSION['tenadmin'])) {
    $ten_admin_bl = $_SESSION['tenadmin'];
    }
    $id_bl = $_GET['id'];
    // $cat_id=$_GET['id'];
    $sql="SELECT * FROM 
    binhluan_sp a join sanpham_sp b on a.id_sp_bl = b.id_sp
    join dangky_sp c on a.id_kh_bl=c.id_dangky WHERE id_bl='$id_bl'";
    $query=mysqli_query($conn, $sql);
    $row=mysqli_fetch_array($query);
    if(isset($_POST['sbm'])){
        $ten_admin_bl=$_POST['ten_admin_bl'];
        $noidung_traloi=$_POST['noidung_traloi'];
        //  xử lý hình ảnh//
        // $hinhanh = $_FILES['hinhanh']['name'];
        // $hinhanh_tmp = $_FILES['hinhanh']['tmp_name'];
        // $hinhanh = time().'_'.$hinhanh;
        // move_uploaded_file($hinhanh_tmp,'anh/'.$hinhanh);
        // -----------------------------
        $sql_UPDATE="UPDATE binhluan_sp SET ten_admin_bl='$ten_admin_bl', noidung_traloi='$noidung_traloi' WHERE id_bl='$id_bl'";
        mysqli_query($conn, $sql_UPDATE);
        header('location: index.php?page_layout=comment');
    }
    ?>			
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="">Quản lý bình luận</a></li>
				<li class="active"><?php echo $row['ten_sp'];?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Sản phẩm bình luận:<?php echo $row['ten_sp'];?></h1>
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
                                <label>Tên Khách hàng:</label>
                                <input type="text" name="ten_kh" required value="<?php echo $row['ten_kh'];?>" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label>Nội dung bình luận:</label>
                                <input type="text" name="noidung_bl" required value="<?php echo $row['noidung_bl'];?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Tên nhân viên:</label>
                                <input type="text" name="ten_admin_bl" required value="<?php echo $ten_admin_bl;?>" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Trả lời bình luận:</label>
                                <input type="text" name="noidung_traloi" required value="<?php echo $row['noidung_traloi'];?>" class="form-control" placeholder="Nội dung...">
                            </div>
                            <!-- <div class="form-group">
                                <label>Ảnh sản phẩm:</label>
                                <input type="file" name="hinhanh" required class="form-control">
                                <img style="width: 100px;height: 100px;" src="anh/<?php echo $row['hinhanh_dm']?>" alt="">
                            </div> -->
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div><!-- /.col-->
	</div>	<!--/.main-->	

