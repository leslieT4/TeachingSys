<?php
include "../inc/log/session2.php";
?>
<!DOCTYPE html>
<html lang="en">
<?php
include "../inc/data/conn.php";
$sql = "select stuclass from cait_class";
	$sql_te = "select teid,tename from cait_te";
	$sql_de = "select depname from cait_dep";
    $sql_co = "select cname,cid from cait_course";
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
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../inc/css/reset.css">
	<link rel="stylesheet" type="text/css" href="../inc/css/mystyle.css">
	<script type="text/javascript" src="../inc/js/ajax.js"></script>
	<script type="text/javascript" src="../inc/js/jquery.js"></script>
	<script type="text/javascript" src="../inc/js/showhide.js"></script>
</head>
<body>
    <!--导航栏-->
	<div class="top_link">
		<a href="../index.php"><img src="../inc/pic/logo.png"></a>
		<ul>
		    <li><a href="tTask.php">教学任务查询</a></li>
		    <li id="fathermenu_second">
				<a href="tScoreln.php">成绩</a>
				<ul id="submenu_second">
					<li><a href="tScoreIn.php">成绩录入</a></li>
					<li><a href="sScoreSearch.php">成绩查询</a></li>
				</ul>
			</li>
		    <li id="fathermenu_first">
                <a href="#">用户设置</a>
                <ul id="submenu_first">
                    <li><a href="user.php">修改密码</a></li>
                    <li><a href="portrait.php">上传头像</a></li>
                </ul>
            </li>
		    <li><a href="../logout.php">注销</a></li>
		    <li><a href="../login.html" class="login_a">登录Login</a></li>
	    </ul>
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
			    	<input type="button" value="查询" name="s2" onclick="showData(document.mytask.studyY.value+document.mytask.term.value+document.mytask.stuclass.value,'inquireArea','ajax/getScore.php',1);">
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
			        <input type="button" style="margin-left:5px;" value="查询" onclick="showData(document.mytask.studyY.value+document.mytask.term.value+document.mytask.courseid.value,'inquireArea','ajax/getScore.php',2);">
			    </li>
			</ul>
		</form>
    </div>
    <div id="inquireArea">

    </div>
</body>
</html>