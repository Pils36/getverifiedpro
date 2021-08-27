<?php
/**
 * Created by PhpStorm.
 * User: Funsho Olaniyi
 * Date: 24/03/2018
 * Time: 05:13 AM
 */


spl_autoload_register(/**
 * @param $class
 */
	function ($class) {
		
		$folders = array(
			"core" => "app/Core/",
			"models" => "app/Models/",
		);
		
		
		
		if (isset($class)) {
			
			$exist = false;
			foreach ($folders as $key => $folder) {
			    
			 //   print_r(ROOT . $folder . $class . ".php");
// 		exit;
				
				if (file_exists(ROOT . $folder . $class . ".php")) {
					/** @noinspection PhpIncludeInspection */
					require_once ROOT . $folder . $class . ".php";
					$exist = true;
				} elseif (file_exists(ROOT . $folder . strtolower($class) . ".php")) {
					/** @noinspection PhpIncludeInspection */
					require_once ROOT . $folder . strtolower($class) . ".php";
					$exist = true;
				} elseif (file_exists(ROOT . $folder . "class." . strtolower($class) . ".php")) {
					/** @noinspection PhpIncludeInspection */
					require_once ROOT . $folder . "class." . strtolower($class) . ".php";
					$exist = true;
				}
			}
			
			if (!$exist) {
				die("File for Class " . ucfirst($class) . " not found");
			}
		}
	});

/* ----------- End of Main ----------- */
