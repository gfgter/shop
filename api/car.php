<?php 

$way = $_GET['way'];
$userName = $_GET['userName'];
$userID = $_GET['userID'];
$goodsID = $_GET['goodsID'];
$buy_num = $_GET['buy_num'];
$del = $_GET['del'];

$num_1 = 1;
$num_0 = 0;


$con = mysqli_connect('localhost','project','123456','project');
function saveCar($con,$goodsID,$userID,$userName,$buy_num){
    $sql = "SELECT * FROM `goods` WHERE `goods_id` = '$goodsID'";
    $res = mysqli_query($con,$sql);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }if($res){
        $row = mysqli_fetch_assoc($res);
        if($row){
            $goods_name= $row["goods_name"];
            $leftcount= $row["leftcount"];
            $goods_price= $row["price"];
            $goods_pic = $row["img1"];
            $sort1= $row["sort1"];
            $sort2 = $row["sort2"];
            $sql1 = "SELECT * FROM `car` WHERE `goods_id` = '$goodsID' AND `indent` = '0' AND `id` = 'userID'";
            $res1 = mysqli_query($con,$sql1);
            $row1 = mysqli_fetch_assoc($res1);
            $count = $row1["count"];
            if($row1){
                $count+=$buy_num;
                $sql2 = "UPDATE `car` SET `count` = '$count' WHERE `car`.`goods_id` = '$goodsID' AND `indent` = '0' AND `id` = 'userID'";
                $res2 = mysqli_query($con,$sql2);
                if(!$res2){
                    die("数据库连接失败!" . mysqli_error($res2));
                }else{
                    if($res2){
                        $arr = array("code"=>"1","msg"=>"添加成功!");
                        print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
                    }else{
                        $arr = array("code"=>"0","msg"=>"添加失败!");
                        print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
                    }
                }
            }
            else{
                $sql2 = "INSERT INTO `car` (`UID`, `id`, `name`, `goods_id`, `goods_number`, `goods_price`, `goods_name`, `goods_pic`, `count`, `sort1`, `sort2`) VALUES (NULL, '$userID', '$userName', '$goodsID', '$leftcount', '$goods_price', '$goods_name', '$goods_pic', '$buy_num', '$sort1', '$sort2')";
                $res2 = mysqli_query($con,$sql2);
                if(!$res2){
                    die("数据库连接失败!" . mysqli_error($res2));
                }else{
                    if($res2){
                        $arr = array("code"=>"1","msg"=>"添加成功!");
                        print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
                    }else{
                        $arr = array("code"=>"0","msg"=>"添加失败!");
                        print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
                    }
                }
            }
        }else{
            $arr = array("code"=>"0","msg"=>"添加失败!");
            print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
        }
    }
}

function getCar($con,$userID,$userName,$num_0){
    $sql = "SELECT * FROM `car` WHERE `id` = '$userID' AND `name` = '$userName' AND `indent` = '$num_0' AND `rember` = '$num_0'";
    $res = mysqli_query($con,$sql);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }else{
        $row = mysqli_fetch_assoc($res);
        $arr = array();
        if($row){;
            while($row){
                array_push($arr,$row);
                $row = mysqli_fetch_assoc($res);
            }
        }else{
            $arr = array("code"=>0,'msg'=>"购物车空空如也!");
        }
    }
    print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}


function updaNum($con,$userID,$goodsID,$buy_num,$num_0){
    $sql = "UPDATE `car` SET `count` = '$buy_num' WHERE `id` = '$userID' AND `goods_id` = '$goodsID' AND `indent` = '$num_0' AND `rember` = '$num_0'";
    $res = mysqli_query($con,$sql);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }
    else{
        $sql2 = "SELECT * FROM `car` WHERE `id` = '$userID' AND `indent` = '$num_0' AND `rember` = '$num_0'";
        $res2 = mysqli_query($con,$sql2);
        $arr = array();
        $row2 = mysqli_fetch_assoc($res2);
        while($row2){
            array_push($arr,$row2);
            $row2 = mysqli_fetch_assoc($res2);
        }
    }
    print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

function del($con,$userID,$goodsID,$del){
    $sql = "DELETE FROM `car` WHERE `id` = '$userID' AND `goods_id` = '$goodsID' AND `indent` = '$del'";
    $res = mysqli_query($con,$sql);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }else{
        if($res == 1){
            $arr = array("code"=>"1","msg"=>"删除成功");
        }
        else{
            $arr = array("code"=>"0","msg"=>"发生错误!");
        }
    }
    print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

function check($con,$userID,$goodsID,$del){
    $sql = "UPDATE `car` SET `is_select`='$del' WHERE `id` = '$userID ' AND `goods_id` = '$goodsID'";
    $res = mysqli_query($con,$sql);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }else{
        if($res == 1){
            $arr = array("code"=>"1","msg"=>"修改成功");
        }
        else{
            $arr = array("code"=>"0","msg"=>"发生错误!");
        }
    }
    print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

function history($con,$userID){
    $sql = "SELECT * FROM `car` WHERE `indent` = '1' AND `rember` = '0' AND `id` = '$userID'";
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
        }
        else{
            $arr = array("code"=>0,'msg'=>"暂无历史订单");
        }
    }
    print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

function rember($con,$userID,$goodsID){
    $sql = "UPDATE `car` SET `rember`= '1' WHERE `id` = '$userID' AND `indent` = '1' AND `goods_id` = '$goodsID'";
    $res = mysqli_query($con,$sql);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }else{
        $sql = "SELECT * FROM `car` WHERE `indent` = '1' AND `rember` = '0' AND `id` = '$userID'";
        $res2 = mysqli_query($con,$sql);
        $row = mysqli_fetch_assoc($res2);
        $arr = array();
        if($row){
            while($row){
                array_push($arr,$row);
                $row = mysqli_fetch_assoc($res);
            }
        }
        else{
            $arr = array("code"=>0,'msg'=>"暂无历史订单");
        }
    }
    print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}
function updaIndent($con,$num_1,$userID,$goodsID,$num_0){
    $sql = "UPDATE `car` SET `indent` = '$num_1' WHERE `id` = '$userID' AND `goods_id` IN $goodsID";
    $res = mysqli_query($con,$sql);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }
    else{
        $sql2 = "SELECT * FROM `car` WHERE `id` = '$userID' AND `indent` = '$num_0' AND `rember` = '$num_0'";
        $res2 = mysqli_query($con,$sql2);
        $arr = array();
        $row2 = mysqli_fetch_assoc($res2);
        if($row2){
            while($row2){
                array_push($arr,$row2);
                $row2 = mysqli_fetch_assoc($res2);
            }
        }else{
            $arr = array("code"=>0,"msg"=>"购物车空空如也!");
        }
    }
    print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}


switch ($way) {
    case 'fun1':
        saveCar($con,$goodsID,$userID,$userName,$buy_num);
        break;
    case 'fun2':
        getCar($con,$userID,$userName,$num_0);
        break;
    case 'fun3':
        updaNum($con,$userID,$goodsID,$buy_num,$num_0);
        break;
    case 'fun4':
        del($con,$userID,$goodsID,$del);
        break;
    case 'fun5':
        check($con,$userID,$goodsID,$del);
        break;
    case 'fun6':
        history($con,$userID);
        break;
    case 'fun7':
        rember($con,$userID,$goodsID);
        break;
    case 'fun8':
        updaIndent($con,$num_1,$userID,$goodsID,$num_0);
        break;
    default:
        # code...
        break;
}
?>