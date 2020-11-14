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
    // 5组 统计专业
    $sql = "select depname,count(depname)
            from cait_major group by depname";
    $re1 = $conn->query($sql);
    // 5组 遍历查询结果
    $re1 -> data_seek(0);
    while ($row = $re1->fetch_assoc()) {
        $mSum[$row["depname"]] = $row["count(depname)"];
    }
    // 5组 统计班级
    $sql = "select depname,count(depname)
            from cait_class,cait_major 
            where cait_class.majorname = cait_major.majorname 
            group by depname";
    $re2 = $conn->query($sql);
    // 5组 遍历查询结果
    $re2 -> data_seek(0);
    while ($row = $re2->fetch_assoc()) {
        $cSum[$row["depname"]] = $row["count(depname)"];
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
    <div class="addDep">
        <input type="button" value="添加学院" onclick="window.location.href='depAdd.php'">
    </div>
	<div class="countbox">
    <form class="countform" method="post">
        <table border="1">
            <tr>
                <td>序号</td>
                <td>二级学院名称</td>
                <td>专业数</td>
                <td>班级数</td>
                <td>操作</td>
                <td>操作</td>
            </tr>
            <?php
            $sql = "select depname from cait_dep";
            $re = $conn->query($sql);
            $i = 1;
            while($row = $re->fetch_assoc()){
            ?>
            <tr>
                <td><?=$i?></td>
                <td><?=$row["depname"]?></td>
                <td><?=$mSum[$row["depname"]]?></td>
                <td><?=$cSum[$row["depname"]]?></td>
                <td><a href="depModi.php?dep=<?=$row['depname']?>">修改</a>|<a href="#" 
                onclick="if(confirm('确定要删除“<?=$row['depname']?>学院”？吗 \n 提示：删除二级学院会导致其下所有的老师、二级学院、班级和学生信息被删除！'))
                location='depDel.php?dep=<?=$row['depname']?>'">删除</a></td>
                <td><a href="majorAdmin.php?dep=<?=$row['depname']?>">管理专业</a>|<a href="classAdmin.php?dep=<?=$row['depname']?>">管理班级</a></td>
            </tr>
            <?php $i++; }?>
        </table>
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