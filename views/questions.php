
<?php
// output errors, if any
$assessment->get_error_messages();?>

<form id="assessment" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
    <div id="progressbar"
        role="progressbar"
        aria-valuemin="1"
        aria-valuenow="<?php echo ($assessment->get_current_question_number() + 1);?>"
        aria-valuemax="<?php echo $assessment->get_total_questions();?>"
        style="width:<?php echo (($assessment->get_current_question_number() + 1)/$assessment->get_total_questions())*100;?>%">
        <span class="sr">Question </span>
        <span id="progress__cqn"><?php echo ($assessment->get_current_question_number() + 1);?></span> of <?php echo $assessment->get_total_questions();?>
    </div>

    <input id="tq" type="hidden" name="total_questions" value="<?php echo $assessment->get_total_questions();?>"/>
    <input id="ac" type="hidden" name="answered_correctly" value="<?php echo $assessment->get_answered_correctly();?>"/>
    <input id="phrase_ac" type="hidden" name="phrase_answered_correctly" value="<?php echo $assessment->get_answered_correctly('phrase');?>"/>
    <input id="application_ac" type="hidden" name="application_answered_correctly" value="<?php echo $assessment->get_answered_correctly('application');?>"/>
    <input id="q_id" type="hidden" name="current_question_number" value="<?php echo $assessment->get_current_question_number();?>"/>

    <?php
        // get the question
        $question_number = $assessment->get_current_question_number();
        $question = new Question($question_number);
    ?>
    <div id="question-container" class="well" tabindex="-1">
        <fieldset id="question">

            <legend><?php echo $question->get_question();?></legend>

            <?php $expressions = $question->get_expression();
            foreach($expressions as $expression) {
                $expression = new Expression($expression);
                include('views/expression.php');
            } ?>

        </fieldset>
    </div>
    <button id="btn--submit" class="btn">Submit</button>
</form>
