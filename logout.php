<?php
session_start();
session_destroy();
header("Location: index.php?act=login");
exit;
