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
    $taskId = $_GET["taskid"];
    require "../../inc/data/connAdmin.php";
    $sql = "select cait_course.ccode,cname,taskterm,
            teid,cait_course.majorname,tasktime,cgrade,cait_task.stuclass,
            taskroom
            from cait_course,cait_task
            where cait_task.cid = cait_course.cid
            and cait_task.taskid = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i",$taskId);
        $stmt->execute();
        $stmt->bind_result($cCode,$cName,$taskTerm,$teId,$majorName,$taskTime,$cGrade,$stuClass,$taskRoom);
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
				<a href="depAdmin.php">二级学院管理</a>
			</li>
		    <li id="fathermenu_first">
                <a href="#">教师管理</a>
            </li>
		    <li><a href="../stu/stuAdmin.php">学生管理</a></li>
            <li><a href="courseAdmin.php">课程管理</a></li>
            <li><a href="taskAdmin.php">教学任务查询管理</a></li>
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
    <div class="coucfg">
        <h2>修改课程信息</h2>
        <form class="coucfgform" id="taskform" method="post" name="taskcfgform" action="taskModiDeal.php?taskid=<?=$taskId?>" enctype="multipart/form-data">
        <?php
        while($stmt->fetch()){
        ?>
            课程编码：
            <input type="text" readonly = "readonly" value="<?=$cCode?>" name="c_code"> </br>
            课程名称：
            <input type="text" readonly = "readonly" value="<?=$cName?>" name="c_name"> </br>
            适用年级：
            <input type="text" readonly = "readonly" value="<?=$cGrade?>" name="c_grade"> </br>
            适用专业：
            <input type="text" readonly = "readonly" value="<?=$majorName?>" name="major"> </br>
            学期：
            <input type="text" value="<?=$taskTerm?>" name="task_term"> </br>
            授课老师：
            <input type="text" value="<?=$teId?>" name="te_id"> </br>
            授课班级：
            <input type="text" value="<?=$stuClass?>" name="stu_class"> </br>
            授课时间：
            <input type="text" value="<?=$taskTime?>" name="task_time"> </br>
            授课地点：
            <input type="text" value="<?=$taskRoom?>" name="task_room"> </br>
        <?php
        }
        ?>
            <input type="submit">
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