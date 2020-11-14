<?php
// 5组  判断登录信息
require "../../inc/log/check2.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require "../../inc/data/connAdmin.php";
    $depName = $_POST["dep_name"];
    // 5组 检查是否重名
    $sql = "select cait_dep.depname 
            from cait_dep where cait_dep.depname = ? ";
    if ($stmtS = $conn->prepare($sql)){
            $stmtS->bind_param("s",$depName);
            $stmtS->execute();
            $stmtS->bind_result($Dname);
    	    $stmtS->store_result();
            if ($stmtS->num_rows > 0){
                echo <<<END
                <script type="text/javascript">
                alert("二级学院名重复，请重新输入！");
                location = "depAdmin.php";
                </script>
END;              
            }
    }
    // 5组 增加二级学院
    $sql = "insert into cait_dep
            values
             (?)";
    if ($stmtI = $conn->prepare($sql)){
        $stmtI->bind_param('s',$depName);
        $stmtI->execute();
        if ($stmtI->affected_rows == 1){
            echo <<<END
                <script type="text/javascript">
                alert("添加成功！");
                history.back();
                </script>
END;
        }              
    }
    ?>
</body>
</html>