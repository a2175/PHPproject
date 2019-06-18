<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title><?php echo $this->title?></title>
<link rel="stylesheet" href="<?php echo _CSS?>common.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo _JS?>common.js"></script>
</head>
<body>
<header id="header">
    <div>
        <div id="logo">
            <h3><a href="<?php echo _URL?>">MVC MODEL HOMPAGE</a></h3>
        </div>
    </div>
    <nav id="gnb">
        <ul>
            <li><a href="<?php echo _URL?>board">게시판</a></li>
            <li><a href="<?php echo _URL?>chat">채팅</a></li>
        </ul>
    </nav>
</header>
<form id="commonForm" name="commonForm"></form>