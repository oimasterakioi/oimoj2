<?php
require('../html/index.php');
require('../database/index.php');
if(getMethod() == "POST")
    $_SESSION['devtool'] = true;