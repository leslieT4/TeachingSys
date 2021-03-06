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
    $stuFile = $_FILES["stufile"]["tmp_name"];
    $spreadSheet = IOFactory::load($stuFile);
    // 5组 获取表
    $workSheet = $spreadSheet->getSheet(0);
    $row = $workSheet->getHighestRow();
    require "../../inc/data/connAdmin.php";
    for ($i = 2;$i <= $row ; $i++){
        $sql = "insert into cait_stu 
        (stuid,stuname,stupa,stuclass) 
        values 
        (?,?,?,?)";
        if ($stmt = $conn->prepare($sql)) {
            $stuId = $workSheet->getCell("a$i")->getValue();
            if ($stuId == ""){
                break;
            }
            $stuName = $workSheet->getCell("b$i")->getValue();
            $stuPa = $workSheet->getCell("c$i")->getValue();
            $stuClass = $workSheet->getCell("d$i")->getValue();
            $stmt->bind_param("isis",$stuId,$stuName,$stuPa,$stuClass);
            $stmt->execute();
            if ($stmt->affected_rows == 1){
                # 5组 成功
                $count +=1;
            }
            else{
                $fail +=1;
                $failId[] = $stuId;
            }
        }
    }
    if ($count > 0){
        // 提示+跳转
        echo <<<END
        <script type="text/javascript">
        alert("添加了$count 个学生！" );
        location = "stuAdmin.php";
        </script>
END;
    }
    else{
        echo <<<END
        <script type="text/javascript">
        alert("添加失败!");
        history.back();
        </script>
END;
    }
    ?>
</body>
</html>