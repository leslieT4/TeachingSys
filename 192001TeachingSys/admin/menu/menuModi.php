<?php
include "../../inc/log/check2.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>复旦大学后台管理系统-添加菜单</title>
	<link rel="stylesheet" type="text/css" href="../../inc/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../../inc/css/mystyle.css">
    <script type="text/javascript" src="../../inc/js/jquery.js"></script>
	<script type="text/javascript" src="../../inc/js/showhide.js"></script>
	<?php
	 require "../../inc/data/connAdmin.php";
	$menuName = $_GET["menu"];
	$sql = "select mhref,mtip
			from cait_menu
			where mname = ?";
	if ($stmt = $conn->prepare($sql)) {
		$stmt->bind_param("s",$menuName);
		$stmt->execute();
		$stmt->bind_result($mHref,$mTip);
		$stmt->store_result();
	}
	?>
</head>
<body>
	<!--导航栏-->
	<div class="top_link_admin">
		<a href="../admin.php"><img src="../../inc/pic/logo.png"></a>
		<ul>
		    <li><a href="school/tTask.php">菜单管理</a></li>
		    <li id="fathermenu_second">
				<a href="depAdmin.php">二级学院管理</a>
			</li>
		    <li id="fathermenu_first">
                <a href="#">教师管理</a>
            </li>
		    <li><a href="logout.php">学生管理</a></li>
            <li><a href="login.html">课程管理</a></li>
            <li><a href="login.html">教学任务查询管理</a></li>
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
    <div class="usersetting">
	    <form method="post" name="" action="menuModiDeal.php?menu=<?=$menuName?>" enctype="multipart/form-data">
		<?php
        while($stmt->fetch()){
        ?>
		<table border="1" cellpadding="0" cellspacing="0">
			    <tr>
				    <td>菜单名:</td>
                    <td><input type="text" value="<?=$menuName?>" name="menu_name" style="font-size:16px;"></td>
			    </tr>
			    <tr>
				    <td>超级链接目的地:</td>
                    <td><input type="text" value="<?=$mHref?>" name="links" style="font-size:16px;"></td>
			    </tr>
			    <tr>
				    <td>备注:</td>
                    <td><input type="text" value="<?=$mTip?>" name="tips" style="font-size:16px;"></td>
			    </tr>
			    <tr>
				    <td>老师权限:</td>
                    <td><input type="radio" name="te" value="有" style="margin-left:0" checked>有
					    <input type="radio" name="te" value="无">无</td>
			    </tr>
			    <tr>
				    <td>学生权限:</td>
                    <td><input type="radio" name="stu" value="有" style="margin-left:0" checked>有
					    <input type="radio" name="stu" value="无">无</td>
			    </tr>
			    <tr>
                    <td colspan="2">
                        <input type="submit" value="确定" name="">
                        <input type="reset" value="清空" name="">
                    </td>
			    </tr>
		    </table>
			<?php
			}
			?>
	    </form>
	</div>
	<!--当前的位置提示-->
	<div class="side">
		<p>当前位置：当前位置：添加菜单</p>
	</div>
	<!--版权-->
	<div class="footer">
		<p>Copyright© 2015-2020 复旦大学版权所有 地址：上海市杨浦区邯郸路220号 | 邮编：200433 | 电话：021-65643207 | 邮箱：urp@fudan.edu.cn</p>
	</div>
</body>
</html>