<?php
include "../../inc/log/check2.php"
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
    require "../../vendor/autoload.php";
    use PhpOffice\PhpSpreadsheet\IOFactory;
    // 5组 获取表单文件域的信息
    $taskFile = $_FILES["taskfile"]["tmp_name"];
    $spreadSheet = IOFactory::load($taskFile);
    // 5组 获取表
    $workSheet = $spreadSheet->getSheet(0);
    $row = $workSheet->getHighestRow();
    require "../../inc/data/connAdmin.php";
    for ($i = 2;$i <= $row ; $i++){
        $sql = "insert into cait_task 
        (teid,cid,stuclass,taskterm,tasktime,taskroom) 
        values 
        (?,?,?,?,?,?)";
        if ($stmt = $conn->prepare($sql)) {
            $teId = $workSheet->getCell("b$i")->getValue();
            if ($teId == ""){
                break;
            }
            $cId = $workSheet->getCell("d$i")->getValue();
            $stuClass = $workSheet->getCell("i$i")->getValue();
            $taskTerm = $workSheet->getCell("h$i")->getValue();
            $taskTime = $workSheet->getCell("j$i")->getValue();
            $taskRoom = $workSheet->getCell("k$i")->getValue();
            $stmt->bind_param("iisiss",$teId,$cId,$stuClass,$taskTerm,$taskTime,$taskRoom);
            $stmt->execute();
        }
            if ($stmt->affected_rows == 1){
                # 5组 成功
                $count +=1;
            }
            else{
                $fail +=1;
            }
        }
    if ($count > 0){
        // 提示+跳转
        echo <<<END
        <script type="text/javascript">
        alert("添加了$count 个教学任务！添加失败的数量：$fail!" );
        location = "courseAdmin.php";
        </script>
END;
    }
    else{
        echo <<<END
        <script type="text/javascript">
        alert("fail" );
        location = "courseAdmin.php";
        </script>
END;
    }
    ?>
</body>
</html>