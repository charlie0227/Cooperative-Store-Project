




<?php
require 'pdfcrowd.php';
//$pdf = $client->convertHtml('<html>'.$html.'</html>');
$html=$_POST['html'];
try
{
    // create an API client instance
    $client = new Pdfcrowd("123xu3u4tp6", "d72254a67a35e6c99cbd534237636cab");
    $client->setPageWidth("210mm");
    $client->setPageHeight("297mm");
    // convert a web page and store the generated PDF into a $pdf variable
    //$pdf = $client->convertURI('http://www.google.com/');
    $pdf = $client->convertHtml($html);
    // set HTTP response headers
    header("Content-Type: application/pdf");
    header("Cache-Control: max-age=0");
    header("Accept-Ranges: none");
    header("Content-Disposition: attachment; filename=\"google_com.pdf\"");

    // send the generated PDF
    echo $pdf;
}
catch(PdfcrowdException $why)
{
    echo "Pdfcrowd Error: " . $why;
}
?>
