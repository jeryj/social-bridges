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
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Social Bridges Assessment</title>
    <link rel='stylesheet' href='dist/css/styles.min.css' />
</head>
<body>
<?php include('views/header.php');?>
<main>
    <?php
    $state = $assessment->get_state();
    if($state === 'question') {
        include('views/question.php');
    } else {
        include ('views/results.php');
    }?>

</main>
<footer></footer>
<?php if($state === 'question') { ?>
    <script type='text/javascript' src='dist/js/scripts.min.js'></script>
<?php } ?>
</body>
</html>
