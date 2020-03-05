<?php 
// Load library 
include_once 'HtmlToDoc.class.php';  
 
// Initialize class 
$htd = new HTML_TO_DOC(); 
$htmlContent = ' 
    <h1>Hello World!</h1> 
    <p>This document is created from HTML.</p>';






    $htd->createDoc('Adhesion_print.php', "my-document", 1);


?>
