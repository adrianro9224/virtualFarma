<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

Class Pathology extends MY_Controller {
	
	
	function __construct(){
		parent::__construct();
		$this->load->model('pathology_model');
		$this->load->library('roots');
	}
	
	public function create_pathologies( $identification_number = NULL, $password = NULL ) {
		
		if ( isset($identification_number ) && isset($password) ) {
			$access_permitted = $this->roots->validate_root_identity( $identification_number, $password );

            if ( $access_permitted ) {
                $pathologies = $this->_read_categories();
                $saved = $this->pathology_model->insert_pathologies( $pathologies );

                if ( $saved )
                    echo "completed!";
                else
                    echo ":(";

            }
			
			
			
		}
		
	}

    public function get_all_pathologies() {

        $pathologies_db = $this->pathology_model->get_all();

        $result = new stdClass();

        $pathologies = json_encode($pathologies_db);

        $result->error = json_last_error();

        if ( $result->error == "JSON_ERROR_NONE" ) {
            echo $pathologies;
        }else {
            echo "NULL";
        }

    }

    private function _read_categories() {
        $handle = fopen(__ROOT__FILES__ . "csv/pathologies_.csv", 'r');

        if( $handle !== FALSE ) {
            $pathologies = array();

            while ( ($data = fgetcsv($handle, 130, '|')) !== FALSE ){
                $current_row = new stdClass();

                    $current_row->name = ucfirst(strtolower(str_replace('\'', '', utf8_encode(trim($data[0])) )));
                    $pathologies[$current_row->name] = $current_row;


                }
            }

            fclose( $handle );

            return $pathologies;
    }
	
	
	public function count_alphabetical() {

        $pathologies = $this->pathology_model->get_all();

        //$alphabeto = array("A", "B", "C", "D", "E", "F", "G", "H", "I", "J", "K", "L", "M", "N", "O", "P", "Q", "R", "S", "T", "U", "V", "W", "X", "Y", "Z");

        //$caracther_position_to_search = 0;

        $results = array();

        $counter = 0;

        foreach ( $pathologies as $key => $pathology ) {



            $string_splited = str_split($pathology->name);

            $pos = strpos( $pathology->name, $string_splited[0]  );

            if ( $pos === false )
                echo $string_splited[0] . " not found in " . $pathology->name;
            else if ( $pos == 0 ) {
                //$counter = $counter + 1;
                $results[$string_splited[0]] = $counter++;
            }else {
                $counter = 0;
            }

        }

        var_dump($results);
    }

}