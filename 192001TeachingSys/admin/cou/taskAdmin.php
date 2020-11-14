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
    <script type="text/javascript" src="../../inc/js/ajax.js"></script>
    <?php
    include "../../inc/data/connAdmin.php";
    $sql_de = "select depname from cait_dep";
    if ($stmtDe = $conn->prepare($sql_de)) {
        $stmtDe->execute();
        $stmtDe->bind_result($depName);
        $stmtDe->store_result();
    }
    $sql_ma = "select majorname from cait_major";
    if ($stmtMa = $conn->prepare($sql_ma)) {
		$stmtMa->execute();
		$stmtMa->bind_result($majorName);
		$stmtMa->store_result();
    }
    $sql_grade = "select cgrade from cait_course";
    if ($stmtGr = $conn->prepare($sql_grade)) {
		$stmtGr->execute();
		$stmtGr->bind_result($cGrade);
		$stmtGr->store_result();
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
	<div class="courseBox">
    <p>批量导入教学任务</p> </br>
    <form method="post" action="taskExImport.php" enctype="multipart/form-data">
        <input type="file" name="taskfile">
        <input type="submit" value="确定">
        <a href="downTaskTemp.php"><input type="button" value="下载模板"></a>
    </form>
    <form method="post" action="" name="TaskSe">
    <h2 class="seTa">新学期教学任务查询</h2>
    学年
	<select name="studyY" id="studyy">
		<?php
		if(date("m") < 7) {
            $thisYear = date("Y");
        }
        else{
            $thisYear = date("Y")+1;
        }
        while($thisYear>=2003){
            $showY = ($thisYear-1) . "-" . $thisYear;
            $valueY = substr(($thisYear-1),2).substr(($thisYear),2);
            echo <<<END
            <option value="$valueY">$showY</option>
END;
            $thisYear--;
        }
		?>
	</select>
    学期
	<select name="term" id="">
		<option value="01"  selected>1</option>
		<option value="02">2</option>
	</select>
    系：
    <select name="depname" id="dep">
		<option value="">请选择二级学院</option>
		<?php
		if ($stmtDe->num_rows > 0){
			while($stmtDe->fetch())
			{
				echo <<<END
			    	<option value="$depName">$depName</option>
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
    </br>
    按专业查询>>专业：
    <select name="major" id="mar">
		<option value="">请选择专业</option>
		<?php
		if ($stmtMa->num_rows > 0){
			while($stmtMa->fetch())
			{
				echo <<<END
			    	<option value="$majorName">$majorName</option>
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
    选择年级：
    <select name="grade" id="gr">
		<?php
		if ($stmtGr->num_rows > 0){
			while($stmtGr->fetch())
			{
				echo <<<END
			    	<option value="$cGrade">$cGrade 级</option>
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
    </br>
    <input type="button" value="查询" name="s1" onclick="showData(document.TaskSe.studyY.value+document.TaskSe.term.value+document.TaskSe.grade.value+document.TaskSe.major.value,'taskArea','../ajaxPhp/getTask.php',1)">
    </form>
    </div>
    <div class="query_result2" id="taskArea">

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