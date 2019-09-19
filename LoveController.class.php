<?php
namespace Home\Controller;
use Think\Controller;
class LoveController extends Controller{
	/*BEGIN*/
public function index(){

	}
public function getuser(){
	header('access-control-allow-origin:*');
	header('Content-Type:application/json;charset=utf-8');
	$obj=M('user');
	$user=$obj->select();
	$data['data']=$user;
	exit(json_encode($data));
}
public function getmoney(){
	$obj=M('money');
	$date=date("Y/m/d");
	$money=$obj->where("date='$date'")->select();
	$data['data']=$money;
	exit(json_encode($data));
}

public function money_daily(){
	$obj=M('money');
	$data['date']=date("Y/m/d");
	$data['user']=$_POST['user'];
	$data['id']=md5($data['date'].$data['user']);
	$id=$data['id'];
	$data['money']=$_POST['money'];
	$data['status']="0";
	$count=$obj->where("id='$id'")->count();
	if($count==0){
	$res=$obj->add($data);
	if($res==1)
		$resjson['code']="1";
	else
		$resjson['code']="0";	
	}
	else
		$resjson['code']="0";
	exit(json_encode($resjson));
}

public function change_status(){
	$obj=M('money');	
	$id=$_POST['id'];
	$data['status']="1";
	$res=$obj->where("id='$id'")->save($data);
	if($res==1)
		$resjson['code']="1";
	else
		$resjson['code']="0";	
	exit(json_encode($resjson));
}
public function add_money(){
	$obj=M('user');	
	$id=$_POST['id'];
	$data['money']=$_POST['money'];
	$money=$obj->where("id='$id'")->select();
	$data['money']=$money[0]['money']+$data['money'];
	$res=$obj->where("id='$id'")->save($data);
	if($res==1)
		$resjson['code']="1";
	else
		$resjson['code']="0";	
	exit(json_encode($resjson));
}
	
public function change_money(){
	$obj=M('money');	
	$id=$_POST['id'];
	$data['money']=$_POST['money'];
	$res=$obj->where("id='$id'")->save($data);
	if($res==1)
		$resjson['code']="1";
	else
		$resjson['code']="0";	
	exit(json_encode($resjson));
}
		
}


