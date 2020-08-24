<?php
if($_GET)
{
    $keys_get = array_keys($_GET);
    foreach ($keys_get as $key_get)
     {
        $$key_get = $_GET[$key_get];
        error_log("variable $key_get viene desde $ _GET");
     }
}
echo "El pago ha sido Aprobado";
echo "<br>";
echo "<br>";
echo "collection_id = " . $_GET['collection_id'];
echo "<br>";
echo "collection_status = " . $_GET['collection_status'];
echo "<br>";
echo "external_reference = " . $_GET['external_reference'];
echo "<br>";
echo "payment_type = " . $_GET['payment_type'];
echo "<br>";
echo "preference_id = " . $_GET['preference_id'];
echo "<br>";
echo "site_id = " . $_GET['site_id'];
echo "<br>";
echo "processing_mode = " . $_GET['processing_mode'];
echo "<br>";
echo "merchant_account_id = " . $_GET['merchant_account_id'];
?>