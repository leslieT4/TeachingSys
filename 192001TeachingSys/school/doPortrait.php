<?php
include "../inc/log/session2.php";
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
        // 5组 判断有无上传错误
        if ($_FILES["partrait"]["error"] > 0)
        {
        echo <<<END
            <script type="text/javascript">
            alert("文件上传错误！");
            history.back();
            </script>
END;
        }
        else{
            // 5组 限制文件上传格式
            if ((($_FILES["portrait"]["type"] == "image/gif")
            || ($_FILES["portrait"]["type"] == "image/jpeg")
            || ($_FILES["portrait"]["type"] == "image/jpg")
            || ($_FILES["portrait"]["type"] == "image/png")))
            {
                // 5组 限制文件上传大小
                if($_FILES["portrait"]["size"] > 102400){
                    echo <<<END
                    <script type="text/javascript">
                    alert("上传文件过大，仅限100kB以内，请重试！");
                    history.back();
                    </script>
END;
                    exit;
                }
            }
            else{
                echo <<<END
                <script type="text/javascript">
                alert("上传文件仅支持png/jpg/gif格式，请重试！");
                history.back();
                </script>
END;
            exit;
            }
        }
        // 5组 规划路径和新文件
        $datePath = date("Ymd")."/";
        $path = "../inc/upload/".$datePath;
        $newName = md5(date("YmdHis"));
        // 5组 检查重名
        if(file_exists($path.$newName)){
            // 5组 发现重名，阻止继续上传
        echo <<<END
            <script type="text/javascript">
            alert("请稍后再试！");
            history.back();
            </script>
END;
        }
        // 5组 检查路径是否存在
        if(!file_exists($path)){
            mkdir($path);
        }
        // 5组 移动到指定位置，新的名字
        move_uploaded_file($_FILES["portrait"]["tmp_name"], $path.$newName);
        if(!file_exists($path.$newName)){
            // 提示+跳转
            echo <<<END
            <script type="text/javascript">
            alert("上传错误,请稍后再试！");
            history.back();
            </script>
END;
        }
            // 5组 根据身份，更新用户头像字段
            $userId = $_SESSION["userid"];
            $str = $datePath.$newName;
            include "../inc/data/conn.php";
            if ($_SESSION["Role"] == "stu"){
                $sql = "update cait_stu set stupic = '$str' where stuid = $userId";
            }
            else{
                $sql = "update cait_te set tepic = '$str' where teid = $userId";
            }
            $conn->query($sql);
            // 5组 判断更新结果，不同的提示和跳转
            if ($conn->affected_rows == 1){
                //更新成功
                //若原头像为默认头像，则不删除
                if ($_SESSION["pic"] == "te.png" || $_SESSION["pic"] == "stu.png"){
                    $_SESSION["pic"] = $str;
                    echo <<<END
                    <script type="text/javascript">
                    alert("头像更新成功！");
                    location = "../index.php";
                    </script>
END;
                }else{
                    unlink("../inc/upload/".$_SESSION["pic"]);
                    $_SESSION["pic"] = $str;
                    echo <<<END
                    <script type="text/javascript">
                    alert("头像更新成功，旧头像已经删除！");
                    location = "../index.php";
                    </script>
END;
                }
            }
            else{
                //更新失败
                echo <<<END
                <script type="text/javascript">
                alert("更新失败！");
                location = "../index.php";
                </script>
END;
            }
?>
</body>
</html>