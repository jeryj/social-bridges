var btn = document.getElementById('submit');

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

function new_question(json) {
    // get the question
    var question = document.getElementById("question");
    // destroy the original question
    question.parentNode.removeChild(question);
    // create the new html
    var question_HTML = questionHTML(json.question);
    // insert it
    btn.insertAdjacentHTML('beforebegin', question_HTML);
}

function append_error(message) {
    var messageHTML = '<section id="message" class="message message--error" role="alertdialog" aria-labelledby="message__title" aria-describedby="enp-message__list"><h3 class="message__title message__title--error">Error</h3><ul class="enp-message__list"><li class="enp-message__item">' + message[0] + '</li></ul></section>';
    btn.insertAdjacentHTML('afterend', messageHTML);
}

btn.addEventListener('click', function(e) {

    var current_question_number = parseInt(document.getElementById('q_id').value) + 1;
    var total_questions = parseInt(document.getElementById('tq').value);
    // get the question they're answering
    var form = document.getElementById("assessment");
    if(current_question_number !== total_questions) {
        e.preventDefault();
        formData = new FormData(form);
        formData.append("ajax", true);
        request.open("POST", form.action);
        request.send(formData);
    } else {
        // submit as normal
        console.log('submit?');
    }

});


function questionHTML(question) {
    var questionHTML = '<fieldset id="question"><legend>'+question.question+'</legend>';
    questionHTML += expressionHTML(question.expression[0]) + expressionHTML(question.expression[1]);
    questionHTML += '</fieldset>';

    return questionHTML;

}

function expressionHTML(expression) {
    return '<label class="exp"><input type="radio" name="expression" value="'+expression.name+'" /><img class="face" src="dist/img/'+expression.image+'" alt="'+expression.description+'" /></label>';
}

function updateValues(json) {
    updateValue('ac', json.answered_correctly);
    updateValue('e_ac', json.easy_answered_correctly);
    updateValue('i_ac', json.intermediate_answered_correctly);
    updateValue('h_ac', json.hard_answered_correctly);
    updateValue('who_ac', json.who_answered_correctly);
    updateValue('which_ac', json.which_answered_correctly);
    updateValue('q_id', json.current_question_number);

}

function updateValue(id, val) {
    e = document.getElementById(id);
    e.value = val;
}

function updateProgressbar() {
    // could put this in a function
    var current_question_number = parseInt(document.getElementById('q_id').value) + 1;
    var total_questions = parseInt(document.getElementById('tq').value);
    // end could put this in a function

    var progressCqn = document.getElementById('progress__cqn');
    // update the text node
    progressCqn.innerText = current_question_number;
    // update the width
    document.getElementById('progressbar').style.width = (current_question_number / total_questions) * 100 +'%';


}
