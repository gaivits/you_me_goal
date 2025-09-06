<?php
session_start();
session_destroy();
header("Location: http://127.0.0.1/xampp/you_me_goal/index.php");
exit;
