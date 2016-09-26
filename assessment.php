<?php
    // display errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-type: text/html; charset=utf-8');
    require_once('config.php');
    require_once('includes/class-Assessment.php');

    // start the assessment
    $assessment = new Assessment();
    $state = $assessment->get_state();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Social Bridges Assessment</title>
    <style><?php include_once('dist/css/critical.min.css');?></style>
    <link rel='stylesheet' href='dist/css/<?php echo $state;?>.min.css' />
    <!--[if lt IE 9]>
        <script src="dist/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
<?php include('views/header.php');?>
<main aria-live="polite" aria-relevant="additions text" class="container">
<?php include("views/$state.php");?></main>
<script type='text/javascript' src='dist/js/<?php echo $state;?>.min.js'></script>
</body>
</html>
