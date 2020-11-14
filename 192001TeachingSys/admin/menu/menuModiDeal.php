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
    $newmName = $_POST["menu_name"];
    $oldmName = $_GET["menu"];
    $Tips = $_POST["tips"];
    $Links = $_POST["links"];
    $AuthTe = $_POST["te"];
    $AuthStu = $_POST["stu"];
    $sqlc = "select mname from cait_menu
            where mname = ?";
    if ($stmtC = $conn->prepare($sqlc)){
        $stmtC->bind_param('s',$newmName);
        $stmtC->execute();
        $stmtC->bind_result($MName);
        $stmtC->store_result();
        if ($stmtC->num_rows > 0){
            echo <<<END
                <script type="text/javascript">
                alert("菜单名重复，请重新输入！");
                history.back();
                </script>
END;          
        }
        else{
            $sql = "update cait_menu
                set mname = ?,mhref = ?,mtip = ?,
                mte = ?,mstu = ?
                where mname = ?";
        if ($stmt = $conn->prepare($sql)){
            $stmt->bind_param('ssssss',$newmName,$Links,$Tips,$AuthTe,$AuthStu,$oldmName);
            $stmt->execute();
            if ($stmt->affected_rows == 1){
                $count +=1;
            }
        }
    }
    
    if ($count > 0){
        echo <<<END
                <script type="text/javascript">
                alert("修改成功！");
                history.back();
                </script>
END;          
    }
}
    ?>
</body>
</html>