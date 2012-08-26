<?php

/**
* This file contain data array which is used to display information 
* on pdf file. It also contain functions which helps to settle down
* information.
*        
* @author      Navdeep Bagga
* @authorEmail admin@navdeepbagga.com
* @category    Data File
* @copyright   Copyright (c) July-August Testing and Consultancy Cell
* @license     General Public License
* @version     $Id:DataFile.php 2012-26-08 $
*/

//Include real value file
require_once('UserDetail.php');

//Define Array
$data = array(
    'Post'              => range(0,3),
    'Dpmt'              => range(4,17),
    'PerAdd'            => range(27,32),
    'CrsAdd'            => range(33,38),
    'Draft'             => range(443,447),
    'Desig'             => range(45,46),
    'Name'              => '136,137,19',
    'PrntName'          => '141,142,140,139,20,138',
    'Dob'               => '21',
    'Place'             => '22',
    'Marital'           => '25',
    'Gender'            => '23',
    'Nation'            => '24',
    'Teleph'            => '39',
    'Mobile'            => '40',
    'Category'          => '41',
    'Specialist'        => '18',
    'MonthPay'          => '43',
    'PayScale'          => '47',
    'BasicPay'          => '48',
    'DA'                => '49',
    'HRA'               => '50',
    'OtherAllow'        => '51',
    'TotSal'            => '52',
    'MedUnfit'          => '53',
    'PhdGuided'         => '213',
    'PhdOngoing'        => '214',
    'PgThesis'          => '215',
    'PgProj'            => '216',
    'SponsorProj'       => '217',
    'ConsultProj'       => '218',
    'Patents'           => '219',
    'BookPublish'       => '220',
    'TechReport'        => '221',
    'InationalJournal'  => '222',
    'NationalJournal'   => '223',
    'InationalConfRef'  => '224',
    'NationalConfRef'   => '225',
    'InationalConfUref' => '226',
    'NationalConfUref'  => '227',
    'Email'             => '232',
    'TeachExp'          => '234',
    'SubTaught'         => '235',
    'PhdTitle'          => '267',
    'SetupLab'          => '268',
    'ConductLab'        => '269',
    'InstrumentLab'     => '270',
    'InterOrg'          => '228',
    'InterAttend'       => '229',
    'NationOrg'         => '230',
    'NationAttend'      => '231',
    'ExtraCurActiv'     => '371',
    'OtherInfo'         => '372',
);

/**
* Arrangement of information in file.
* Define various functions according to columns present in pdf file.  
* Data chunk, Repeat dynamic horizontal rows and vertical columns.
* 
* @category   Data File
* @copyright  Copyright (c) June-August Testing and Consultancy Cell
* @license    General Public License
* @version    Release: @package_version@
* @since      Class available since Release 1
* @deprecated Class deprecated in Release 2
*/
class Applicant_Form
{
    /**
     * This function set range of data, divide into chunks, set steps.
     * 
     * @arguments rangestart,rangestop,divide,difference,vertical number 
     * 
     * @return    array,loop
     */	
    function chunk($from, $to, $chunk, $step, $vertCol)
    {
        if(!empty($vertCol))
        {
            for($i = $from; $i <= $vertCol; $i++)
            {
                $array[] = range($from, $to, $step);
                $array[loop] = $chunk-1;
                return($array);
            }
        }
        else
        {
            $range = range($from, $to, $step);
            $array[div] = array_chunk($range, $chunk);
            $array[loop] = $chunk-1;
            return($array);
        }
    }

    /**
     * This function get array of data and loop repeat row and column,
     * segment and template variable is used to replace variable in file.
     * 
     * @arguments segment value,data array,loop,variable value 
     * 
     * @return display values in repetitive columns.
     */        
    function metrics($segment, $array, $loop, $temp)
    {	
        global $odf;
        global $displayResult;
        $segment = $odf->setSegment($segment);
        foreach($array AS $element) 
        {
            if(!empty($displayResult[$element[0]]))
            {		
                for($i=0; $i<=$loop; $i++)
                {	
                    $var = "$temp$i";
                    $segment -> $var($displayResult[$element[$i]]);       
                }
                $segment -> merge();	
            }	
        }
        $odf -> mergeSegment($segment);
    }
    /**
     * Check the type of data array, according to it apply operations.
     * 
     * @arguments data array 
     * 
     * @return replace variable with real value.
     */    	
    function singleColumn($dataArray)
    {	
        global $odf;
        global $displayResult;
        foreach($dataArray as $key => $var)
        {
            $pos = strpos($var, ",");
            if ($pos === false) 
            {
                $realValue = $displayResult[$var];
                $odf -> setVars($key, $realValue);
            }
            else {
                $pieces = explode(",", $var);
                $aryCount = count($pieces);
                $concatDisplay = "";
                for ($i=0; $i<=$aryCount; $i++)
                {
                    $number = $pieces[$i];
                    if($number == "139")
                    {
                    $realValue = $displayResult[$number];
                    if(isset($realValue))
                    {
                        $concatDisplay .= "/".$displayResult[$number];
                    }
                    }
                    else{
                    $realValue = $displayResult[$number];
                    if(isset($realValue))
                    {
                        $concatDisplay .= " ".$displayResult[$number];
                    }
                    }
                    $odf -> setVars($key, $concatDisplay);
                }
            }
            if(is_array($var))
            {	
                $rangeDisplay = "";
                $j = 0;
                foreach($var as $element)
                {	
                    if(!empty($displayResult[$element]))
                    {
                        if($j == 0)
                        $rangeDisplay .= $displayResult[$element];
                        else
                        $rangeDisplay .= ",".$displayResult[$element];
                        $j++;
                    } 
                    $odf->setVars($key, $rangeDisplay);
                   
                }
            }
        }
    }
}

?>
