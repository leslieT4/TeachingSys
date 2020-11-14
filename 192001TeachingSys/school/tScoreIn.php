<?php
include "../inc/log/session2.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>复旦大学教务管理系统-教师成绩录入</title>
	<link rel="stylesheet" type="text/css" href="../inc/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../inc/css/mystyle.css">
	<script type="text/javascript" src="../inc/js/ajax.js"></script>
	<script type="text/javascript" src="../inc/js/jquery.js"></script>
	<script type="text/javascript" src="../inc/js/showhide.js"></script>
</head>
<body>
	<?php
	include "../inc/data/conn.php";
	$userId = $_SESSION["userid"];
	$sql = "select cait_task.taskid,cait_task.stuclass,cait_course.cname 
	from cait_task,cait_course 
	where cait_task.teid = ?
	and cait_course.cid = cait_task.cid";
	$result = $conn->prepare($sql);
	$result->bind_param("i",$userId);
	$result->execute();
	$result->bind_result($taskId,$stuClass,$cName);
	$result->store_result();
	?>
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
	<!--查询条件-->
	<div class="query_terms">
		<h2>查询条件</h2>
		<form action="" id="select-in" name="selectin">
			请选择录入成绩的课程：
			<select name="task" id="task">
				<?php
				if ($result->num_rows > 0){
					while ($result->fetch()){
						echo <<<END
						<option value="$taskId $stuClass">$stuClass $cName</option>
END;
					}
				}
				else{
					echo <<<END
					<option vlaue="">暂无记录</option>
END;
				}
				?>
			</select>
			<input type="button" value="查询" onclick="showData(document.selectin.task.value,'scoreArea','ajax/getScoreIn.php',1);">
		</form>
	</div>
	<!--录入成绩-->
	<div class="scoreRecord" id="scoreArea">
	
	</div>
	<!--当前的位置提示-->
	<div class="side">
		<p>当前位置：学生-成绩录入</p>
	</div>
	<!--版权-->
	<div class="footer">
		<p>Copyright© 2015-2020 复旦大学版权所有 地址：上海市杨浦区邯郸路220号 | 邮编：200433 | 电话：021-65643207 | 邮箱：urp@fudan.edu.cn</p>
	</div>
</body>
</html>