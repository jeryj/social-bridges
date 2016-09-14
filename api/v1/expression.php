<?php

require_once('../../config.php');

if(isset($_GET['expression'])) {
    $expression = $_GET['expression'];

    require_once(ROOT_DIR.'/includes/class-Expression.php');
    // try getting the expression
    $expression = new Expression($expression);
    // convert to json
    echo json_encode($expression);
    die;
} else {
    echo 'No expression requested.';
    die;
}

?>
