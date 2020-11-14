<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录验证</title>
</head>
<body>
	<?php
	// 5组  获取用户的账号和信息
	$uName = $_POST["userid"];
	$userPa = md5($_POST["password"]);
	include("../inc/data/connAdmin.php");
	$sql = "select uname,adminpic from cait_back
			where uname = ? and upa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is",$uName,$userPa);
    $stmt->execute();
    $stmt->bind_result($userName,$pic);
    $stmt->store_result();
    //5组  根据查询结果，提示跳转
    if ($stmt->fetch()) {
    	#5组 成功
    	//5组 发票
    	session_start();
		$_SESSION["user"] = $userName;
		$_SESSION["userpa"] = $userPa;
		$_SESSION["pic"] = $pic;
    	echo <<<END
		<script type="text/javascript">
		alert("$userName 欢迎你登录！");
		location = "admin.php";
		</script>
END;
    }
    else{
    	#5组 失败
    	echo <<<END
		<script type="text/javascript">
		alert("用户名或密码有误！");
		location = "adminLogin.html";
		</script>
END;
    }
	?>
</body>
</html>