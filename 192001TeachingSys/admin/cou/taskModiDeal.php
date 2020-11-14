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
    $taskId = $_GET["taskid"];
    $cCode = $_POST["c_code"];
    $cName = $_POST["c_name"];
    $cGrade = $_POST["c_grade"];
    $cmajor = $_POST["major"];
    $stuClass = $_POST["stu_class"];
    $taskRoom = $_POST["task_room"];
    $taskTerm = $_POST["task_term"];
    $teId = $_POST["te_id"];
    $taskTime = $_POST["task_time"];
    $sql = "update cait_task
            set taskterm = ?,teid = ?,tasktime = ?,
            stuclass = ?,taskroom = ?
            where taskid = ?";
    if ($stmt = $conn->prepare($sql)){
        $stmt->bind_param('iisssi',$taskTerm,$teId,$taskTime,$stuClass,$taskRoom,$taskId);
        $stmt->execute();
        if ($stmt->affected_rows == 1){
            $count +=1; 
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
    ?>
</body>
</html>