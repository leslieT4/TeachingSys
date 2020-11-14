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
    $cId = $_GET["cid"];
    require "../../inc/data/connAdmin.php";
    $sql = "select ctype from cait_course";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->execute();
        $stmt->bind_result($cType);
        $stmt->store_result();
    }
    $sqle = "select cexam from cait_course";
    if ($stmtE = $conn->prepare($sqle)) {
        $stmtE->execute();
        $stmtE->bind_result($cExam);
        $stmtE->store_result();
    }
    $sqlmo = "select cait_course.ccode,cname,cterm,cpoint,cweekh,cweek,
            ctype,cexam,cait_course.majorname,cgrade,ctotalh
            from cait_course
            where cait_course.cid = ?";
    if ($stmtMo = $conn->prepare($sqlmo)) {
        $stmtMo->bind_param("i",$cId);
        $stmtMo->execute();
        $stmtMo->bind_result($cCode,$cName,$cTerm,$cPoint,$cWeekh,$cWeek,$cType,$cExam,$majorName,$cGrade,$cTotalh);
        $stmtMo->store_result();
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
        <form class="coucfgform" method="post" name="coucfgform" action="courseModiDeal.php?cid=<?=$cId?>" enctype="multipart/form-data">
        <?php
        while($stmtMo->fetch()){
        ?>
            课程编码：
            <input type="text" value="<?=$cCode?>" name="c_code"> </br>
            课程名称：
            <input type="text" value="<?=$cName?>" name="c_name"> </br>
            适用年级：
            <input type="text" value="<?=$cGrade?>" name="c_grade"> </br>
            适用专业：
            <input type="text" value="<?=$majorName?>" name="major"> </br>
            学期：
            <input type="text" value="<?=$cTerm?>" name="c_term"> </br>
            学分：
            <input type="text" value="<?=$cPoint?>" name="c_point"> </br>
            周学时：
            <input type="text" value="<?=$cWeekh?>" name="c_weekh"> </br>
            起止周：
            <input type="text" value="<?=$cWeek?>" name="c_week"> </br>
            总学时：
            <input type="text" value="<?=$cTotalh?>" name="c_totalh"> </br>
        <?php
        }
        ?>
            课程类型：
            <select name="c_type" id="type">
		    <option value="">请选择课程类型</option>
		    <?php
		    if ($stmt->num_rows > 0){
			    while($stmt->fetch())
			    {
				    echo <<<END
			    	<option value="$cType">$cType</option>
END;
			    }
		    }
		    else{
			    echo <<<END
			    <option value="">暂无数据</option>
END;
			    		
		    } 
		    ?>
            </select> </br>
            考核方式：
            <select name="c_exam" id="exam">
		    <option value="">请选择考核方式</option>
		    <?php
		    if ($stmtE->num_rows > 0){
			    while($stmtE->fetch())
			    {
				    echo <<<END
			    	<option value="$cExam">$cExam</option>
END;
			    }
		    }
		    else{
			    echo <<<END
			    <option value="">暂无数据</option>
END;
			    		
		    } 
		    ?>
            </select>
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