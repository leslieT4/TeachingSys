<?php
include "inc/log/session1.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>复旦大学教务管理系统-首页</title>
	<link rel="stylesheet" type="text/css" href="inc/css/reset.css">
	<link rel="stylesheet" type="text/css" href="inc/css/mystyle.css">
    <script type="text/javascript" src="inc/js/jquery.js"></script>
	<script type="text/javascript" src="inc/js/showhide.js"></script>
	<?php
	//5组，mysqli面向对象
	//5组 设置mysql服务器的连接参数
	include "inc/data/conn.php";
	//echo "连接成功"
	//第二步 5组 预处理一个sql语句，得到mysqli_stmt对象，绑定参数
	$sql = "select stuid,stuname,stuclass from cait_stu";
	$stmt = $conn->prepare($sql);
	//没有条件，所以绑定参数省略
	//第三步 5组，绑定结果，执行查询
	$stmt->execute();
	$stmt->bind_result($stuid,$stuname,$stuclass);
	//第四步，5组，保存结果记录集
	$stmt->store_result();
	//echo $stmt->num_rows;
	//$stmt->fetch();
	//echo "$stuname,$stuid,$stuclass";
	//5组 增加的下拉菜单
	$classQ = "select stuclass from cait_class";
	$classresult = 	$conn->prepare($classQ);
	$classresult->execute();
	$classresult->bind_result($stuclass);
	$classresult->store_result();
	//$classresult->fetch();
	//echo "$stuclass";
?>
</head>
<body>
	<!--导航栏-->
	<div class="top_link">
		<a href="index.php"><img src="inc/pic/logo.png"></a>
		<?php
		include "inc/data/conn.php";
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
		<img src="inc/pic/shouye1.jpg">
		<h2>复旦大学教务系统欢迎您！</h2>
	</div>
	<div class="person">
		<img src="inc/upload/<?=$_SESSION["pic"]?>">
		<h2>您好！<?=$_SESSION["user"]?> &nbsp;&nbsp;<?=$_SESSION["Roleid"]?>:<?=$_SESSION["userid"]?>&nbsp;&nbsp;&nbsp;系：计算机学院</h2>
	</div>
	<div class="count">
	<?php
    include "inc/data/conn.php";
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
    // 5组 统计学生
    $sql = "select depname,count(depname)
            from cait_class,cait_major,cait_stu
            where cait_class.majorname = cait_major.majorname 
            and cait_stu.stuclass = cait_class.stuclass 
            group by depname";
    $re3 = $conn->query($sql);
    // 5组 遍历查询结果
    $re3 -> data_seek(0);
    while ($row = $re3->fetch_assoc()) {
        $sSum[$row["depname"]] = $row["count(depname)"];
    }
    ?>
    <table border="1">
        <tr>
            <td>序号</td>
            <td>二级学院</td>
            <td>专业数</td>
            <td>班级数</td>
            <td>学生数</td>
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
            <td><?=$sSum[$row["depname"]]?></td>
        </tr>
        <?php $i++; }?>
    </table>
	</div>
	<div class="classQuery">
	    <form action="">
			<ul>
			    <li>
			    	按班级查询>>班级:
			    	<select>
			    		<?php
			    		while($classresult->fetch()){
			    		?>
			    		<option value=""><?=$stuclass?></option>
			    		<?php
			    	    }
			    	    ?>
			    	</select>
			    	<input type="submit" value="查询">
			    </li>
			</ul>
		</form>
	</div>
	<!--表格-->
	<div class="info_personal">
		<?php
		if($stmt->num_rows > 0){
		?>
	    <table border="1">
		    <tr>
			    <th>序号</th>
			    <th>班级</th>
			    <th>学号</th>
			    <th>姓名</th>
			    <th>二级学院</th>
		    </tr>
		    <?php
		    for($i = 1; $i <= 10 and $stmt->fetch();$i++){
		    ?>
		    <tr>
			    <td><?=$i?></td>
			    <td><?=$stuclass?></td>
			    <td><?=$stuid?></td>
			    <td><?=$stuname?></td>
			    <td>计算机学院</td>
		    </tr>
		    <?php
		}
		    ?>
	    </table>
	    <?php
	}
	    ?>
	</div>
	<!--当前的位置提示-->
	<div class="side">
		<p>当前位置：学生-首页</p>
	</div>
	<!--版权-->
	<div class="footer">
		<p>Copyright© 2015-2020 复旦大学版权所有 地址：上海市杨浦区邯郸路220号 | 邮编：200433 | 电话：021-65643207 | 邮箱：urp@fudan.edu.cn</p>
	</div>
</body>
</html>