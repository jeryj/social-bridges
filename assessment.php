<?php
    // display errors
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    header('Content-type: text/html; charset=utf-8');
    // required files
    require_once('includes/class-Question.php');
    require_once('includes/class-Expression.php');

    // set the question
    $question = new Question(0);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Social Bridges Assessment</title>
    <link rel='stylesheet' href='dist/css/styles.min.css' />
    <script type='text/javascript' src='dist/js/scripts.min.js'></script>
</head>
<body>
<header role='banner'>
    <h2><a href='/'>Social Bridges</a></h2>
</header>
<main>
    <form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
        <fieldset>
            <legend><?php echo $question->get_question();?></legend>
            <?php $expressions = $question->get_expression();
            foreach($expressions as $expression) {
                $expression = new Expression($expression);?>
                <label>
                    <input type="radio" name="facial_expression" value="<?php echo $expression->get_name();?>" />
                    <?php echo $expression->get_description();?>
                </label>
            <?php } ?>
        </fieldset>
        <button>Submit</button>
    </form>
    <!-- about the app and how to use it -->
</main>
<footer></footer>
</body>
</html>
