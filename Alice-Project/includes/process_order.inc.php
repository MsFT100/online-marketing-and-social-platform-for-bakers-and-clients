<?php
session_start();
include 'dbhlogin.inc.php';
include 'functions.inc.php';

processItems($conn);
