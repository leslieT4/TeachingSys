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
    $couFile = $_FILES["coufile"]["tmp_name"];
    $spreadSheet = IOFactory::load($couFile);
    // 5组 获取表
    $workSheet = $spreadSheet->getSheet(0);
    $row = $workSheet->getHighestRow();
    require "../../inc/data/connAdmin.php";
    for ($i = 2;$i <= $row ; $i++){
        $sql = "insert into cait_course 
        (ccode,cname,cgrade,majorname,cterm,cpoint,cweekh,cweek,
        ctotalh,ctype,cexam) 
        values 
        (?,?,?,?,?,?,?,?,?,?,?)";
        if ($stmt = $conn->prepare($sql)) {
            $cCode = $workSheet->getCell("a$i")->getValue();
            if ($cCode == ""){
                break;
            }
            $cName = $workSheet->getCell("b$i")->getValue();
            $cGrade = $workSheet->getCell("c$i")->getValue();
            $majorName = $workSheet->getCell("d$i")->getValue();
            $cTerm = $workSheet->getCell("e$i")->getValue();
            $cPoint = $workSheet->getCell("f$i")->getValue();
            $cWeekh = $workSheet->getCell("g$i")->getValue();
            $cWeek = $workSheet->getCell("h$i")->getValue();
            $cTotalh = $workSheet->getCell("i$i")->getValue();
            $cType = $workSheet->getCell("j$i")->getValue();
            $cExam = $workSheet->getCell("k$i")->getValue();
            $stmt->bind_param("isisiiisiss",$cCode,$cName,$cGrade,$majorName,
            $cTerm,$cPoint,$cWeekh,$cWeek,$cTotalh,$cType,$cExam);
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
        alert("添加了$count 个课程！" );
        location = "courseAdmin.php";
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