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
    $stuClass = $_POST["stuclass"];
    $stuId = $_GET["id"];
    require "../../inc/data/connAdmin.php";
    $sql = "update cait_stu
            set stuclass = ?
            where stuid = ?";
    if ($stmt = $conn->prepare($sql)){
        $stmt->bind_param('si',$stuClass,$stuId);
        $stmt->execute();
        if ($stmt->affected_rows == 1){
            echo <<<END
            <script type="text/javascript">
                alert("学生转班操作成功! 新的班级为：$stuClass");
                history.back();
            </script>
    END;          
        }
    }
    else{
        echo <<<END
        <script type="text/javascript">
            alert("修改失败！");
            history.back();
        </script>
END;        
    } 
    ?>

</body>
</html>