<?php

class LindaRowModel {

    private $model_fields = array();
    private $altered_fields = array();

    public function __construct($column, $data) {


        for ($i = 0; $i < count($column); $i++) {
            $this->model_fields[$column[$i]] = current($data);

            next($data);//move the internal pointer to the next index
        }
    }

    public function __get($name) {


        if (array_key_exists($name, $this->model_fields)) {

            return $this->model_fields[$name];
        }
		return NULL;
    }

    public function __set($name, $value) {

        if (array_key_exists($name, $this->model_fields)) {


            $this->model_fields[$name] = $value;
            $this->altered_fields[$name] = $value;
        }
    }

    public function hasKey($name) {

        if (array_key_exists($name, $this->model_fields)) {

            return TRUE;
        }
    }

    public function getValues() {
        return array_values($this->model_fields);
    }

    public function getValuesAsObject() {
        $r = new stdClass();

        foreach ($this->model_fields as $key => $value) {
            $r->{$key} = $value;
        }

        return $r;
    }

    public function __destruct() {
        
    }

}
