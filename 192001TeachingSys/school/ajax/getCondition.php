<!DOCTYPE html>
<html lang="en">
<?php
include "../../inc/data/conn.php";
$txt = $_GET["q"];
// x=1 查询班级
// x=2 查询课程
// x=3 查询教师
$x = $_GET["x"];

if ($x == 1) {
  //查询班级
  $depName = $txt;
  $sql = "select cait_class.stuclass from cait_class,cait_major
          where cait_class.majorname = cait_major.majorname
          and cait_major.depname = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s",$depName);
  $stmt->bind_result($stuClass);
}
elseif ($x == 2) {
  //查询课程
  $taskTerm = substr($txt,1,1);
  if ($taskTerm == 1) {
    $sql = "select cait_course.cid,cait_course.cname from cait_course,cait_major
            where cait_course.majorname = cait_major.majorname
            and cait_major.depname = ?
            and ( cait_course.cterm = 1 or cait_course.cterm = 3 or cait_course.cterm = 5 )";
  }
  else{
    $sql = "select cait_course.cid,cait_course.cname from cait_course,cait_major
            where cait_course.majorname = cait_major.majorname
            and cait_major.depname = ?
            and ( cait_course.cterm = 2 or cait_course.cterm = 4)";       
  }
  $depName = substr($txt,2);
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s",$depName);
  $stmt->bind_result($cId,$cName);
}
elseif ($x == 3){
  //查询教师
  $depName = $txt;
  $sql = "select teid,tename from cait_te where depname = ?";
  $stmt = $conn->prepare($sql);
  $stmt->bind_param("s",$depName);
  $stmt->bind_result($teId,$teName);
}
else{
  exit();
}
$stmt->execute();
$stmt->store_result();
?>
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <?php
  if ($x == 1){
    if ($stmt->num_rows>0) {
      while($stmt->fetch()){
        echo "<option value='$stuClass'>$stuClass</option>";
      }
    }
    else{
      echo "<option value=''>暂无记录</option>";
    }
  }
  elseif ($x == 2){
    if ($stmt->num_rows>0){
      while($stmt->fetch()){
        echo "<option value='$cId'>$cName</option>";
      }
    }
    else{
      echo "<option value=''>暂无记录</option>";
    }
  }
  else{
    if ($stmt->num_rows>0){
      while($stmt->fetch()){
        echo "<option value='$teId'>$teName</option>";
      }
    }
    else{
      echo "<option value=''>暂无记录</option>";
    }
  }
  ?>
</body>
</html>