<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    require "../vendor/autoload.php";
    use PhpOffice\PhpSpreadsheet\IOFactory;
    // 5组 获取表单文件域 scoreFile 的信息
    $scoreFile = $_FILES["scoreFile"]["tmp_name"];
    $spreadSheet = IOFactory::load($scoreFile);
    // 5组 获取表
    $workSheet = $spreadSheet->getSheet(0);
    $row = $workSheet->getHighestRow();
    $taskId = $_POST["taskid"];
    require "../inc/data/conn.php";
    for ($i = 3;$i <= $row ; $i++){
        $sql = "insert into cait_score 
        (taskid,stuid,scfinal,scoverall) 
        values 
        ($taskId,?,?,?)";
        if ($stmt = $conn->prepare($sql)) {
            $id = $workSheet->getCell("b$i")->getValue();
            if ($id == ""){
                break;
            }
            $Scfinal = $workSheet->getCell("g$i")->getValue();
            $Scoverall = $workSheet->getCell("h$i")->getValue();
            $stmt->bind_param("iii",$id,$Scfinal,$Scoverall);
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
        alert("成功录入$count 位学生的成绩！");
        history.back();
        </script>
END;
    }
    else{
        echo <<<END
        <script type="text/javascript">
        alert("录入失败！");
        history.back();
        </script>
END;
    }
    ?>
</body>
</html>