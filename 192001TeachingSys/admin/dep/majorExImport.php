<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require "../../vendor/autoload.php";
    use PhpOffice\PhpSpreadsheet\IOFactory;
    // 5组 获取表单文件域的信息
    $majorFile = $_FILES["majorfile"]["tmp_name"];
    $spreadSheet = IOFactory::load($majorFile);
    // 5组 获取表
    $workSheet = $spreadSheet->getSheet(0);
    $row = $workSheet->getHighestRow();
    require "../../inc/data/connAdmin.php";
    for ($i = 2;$i <= $row ; $i++){
        $sql = "insert into cait_major 
        (majorname,majorlength,depname) 
        values 
        (?,?,?)";
        if ($stmt = $conn->prepare($sql)) {
            $majorName = $workSheet->getCell("a$i")->getValue();
            if ($majorName == ""){
                break;
            }
            $majorLength = $workSheet->getCell("b$i")->getValue();
            $depName = $workSheet->getCell("c$i")->getValue();
            $stmt->bind_param("sis",$majorName,$majorLength,$depName);
            $stmt->execute();
            if ($stmt->affected_rows == 1){
                # 5组 成功
                $count +=1;
            }
        }
    }
    if ($count > 0){
        // 提示+跳转
        echo <<<END
        <script type="text/javascript">
        alert("添加了$count 个专业！");
        history.back();
        </script>
END;
    }
    else{
        echo <<<END
        <script type="text/javascript">
        alert("添加失败！");
        history.back();
        </script>
END;
    }
    ?>
</body>
</html>