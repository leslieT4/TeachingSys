<?php
include "../../inc/log/check2.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>复旦大学后台管理系统-专业管理</title>
	<link rel="stylesheet" type="text/css" href="../../inc/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../../inc/css/mystyle.css">
    <script type="text/javascript" src="../../inc/js/jquery.js"></script>
	<script type="text/javascript" src="../../inc/js/showhide.js"></script>
    <?php
    include "../../inc/data/connAdmin.php";
    $sql1 = "select stuclass,count(stuclass) from cait_stu group by stuclass";
    $re1 = $conn->query($sql1);
    while ($row = $re1->fetch_assoc()){
		# code...
	$stuSum[$row["stuclass"]] = $row["count(stuclass)"];
	}
    /*$sqlC = "select stuclass,count(stuclass)
            from cait_class,cait_stu 
            where cait_class.stuclass = cait_stu.stuclass 
            group by stuclass";
    $re7 = $conn->query($sqlC);
    // 5组 遍历查询结果
    while ($row = $re7->fetch_assoc()) {
        echo "{$row['stuclass']}{$row['count(stuclass)']}";
    }*/
    ?>
</head>
<body>
	<!--导航栏-->
	<div class="top_link_admin">
		<a href="../admin.php"><img src="../../inc/pic/logo.png"></a>
		<ul>
		    <li><a href="../menu/menuAdmin.php">菜单管理</a></li>
		    <li id="fathermenu_second">
				<a href="../dep/depAdmin.php">二级学院管理</a>
			</li>
		    <li id="fathermenu_first">
                <a href="#">教师管理</a>
            </li>
		    <li><a href="stuAdmin.php">学生管理</a></li>
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
	<div class="countbox">
    <form class="countform" method="post">
        <table border="1">
            <tr>
                <td>序号</td>
                <td>专业</td>
                <td>班级名称</td>
                <td>学生人数</td>
                <td>操作</td>
            </tr>
            <?php
            $sql = "select majorname,stuclass from cait_class";
            $re = $conn->query($sql);
            $i = 1;
            while($row = $re->fetch_assoc()){
            ?>
            <tr>
                <td><?=$i?></td>
                <td><?=$row["majorname"]?></td>
                <td><?=$row["stuclass"]?></td>
                <td><?=$stuSum[$row["stuclass"]]?></td>
                <td><a href="stuShow.php?stuclass=<?=$row['stuclass']?>">查看班级学生</a></td>
            </tr>
            <?php $i++;
            }
            ?>
        </table>
    </form>
    <p>批量导入学生（不允许重复导入）：</p> </br>
    <form method="post" action="stuExImport.php" enctype="multipart/form-data">
        <input type="file" name="stufile">
        <input type="submit" value="确定">
        <input type="button" value="下载模板">
    </form>
	</div>
	<!--当前的位置提示-->
	<div class="side">
		<p>当前位置：二级学院管理</p>
	</div>
	<!--版权-->
	<div class="footer">
		<p>Copyright© 2015-2020 复旦大学版权所有 地址：上海市杨浦区邯郸路220号 | 邮编：200433 | 电话：021-65643207 | 邮箱：urp@fudan.edu.cn</p>
	</div>
</body>
</html>