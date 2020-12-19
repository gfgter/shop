<?php 
    $uid = $_GET['uid'];

    $con = mysqli_connect('localhost','project','123456','project');
    $sql = "SELECT * FROM `goods` WHERE `goods_id` = '$uid'";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($res);
    if(!$res){
        $arr=array("code"=>0,"msg"=>"error");
    }else{
        print_r(json_encode($row,JSON_UNESCAPED_UNICODE));
    }
?>