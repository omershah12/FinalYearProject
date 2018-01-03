<?php
//Session Start 
session_start();

//Session deleted
session_destroy();

//When session is destroyed the user will be returned to signin.php via home.php
header("Location:../../View/Home/home.php");

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

