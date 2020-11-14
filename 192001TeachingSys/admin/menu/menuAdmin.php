<?php
include "../../inc/log/check2.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>复旦大学后台管理系统-菜单管理</title>
	<link rel="stylesheet" type="text/css" href="../../inc/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../../inc/css/mystyle.css">
    <script type="text/javascript" src="../../inc/js/jquery.js"></script>
	<script type="text/javascript" src="../../inc/js/showhide.js"></script>
	<?php
	include "../../inc/data/connAdmin.php";
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
    <div class="countbox">
    <div style="width:90px;height:25px;background-color:#3e50b4;text-align:center;font-weight: bold;float: right;"><a href="menuAdd.php" style='color:white;'>添加菜单</a></div>
	<form class="countform" method="post">
        <table border="1">
            <tr>
                <td>序号</td>
                <td>菜单名称</td>
                <td>超级链接目的地</td>
                <td>备注</td>
                <td>教师权限</td>
                <td>学生权限</td>
                <td width="90px">操作修改</td>
            </tr>
            <?php
            $sql = "select mname,mhref,mtip,mte,mstu from cait_menu";
            $re = $conn->query($sql);
            $i = 1;
            while($row = $re->fetch_assoc()){
            ?>
            <tr>
                <td><?=$i?></td>
                <td><?=$row["mname"]?></td>
                <td><a href="../../school/<?=$row["mhref"]?>"><?=$row["mhref"]?></a></td>
                <td><?=$row["mtip"]?></td>
                <td><?=$row["mte"]?></td>
                <td><?=$row["mstu"]?></td>
                <td><a href="menuModi.php?menu=<?=$row['mname']?>">修改</a>|<a href="#" 
                onclick="if(confirm('确定要删除“<?=$row['mname']?>菜单”？吗 \n 提示：删除菜单会导致其下所有的老师、二级学院、班级和学生信息被删除！'))
                location='menuDel.php?menu=<?=$row['mname']?>'">删除</a></td>
            </tr>
            <?php $i++; }?>
        </table>
    </form>
    </div>
    <!--当前的位置提示-->
	<div class="side">
		<p>当前位置：菜单管理</p>
	</div>
	<!--版权-->
	<div class="footer">
		<p>Copyright© 2015-2020 复旦大学版权所有 地址：上海市杨浦区邯郸路220号 | 邮编：200433 | 电话：021-65643207 | 邮箱：urp@fudan.edu.cn</p>
	</div>
</body>
</html>