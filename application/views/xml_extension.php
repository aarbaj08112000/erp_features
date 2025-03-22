<?php
// Create a SimpleXMLElement object
$xml = new SimpleXMLElement('<ENVELOPE></ENVELOPE>');

// Add the HEADER section
$header = $xml->addChild('HEADER');
$header->addChild('TALLYREQUEST', 'Import Data');
$header->addChild('TYPE', 'Data');
$header->addChild('ID', 'YourID'); // Replace with your ID

// Add the BODY section
$body = $xml->addChild('BODY');
$data = $body->addChild('DATA');
requestSalesXML($data);

// Function to add sales data request
function requestSalesXML($data)
{
    $request = $data->addChild('REQUESTDATA');
    $voucher = $request->addChild('TALLYMESSAGE', 'Voucher');
    $voucher->addAttribute('VCHTYPE', 'Sales'); // Specify the voucher type (Sales in this case)
    
    // Add voucher details
    $voucher->addChild('VOUCHERKEY', 'YourVoucherKey'); // Replace with your voucher key
    $voucher->addChild('DATE', '2023-09-26'); // Replace with the voucher date
    $voucher->addChild('NARRATION', 'Sales Invoice'); // Replace with the narration
    
    // Add ledger details
    $ledgerEntries = $voucher->addChild('ALLLEDGERENTRIES.LIST');
    $ledgerEntries->addChild('LEDGERNAME', 'Customer'); // Replace with the customer's ledger name
    $ledgerEntries->addChild('ISDEEMEDPOSITIVE', 'No');
    $ledgerEntries->addChild('AMOUNT', '1000.00'); // Replace with the invoice amount
    

}
// Set the Content-Type header to specify XML
header('Content-Type: text/xml');

// Output the XML
echo $xml->asXML();
?>
