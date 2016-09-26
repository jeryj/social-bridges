<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <title>Social Bridges</title>
    <style><?php include_once('dist/css/critical.min.css');?></style>

    <link rel='stylesheet' href='dist/css/questions.min.css' />
    <link rel='stylesheet' href='dist/css/results.min.css' />
    <link rel='stylesheet' href='dist/css/home.min.css' />
    <!--[if lt IE 9]>
        <script src="dist/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
<?php include('views/header.php');?>
<main>
    <div class="hero">
        <div class="container">
            <h1 class="ad__title">Assess Social Comrehension</h1>
            <div id="question-container" class="well">
                <fieldset id="question" aria-role="presentation">
                    <legend><span class="sr">Example Question: </span>Who is happy?</legend>

                        <label class="exp">
                            <img class="face" src="dist/img/happy.jpg" alt="" />
                            <span class="sr">Face with pouted bottom lip, furrowed brow with horizontal eyebrows, and open, caring eyes.</span>
                        </label>
                        <label class="exp">
                            <img class="face" src="dist/img/distracted.jpg" alt="" />
                            <span class="sr">Face with slanted eyebrows and small eyes. Flared nostrils with mouth open wide as if screaming, showing teeth.</span>
                        </label>
                </fieldset>
                <a class="overlay-link" href='assessment.php'></a>
                <p class="assessment-link__container">
                    <a class="assessment-link btn" href='assessment.php'>Start Assessment</a>
                </p>
            </div>
        </div>
    </div>

    <div class="report-container">

        <div class="container">
            <h2 class="ad__title">Get Detailed Results</h2>
            <div class="results well">
                    <div class="result">
                <h3 class="results__title">Phrase</h3>
                <p class="results__description">"Who is..." type questions</p>
                <div class="score score--breakdown">
                    <p class="score__title">100<span class="score__percentage">%</span><span class="score__fraction">4 of 4<span class="sr"> Correct</span></span></p>
                    <svg class="score-circle" width="200" height="200" viewport="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                      <circle class="score-circle__bg" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
                      <circle class="score-circle__path score-circle__setOffset" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
                    </svg>
                </div>
            </div>
            <div class="result">
                <h3 class="results__title">Application</h3>
                <p class="results__description">Scenario type questions.</p>
                <div class="score score--breakdown">
                    <p class="score__title">75<span class="score__percentage">%</span><span class="score__fraction">3 of 4<span class="sr"> Correct</span></span></p>
                    <svg class="score-circle" width="200" height="200" viewport="0 0 100 100" version="1.1" xmlns="http://www.w3.org/2000/svg">
                      <circle class="score-circle__bg" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="0"></circle>
                      <circle class="score-circle__path score-circle__setOffset" r="90" cx="100" cy="100" fill="transparent" stroke-dasharray="565.48" stroke-dashoffset="141.371669412"></circle>
                    </svg>
                </div>
            </div>
    </div>
</div>

<p class="restart-assessment"><a class="btn" href="assessment.php">Start Assessment</a></p>
</main>
        </div>
    </div>

</main>
</body>
</html>
