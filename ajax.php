<?php
function db_connect($str,$dbn){
	$connect = mysql_connect('localhost', 'root', '') or die ("Can`t connect to db!");
	mysql_query("SET NAMES utf8");
	$db=mysql_select_db ($dbn, $connect);
	$result = mysql_query($str,$connect);
	return $result;
}
function getList($query){
	$select=db_connect($query,'uh371665_info');
	while($row = mysql_fetch_row($select)){
		$list_of_news[]=$row;
	}
	if(!empty($list_of_news)){
		return $list_of_news;
	}
}
if(!empty($_POST)){
   if(!empty($_POST['edit_id'])){
           $id = $_POST['edit_id'];
           $query = 'SELECT * FROM `students` WHERE `id`='.$id.';';
           $list = getList($query);
           echo json_encode($list);
    }
}
?>