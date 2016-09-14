<?php

require_once('../../config.php');

if(isset($_GET['id'])) {
    $id = (int) $_GET['id'];
    if($id < 0) {
        echo 'Invalid question number';
        die;
    }
    require_once(ROOT_DIR.'/includes/class-Question.php');
    // try getting a question
    $question = new Question($id);
    // convert to json
    echo json_encode($question);
    die;
} else {
    echo 'No question number provided';
    die;
}
?>
