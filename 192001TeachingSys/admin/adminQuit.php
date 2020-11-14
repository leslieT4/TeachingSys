<?php
include "../inc/log/check1.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
	unset($_SESSION["user"]);
	unset($_SESSION["userpa"]);
	?>
	<script type="text/javascript">
	alert("注销成功！");
	location = "adminLogin.html";
	</script>
</body>
</html>