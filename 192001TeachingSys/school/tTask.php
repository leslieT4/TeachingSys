<?php
include "../inc/log/session2.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>复旦大学教务管理系统-教学任务查询</title>
	<link rel="stylesheet" type="text/css" href="../inc/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../inc/css/mystyle.css">
	<script type="text/javascript" src="../inc/js/ajax.js"></script>
	<script type="text/javascript" src="../inc/js/jquery.js"></script>
	<script type="text/javascript" src="../inc/js/showhide.js"></script>
</head>
<body>
	<?php
	include "../inc/data/conn.php";
	//第二步，5组，创建mysqli_stmt对象，绑定参数
	$sql = "select stuclass from cait_class";
	$sql_te = "select teid,tename from cait_te";
	$sql_de = "select depname from cait_dep";
    $sql_co = "select cname,cid from cait_course";
	//教学任务的查询：学年学期+教师工号
	//第二步,5组
	//$sql_ta = "select teid,cid,stuclass from cait_task where taskterm = ? and teid = ?";

	if ($stmtCl = $conn->prepare($sql)) {
		//$stmtCl->bind_param();
		//第三步，5组，执行，绑定结果
		$stmtCl->execute();
		$stmtCl->bind_result($stuClass);
		//第四步，5组，保存结果
		$stmtCl->store_result();
	}
    if ($stmtTe = $conn->prepare($sql_te)) {
    	$stmtTe->execute();
    	$stmtTe->bind_result($teId,$teName);
    	$stmtTe->store_result();
    } 
	if ($stmtDe = $conn->prepare($sql_de)) {
		$stmtDe->execute();
		$stmtDe->bind_result($depName);
		$stmtDe->store_result();
	}
	if ($stmtCo = $conn->prepare($sql_co)) {
		$stmtCo->execute();
		$stmtCo->bind_result($cName,$cId);
		$stmtCo->store_result();
	}
	
	?>
	<!--导航栏-->
	<div class="top_link">
		<a href="../index.php"><img src="../inc/pic/logo.png"></a>
		<?php
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
		<form method="post" action="" name="mytask">
			<ul>
				<li>
					学年
					<select name="studyY" id="studyy">
						<?php
						/*
						从2002年到当前年（7月份之前），或者当前年+1（7月份之后）
						*/
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
					<select name="term" id="" onchange="showData(document.mytask.term.value+document.mytask.depname.value,'coArea','ajax/getCondition.php',2)">
						<option value="01"  selected>1</option>
						<option value="02">2</option>
					</select>
					系：
					<select name="depname" id="dep" onchange="showData(document.mytask.depname.value,'clArea','ajax/getCondition.php',1);showData(document.mytask.depname.value,'teArea','ajax/getCondition.php',3);showData(document.mytask.term.value+document.mytask.depname.value,'coArea','ajax/getCondition.php',2);">
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
					<input type="button" value="查询" onclick="showData(document.mytask.studyY.value+document.mytask.term.value+document.mytask.depname.value,'taskArea','ajax/getTask.php',1);">
				</li>
			    <li>
			    	按班级查询>>班级:
			    	<select name="stuclass" id="clArea">
			    		<?php
			    		if ($stmtCl->num_rows > 0) {
			    			while($stmtCl->fetch())
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
			    	<input type="button" value="查询" name="s2" onclick="showData(document.mytask.studyY.value+document.mytask.term.value+document.mytask.stuclass.value,'taskArea','ajax/getTask.php',2);">
			    </li>
			    <li>
			        按课程查询>>课程：
			        <select name="courseid" id="coArea">
			            <?php
			    		if ($stmtCo->num_rows > 0) {
			    			while($stmtCo->fetch())
			    			{
			    				echo <<<END
			    					<option value="$cId">$cName</option>
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
			        <input type="button" value="查询" onclick="showData(document.mytask.studyY.value+document.mytask.term.value+document.mytask.courseid.value,'taskArea','ajax/getTask.php',3);">
			    </li>
			    <li>
			        按教师查询>>教师：
			        <select name="teid" id="teArea">
			        	<?php
			        	if ($stmtTe->num_rows > 0){
                            while($stmtTe->fetch())
                            {
                             echo <<<END
                               <option value='$teId'>$teName</option>;
END;
                            }
                        }
                        else{
                            echo <<<END
                               <option value=""></option>
END;
                        }
                        ?>
			        </select>
			        <input type="button" value="查询" class="tebutton" onclick="showData(document.mytask.studyY.value+document.mytask.term.value+document.mytask.teid.value,'taskArea','ajax/getTask.php',4);">
			    </li>
			    <li>
			    	<input type="button" value="导出EXCEL">
			    	点击导出EXCEL没反应，请先关掉上网助手或者按住ctrl键点击按钮！！
			    </li>
			</ul>
		</form>
	</div>
	<!--查询结果-->
	<div class="query_result" id="taskArea">
		
	</div>
	<!--当前的位置提示-->	
	<div class="side">
		<p>当前位置：教师-教学任务查询</p>
	</div>
	<!--版权-->
	<div class="footer">
		<p>Copyright© 2015-2020 复旦大学版权所有 地址：上海市杨浦区邯郸路220号 | 邮编：200433 | 电话：021-65643207 | 邮箱：urp@fudan.edu.cn</p>
	</div>
</body>
</html>