<!DOCTYPE html>
<html lang="en">
<?php
include "../../inc/data/conn.php";
$txt = $_GET["q"];
$taskTerm = substr($txt,0,6);
$endTxt = substr($txt,6);
// x:1为班级查询；2为课程查询
$x = $_GET["x"];
if($x == 1){ //班级查询成绩
	$stuClass = $endTxt;
	$sql = "select 
			cait_stu.stuid,cait_stu.stuname,
			cait_course.cname,cait_course.ccode,cait_course.ctype,cait_course.cexam,
			cait_course.cpoint,cait_score.scoverall,cait_score.scmakeup,
			cait_score.scagain from cait_task,cait_score,
			cait_stu,cait_course
			where cait_task.stuclass= ? 
			and cait_task.taskterm = ? 
			and cait_task.taskid = cait_score.taskid
			and cait_task.cid = cait_course.cid
			and cait_score.stuid = cait_stu.stuid";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("si",$stuClass,$taskTerm);
}
elseif($x == 2){ //课程查询成绩
	$ciid = $endTxt;
	$sql = "select 
			cait_stu.stuid,cait_stu.stuname,
			cait_course.cname,cait_course.ccode,cait_course.ctype,
			cait_course.cexam,cait_course.cpoint,cait_score.scoverall,
			cait_score.scmakeup,cait_score.scagain from cait_task,cait_score,
			cait_stu,cait_course
			where cait_task.cid = ? 
			and cait_task.taskterm = ? 
			and cait_task.taskid = cait_score.taskid
			and cait_task.cid = cait_course.cid
			and cait_score.stuid = cait_stu.stuid";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("ii",$ciid,$taskTerm);
}
else{
	exit();
}
$stmt->execute();
$stmt->bind_result($stuId,$stuName,$cName,$cCode,$cType,$cExam,$cPoint,$scOverall,$scMakeup,$scAgain);
$stmt->store_result();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form>
				<tr>
					<td colspan="2">
						<table border="1">
							<tr>
								<td>学年学期</td>
								<td>学号</td>
								<td>姓名</td>
								<td>课程名称</td>
								<td>课程代码</td>
								<td>课程类型</td>
								<td>考核方式</td>
								<td>总评成绩</td>
								<td>补考成绩</td>
								<td>重修成绩</td>
								<td>学分</td>
							</tr>
                            <?php
                            for ($i = 1;$i <=1000 and $stmt->fetch();$i++){
                            ?>
							<tr>
								<td><?=$taskTerm?></td>
								<td><?=$stuId?></td>
								<td><?=$stuName?></td>
								<td><?=$cName?></td>
								<td><?=$cCode?></td>
								<td><?=$cType?></td>
								<td><?=$cExam?></td>
								<td><input type="text" value="<?=$scOverall?>"></td>
								<td><input type="text" value="<?=$scMakeup?>"></td>
								<td><input type="text" value="<?=$scAgain?>"></td>
								<td><input type="text" value="<?=$cPoint?>"></td>
							</tr>
                            <?php
                            }
                            ?>
						</table>
					</td>
				</tr>
			</table>
		</form>
</body>
</html>