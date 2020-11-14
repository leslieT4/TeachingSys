<?php
include "../inc/log/session2.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>复旦大学教务管理系统-上传头像</title>
	<link rel="stylesheet" type="text/css" href="../inc/css/reset.css">
    <link rel="stylesheet" type="text/css" href="../inc/css/mystyle.css">
    <script type="text/javascript" src="../inc/js/jquery.js"></script>
    <script type="text/javascript" src="../inc/js/showhide.js"></script>
</head>
<body>
	<!--导航栏-->
	<div class="top_link">
		<a href="../index.php"><img src="../inc/pic/logo.png"></a>
		<?php
		include "../inc/data/conn.php";
		$sqlA = "select mname,mhref,mte,mstu from cait_menu";
		$menuRe = $conn->query($sqlA);
		while($menuRow = $menuRe->fetch_assoc()){
			if (($_SESSION["Role"] == "stu" and $menuRow["mstu"] == "有") or
			($_SESSION["Role"] == "te" and $menuRow["mte"] == "有")){
		?>
		<ul>
		<li><a href="<?=$menuRow['mhref']?>"><?=$menuRow['mname']?></a></li>
		</ul>
		<?php
			}
		}
		?>
	</div>

	<!--欢迎-->
	<div class="Con_box">
		<img src="../inc/pic/shouye1.jpg">
		<h2>复旦大学教务系统欢迎您！</h2>
	</div>
	<div class="person">
		<img src="../inc/upload/<?=$_SESSION["pic"]?>">
		<h2>您好！<?=$_SESSION["user"]?> &nbsp;&nbsp;<?=$_SESSION["Roleid"]?>:<?=$_SESSION["userid"]?>&nbsp;&nbsp;&nbsp;系：计算机学院</h2>
	</div>
	<!--密码修改-->
	<div class="usersetting">
	    <form method="post" action="doPortrait.php" id="do_user" enctype="multipart/form-data">
            <table border="1" cellpadding="0" cellspacing="0">
			    <tr>
				    <td>上传头像:</td>
				    <td><input type="file" name="portrait"></td>
			    </tr>
			    <tr>
                    <td colspan="2">
                        <input type="submit" value="确定" name="">
                    </td>
			    </tr>
		    </table>
	    </form>
	</div>
	<div class="side">
		<p>当前位置：教师-上传头像</p>
	</div>
	<div class="footer">
		<p>Copyright© 2015-2020 复旦大学版权所有 地址：上海市杨浦区邯郸路220号 | 邮编：200433 | 电话：021-65643207 | 邮箱：urp@fudan.edu.cn</p>
	</div>
</body>
</html>