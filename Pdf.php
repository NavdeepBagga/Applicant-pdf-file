<?php

/**
* This file create instance of class 
* Call functions of class
* Generate pdf
*        
* @author      Navdeep Bagga
* @authorEmail admin@navdeepbagga.com
* @category    Function call
* @copyright   Copyright (c) June-August Testing and Consultancy Cell
* @license     General Public License
* @version     $Id:Pdf.php 2012-26-08 $
*/

//Include library and datafile
require_once('../library/odf.php');
require_once('DataFile.php');

//Define template file
$odf = new odf('form.odt');

//Create object of class	
$Applicant_Form_Obj = new Applicant_Form();

//Function call
$displayColumn = $Applicant_Form_Obj -> singleColumn($data);
$education = $Applicant_Form_Obj -> chunk('56','135','8','1');
$eduMetrics =  $Applicant_Form_Obj -> metrics('edu', $education[div], $education[loop], 'Edu');
$employment = $Applicant_Form_Obj -> chunk('143','212','7','1');
$employMetrics =  $Applicant_Form_Obj -> metrics('org', $employment[div], $employment[loop], 'Org');
$courses = $Applicant_Form_Obj -> chunk('271','350','4','1');
$coursMetrics =  $Applicant_Form_Obj -> metrics('crs', $courses[div], $courses[loop], 'Crs');
$taught = $Applicant_Form_Obj -> chunk('236','265','3','1');
$taughtMetrics =  $Applicant_Form_Obj -> metrics('teach', $taught[div], $taught[loop], 'Teach');
$membership = $Applicant_Form_Obj -> chunk('351','370','2','1');
$memberrMetrics =  $Applicant_Form_Obj -> metrics('member', $membership[div], $membership[loop], 'Member');
$documents = $Applicant_Form_Obj -> chunk('428','442','1','1');
$docMetrics =  $Applicant_Form_Obj -> metrics('doc', $documents[div], $documents[loop], 'Doc');
$reference = $Applicant_Form_Obj -> chunk('373','427','10','5','377');
$refMetrics =  $Applicant_Form_Obj -> metrics('refer', $reference, $reference[loop], 'Refer');

//Export file with current date
$filename = 'Applicant_'.date('Y_m_d');
$odf->exportAsAttachedFile($filename.'.odt');
?>


