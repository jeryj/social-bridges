<h1>Results</h1>
<h3>Total Correct</h3>
<p><?php echo $assessment->get_answered_correctly();?>/<?php echo $assessment->get_total_questions();?> Correct</p>

<h2>Breakdown by Difficulty</h2>
<?php
$difficulty = array('easy', 'intermediate', 'hard');
foreach($difficulty as $diff) {
    $total = $assessment->get_total_questions($diff);
    if(0 < $total) {?>
        <h3><?php echo ucfirst($diff);?> Questions</h3>
        <p><?php echo $assessment->get_answered_correctly($diff);?>/<?php echo $assessment->get_total_questions($diff);?> Correct</p>
    <?php }
}?>


<h2>Breakdown by Question Type</h2>

<?php
$types = array('who', 'which');
foreach($types as $type) {
    $total = $assessment->get_total_questions($type);
    if(0 < $total) {?>
        <h3>&ldquo;<?php echo ucfirst($type);?>&rdquo; Questions</h3>
        <p><?php echo $assessment->get_answered_correctly($type);?>/<?php echo $assessment->get_total_questions($type);?> Correct</p>
    <?php }
}?>


<p><a href="assessment.php">Restart Assessment</a></p>
