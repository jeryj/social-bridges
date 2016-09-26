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
        <link rel='stylesheet' href='dist/css/ie8.min.css' />
        <script src="dist/js/html5shiv.js"></script>
    <![endif]-->
</head>
<body>
<?php include('views/header.php');?>
<main>
    <section class="hero">
        <div class="container">
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
                            <span class="sr">Face with slanted eyebrows and small eyes. Flared nostrils with mouth open wide as if screaming, showing teeth.</span>
                        </label>
                </figure>

                <a class="overlay-link" href='assessment.php'></a>
            </div>
            <h1 class="ad__title">Autism Social Comrehension Assessment</h1>
            <p class="ad__description">Used by Speech-Language Pathologists as a pre-screening &amp; therapy practice tool.</p>
            <p class="ad__link-container">
                <a class="ad__link btn" href='assessment.php'>Start Assessment</a>
            </p>
        </div>
    </section>

    <section class="report-container">

        <div class="container">
            <figure class="results well">
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
            </figure>
            <h2 class="ad__title">Detailed Results</h2>
            <p class="ad__description">Get a full-picture of your student's in a glance.</p>
            <p class="ad__link-container"><a class="btn" href="assessment.php">Start Assessment</a></p>
        </div>
    </section>

</main>
<footer class="footer">
    <p>Social Bridges &copy; <?php echo Date('Y');?>
</footer>
</body>
</html>
