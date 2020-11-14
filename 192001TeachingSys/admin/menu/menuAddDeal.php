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
    $mName = $_POST["menu_name"];
    $Tips = $_POST["tips"];
    $Links = $_POST["links"];
    $AuthTe = $_POST["te"];
    $AuthStu = $_POST["stu"];
    // 5组 检查是否重名
    $sql = "select cait_menu.mname 
            from cait_menu where cait_menu.mname = ? ";
    if ($stmtS = $conn->prepare($sql)){
            $stmtS->bind_param("s",$mName);
            $stmtS->execute();
            $stmtS->bind_result($Dname);
            $stmtS->store_result();
            if ($stmtS->num_rows > 0){
                echo <<<END
                <script type="text/javascript">
                alert("菜单名重复，请重新输入！");
                location = "menuAdmin.php";
                </script>
END;              
            }
    }
        $sql2 = "insert into cait_menu
            (mname,mhref,mtip,mte,mstu)
            values
            (?,?,?,?,?)";
        if ($stmtI = $conn->prepare($sql2)){
            $stmtI->bind_param('sssss',$mName,$Links,$Tips,$AuthTe,$AuthStu);
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