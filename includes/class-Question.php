<?php

class Question {
    public $question,
           $answer,
           $expression = array(),
           $difficulty,
           $type = array();

    public function __construct($question_number) {
        if(0 <= (int) $question_number && (int) $question_number <= 10) {
            $this->set_question($question_number);
        } else {
            return 'Error: Question number does not exist';
        }
    }

    public function set_question($question_number) {
        $question_data = $this->get_question_data();
        $question = $question_data[$question_number];

        $this->question = $question['question'];
        $this->answer = $question['answer'];
        $this->expression[] = $question['expression'][0];
        $this->expression[] = $question['expression'][1];
        $this->difficulty = $question['difficulty'];
        $this->type = $question['type'];
    }

    protected function get_question_data() {
        $question_json = file_get_contents(ROOT_DIR."/data/question.json");
        $question_data = json_decode($question_json, true);
        return $question_data['question'];
    }

    public function get_question() {
        return $this->question;
    }

    public function get_expression() {
        return $this->expression;
    }

    public function get_answer() {
        return $this->answer;
    }

    public function get_difficulty() {
        return $this->difficulty;
    }

    public function get_type() {
        return $this->type;
    }
}

?>
