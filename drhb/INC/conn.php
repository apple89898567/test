<?php
 header("Content-Type:text/html;charset=utf-8");
 session_start();
 $conn=@mysql_connect("localhost","root","250025") or die("���ݿ�����ʧ��!");
 @mysql_select_db("name",$conn) or die("���ݿ�����ʧ��!");
mysql_query("set character set 'utf8'");
mysql_query("set names 'utf8'");

?>