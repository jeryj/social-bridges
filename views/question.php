<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
    <?php
    // output errors, if any
    $assessment->get_error_messages();?>
    <input type="hidden" name="answered_correctly" value="<?php echo $assessment->get_answered_correctly();?>"/>
    <input type="hidden" name="current_question_number" value="<?php echo $assessment->get_current_question_number();?>"/>

    <?php
        // get the question
        $question_number = $assessment->get_current_question_number();
        $question = new Question($question_number);
    ?>
    <fieldset>
        <legend id="question"><?php echo $question->get_question();?></legend>

        <?php $expressions = $question->get_expression();
        foreach($expressions as $expression) {
            $expression = new Expression($expression);
            include('views/expression.php');
        } ?>
    </fieldset>
    <button>Submit</button>
</form>
