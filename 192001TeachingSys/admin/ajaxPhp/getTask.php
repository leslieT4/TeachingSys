<?php
include "../../inc/log/check2.php"
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "../../inc/data/connAdmin.php";
$txt = $_GET['q'];
$taskTerm = substr($txt, 0 , 6);
$cGarde = substr($txt, 6, 10);
$endTxt = substr($txt, 10);
$x = $_GET["x"];
	
if ($x == 1) {
	$major_name = $endTxt;
    $sql = "select cait_course.ccode,cname,taskterm,cweekh,cweek,
            ctype,cait_task.stuclass,tename,taskid
            from cait_course,cait_task,cait_te
			where cait_task.cid = cait_course.cid
			and cait_te.teid = cait_task.teid
            and cait_task.taskterm = ?
			and cait_course.cgrade = ?
			and cait_course.majorname = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("iis",$taskTerm,$cGarde,$major_name);
}
else{
	exit();
}
$stmt->execute();
$stmt->bind_result($cCode,$cName,$taskTerm,$cWeekh,$cWeek,$cType,$stuClass,$teName,$taskId);
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
					<th>课程编号</th>
					<th>课程名称</th>
					<th>开课学期</th>
					<th>周课时</th>
                    <th>起止周</th>
                    <th>课程类型</th>
					<th>开课班级</th>
                    <th>授课教师</th>
                    <th>操作</th>
				</tr>
				<?php
				while($stmt->fetch()){
                ?>
						<tr>
							<td><?=$cCode?></td>
							<td><?=$cName?></td>
							<td><?=$taskTerm?></td>
							<td><?=$cWeekh?></td>
							<td><?=$cWeek?></td>
							<td><?=$cType?></td>
                            <td><?=$stuClass?></td>
                            <td><?=$teName?></td>
                            <td><a href="#" onclick="if(confirm('确定要删除taskid为“<?=$taskId?>”的教学任务吗”吗?'))
                            location='taskDel.php?taskid=<?=$taskId?>'">删除</a>|
                            <a href="taskModi.php?taskid=<?=$taskId?>">修改</a></td>
                        </tr>
                <?php
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