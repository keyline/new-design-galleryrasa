<?php


   function dbconnect()
   {
       try {
           $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);
           $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
           $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $conn->query("SET SESSION sql_mode=''")->execute(); //added due to sql_mode=only_full_group_by on 26/09/2022 by shuvadeep@keylines.net

           return $conn;
       } catch (PDOException $e) {
           echo db_error($e->getMessage());
       }
   }
