<h1>Results</h1>
<h3>Total Correct</h3>
<p><?php echo $assessment->get_answered_correctly();?>/<?php echo $assessment->get_total_questions();?> Correct</p>


<?php
$types = array('phrase', 'application');
foreach($types as $type) {
    $total = $assessment->get_total_questions($type);
    if(0 < $total) {?>
        <h3><?php echo ucfirst($type);?> Questions</h3>
        <p><?php echo $assessment->get_answered_correctly($type);?>/<?php echo $assessment->get_total_questions($type);?> Correct</p>
    <?php }
}?>


<p><a href="assessment.php">Restart Assessment</a></p>
