<?php
if (!defined('hang')) {
    die('Bạn không có quyền truy cập file account');
}
include("connect.php");
$mail=$_SESSION['mail'];
$pass=$_SESSION['pass'];
$sql="SELECT * FROM user WHERE user_mail='$mail' AND user_pass='$pass'";
$query=mysqli_query($conn, $sql);
$row=mysqli_fetch_array($query);
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li>
                <a href="#">
                    <svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg>
                </a>
            </li>
            <li class="active">Tài khoản: <?php if($row['user_level']==2){ echo "Biên tập viên";} else{ echo "Admin";}?></li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Thành viên: <?php if($row['user_level']==2){ echo "Biên tập viên";} else{ echo "Admin";}?></h1>
        </div>
    </div>
    <!--/.row-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-body">
                    <table data-toolbar="#toolbar" data-toggle="table">
                        <thead>
                            <tr>
                                <th data-field="id" data-sortable="true">ID</th>
                                <th data-field="name" data-sortable="true">Họ & Tên</th>
                                <th data-field="price" data-sortable="true">Email</th>
                                <th>Quyền</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                    <td style=""><?php echo $row['user_id'];?></td>
                                    <td style=""><?php echo $row['user_full'];?></td>
                                    <td style=""><?php echo $row['user_mail'];?></td>
                                    <td><span class="label label-<?php if($row['user_level']==1){echo "danger";}else{echo 'success';}?>"><?php if($row['user_level']==2){ echo "Biên tập viên";} else{ echo "Admin";}?></span></td>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--/.row-->
</div>
<!--/.main-->

<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>