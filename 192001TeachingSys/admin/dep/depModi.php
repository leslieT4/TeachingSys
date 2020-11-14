<?php
include "../../inc/log/check2.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>复旦大学教务管理系统-首页</title>
	<link rel="stylesheet" type="text/css" href="../../inc/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../../inc/css/mystyle.css">
    <script type="text/javascript" src="../../inc/js/jquery.js"></script>
	<script type="text/javascript" src="../../inc/js/showhide.js"></script>
	<?php
	$dep = $_GET["dep"];
	?>
</head>
<body>
	<!--导航栏-->
	<div class="top_link_admin">
		<a href="../admin.php"><img src="../../inc/pic/logo.png"></a>
		<ul>
		    <li><a href="../menu/menuAdmin.php">菜单管理</a></li>
		    <li id="fathermenu_second">
				<a href="depAdmin.php">二级学院管理</a>
			</li>
		    <li id="fathermenu_first">
                <a href="#">教师管理</a>
            </li>
		    <li><a href="../stu/stuAdmin.php">学生管理</a></li>
            <li><a href="../cou/courseAdmin.php">课程管理</a></li>
            <li><a href="../cou/taskAdmin.php">教学任务查询管理</a></li>
            <li><a href="../adminQuit.php">注销</a></li>
	    </ul>
	</div>
	<!--欢迎-->
	<div class="Con_box">
		<img src="../../inc/pic/shouye1.jpg">
		<h2>复旦大学后台管理系统欢迎您！</h2>
	</div>
	<div class="person">
		<img src="../../inc/upload/<?=$_SESSION["pic"]?>">
		<h2>您好！<?=$_SESSION["user"]?></h2>
    </div>
    <div class="depcfg">
	    <form class="depcfgform" method="post" name="depcfgform" action="depModiDeal.php" enctype="multipart/form-data">
            <table border="1" cellpadding="0" cellspacing="0">
			    <tr>
				    <td width="200px">二级学院原名:</td>
                    <td><input type="text" name="depOlN" id="depOlN" value="<?=$dep?>" style="font-size:16px;"></td>
                    <td width="200px">二级学院的新名字:</td>
				    <td><input type="text" name="depNewN" id="depNewN" style="font-size:16px;"></td>
			    </tr>
			    <tr>
                    <td colspan="4">
                        <input type="submit" value="确定" name="">
                        <input type="reset" value="清空" name="">
                    </td>
			    </tr>
		    </table>
	    </form>
	</div>
	<!--当前的位置提示-->
	<div class="side">
		<p>当前位置：当前位置：添加二级学院</p>
	</div>
	<!--版权-->
	<div class="footer">
		<p>Copyright© 2015-2020 复旦大学版权所有 地址：上海市杨浦区邯郸路220号 | 邮编：200433 | 电话：021-65643207 | 邮箱：urp@fudan.edu.cn</p>
	</div>
</body>
</html>