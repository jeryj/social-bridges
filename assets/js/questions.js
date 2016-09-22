var btn = document.getElementById('btn--submit');
if(btn) {
    // hide the submit button
    btn.className = 'hidden';
}
var form = document.getElementById("assessment");
var question = document.getElementById("question");
var progressCqn = document.getElementById('progress__cqn');
var progressBar = document.getElementById('progressbar');
var totalQuestions = document.getElementById('tq');
if(totalQuestions) {
    totalQuestions = parseInt(totalQuestions.value);
}
var request = new XMLHttpRequest();

request.onreadystatechange = function() {
    // destroy any existing messages
    var message = document.getElementById('message');
    if(message !== null) {
        message.parentNode.removeChild(message);
    }

    if(request.readyState === 4 && request.status === 200) {
      json = JSON.parse(request.responseText);
      // check for errors
      if(json.error.length) {
          // append error message
          append_error(json.error);
      } else {
          new_question(json);
          updateValues(json);
          updateProgressbar();
      }

    }
};


if(question) {
    question.addEventListener('mouseup', nextQuestionMouseDownListener);
    question.addEventListener('keydown', nextQuestionKeyDownListener);
}

function new_question(json) {
    // add a class to the question and wait
    question.className = 'q-remove';
    // destroy the original innerHTML and replaces it with our new HTML
    question.innerHTML = questionHTML(json.question);
    setTimeout(removeQuestionClass, 500);

    // move focus to the question
    question.parentElement.focus();
}

function removeQuestionClass() {
    // remove the question animation class
    question.className = 'q-on-deck';
}

function append_error(message) {
    var messageHTML = '<section id="message" class="message message--error" role="alertdialog" aria-labelledby="message__title" aria-describedby="enp-message__list"><h3 class="message__title message__title--error">Error</h3><ul class="enp-message__list"><li class="enp-message__item">' + message[0] + '</li></ul></section>';
    btn.insertAdjacentHTML('afterend', messageHTML);
}

function nextState(e) {
    if(currentQuestion() !== totalQuestions) {
        e.preventDefault();
        formData = new FormData(form);
        formData.append("ajax", true);
        request.open("POST", form.action);
        request.send(formData);
    } else {
        // we're on the final question, so trigger a click
        // on our button to send us to the results page
        btn.click();
    }
}

function questionHTML(question) {
    var questionHTML = '<legend>'+question.question+'</legend>';
    questionHTML += expressionHTML(question.expression[0]) + expressionHTML(question.expression[1]);

    return questionHTML;
}

function expressionHTML(expression) {
    return '<label class="exp"><input class="exp_input" type="radio" name="expression" value="'+expression.name+'" /><img class="face" src="dist/img/'+expression.image+'" alt="" /><span class="sr">'+expression.description+'</span></label>';
}

function updateValues(json) {
    updateValue('ac', json.answered_correctly);
    updateValue('phrase_ac', json.phrase_answered_correctly);
    updateValue('application_ac', json.application_answered_correctly);
    updateValue('q_id', json.current_question_number);
}

function updateValue(id, val) {
    e = document.getElementById(id);
    e.value = val;
}

function updateProgressbar() {
    var cqn = currentQuestion();
    // update the text node
    progressCqn.innerText = cqn;
    // update the width
    progressBar.style.width = (currentQuestion() / totalQuestions) * 100 +'%';
    // update the valuenow attr
    progressBar.setAttribute('aria-valuenow', cqn);

}

// return current question number
function currentQuestion() {
    return parseInt(document.getElementById('q_id').value) + 1;
}


function nextQuestionKeyDownListener(e) {

    if (!e.target || e.target.className !== 'exp_input') {
        return false;
    }

    // detect keypress vs click
    var x = e.x || e.clientX;
    var y = e.y || e.clientY;

    // keypress on enter!
    if (!x && !y) {
        console.log(e.keyCode);
        // keypress, so let's check the code
        if(e.keyCode === 13) {
            // check if this input has a selected state
            // if it doesn't, select it!
            if(e.target.checked !== true) {
                e.target.checked = true;
            }
            nextState(e);
        }

   } else {
       return false;
   }
}


function nextQuestionMouseDownListener(e) {
    // check to see if we're on a child element of the label or the label itself
    if(e.target.parentNode.className !== 'exp' && e.target.className !== 'exp' ) {
        return false;
    }

    var exp_input;

    // we're clear, now we just need to check and submit
    // let's find the input
    if(e.target.className === 'face') {
        // get the first child (the input) of the parentElement
        exp_input = e.target.parentElement.children[0];
    } else if(e.target.className === 'enp_input') {
        // it's what it is!
        exp_input = e.target;
    } else if(e.target.className === 'exp') {
        // get the first childNode (the input)
        exp_input = e.target.children[0];
    } else {
        // ???
        // what did you click?
        console.log('what got clicked?');
        return false;
    }

    // make sure our input is selected
    if(exp_input.checked !== true) {
        exp_input.checked = true;
    }
    // move on!
    nextState(e);
}
