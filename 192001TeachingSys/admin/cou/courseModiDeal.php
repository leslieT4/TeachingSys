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
    $cId = $_GET["cid"];
    $cCode = $_POST["c_code"];
    $cName = $_POST["c_name"];
    $cType = $_POST["c_type"];
    $cGrade = $_POST["c_grade"];
    $cmajor = $_POST["major"];
    $cTerm = $_POST["c_term"];
    $cExam = $_POST["c_exam"];
    $cPoint = $_POST["c_point"];
    $cWeekh = $_POST["c_weekh"];
    $cWeek = $_POST["c_week"];
    $cTotalh = $_POST["c_totalh"];
    $sql = "update cait_course
            set ccode = ?,cname = ?,cgrade = ?,majorname = ?,cterm = ?,
            cpoint = ?,cweekh = ?,cweek = ?,ctotalh = ?,ctype = ?,cexam = ?
            where cid = ?";
    if ($stmt = $conn->prepare($sql)){
        $stmt->bind_param('isssiiisissi',$cCode,$cName,$cGrade,$cmajor,$cTerm,$cPoint,$cWeekh,$cWeek,$cTotalh,$cType,$cExam,$cId);
        $stmt->execute();
        if ($stmt->affected_rows == 1){
           $count +=1;
        }
    }
    if ($count > 0){
        echo <<<END
        <script type="text/javascript">
        alert("课程信息修改成功！");
        location = "courseAdmin.php";
        </script>
END;          
    }
    ?>
</body>
</html>