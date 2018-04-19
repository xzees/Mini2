<?php

namespace Core\Provider;

use PHPexcel;
use PHPExcel_IOFactory;

class ExcelProvider
{
    protected $_excel;
    protected $_workSheet;
    protected $_lastRow;
    protected $_title;
    protected $_type;
    protected $_reader;

    public function __construct()
    {
        $this->_root = dirname(dirname(__DIR__));
        header('Content-Type: text/html; charset=utf-8');
    }
    public static function export($array, $arr_path)
    {
        $obj = (new self);
        $path  = $obj->_root.$arr_path['path'];
        
        $objXLS =new PHPExcel();
        $man_val=array();
        $value=1;
        foreach ($array as $key => $jsons) { 
            if($value==1){
                foreach($jsons as $key => $value1) {
                    array_push($man_val,$key);
                }
                $objXLS->getSheet(0)->fromArray($man_val, null, "A".$value);
                $value=$value+1;
                $man_val=array();
                foreach($jsons as $key => $value1) {
                    array_push($man_val,$value1);
                }
                $objXLS->getSheet(0)->fromArray($man_val, null, "A".$value);
                $value=$value+1;
                $man_val=array();
            }else{
                foreach($jsons as $key => $value1) {
                    array_push($man_val,$value1);
                }
                $objXLS->getSheet(0)->fromArray($man_val, null, "A".$value);
                $value=$value+1;
                $man_val=array();
            }
        }
        $fileType = 'Excel2007';
        $fileName = $arr_path['name'];
        $objWriter = PHPExcel_IOFactory::createWriter($objXLS, $fileType);
        $objWriter->save($path.$fileName);

        return $path;
    }
    public static function get($to, $func=null)
    {
        $obj = (new self);
        $path  = $obj->_root.$to;
        if(file_exists($path))
        {
            ## function read excel
            $obj->_type = PHPExcel_IOFactory::identify($path);
            /**  Create a new Reader of the type that has been identified  **/
            $obj->_reader = PHPExcel_IOFactory::createReader($obj->_type);
            /** Set read type to read cell data onl **/
            $obj->_reader->setReadDataOnly(true);
            /**  Load $inputFileName to a PHPExcel Object  **/
            $obj->_excel = $obj->_reader->load($path);
            //Get worksheet and built array with first row as header
            $obj->_workSheet = $obj->_excel->getActiveSheet();

            if($func){
                $func($obj);
            }
        }else{
            trigger_error("Could not find file {$path}", E_USER_ERROR);
        }
        return $obj;
    }
    
    public function sheet($data)
    {
        $this->_workSheet = $this->_excel->getSheet($data);
        return $this;
    }

    public function countRow()
    {
        $highestRow = $this->_workSheet->getHighestRow();
        return $highestRow;
    }
    public function countCol()
    {
        $highestRow = $this->_workSheet->getHighestColumn();
        return $highestRow;
    }
    
    public function toArray($header=null)
    {
        if($header){
            $highestRow = $this->_workSheet->getHighestRow();
            $highestColumn = $this->_workSheet->getHighestColumn();
            $headingsArray = $this->_workSheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
            $headingsArray = $headingsArray[1];
            $r = -1;
            $namedDataArray = array();
            for ($row = 2; $row <= $highestRow; ++$row) {
                $dataRow = $this->_workSheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
                if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
                    ++$r;
                    foreach($headingsArray as $columnKey => $columnHeading) {
                        $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
                    }
                }
            }
        }else{
            $namedDataArray = $this->_workSheet->toArray(null,true,true,true);
        }
        return $namedDataArray;
    }   

    
}
