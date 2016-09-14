<?php

class Assessment {
    public $current_question_number = 0,
           $answered_correctly = 0,
           $total_questions = 3,
           $easy_answered_correctly = 0,
           $total_easy_questions = 2,
           $intermediate_answered_correctly = 0,
           $total_intermediate_questions = 1,
           $hard_answered_correctly = 0,
           $total_hard_questions = 0,
           $who_answered_correctly = 0,
           $total_who_questions = 1,
           $which_answered_correctly = 0,
           $total_which_questions = 2,
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
        $this->easy_answered_correctly = $_POST['easy_answered_correctly'];
        $this->intermediate_answered_correctly = $_POST['intermediate_answered_correctly'];
        $this->hard_answered_correctly = $_POST['hard_answered_correctly'];
        $this->who_answered_correctly = $_POST['who_answered_correctly'];
        $this->which_answered_correctly = $_POST['which_answered_correctly'];

        // make sure we have a submitted answer
        if(!isset($_POST['expression']) || empty($_POST['expression'])) {
            $this->error[] = 'No facial expression was selected. Please choose a facial expression and try again.';
        } else {
            // we have an answer, let's see if it's right!
            $question_number = $this->get_current_question_number();
            // get the question
            $question = new Question($question_number);

            $is_correct = $this->is_answer_correct($_POST['expression'], $question);

            // if it's right, increase the answered_correctly value by 1
            if($is_correct === true) {
                $this->answered_correctly++;

                // get question difficulty
                $difficulty = $question->get_difficulty();
                $difficulty_answered_correctly = $difficulty.'_answered_correctly';
                // increase the count on the difficulty
                $this->$difficulty_answered_correctly++;

                // get question type
                $types = $question->get_type();
                foreach($types as $type) {
                    $type_answered_correctly = $type.'_answered_correctly';
                    // increase the count on the type
                    $this->$type_answered_correctly++;
                }

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

    // $question = question object
    private function is_answer_correct($submitted_answer, $question) {

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

    /**
    * Pass the type of question you want (hard, intermediate, which, etc)
    */
    public function get_answered_correctly($type = 'total') {
        if($type === 'total') {
            $answered_correctly = $this->answered_correctly;
        } else {
            $type_answered_correctly = $type.'_answered_correctly';
            $answered_correctly = $this->$type_answered_correctly;
        }
        return $answered_correctly;
    }

    /**
    * Pass the type of question you want (hard, intermediate, which, etc)
    */
    public function get_total_questions($type = 'total') {
        if($type === 'total') {
            $total_questions = $this->total_questions;
        } else {
            $type_total_questions = 'total_'.$type.'_questions';
            $total_questions = $this->$type_total_questions;
        }
        return $total_questions;
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
