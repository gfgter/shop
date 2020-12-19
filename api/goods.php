<?php

$way = $_GET['way'];
$keyword = $_GET['keyword'];

$goodsID = $_GET['goodsID'];
$goodsName = $_GET['goodsName'];
$img1 = $_GET['img1'];
$img2 = $_GET['img2'];
$img3 = $_GET['img3'];
$img4 = $_GET['img4'];
$img5 = $_GET['img5'];
$price = $_GET['price'];
$hadsale = $_GET['hadsale'];
$leftcount = $_GET['leftcount'];
$listimg = $_GET['listimg'];
$sort2 = $_GET['sort2'];



$con = mysqli_connect('localhost','project','123456','project');


function getGoods($con){
    $sql = "SELECT * FROM `goods`";
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
        }
    }
    print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}
function history($con){
    $sql = "SELECT * FROM `car` WHERE `indent` = '1'";
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
            $arr = array("code"=>0,'msg'=>"暂无订单");
        }
    }
    print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

function selectGoods($con,$keyword){
    $sql = "SELECT * FROM  `goods` WHERE `goods_name` LIKE '%$keyword%' ";
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
            $arr = array("code"=>0,"msg"=>"此商品不存在");
        }
    }
    print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}
function delGoods($con,$goodsID){
    $sql = "DELETE FROM  `goods` WHERE `goods_id` = '$goodsID' ";
    $res = mysqli_query($con,$sql);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }else{
        $sql2 = "SELECT * FROM  `goods` ";
        $res2 = mysqli_query($con,$sql2);
        $row = mysqli_fetch_assoc($res2);
        $arr = array();
        if($row){
            while($row){
                array_push($arr,$row);
                $row = mysqli_fetch_assoc($res2);
            }
        }else{
            $arr = array("code"=>0,"msg"=>"暂无更多数据");
        }
    }
    print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

function addGoods($con,$goodsID,$goodsName,$img1,$img2,$img3,$img4,$img5,$price,$hadsale,$leftcount,$listimg,$sort2){
    $sql = "SELECT * FROM  `goods` WHERE `goods_id` = '$goodsID' ";
    $res = mysqli_query($con,$sql);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }else{
        $row = mysqli_fetch_assoc($res);
        $arr = array();
        if($row){
            $arr = array("code"=>0,"msg"=>"此商品已存在");
        }else{
            $sql2="INSERT INTO `goods` (`id`, `goods_id`, `goods_name`, `img1`, `img2`, `img3`, `img4`, `img5`, `details`, `price`, `hadsale`, `comments`, `leftcount`, `listimg`, `launch_time`, `weight`, `merchant_qq`, `merchant_tel`, `merchant_online_data`, `sort1`, `sort2`) VALUES (NULL, '$goodsID', '$goodsName', '$img1', '$img2', '$img3', '$img4', '$img5', NULL, '$price', '$hadsale', NULL, '$leftcount', '$listimg', NULL, '1kg', NULL, NULL, NULL, NULL, '$sort2');";
            $res2 = mysqli_query($con,$sql2);
            if($res2){
                $sql3 = "SELECT * FROM `goods`";
                $res3 = mysqli_query($con,$sql3);
                $row = mysqli_fetch_assoc($res3);
                $arr = array();
                if($row){
                    while($row){
                    array_push($arr,$row);
                    $row = mysqli_fetch_assoc($res3);
                }
                }else{
                    $arr = array("code"=>0,"msg"=>"暂无更多用户");
                }
            }
        }
    }
    print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

switch ($way) {
    case 'getGoods':
        getGoods($con);
        break;
    case 'history':
        history($con);
        break;
    case 'selectGoods':
        selectGoods($con,$keyword);
        break;
    case 'delGoods':
        delGoods($con,$goodsID);
        break;
    case 'addGoods':
        addGoods($con,$goodsID,$goodsName,$img1,$img2,$img3,$img4,$img5,$price,$hadsale,$leftcount,$listimg,$sort2);
        break;
    default:
        #code;
        break;
}
?>