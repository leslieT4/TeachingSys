<?php
include "../../inc/log/check2.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<?php
    $stuId = $_GET["id"];
    $rePa = substr($stuId, 4);
    include "../../inc/data/connAdmin.php";
    $sql = "select cait_stu.stupa from cait_stu
            where cait_stu.stuid = ?";
    if($stmt = $conn->prepare($sql)){
	    $stmt->bind_param("i",$stuId);
        $stmt->execute();
        $stmt->bind_result($stuPa);
        $stmt->store_result();
        $stmt->fetch();
	    if ($rePa == $stuPa){
	    	echo <<<END
	    	<script type="text/javascript">
	    	alert("已经是初始密码，无需重置！");
	    	history.back();
	    	</script>
END;
        }
        else{
            $sqlP = "update cait_stu set stupa = ? where stuid = ?";
            if ($stmtP = $conn->prepare($sqlP)){
                $stmtP->bind_param("si",$rePa,$stuId);
                $stmtP->execute();
                if ($stmtP->affected_rows == 1){
                    echo <<<END
	    	        <script type="text/javascript">
	    	        alert("重置成功！");
	    	        </script>
END;
                }
            }
        }
    }

?>

</body>
</html>