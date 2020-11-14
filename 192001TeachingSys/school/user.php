<?php
include "../inc/log/session2.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>复旦大学教务管理系统-用户设置</title>
	<link rel="stylesheet" type="text/css" href="../inc/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../inc/css/mystyle.css">
	<script type="text/javascript" src="../inc/js/jquery.js"></script>
	<script type="text/javascript" src="../inc/js/jquery.validate.min.js"></script>
	<script type="text/javascript" src="../inc/js/showhide.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$("#modipas").validate({
				rules:{
					oldpa:{
						required:true,
						minlength:6,
						maxlength:16,
					},
					newpa1:{
						required:true,
						minlength:6,
						maxlength:16,
					},
					newpa2:{
						equalTo:"#newpa1",
					},
				},
				messages:{
					oldpa:{
						required:"<span class='tip'>请输入旧密码</span>",
						minlength:"<span class='tip'>旧密码至少6位字符</span>",
						maxlength:"<span class='tip'>旧密码最多16位字符</span>",
					},
					newpa1:{
						required:"<span class='tip'>请输入新密码</span>",
						minlength:"<span class='tip'>新密码至少6位字符</span>",
						maxlength:"<span class='tip'>新密码最多16位字符</span>",
					},
					newpa2:{
						equalTo:"<span class='tip'>两次密码不一致</span>",
					},
				}
			})
		})
	</script>
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
	    <form method="post" action="modiPa.php" id="modipas">
		    <table border="1" cellpadding="0" cellspacing="0">
			    <tr>
				    <td>用户名：</td>
				    <td><input type="text" value="<?=$_SESSION["userid"]?>" disabled="disabled"></td>
			    </tr>
			    <tr>
				    <td>旧密码：</td>
				    <td><input type="password" name="oldpa" id="oldpa"></td>
			    </tr>
			    <tr>
				    <td>新密码：</td>
				    <td><input type="password" name="newpa1" id="newpa1"></td>
			    </tr>
			    <tr>
				    <td>新密码确认：</td>
				    <td><input type="password" name="newpa2" id="newpa2"></td>
			    </tr>
			    <tr>
				    <td>E-mail：</td>
				    <td><input type="email" name=""></td>
			    </tr>
			    <tr>
			    	<td colspan="2"><input type="submit" value="确定" name="">   <input type="reset" value="清空" name=""></td>
			    </tr>
		    </table>
	    </form>
	</div>
	<div class="side">
		<p>当前位置：教师-用户设置</p>
	</div>
	<div class="footer">
		<p>Copyright© 2015-2020 复旦大学版权所有 地址：上海市杨浦区邯郸路220号 | 邮编：200433 | 电话：021-65643207 | 邮箱：urp@fudan.edu.cn</p>
	</div>
</body>
</html>