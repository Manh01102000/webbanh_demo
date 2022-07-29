<?php
if (!defined('hang')) {
    die('ban truy cap sai cach');
}
?>
<style>
    #toolbar ul {
        padding: 0;
    }

    #toolbar ul li {
        list-style: none;
        margin-top: 10px;
    }
</style>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><svg class="glyph stroked home">
                        <use xlink:href="#stroked-home"></use>
                    </svg></a></li>
            <li class="active">Cấu hình Website</li>
        </ol>
    </div>
    <!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Danh sách cấu hình</h1>
        </div>
    </div>
    <!--/.row-->
    <div id="toolbar" class="btn-group">
        <ul>
            <li>
                <a href="index.php?page_layout=logo" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Cấu hình logo </a>
            </li>
            <li>
                <a href="index.php?page_layout=setting_title" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Cấu hình Title </a>
            </li>
            <li>
                <a href="index.php?page_layout=setting_footer" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Cấu hình chân trang</a>
            </li>
            <li>
                <a href="index.php?page_layout=number_comment" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Cấu hình số bình luận một trang </a>
            </li>
            <li>
                <a href="index.php?page_layout=number_product" class="btn btn-success"><i class="glyphicon glyphicon-plus"></i> Cấu hình số sản phẩm một trang (Sản phẩm nổi bật) </a>
            </li>
        </ul>
    </div>
    <!--/.row-->
</div>
<!--/.main-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/bootstrap-table.js"></script>