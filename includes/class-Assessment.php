<?php

class Assessment {
    public $current_question_number = 0,
           $answered_correctly = 0,
           $total_questions = 2,
           $error = array(),
           $state = 'question'; // question, end

    public function __construct() {
        $this->init();
        // see if we've posted form submission
        if(isset($_POST) && !empty($_POST)) {
            $this->process_submit();
        }
    }

    private function init() {
        // required files
        require_once('includes/class-Question.php');
        require_once('includes/class-Expression.php');
    }

    public function process_submit() {
        if(!isset($_POST['current_question_number']) || !isset($_POST['answered_correctly'])) {
            $this->error[] = 'Not all data was sumitted correctly. Reload the page and try again.';
        }

        // set our known, submitted variables
        $this->current_question_number = $_POST['current_question_number'];
        $this->answered_correctly = $_POST['answered_correctly'];

        // make sure we have a submitted answer
        if(!isset($_POST['expression']) || empty($_POST['expression'])) {
            $this->error[] = 'No facial expression was selected. Please choose a facial expression and try again.';
        } else {
            // we have an answer, let's see if it's right!
            $is_correct = $this->is_answer_correct($_POST['expression']);

            // if it's right, increase the answered_correctly value by 1
            if($is_correct === true) {
                $this->answered_correctly++;
            }

            // everything looks good, so let's go to the next question!
            if(($this->current_question_number + 1) < $this->total_questions) {
                $this->current_question_number++;
            } else {
                $this->state = 'end';
                $this->current_question_number = null;
            }
        }

    }

    private function is_answer_correct($submitted_answer) {
            $question_number = $this->get_current_question_number();
            // get the question
            $question = new Question($question_number);
            // get the answer
            $question_answer = $question->get_answer();
            // see if what they submitted is right
            if($submitted_answer == $question_answer) {
                return true;
            } else {
                return false;
            }
    }

    public function get_current_question_number() {
        return $this->current_question_number;
    }

    public function get_answered_correctly() {
        return $this->answered_correctly;
    }

    public function get_state() {
        return $this->state;
    }

    public function get_error_messages() {
		if(isset($this->error) && !empty($this->error)) {
	        $errors = $this->error;
	        echo '<section class="message message--error" role="alertdialog"  aria-labelledby="message__title" aria-describedby="enp-message__list">
	        <h3 class="message__title message__title--error">Error</h3>
	        <ul class="enp-message__list">';
	        foreach($errors as $error) {
	            echo '<li class="enp-message__item">'.$error.'</li>';
	        }
	        echo '</ul></section>';
		}
	}

}
?>
