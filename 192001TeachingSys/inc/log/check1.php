<?php
session_start();
if ($_SESSION["user"] == null) {
	echo <<<END
	<script type="text/javascript">
	alert('请登录后再访问！');
	location = "adminLogin.html";
	</script>
END;
}
?>