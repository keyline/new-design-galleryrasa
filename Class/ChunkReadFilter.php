<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**  Define a Read Filter class implementing \PhpOffice\PhpSpreadsheet\Reader\IReadFilter  */
Class ChunkReadFilter implements \PhpOffice\PhpSpreadsheet\Reader\IReadFilter {

    private $_startRow = 0;
    private $_endRow = 0;
    
    
   

    /**  Set the list of rows that we want to read  */
    public function setRows($startRow, $chunkSize) {
        $this->_startRow = $startRow;
        $this->_endRow = $startRow + $chunkSize;
        
    }

    public function readCell($column, $row, $worksheetName = '') {

        //  Only read the heading row, and the rows that are configured in $this->_startRow and $this->_endRow 
        if (($row == 1) || ($row >= $this->_startRow && $row < $this->_endRow)) {

            return true;
        }
        return false;
    }

}
