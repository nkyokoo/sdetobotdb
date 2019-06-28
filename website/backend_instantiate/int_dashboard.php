<?php

include '../backend_web/dashboard.php';

 $dashboard = new DashBoard();

 $info = $dashboard->__getInfo();

 echo $info;