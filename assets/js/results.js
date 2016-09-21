var scores = document.getElementsByClassName('score-circle__path');

for(var i = 0; i < scores.length; i++) {
    // add the resetOffset to take it to 0%
    scores[i].setAttribute('class', 'score-circle__path score-circle__resetOffset');
    // add the animateScore after a slight delay so the animation comes in
    animateScoreID = window.setTimeout(animateScore, 250, scores[i]);
}

// function for our timeout to animate the svg percentage correct
function animateScore(score) {
        score.setAttribute('class', 'score-circle__path score-circle__setOffset');
}
