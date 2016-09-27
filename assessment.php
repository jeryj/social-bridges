<?php
// STARTUP
// display errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    header('Content-type: text/html; charset=utf-8');
    require_once('config.php');
    require_once('includes/class-Assessment.php');

    // start the assessment
    $assessment = new Assessment();
    $assessment->load_assessment();
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
        <link rel='stylesheet' href='dist/css/ie8.min.css' />
        <script src="dist/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
<?php include('views/header.php');?>
<main aria-live="polite" aria-relevant="additions text">
    <div class="container">
        <?php include("views/$state.php");?>
    </div>
</main>

<script>
if( window.FormData !== undefined) {
    document.addEventListener("DOMContentLoaded", function(event) {
        insertScript('<?php echo $state;?>');
    });
}
function insertScript(e){var t=document.getElementsByTagName("body")[0],a=document.createElement("script");a.type="text/javascript",a.src="dist/js/"+e+".min.js",t.appendChild(a)}</script>
</body>
</html>
