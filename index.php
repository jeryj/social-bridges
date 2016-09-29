<?php
require_once('config.php');
require_once('includes/class-Assessment.php');
// set the button text for starting or resuming an assessment
if(isset($_COOKIE['state']) && $_COOKIE['state'] === 'results') {
    // just offer a Resume Assessment
    $assessment_btn_text = 'Resume Asessement';
}
// check if we're on the first question or not
elseif(isset($_COOKIE['cqn']) && $_COOKIE['cqn'] != 0) {
    $assessment_btn_text = $assessment_btn_text = 'Resume Asessement';
} else {
    $assessment_btn_text = 'Start Assessment';
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Social Bridges</title>
    <style><?php include_once('dist/css/critical.min.css');?></style>
    <link rel='stylesheet' href='dist/css/questions.min.css'/>
    <link rel='stylesheet' href='dist/css/results.min.css'/>
    <link rel='stylesheet' href='dist/css/home.min.css'/>

    <!--[if lt IE 9]>
        <link rel='stylesheet' href='dist/css/ie8.min.css' />
        <script src="dist/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
<?php include('views/header.php');?>
<main>
    <section class="hero">
        <div class="container">
            <h1 class="ad__title">Test Social Comprehension</h1>
            <p class="ad__description">Used by Speech Language Pathologists as a therapy practice tool for emotional recognition and pragmatic awareness.</p>
            <div id="question-container" class="well">
                <figure id="question" aria-role="presentation">
                    <figcaption><span class="sr">Example question from the Social Bridges Assessment</span></figcaption>
                    <div class="question__text">Who is happy?</div>
                    <label class="exp">
                        <img class="face" src="dist/img/happy.jpg" alt="" />
                        <span class="sr">Face with pouted bottom lip, furrowed brow with horizontal eyebrows, and open, caring eyes.</span>
                    </label>
                    <label class="exp">
                        <img class="face" src="dist/img/distracted.jpg" alt="" />
                        <span class="sr">Face with eyes open normally, staring straight ahead. Mouth straight and facial muscles relaxed.</span>
                    </label>
                </figure>
                <a class="overlay-link" href='assessment.php'></a>
            </div>
            <p class="ad__link-container"><a class="btn" href="assessment.php"><?php echo $assessment_btn_text;?></a></p>
        </div>
    </section>
    <section class="report-container">
        <div class="container">
            <h2 class="ad__title">Detailed Results</h2>
            <p class="ad__description">Get a full-picture of your student's assessment in a glance, so you always know what to work on next.</p>
            <figure class="results well">
                <div class="result">
                    <h3 class="results__title">Phrase</h3>
                    <p class="results__description">"Who is..." type questions</p>
                    <div class="score score--breakdown">
                        <p class="score__title">75<span class="score__percentage">%</span><span class="score__fraction">3 of 4<span class="sr"> Correct</span></span></p>
                        <svg class="score-circle" width="200" height="200" viewport="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                          <circle class="score-circle__bg" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
                          <circle class="score-circle__path score-circle__setOffset" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="141.371669412"></circle>
                        </svg>
                    </div>
                </div>
                <div class="result">
                    <h3 class="results__title">Application</h3>
                    <p class="results__description">Scenario type questions.</p>
                    <div class="score score--breakdown">
                        <p class="score__title">50<span class="score__percentage">%</span><span class="score__fraction">2 of 4<span class="sr"> Correct</span></span></p>
                        <svg class="score-circle" width="200" height="200" viewport="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                          <circle class="score-circle__bg" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
                          <circle class="score-circle__path score-circle__setOffset" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="282.743338823"></circle>
                        </svg>
                    </div>
                </div>
            </figure>
            <p class="ad__link-container"><a class="btn" href="assessment.php"><?php echo $assessment_btn_text;?></a></p>
        </div>
    </section>
</main>
<footer class="footer">
    <p>Social Bridges &copy; <?php echo Date('Y');?>
</footer>
</body>
</html>
