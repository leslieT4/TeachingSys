<?php
include "../../inc/log/check2.php"
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "../../inc/data/connAdmin.php";
$txt = $_GET['q'];
$cTerm = substr($txt, 0 , 1);
$endTxt = substr($txt, 1);
$x = $_GET["x"];
	
if ($x == 1) {
	$depName = $endTxt;
    $sql = "select cait_course.cid,cname,cterm,cpoint,cweekh,cweek,
            ctype,cexam,cait_course.majorname,cgrade
            from cait_course,cait_major
            where cait_course.majorname = cait_major.majorname
            and cait_course.cterm = ?
            and cait_major.depname = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("is",$cTerm,$depName);
}
elseif ($x == 2) {
	$majorName = $endTxt;
	$sql = "select cait_course.cid,cname,cterm,cpoint,cweekh,cweek,
            ctype,cexam,cait_course.majorname,cgrade
			from cait_course
            where cait_course.cterm = ?
            and cait_course.majorname = ?";
	$stmt = $conn->prepare($sql);
	$stmt->bind_param("is",$cTerm,$majorName);
}
else{
	exit();
}
$stmt->execute();
$stmt->bind_result($cId,$cName,$cTerm,$cPoint,$cWeekh,$cWeek,$cType,$cExam,$majorName,$cGrade);
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
					<th>课程ID</th>
					<th>课程名称</th>
					<th>开课学期</th>
					<th>学分</th>
					<th>周课时</th>
                    <th>起止周</th>
                    <th>课程类型</th>
                    <th>考核方式</th>
					<th>开课专业</th>
                    <th>适用年级</th>
                    <th>操作</th>
				</tr>
				<?php
				while($stmt->fetch()){
                ?>
						<tr>
							<td><?=$cId?></td>
							<td><?=$cName?></td>
							<td><?=$cTerm?></td>
							<td><?=$cPoint?></td>
							<td><?=$cWeekh?></td>
							<td><?=$cWeek?></td>
							<td><?=$cType?></td>
                            <td><?=$cExam?></td>
                            <td><?=$majorName?></td>
                            <td><?=$cGrade?></td>
                            <td><a href="#" onclick="if(confirm('确定要删除“<?=$cName?>课程”吗?'))
                            location='courseDel.php?cid=<?=$cId?>'">删除</a>|
                            <a href="courseModi.php?cid=<?=$cId?>">修改</a></td>
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