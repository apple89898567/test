<?php
//判断是否配置基本信息开始
$sql="select * from ws_config";
$rs=mysql_query($sql,$conn);
if($row=mysql_fetch_array($rs)){
	if($row["webon"]==1){
		echo $row["off_sm"];
		exit;
	}
}else{
	echo "请登录后台配置网站！";
	exit;
}

//判断是否配置基本信息结束

//判断客户ip是否锁定开始
$sql="select * from ws_sqlin where ip='".getIP()."'";
$rs=mysql_query($sql,$conn);
while($row=mysql_fetch_array($rs)){
	if($row["killip"]==1){
		echo "<script>alert('您的IP已被拉黑锁定，请联系管理员！');window.opener=null; window.close();</script>";
		exit;
	}
}
//判断客户ip是否锁定结束

$sql="select * from ws_sqlconfig";
$rs=mysql_query($sql,$conn);
if($row=mysql_fetch_array($rs)){
	$keywords=$row["keywords"];
	$killip=$row["killip"];
	$anquanis=$row["anquanis"];
	$anquan=$row["anquan"];
	$alerttype=$row["alerttype"];
	$alertinfo=$row["alertinfo"];
}else{
	echo "请登录后台配置SQL注入设置！";
	exit;
}
if($_POST){
	$cs=$_POST;
	if($anquanis==1){
		if(!stristr($anquan,$_SERVER['PHP_SELF'])){
			foreach($cs as $key=>$value){
				if(stristr($keywords,$value)){
					if ($killip==1){
						$k=1;
					}else{
						$k=0;
					}
					$sql="insert into ws_sqlin(id,ip,web,intime,fs,cs,sj,killip)value(null,'".getIP()."','".$_SERVER['PHP_SELF']."',now(),'POST','".$value."','".$key."',".$k.")";
					mysql_query($sql,$conn);
					if($alerttype==1){
						echo "<script>alert('".$alertinfo."');this.location.href='index.php';</script>";
						exit;
					}else{
						echo "<script>alert('".$alertinfo."');window.opener=null; window.close();</script>";
						exit;
					}
					break;
				}
			}
		}
	}else{
		
		foreach($cs as $key=>$value){
				if(stristr($keywords,$value)){
					if ($killip==1){
						$k=1;
					}else{
						$k=0;
					}
					$sql="insert into ws_sqlin(id,ip,web,intime,fs,cs,sj,killip)value(null,'".getIP()."','".$_SERVER['PHP_SELF']."',now(),'GET','".$value."','".$key."',".$k.")";
					mysql_query($sql,$conn);
					if($alerttype==1){
						echo "<script>alert('".$alertinfo."');this.location.href='index.php';</script>";
						exit;
					}else{
						echo "<script>alert('".$alertinfo."');window.opener=null; window.close();</script>";
						exit;
					}
					break;
				}
			}
	}
}elseif($_GET){
	$cs=$_GET;
	if($anquanis==1){
		if(!stristr($anquan,$_SERVER['PHP_SELF'])){
			foreach($cs as $key=>$value){
				if(stristr($keywords,$value)){
					if ($killip==1){
						$k=1;
					}else{
						$k=0;
					}
					$sql="insert into ws_sqlin(id,ip,web,intime,fs,cs,sj,killip)value(null,'".getIP()."','".$_SERVER['PHP_SELF']."',now(),'GET','".$value."','".$key."',".$k.")";
					mysql_query($sql,$conn);
					if($alerttype==1){
						echo "<script>alert('".$alertinfo."');this.location.href='index.php';</script>";
						exit;
					}else{
						echo "<script>alert('".$alertinfo."');window.opener=null; window.close();</script>";
						exit;
					}
					break;
				}
			}
		}
	}else{
		
		foreach($cs as $key=>$value){
				if(stristr($keywords,$value)){
					if ($killip==1){
						$k=1;
					}else{
						$k=0;
					}
					$sql="insert into ws_sqlin(id,ip,web,intime,fs,cs,sj,killip)value(null,'".getIP()."','".$_SERVER['PHP_SELF']."',now(),'GET','".$value."','".$key."',".$k.")";
					mysql_query($sql,$conn);
					if($alerttype==1){
						echo "<script>alert('".$alertinfo."');this.location.href='index.php';</script>";
						exit;
					}else{
						echo "<script>alert('".$alertinfo."');window.opener=null; window.close();</script>";
						exit;
					}
					break;
				}
			}
	}
	
}
?>