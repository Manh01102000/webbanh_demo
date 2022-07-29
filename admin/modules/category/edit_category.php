
    <?php
    if(!defined('hang')){
        die('ban truy cap sai cach');
    }
    $cat_id=$_GET['id'];
    $sql="SELECT*FROM category WHERE cat_id=$cat_id";
    $query=mysqli_query($conn, $sql);
    $row=mysqli_fetch_array($query);
    if(isset($_POST['sbm'])){
        $cat_name=$_POST['cat_name'];
        $title=$_POST['title'];
        $sql_UPDATE="UPDATE category SET cat_name='$cat_name', title='$title' WHERE cat_id='$cat_id'";
        mysqli_query($conn, $sql_UPDATE);
        header('location: index.php?page_layout=category');
    }
    ?>			
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#"><svg class="glyph stroked home"><use xlink:href="#stroked-home"></use></svg></a></li>
				<li><a href="">Quản lý danh mục</a></li>
				<li class="active"><?php echo $row['cat_name'];?></li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Danh mục:<?php echo $row['cat_name'];?></h1>
			</div>
		</div><!--/.row-->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="col-md-8">
                            <div class="alert alert-danger">Danh mục đã tồn tại !</div>
                        <form role="form" method="post">
                            <div class="form-group">
                                <label>Tên danh mục:</label>
                                <input type="text" name="cat_name" required value="<?php echo $row['cat_name'];?>" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <div class="form-group">
                                <label>Title danh mục:</label>
                                <input type="text" name="title" required value="<?php echo $row['title'];?>" class="form-control" placeholder="Tên danh mục...">
                            </div>
                            <button type="submit" name="sbm" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div><!-- /.col-->
	</div>	<!--/.main-->	

