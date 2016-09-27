<?php

class Assessment {
    public $current_question_number = 0,
           $answered_correctly = 0,
           $total_questions = 8,
           $phrase_answered_correctly = 0,
           $total_phrase_questions = 4,
           $application_answered_correctly = 0,
           $total_application_questions = 4,
           $error = array(),
           $state, // question, end
           $response;

    public function __construct() {
        $this->init();

    }

    public function load_assessment() {
        // see if we've posted form submission
        if(isset($_POST) && !empty($_POST)) {

            if(isset($_POST['restart'])) {
    			// sets $this->response;
                $this->assessment_restart();
            } else {
                $this->process_submit();
                $this->set_response();
                $this->set_cookies();

                if(isset($_POST['ajax']) && $_POST['ajax'] == true) {

                    echo json_encode($this->response);
                    die;
                }
            }

        }

        // setup our states and cookies if we have them
        $this->set_assessment();
    }

    private function set_response() {
        $this->response = (array) $this;
        if($this->state === 'questions') {
            // append the next question info
            $question = new Question($this->current_question_number);
            $expressions = array();
            foreach($question->expression as $exp) {
                $exp = new Expression($exp);
                $expressions[] = (array) $exp;
            }
            $question = (array) $question;
            // replace the expressions with the full object
            $question['expression'] = $expressions;

            $this->response['question'] = $question;
        }

    }

    private function init() {
        // required files
        require_once('includes/class-Cookies.php');
        require_once('includes/class-Question.php');
        require_once('includes/class-Expression.php');
    }

    private function set_assessment() {
        $this->set_state();
        $this->set_current_question_number();
        $this->set_answered_correctly();
        $this->set_phrase_answered_correctly();
        $this->set_application_answered_correctly();
    }

    private function set_state() {
        // set state off response, if it's there
        if(isset($this->response['state']) && !empty($this->response['state'])) {
            $this->state = $this->response['state'];
        }
        elseif(!empty($this->state)) {
            // don't worry about setting it
        }
        // try to set the state from the cookie
        elseif(isset($_COOKIE['state']) && !empty($_COOKIE['state'])) {
            $this->state = $_COOKIE['state'];
        }
        // probably a new assessment
        else {
            $this->state = 'questions';
        }
    }

    private function set_current_question_number() {
        // set state off response, if it's there
        if(isset($this->response['current_question_number']) && !empty($this->response['current_question_number'])) {
            $this->current_question_number = $this->response['current_question_number'];
        }
        elseif(isset($_POST['current_question_number']) && $_POST['current_question_number']) {
            // set it from the processing of the form submit,
            // bc for some reason it's not updating the cookie right
            // do nothing, bc it's already set-up
            $this->current_question_number = $this->current_question_number;
        }
        // try to set the current_question_number from the cookie
        elseif(isset($_COOKIE['cqn']) && !empty($_COOKIE['cqn'])) {
            $this->current_question_number = $_COOKIE['cqn'];
        }
        // probably a new assessment
        else {
            $this->current_question_number = 0;
        }
    }

    /**
	* Track how many questions they've gotten right over the course of the quiz
	*/
	private function set_answered_correctly() {

		// set state off response, if it's there
		if(isset($this->response['answered_correctly'])) {
			$answered_correctly = $this->response['answered_correctly'];
		}
		// try to set the state from the cookie
		elseif(isset($_COOKIE['ac'])) {
			$answered_correctly = $_COOKIE['ac'];
		}
		// probably a new assessment
		else {
			$answered_correctly = 0;
		}

		$this->answered_correctly = $answered_correctly;
	}

    /**
    * Track how many questions they've gotten right over the course of the quiz
    */
    private function set_phrase_answered_correctly() {

        // set state off response, if it's there
        if(isset($this->response['phrase_answered_correctly'])) {
            $phrase_answered_correctly = $this->response['phrase_answered_correctly'];
        }
        // try to set the state from the cookie
        elseif(isset($_COOKIE['phrase_ac'])) {
            $phrase_answered_correctly = $_COOKIE['phrase_ac'];
        }
        // probably a new assessment
        else {
            $phrase_answered_correctly = 0;
        }

        $this->phrase_answered_correctly = $phrase_answered_correctly;
    }

    /**
    * Track how many questions they've gotten right over the course of the quiz
    */
    private function set_application_answered_correctly() {

        // set state off response, if it's there
        if(isset($this->response['application_answered_correctly'])) {
            $application_answered_correctly = $this->response['application_answered_correctly'];
        }
        // try to set the state from the cookie
        elseif(isset($_COOKIE['application_ac'])) {
            $application_answered_correctly = $_COOKIE['application_ac'];
        }
        // probably a new assessment
        else {
            $application_answered_correctly = 0;
        }

        $this->application_answered_correctly = $application_answered_correctly;
    }

    public function process_submit() {
        if(!isset($_POST['current_question_number']) || !isset($_POST['answered_correctly'])) {
            $this->error[] = 'Not all data was sumitted correctly. Reload the page and try again.';
        }

        // set our known, submitted variables
        $this->current_question_number = $_POST['current_question_number'];
        $this->answered_correctly = $_POST['answered_correctly'];
        $this->phrase_answered_correctly = $_POST['phrase_answered_correctly'];
        $this->application_answered_correctly = $_POST['application_answered_correctly'];

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
                $this->state = 'questions';
                $this->current_question_number++;
            } else {
                $this->state = 'results';
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
	        echo '<section class="message message--error" role="alertdialog" aria-labelledby="message__title" aria-describedby="enp-message__list">
	        <h3 class="message__title message__title--error">Error</h3>
	        <ul class="enp-message__list">';
	        foreach($errors as $error) {
	            echo '<li class="enp-message__item">'.$error.'</li>';
	        }
	        echo '</ul></section>';
		}
	}

    public function percentagize($part, $total) {
        return (int) round(($part / $total) * 100);
    }

    public function get_score_circle_dashoffset($score) {
		$dashoffset = 0;
		if(!empty($score)) {
			// calculate the score dashoffset
            $r = 90;
            $c = M_PI*($r*2);
            $dashoffset = ((100-$score)/100)*$c;
		}
		return $dashoffset;
	}

    /**
	* Process a assessment restart submission
	*/
	private function assessment_restart() {

		// delete cookies and set new cookie states
		$this->reset_cookies();

		// if cookies are set, we can safely redirect them
		// and let the cookies set the new state. Without a redirect
		// the cookie state gets stuck on the end
		// so, if we have a cookie set, let's redirect them
        $url = 'http'.(isset($_SERVER['HTTPS']) ? 's' : '') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

		if(isset($_COOKIE['state'])) {
			header('Location: '.$url);
			exit;
		} else {
			return;
		}


	}

    private function reset_cookies() {
        $cookies = new Cookies();
        $cookies->set_cookie('state', 'questions');
        $cookies->unset_cookie('cqn');
        $cookies->unset_cookie('ac');
        $cookies->unset_cookie('phrase_ac');
        $cookies->unset_cookie('application_ac');
    }

    private function set_cookies() {
        $cookies = new Cookies();
        $cookies->set_cookie('state', $this->state);
        $cookies->set_cookie('cqn', $this->current_question_number);
        $cookies->set_cookie('ac', $this->answered_correctly);
        $cookies->set_cookie('phrase_ac', $this->phrase_answered_correctly);
        $cookies->set_cookie('application_ac', $this->application_answered_correctly);
    }
}


?>
