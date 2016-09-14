<?php

class Expression {
    public $name,
           $image,
           $description;

    public function __construct($expression) {
        if(!empty($expression)) {
            $this->set_expression($expression);
        } else {
            return 'Error: No expression requested.';
        }

    }

    private function set_expression($expression) {

        $expression_data = $this->get_expression_data();
        $expression_data = $expression_data[$expression];

        $this->name = $expression;
        $this->image = $expression_data['image'];
        $this->description = $expression_data['description'];
    }

    protected function get_expression_data() {
        $expression_json = file_get_contents(ROOT_PATH."/data/expression.json");
        $expression_data = json_decode($expression_json, true);
        return $expression_data['expression'];
    }

    public function get_name() {
        return $this->name;
    }
    public function get_image() {
        return $this->image;
    }

    public function get_description() {
        return $this->description;
    }

}

?>
