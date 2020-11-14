<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录验证</title>
</head>
<body>
	<?php
	// 5组  获取用户的账号和信息
	$userId = $_POST["userid"];
	$userPa = md5($_POST["password"]);
	$role = $_POST["role"];
	include("inc/data/conn.php");
	//stu--学生登录
	//te--老师登录
	if ($role == "stu") {
	 #5组 学生登录验证
	$sql_stu = "select stuname,stuid,stupic from cait_stu
			where stuid = ? and stupa = ?";
    $stmt = $conn->prepare($sql_stu);
    $stmt->bind_param("is",$userId,$userPa);
    $stmt->execute();
    $stmt->bind_result($userName,$userId,$pic);
    $stmt->store_result();
    $roleid = '学号';
	}
    else{
    	# 5组 老师登录验证
    	$sql_te = "select tename,teid,tepic from cait_te
    			  where teid = ? and tepa = ?";
    	$stmt = $conn->prepare($sql_te);
    	$stmt->bind_param("is",$userId,$userPa);
    	$stmt->execute();
    	$stmt->bind_result($userName,$userId,$pic);
    	$stmt->store_result();
        $roleid = '工号';
    }
    //5组  根据查询结果，提示跳转
    if ($stmt->fetch()) {
    	#5组 成功
    	//5组 发票
    	session_start();
    	$_SESSION["user"] = $userName;
    	$_SESSION["userid"] = $userId;
        $_SESSION["Role"] = $role;
		$_SESSION["Roleid"] = $roleid;
		$_SESSION["pic"] = $pic;
    	echo <<<END
		<script type="text/javascript">
		alert("$userName 欢迎你登录！");
		location = "index.php";
		</script>
END;
    }
    else{
    	#5组 失败
    	echo <<<END
		<script type="text/javascript">
		alert("用户名或密码有误！");
		location = "login.html";
		</script>
END;
    }
	?>
</body>
</html>