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
    // 5组  获取删除二级学院的信息
    require "../../inc/data/connAdmin.php";
    $depName = $_GET["dep"];
    // 5组 执行删除
    $sql = "delete from cait_dep
            where depname = ?";
    if ($stmtD = $conn->prepare($sql)){
        $stmtD->bind_param('s',$depName);
        $stmtD->execute();
        if ($stmtD->affected_rows == 1){
            echo <<<END
                <script type="text/javascript">
                alert("删除成功！");
                history.back();
                </script>
END;          
        }
    }
    ?>

</body>
</html>