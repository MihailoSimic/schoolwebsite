<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    
    $pdfName = $_POST["pdfName"];

    if (!empty($pdfName)) {
        
        $pdfUrl = "biografije/" . $pdfName . ".pdf";
        
        
        header("Location: $pdfUrl");
        exit;
    } else {
        
        header("Location: admin.php");
        exit;
    }
}
?>