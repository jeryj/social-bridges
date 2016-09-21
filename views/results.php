<div class="container">
    <h1 class="results__section-title">Results</h1>
    <div class="well">
        <?php
            $correct = $assessment->get_answered_correctly();
            $questions = $assessment->get_total_questions();
            $percentage = $assessment->percentagize($correct, $questions);
        ?>

        <h2 class="results__title">Total Correct</h2>
        <div class="score">
            <p class="score__title"><?php echo $percentage;?><span class="score__percentage">%</span>
                <span class="score__fraction">
                    <?php echo $correct;?> of <?php echo $questions;?>
                    <span class="sr"> Correct</span>
                </span>
            </p>
            <svg class="score-circle" width="200" height="200" viewPort="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
              <circle class="score-circle__bg" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
              <circle class="score-circle__path" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="<?php echo $assessment->get_score_circle_dashoffset($percentage);?>"></circle>
            </svg>
        </div>
    </div>
</div>

<div class="container">
    <h2 class="results__section-title"><span class="sr">Results </span>Breakdown</h2>
    <div class="results well">
        <?php
        $types = array('phrase', 'application');
        foreach($types as $type) :
            $total = $assessment->get_total_questions($type);
            $correct = $assessment->get_answered_correctly($type);
            $questions = $assessment->get_total_questions($type);
            $percentage = $assessment->percentagize($correct, $questions);
            ?>
            <div class="result">
                <h3 class="results__title"><?php echo ucfirst($type);?></h3>
                <?php if($type === 'phrase') {
                    echo '<p class="results__description">"Who is..." type questions</p>';
                } else if($type === 'application') {
                    echo '<p class="results__description">Scenario type questions.</p>';
                }?>

                <div class="score score--breakdown">
                    <p class="score__title"><?php echo $percentage;?><span class="score__percentage">%</span><span class="score__fraction"><?php echo $correct;?> of <?php echo $questions;?><span class="sr"> Correct</span></span></p>
                    <svg class="score-circle" width="200" height="200" viewPort="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                      <circle class="score-circle__bg" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
                      <circle class="score-circle__path" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="<?php echo $assessment->get_score_circle_dashoffset($percentage);?>"></circle>
                    </svg>
                </div>
            </div>
        <?php endforeach;?>

    </div>
</div>

<p class="restart-assessment"><a class="btn" href="assessment.php">Restart Assessment</a></p>
