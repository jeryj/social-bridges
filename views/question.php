
<?php
// output errors, if any
$assessment->get_error_messages();?>

<form method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
    <div class="progressbar"
        role="progressbar"
        aria-valuemin="1"
        aria-valuenow="<?php echo ($assessment->get_current_question_number() + 1);?>"
        aria-valuemax="<?php echo $assessment->get_total_questions();?>"
        style="width:<?php echo (($assessment->get_current_question_number() + 1)/$assessment->get_total_questions())*100;?>%">
        <?php echo ($assessment->get_current_question_number() + 1);?>/<?php echo $assessment->get_total_questions();?>
    </div>

    <input type="hidden" name="answered_correctly" value="<?php echo $assessment->get_answered_correctly();?>"/>
    <input type="hidden" name="easy_answered_correctly" value="<?php echo $assessment->get_answered_correctly('easy');?>"/>
    <input type="hidden" name="intermediate_answered_correctly" value="<?php echo $assessment->get_answered_correctly('intermediate');?>"/>
    <input type="hidden" name="hard_answered_correctly" value="<?php echo $assessment->get_answered_correctly('hard');?>"/>
    <input type="hidden" name="who_answered_correctly" value="<?php echo $assessment->get_answered_correctly('who');?>"/>
    <input type="hidden" name="which_answered_correctly" value="<?php echo $assessment->get_answered_correctly('which');?>"/>
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
