<?php
    $way = $_GET['way'];
    $user_name = $_GET['user_name'];
    $user_pwd = $_GET['user_pwd'];
    $user_tel = $_GET['user_tel'];

    $keyword = $_GET['keyword'];
    $userID = $_GET['userID'];

    $con = mysqli_connect('localhost','project','123456','project');
    function login($con,$user_name,$user_pwd){
        $sql = "SELECT * FROM `user` WHERE `user_name`= '$user_name' AND `user_password` = '$user_pwd'";
        $res = mysqli_query($con,$sql);
        if(!$res){
            die("数据库连接失败!" . mysqli_error($res));
        }
        else{
            $row = mysqli_fetch_assoc($res);
            if($row){
                $userID = $row["user_id"];
                $arr = array("code"=>1,"id"=>$userID,"name"=>$user_name,"msg"=>"登陆成功");
                print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
            }else{
                $arr = array("code"=>0,"msg"=>"用户名或者密码错误");
                print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
            }
        }
    }
    function register($con,$user_name,$user_pwd,$user_tel){
    $sql = "SELECT * FROM `user` WHERE `user_name` = '$user_name'";
    $res = mysqli_query($con, $sql);
    if (!$res) {
        die("数据库连接失败!" . mysqli_error($res));
    }if($res){
        $row = mysqli_fetch_assoc($res);
        if($row){
            $arr = array("code"=>0,"msg"=>"用户名已存在!");
            print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
        }else{
            $sql2 = "INSERT INTO `user` (`user_id`, `user_name`, `user_password`, `tel`, `root`) VALUES (NULL, '$user_name', '$user_pwd', '$user_tel', '0')";
            $res2 = mysqli_query($con,$sql2);
            $row2 = mysqli_insert_id($con);
            if(!$res2){
                $arr = array("code"=>0,"msg"=>"注册失败!");
                print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
            }
            else{
                $arr = array("code"=>1,"id"=>$row2,"msg"=>"注册成功!");
                print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
            }
        }
    }
}

    function admin($con,$user_name,$user_pwd){
        $sql = "SELECT * FROM `user` WHERE `user_name`= '$user_name' AND `user_password` = '$user_pwd' AND `root` ='1'";
        $res = mysqli_query($con,$sql);
        if(!$res){
            die("数据库连接失败!" . mysqli_error($res));
        }
        else{
            $row = mysqli_fetch_assoc($res);
            if($row){
                $userID = $row["user_id"];
                $arr = array("code"=>1,"id"=>$userID,"name"=>$user_name,"msg"=>"登陆成功");
                print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
            }else{
                $arr = array("code"=>0,"msg"=>"用户名或者密码错误");
                print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
            }
        }
    }


    function getUser($con){
        $sql = "SELECT * FROM `user`";
        $res = mysqli_query($con,$sql);
        if(!$res){
            die("数据库连接失败!" . mysqli_error($res));
        }else{
            $row = mysqli_fetch_assoc($res);
            $arr = array();
            if($row){
                while($row){
                    array_push($arr,$row);
                    $row = mysqli_fetch_assoc($res);
                }
            }else{
                $arr = array("code"=>0,"msg"=>"暂无更多用户");
            }
        }
        print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
    }

    function selectUser($con,$keyword){
        $sql = "SELECT * FROM `user` WHERE `user_name` LIKE '%$keyword%'";
        $res = mysqli_query($con,$sql);
        if(!$res){
            die("数据库连接失败!" . mysqli_error($res));
        }else{
            $row = mysqli_fetch_assoc($res);
            $arr = array();
            if($row){
                while($row){
                    array_push($arr,$row);
                    $row = mysqli_fetch_assoc($res);
                }
            }else{
                $arr = array("code"=>0,"msg"=>"此用户不存在");
            }
        }
        print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
    }

    function delUser($con,$userID){
        $sql = "DELETE FROM `user` WHERE `user_id` = '$userID'";
        $res = mysqli_query($con,$sql);
        if(!$res){
            die("数据库连接失败!" . mysqli_error($res));
        }else{
            $sql2 = "SELECT * FROM `user`";
            $res2 = mysqli_query($con,$sql2);
            $row = mysqli_fetch_assoc($res2);
            $arr = array();
            if($row){
                while($row){
                array_push($arr,$row);
                $row = mysqli_fetch_assoc($res2);
            }
            }else{
                $arr = array("code"=>0,"msg"=>"暂无更多用户");
            }
        }
        print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
    }
    switch ($way) {
        case 'login':
            login($con,$user_name,$user_pwd);
            break;
        case 'register':
            register($con,$user_name,$user_pwd,$user_tel);
            break;    
        case 'admin':
            admin($con,$user_name,$user_pwd);
            break;     
        case 'getUser':
            getUser($con);
            break; 
        case 'selectUser':
            selectUser($con,$keyword);
            break;
        case 'delUser':
            delUser($con,$userID);
            break;
        default:
            # code...
            break;
    }

?>