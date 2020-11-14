<?php
include "../inc/log/session2.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
	// 5组 获取用戶输入的密码
	$oldPa = md5($_POST["oldpa"]);
	$newPa = md5($_POST["newpa1"]);
	$newPa2 = md5($_POST["newpa2"]);
    // 5组 老师
    if ($_SESSION["Role"] == "te"){
	    $sql = "update cait_te set tepa = ? where teid = ? and tepa = ?";
	}
	// 5组 学生
	else{
		$sql = "update cait_stu set stupa = ? where stuid = ? and stupa = ?";
	}
	include "../inc/data/conn.php";
    if($stmt = $conn->prepare($sql)){
	    $stmt->bind_param("sis",$newPa,$_SESSION["userid"],$oldPa);
	    $stmt->execute();
	    	// 5组 判断更新结果
	    if ($stmt->affected_rows == 1){
	    	# 5组 成功
	    	echo <<<END
	    	<script type="text/javascript">
	    	alert("密码更新成功！");
	    	location = "../logout.php";
	    	</script>
END;
	    }
	    elseif ($newPa == $oldPa){
	    	# 5组 失败
	    	echo <<<END
	    	<script type="text/javascript">
	    		alert("密码修改失败：新密码和旧密码不能一样！")
	    	history.back();
	    	</script>
END;
	    }
	    else{
	    	# 5组 失败
	    	echo <<<END
	    	<script type="text/javascript">
	    		alert("密码修改失败：旧密码输入有误！")
	    	history.back();
	    	</script>
END;
	    }
	}
?>
</body>
</html>