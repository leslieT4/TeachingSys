<?php
include "../../inc/log/check2.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>复旦大学后台管理系统-学生管理</title>
	<link rel="stylesheet" type="text/css" href="../../inc/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../../inc/css/mystyle.css">
    <script type="text/javascript" src="../../inc/js/jquery.js"></script>
	<script type="text/javascript" src="../../inc/js/showhide.js"></script>
    <?php
    include "../../inc/data/connAdmin.php";
    $stu_Class = $_GET["stuclass"];
    $sql = "select cait_stu.stuclass,cait_stu.stuid,cait_stu.stuname
            from cait_stu
            where cait_stu.stuclass = ?";
    if ($stmt = $conn->prepare($sql)){
        $stmt->bind_param('s',$stu_Class);
        $stmt->execute();
        $stmt->bind_result($stuClass,$stuId,$stuName);
        $stmt->store_result();
    }
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
        <?php
        if ($stmt->num_rows > 0){
        ?>
        <table border="1">
            <tr>
                <td>序号</td>
                <td>学生学号</td>
                <td>学生姓名</td>
                <td>班级</td>
                <td>操作</td>
            </tr>
            <?php
            $i = 1;
            while($stmt->fetch()){
            echo <<<END
            <tr>
                <td>$i</td>
                <td>$stuId</td>
                <td>$stuName</td>
                <td>$stuClass</td>
                <td><a href="stuReset.php?id=$stuId">重置密码</a>|<a href="stuChangeClass.php?id=$stuId & name=$stuName">转班</a></td>
            </tr>
END;
            $i++;
            }
            ?>
        </table>
        <?php
        }
        else{
            echo "暂无记录";
        }
        ?>
    </form>
	</div>
	<!--当前的位置提示-->
	<div class="side">
		<p>当前位置：二级学院管理</p>
	</div>
	<!--版权-->
	<div class="footer" style="margin-top:800px;">
		<p>Copyright© 2015-2020 复旦大学版权所有 地址：上海市杨浦区邯郸路220号 | 邮编：200433 | 电话：021-65643207 | 邮箱：urp@fudan.edu.cn</p>
	</div>
</body>
</html>