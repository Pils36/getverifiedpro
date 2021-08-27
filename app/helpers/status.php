<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 03/04/2018
 * Time: 03:54 PM
 */

function getOnlineUsers()
{
	$array = array();
	
	$res = mysql_query("SELECT * FROM `posts` WHERE status=1");
	if (mysql_num_rows($res) > 0) {
		while ($row = mysql_fetch_assoc($res)) {
			$array[] = $row['user_id'];  // this adds each online user id to the array
		}
	}
	echo json_encode($array);
}

function stayOnline()
{

}