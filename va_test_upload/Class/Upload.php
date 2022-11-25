<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Supported File Format = [application/vnd.ms-excel];
 */
class Upload {

    protected $n_fieldname;
    private static $n_type = ['/application\/vnd./'];
    public $n_upload_dir;
    public $result=array();

    public function __construct($n_fieldname, $n_upload_dir) {
        $this->n_fieldname = $n_fieldname;
        //$this->n_type = $n_type;
        $this->n_upload_dir = $n_upload_dir;
        //$this->filename = $n_filename;
        $this->result =$this->uploaded();
    }

    public function uploaded() {
        try {
            
            for ($i = 0; $i < count(self::$n_type); $i++) {
            if (preg_match(self::$n_type[$i], $_FILES[$this->n_fieldname]["type"])) {
                if ($_FILES[$this->n_fieldname]["error"] == 0) {
                    
                    /**
                    echo "<b>File name: </b>" . $_FILES[$this->n_fieldname]["name"] . "<br />";
                    echo "<b>File type: </b>" . $_FILES[$this->n_fieldname]["type"] . "<br />";
                    echo "<b>File size: </b>" . (($_FILES[$this->n_fieldname]["size"] / 1024) / 1024) . " Mb<br />";
                    echo "<b>File Tmp: </b>" . $_FILES[$this->n_fieldname]["tmp_name"] . "<br />";
                     * 
                     */

                    if (move_uploaded_file($_FILES[$this->n_fieldname]["tmp_name"], $this->n_upload_dir . $_FILES[$this->n_fieldname]["name"])) {

                        //echo "Uploaded..";
                        return $result=[$_FILES[$this->n_fieldname]["name"]];
                        
                    }
                } else {

                    //echo "Error: " . $_FILES[$this->n_fieldname]["error"] . "<br />";
                    $error = "Your File contains error, rectify and try to upload again. FileName: " . $_FILES[$this->n_fieldname]["name"] . ", Error Description:" .$_FILES[$this->n_fieldname]["error"]. " End";
                    throw new Exception($error);
                }
            }
            else
            {
                $error= "Wrong file type..";
                throw new Exception($error);
            }
        }
        } catch (Exception $exc) {
            echo $exc->getTraceAsString();
        }



        
        
    }

}
