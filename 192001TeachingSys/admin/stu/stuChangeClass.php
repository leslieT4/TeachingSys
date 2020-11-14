<?php
include "../../inc/log/check2.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>复旦大学后台管理系统-转班</title>
	<link rel="stylesheet" type="text/css" href="../../inc/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../../inc/css/mystyle.css">
    <script type="text/javascript" src="../../inc/js/jquery.js"></script>
	<script type="text/javascript" src="../../inc/js/showhide.js"></script>
    <?php
    include "../../inc/data/connAdmin.php";
    $stuId = $_GET["id"];
    $stuName = $_GET["name"];
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
    $sql_ca = "select stuclass from cait_class";
    if ($stmtCa = $conn->prepare($sql_ca)) {
		$stmtCa->execute();
		$stmtCa->bind_result($stuClass);
		$stmtCa->store_result();
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
				<a href="../dep/depAdmin.php">二级学院管理</a>
			</li>
		    <li id="fathermenu_first">
                <a href="#">教师管理</a>
            </li>
		    <li><a href="stuAdmin.php">学生管理</a></li>
            <li><a href="../cou/courseAdmin.php">课程管理</a></li>
            <li><a href="../cou/taskAdmin.php">教学任务查询管理</a></li>
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
    <div class="changeBox">
        <p class="changeMes">请为学生<?=$stuId?> <?=$stuName?> 选择新的班级</p>
        <form action="stuChangeClassDeal.php?id=<?=$stuId?>" method="post" name="change">
            <h2>选择系</h2>
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
            <h2>选择专业</h2>
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
            <h2>选择班级</h2>
            <select name="stuclass" id="cla">
				<option value="">请选择班级</option>
				<?php
				if ($stmtCa->num_rows > 0){
			   		while($stmtCa->fetch())
			        {
						echo <<<END
			    		<option value="$stuClass">$stuClass</option>
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
            <input type="submit" value="确定转班">
        </form>
        
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