<!DOCTYPE html>
<html lang="en">
<?php
include "../../inc/data/conn.php";
$txt = $_GET['q'];
$taskId = substr($txt,0 , 1);
$endTxt = substr($txt, 1);
$x = $_GET["x"];
if ($x == 1){
    $stuClass = $endTxt;
    $sql = "select cait_te.tename,cait_course.cname,
    cait_task.stuclass,cait_task.taskterm,
    cait_course.ctype,cait_course.cexam
    from cait_task,cait_te,cait_course
    where cait_task.cid = cait_course.cid
    and cait_task.teid = cait_te.teid
    and cait_task.taskid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i",$taskId);
    $stmt->bind_result($teName,$cName,$stuClass,$taskTerm,$cType,$cExam);
    $stmt->execute();
    $stmt->store_result();

    $sqlStu = "select cait_stu.stuclass,cait_stu.stuid,stuname,scnormal,
    sclab,scmidterm,scfinal,scoverall
    from cait_stu,cait_score
    where cait_stu.stuid = cait_score.stuid
    and cait_score.taskid = ?";
    $stmtStu = $conn->prepare($sqlStu);
    $stmtStu->bind_param("i",$taskId);
    $stmtStu->bind_result($stuClass,$stuId,$stuName,$scNormal,$sclab,$scMidterm,$scFinal,$scOverall);
    $stmtStu->execute();
    $stmtStu->store_result();
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    if ($stmt->num_rows > 0){
        while($stmt->fetch()){
    ?>
    <form method="post" action="doScoreIn.php" enctype="multipart/form-data">
    <table border="1">
        <tr>
            <td>教师姓名：<?=$teName?></td>
            <td>课程名称：<?=$cName?></td>
        </tr>
        <tr>
            <td>班级：<?=$stuClass?></td>
            <td>学年学期：<?=$taskTerm?></td>
        </tr>
        <tr>
            <td>课程性质：<?=$cType?></td>
            <td>考核方式：<?=$cExam?></td>
        </tr>
   
        <tr>
            <td>输入规范提示：数字成绩不得超过100分。</td>
            <td>输入记分制：总评好成绩保存为：</td>
        </tr>
    <?php
    }
        }
    ?>
        <tr>
            <td colspan="2">平时(%)<input type="text" value="0">期中(%)<input type="text" value="0">实验(%)<input type="text" value="0">期末(%)<input type="text" value="0"><span>折算总评成绩之前请先清空总评成绩。</span><input type="button" value="清空总评成绩"></td>
        </tr>
        <tr>
            <td colspan="2">
                <input type="button" value="成绩下载模板">
                Excel成绩文件：<input type="file" name="scoreFile">
                <input type="hidden" value="<?=$taskId?>" name="taskid">
                <input type="submit" value="载入">
            </td>
        </tr>
    </form>
    <form>
				<tr>
					<td colspan="2">
						<table border="1">
							<tr>
								<td>序号</td>
								<td>班级名称</td>
								<td>学号</td>
								<td>姓名</td>
								<td>平时成绩</td>
								<td>期中成绩</td>
								<td>实验成绩</td>
								<td>期末成绩</td>
								<td>总评成绩</td>
							</tr>
                            <?php
                            for ($i = 1;$i <=60 and $stmtStu->fetch();$i++){
                            ?>
							<tr>
								<td><?=$i?></td>
								<td><?=$stuClass?></td>
								<td><?=$stuId?></td>
								<td><?=$stuName?></td>
								<td><input type="text" value="<?=$scNormal?>"></td>
								<td><input type="text" value="<?=$sclab?>"></td>
								<td><input type="text" value="<?=$scMidterm?>"></td>
								<td><input type="text" value="<?=$scFinal?>"></td>
								<td><input type="text" value="<?=$scOverall?>"></td>
							</tr>
                            <?php
                            }
                            ?>
						</table>
					</td>
				</tr>
			</table>
			<p>总共有5条记录</p>
			<ul>
				<li><input type="submit" value="保存" name=""></li>
				<li><input type="button" value="成绩校对打印" name=""></li>
				<li><input type="submit" value="提交" name=""></li>
				<li><input type="button" value="成绩输出打印" name=""></li>
				<li><input type="button" value="学生照片查看" name=""></li>
			</ul>
		</form>
</body>
</html>