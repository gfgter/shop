<?php 
$way = $_GET['way'];
$length = 12;
$num = ($_GET['num'] * $length);
$key_word = $_GET['key_word'];



$con = mysqli_connect('localhost','project','123456','project');

// id升序
function dataArray1($con,$num,$length){
    $sql = "SELECT * FROM `goods` ORDER BY `id` ASC LIMIT $num,$length";
    $res = mysqli_query($con,$sql);
    $arr = array();
    $row = mysqli_fetch_assoc($res);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }if($res){
        while($row){
            array_push($arr,$row);
            $row = mysqli_fetch_assoc($res);
        }
}
print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

// id降序
function dataArray2($con,$num,$length){
    $sql = "SELECT * FROM `goods` ORDER BY `id` DESC LIMIT $num,$length";
    $res = mysqli_query($con,$sql);
    $arr = array();
    $row = mysqli_fetch_assoc($res);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }if($res){
        while($row){
            array_push($arr,$row);
            $row = mysqli_fetch_assoc($res);
        }
}
print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

// 价格升序
function dataArray3($con,$num,$length){
    $sql = "SELECT * FROM `goods` ORDER BY `price` ASC LIMIT $num,$length";
    $res = mysqli_query($con,$sql);
    $arr = array();
    $row = mysqli_fetch_assoc($res);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }if($res){
        while($row){
            array_push($arr,$row);
            $row = mysqli_fetch_assoc($res);
        }
}
print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

// 价格降序
function dataArray4($con,$num,$length){
    $sql = "SELECT * FROM `goods` ORDER BY `price` DESC LIMIT $num,$length";
    $res = mysqli_query($con,$sql);
    $arr = array();
    $row = mysqli_fetch_assoc($res);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }if($res){
        while($row){
            array_push($arr,$row);
            $row = mysqli_fetch_assoc($res);
        }
}
print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

// 上架时间升序
function dataArray5($con,$num,$length){
    $sql = "SELECT * FROM `goods` ORDER BY `launch_time` ASC LIMIT $num,$length";
    $res = mysqli_query($con,$sql);
    $arr = array();
    $row = mysqli_fetch_assoc($res);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }if($res){
        while($row){
            array_push($arr,$row);
            $row = mysqli_fetch_assoc($res);
        }
}
print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

// 上架时间降序
function dataArray6($con,$num,$length){
    $sql = "SELECT * FROM `goods` ORDER BY `launch_time` DESC LIMIT $num,$length";
    $res = mysqli_query($con,$sql);
    $arr = array();
    $row = mysqli_fetch_assoc($res);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }if($res){
        while($row){
            array_push($arr,$row);
            $row = mysqli_fetch_assoc($res);
        }
}
print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

// 销售量升序
function dataArray7($con,$num,$length){
    $sql = "SELECT * FROM `goods` ORDER BY `hadsale` ASC LIMIT $num,$length";
    $res = mysqli_query($con,$sql);
    $arr = array();
    $row = mysqli_fetch_assoc($res);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }if($res){
        while($row){
            array_push($arr,$row);
            $row = mysqli_fetch_assoc($res);
        }
}
print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}
// 销售量降序
function dataArray8($con,$num,$length){
    $sql = "SELECT * FROM `goods` ORDER BY `hadsale` DESC LIMIT $num,$length";
    $res = mysqli_query($con,$sql);
    $arr = array();
    $row = mysqli_fetch_assoc($res);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }if($res){
        while($row){
            array_push($arr,$row);
            $row = mysqli_fetch_assoc($res);
        }
}
print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

// 有货查询
function dataArray9($con,$num,$length){
    $sql = "SELECT * FROM `goods` WHERE `leftcount` > 0 ORDER BY `leftcount` DESC LIMIT $num,$length";
    $res = mysqli_query($con,$sql);
    $arr = array();
    $row = mysqli_fetch_assoc($res);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }if($res){
        while($row){
            array_push($arr,$row);
            $row = mysqli_fetch_assoc($res);
        }
}
print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

// 关键字查询
function dataArray10($con,$num,$length,$key_word){
    $sql = "SELECT * FROM `goods` WHERE `goods_name` LIKE '%$key_word%' LIMIT $num,$length";
    $res = mysqli_query($con,$sql);
    $arr = array();
    $row = mysqli_fetch_assoc($res);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }if($res){
        while($row){
            array_push($arr,$row);
            $row = mysqli_fetch_assoc($res);
        }
}
print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

function dataArray11($con,$num,$length,$key_word){
    $sql = "SELECT * FROM `goods` WHERE `sort2` = '$key_word' LIMIT $num,$length";
    $res = mysqli_query($con,$sql);
    $arr = array();
    $row = mysqli_fetch_assoc($res);
    if(!$res){
        die("数据库连接失败!" . mysqli_error($res));
    }if($res){
        while($row){
            array_push($arr,$row);
            $row = mysqli_fetch_assoc($res);
        }
}
print_r(json_encode($arr,JSON_UNESCAPED_UNICODE));
}

switch ($way) {
    case 'fun1':
        dataArray1($con,$num,$length);
        break;
    case 'fun2':
        dataArray2($con,$num,$length);
        break;
    case 'fun3':
        dataArray3($con,$num,$length);
        break;
    case 'fun4':
        dataArray4($con,$num,$length);
        break;
    case 'fun5':
        dataArray5($con,$num,$length);
        break;
    case 'fun6':
        dataArray6($con,$num,$length);
        break;
    case 'fun7':
        dataArray7($con,$num,$length);
        break;
    case 'fun8':
        dataArray8($con,$num,$length);
        break;
    case 'fun9':
        dataArray9($con,$num,$length);
        break;
    case 'fun10':
        dataArray10($con,$num,$length,$key_word);
        break;
    case 'fun11':
        dataArray11($con,$num,$length,$key_word);
        break;
    default:
        # code...
        break;
}
?>