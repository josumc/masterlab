<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["xmlFile"])) {
    $xmlFile = $_FILES["xmlFile"]["tmp_name"];
    $xmlContent = file_get_contents($xmlFile);

    libxml_set_external_entity_loader(null);

    $doc = new DOMDocument();
    $doc->loadXML($xmlContent, LIBXML_NOENT | LIBXML_DTDLOAD);

    echo "<pre>";
    echo htmlentities($doc->saveXML());
    echo "</pre>";
}
?>
