<!DOCTYPE html>
<html lang="en">
<?php
include "../../inc/data/conn.php";
$txt = $_GET['q'];
$taskTerm = substr($txt, 0 , 6);
$endTxt = substr($txt, 6);
//x=1 查询学年学期+系
//x=2 查询学年学期+班级
//x=3 查询学年学期+课程
//x=4 查询学年学期+教师
$x = $_GET["x"];
	
if ($x == 1) {
		//x=1 查询学年学期+系
	$depName = $endTxt;
	$sql = "select cait_te.tename,
			cait_course.cname,cait_course.ctype,cait_course.cweekh,cait_course.cweek,
			cait_course.ctotalh,cait_course.cexam,cait_task.stuclass
			from cait_task,cait_major,cait_course,cait_te
			where cait_task.teid = cait_te.teid
			and cait_major.majorname = cait_course.majorname
			and cait_course.cid = cait_task.cid
			and cait_task.taskterm = ?
			and cait_major.depname = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("is",$taskTerm,$depName);
}
elseif ($x == 2) {
	//x=2 查询学年学期+班级
	$stuClass = $endTxt;
	$sql = "select cait_te.tename,
			cait_course.cname,cait_course.ctype,cait_course.cweekh,cait_course.cweek,
			cait_course.ctotalh,cait_course.cexam,cait_task.stuclass
			from cait_task,cait_course,cait_te
			where cait_task.cid = cait_course.cid
			and cait_task.teid = cait_te.teid
			and taskterm = ?
			and stuclass = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("is",$taskTerm,$stuClass);
}
elseif ($x == 3) {
	//x=3 查询学年学期+课程
	$cId = $endTxt;
	$sql = "select cait_te.tename,
			cait_course.cname,cait_course.ctype,cait_course.cweekh,cait_course.cweek,
			cait_course.ctotalh,cait_course.cexam,cait_task.stuclass
			from cait_task,cait_te,cait_course
			where cait_task.cid = cait_course.cid
			and cait_task.teid = cait_te.teid
			and taskterm = ?
			and cait_task.cid = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ii",$taskTerm,$cId);
}
elseif ($x == 4) {
	//x=4 查询学年学期+教师
	$teId = $endTxt;
	$sql = "select cait_te.tename,
			cait_course.cname,cait_course.ctype,cait_course.cweekh,cait_course.cweek,
			cait_course.ctotalh,cait_course.cexam,cait_task.stuclass
			from cait_task,cait_te,cait_course
			where cait_task.cid = cait_course.cid
			and cait_task.teid = cait_te.teid
			and taskterm = ?
			and cait_te.teid = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ii",$taskTerm,$teId);
}
else{
	exit();
}
$stmt->execute();
$stmt->bind_result($teName,$cName,$cType,$cWeekH,$cWeek,$cTotalH,$cExam,$stuClass);
//第四步,5组
$stmt->store_result();
?>


<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
	if ($stmt->num_rows > 0){
	?>
			<table border="1">
				<tr>
					<th>班级名称</th>
					<th>任课教师</th>
					<th>课程名称</th>
					<th>课程类型</th>
					<th>周课时</th>
					<th>起止周</th>
					<th>总课时</th>
					<th>考核方式</th>
				</tr>
				<?php
				while($stmt->fetch()){
					echo <<<END
						<tr>
							<td>$stuClass</td>
							<td>$teName</td>
							<td>$cName</td>
							<td>$cType</td>
							<td>$cWeekH</td>
							<td>$cWeek</td>
							<td>$cTotalH</td>
							<td>$cExam</td>
					    </tr>
END;
				}
				?>	
			</table>
	<?php
	}
	else{
		echo "查询结果为空！";
	}
	?>	
</body>
</html>