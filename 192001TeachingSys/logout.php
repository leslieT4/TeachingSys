<?php
include "inc/log/session1.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
	//5组 清除session变量
	unset($_SESSION["user"]);
	unset($_SESSION["userid"]);
	unset($_SESSION["role"]);
	//5组 提示跳转
	?>
	<script type="text/javascript">
		alert('注销成功！');
		location = "login.html";
	</script>
</body>
</html>