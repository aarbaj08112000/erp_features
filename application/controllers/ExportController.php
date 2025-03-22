<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once 'CommonController.php';
require_once APPPATH . 'libraries/PHPExcel/IOFactory.php';

class ExportController extends CommonController
{

    public function __construct()
    {
        parent::__construct();
    }

    private function getPage($viewPage, $viewData)
    {
        //$this->loadView($this->getPath().$viewPage,$viewData);
        $this->loadView($viewPage, $viewData);
    }

    public function get_grnExport_heading($isGrnInvExport){
        if ($isGrnInvExport == true) {
                // Inventory details
                $headings = ["Voucher Date", "Voucher Type Name", "Voucher Number", "Reference No.", "Reference Date", "Order No(s)", "Order - Date", "Bill Type of Ref", "Bill Name", "Bill Amount", "Bill Amount - Dr/Cr",
                    "Bill Due Dt or Credit Days", "Buyer/Supplier - Address", "Buyer/Supplier - Country", "Buyer/Supplier - State", "Buyer/Supplier - Pincode", "Buyer/Supplier - GSTIN/UIN",
                    "Buyer/Supplier - Place of Supply", "Consignee (ship to)", "Consignee - Mailing Name", "Consignee - Address", "Consignee - Country", "Consignee - State",
                    "Consignee - Pincode", "Consignee - GSTIN/UIN", "Ledger Name", "Ledger Amount", "Ledger Amount Dr/Cr", "Item Name", "Billed Quantity", "Item Rate",
                    "Item Rate per", "Item Amount", "Item Allocations - Order No.", "Item Allocations - Order Due on", "Accounting Allocation - Ledger",
                    "Accounting Allocation - Amount", "Change Mode"];
            } else {
                //voucher details
                $headings = ["Voucher Date", "Voucher Type Name", "Voucher Number", "Reference No.", "Reference Date", "Bill Type of Ref", "Bill Name", "Bill Date", "Bill Amount", "Bill Amount - Dr/Cr",
                    "Bill Due Dt or Credit Days" , "Buyer/Supplier - Address", "Buyer/Supplier - Country", "Buyer/Supplier - State", "Buyer/Supplier - Pincode", "Buyer/Supplier - GSTIN/UIN",
                    "Buyer/Supplier - Place of Supply", "Consignee (ship to)", "Consignee - Mailing Name", "Consignee - Address", "Consignee - Country", "Consignee - State",
                    "Consignee - Pincode", "Consignee - GSTIN/UIN", "Ledger Name", "Ledger Amount", "Ledger Amount Dr/Cr", "Buyer/Supplier - Address", "Buyer/Supplier - Country", "Buyer/Supplier - State", "Buyer/Supplier - Pincode", "Buyer/Supplier - GSTIN/UIN",
                    "Buyer/Supplier - Place of Supply", "Voucher Narration"];
            }
        return $headings;
    }

    public function grn_excel_export()
    {
        $grn_detail_list = $this->get_grn_details();

        if (empty($grn_detail_list)) {
            $this->session->set_userdata(['error_message' => 'No records found for this export criteria.']);
            $this->redirectMessage();   
        }

        //Inventory type data
        $isGrnInvExport = $this->GlobalConfig->readConfiguration("isGrnExportWithInventory", "Yes");
        if (strcasecmp($isGrnInvExport, "Yes") == 0) {
            $isGrnInvExport = true;
        }else{
            $isGrnInvExport = false;
        }

        $this->load->library("excel");
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $sheet = $object->getActiveSheet();
        $sheet->setTitle('Voucher');

        $headings = $this->get_grnExport_heading($isGrnInvExport); 

        // Set heading row with colors
        $sheet->fromArray([$headings], NULL, 'A1');
        $headingsStyle = array(
            'font' => array('bold' => true),
            'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F9C40E')), 
        );
        $sheet->getStyle('A1:AL1')->applyFromArray($headingsStyle);

       
        
        if ($grn_detail_list) {

            $excel_row = 2;
            $rowNo = 1;
            foreach ($grn_detail_list as $grn_details) {
                $grn_part_details = $this->getTAXQueryData($grn_details);
                $leger_arr = $this->getTaxDetailsUsingTaxQuery($grn_part_details);


                /* Get the final amount */
                foreach ($leger_arr as $leger_entry) {
                        $name = $leger_entry["name"];
                        if($name == "SUPPLIER_NAME") {
                            $ledger_value = round($leger_entry["value"],2);
                            $ledger_name = $leger_entry["supplier_name"];
                        }
                    }
        
                $object->getActiveSheet()->setCellValueByColumnAndRow(0, $excel_row, $this->getDateByFormat($grn_details->grn_date)); //grn date
                $object->getActiveSheet()->setCellValueByColumnAndRow(1, $excel_row, "Purchase"); //HARD CODED
                $object->getActiveSheet()->setCellValueByColumnAndRow(2, $excel_row, $grn_details->grn_number); //grn number
                $object->getActiveSheet()->setCellValueByColumnAndRow(3, $excel_row, $grn_details->invoice_number); //invoice_number - Reference No.
                $object->getActiveSheet()->setCellValueByColumnAndRow(4, $excel_row, $this->getDateByFormat($grn_details->invoice_date)); //invoice_date - Reference Date

                $dataRowNo = 5;
                if($isGrnInvExport){
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->po_number); // po_number - Order No(s)
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $this->getDateByFormat($grn_details->po_date)); // po_date - Order - Date
                    $dataRowNo = 7;
                }
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, "New Ref"); // HARD CODED AS OF NOW - Bill Type of Ref
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->invoice_number); // grn_number - Bill Name
                if($isGrnInvExport==false){
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $this->getDateByFormat($grn_details->grn_date)); // grn date - Bill Date
                }
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $ledger_value); // Complete AMOUNT - Bill Amount
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, "cr"); // HARD CODED - Bill Amount - Dr/Cr - 

                //Supplier details
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->credit_days." days"); //Bill Due Dt or Credit Days
                    
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->supplier_address); //Supplier Address
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, "India"); // HARD CODED
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->supplier_state); // Supplier STATE
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, "PIN"); // Supplier PIN
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->supplier_gst); // Supplier GST

                //buyers details
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->client_shifting_address); // Buyers address

                //Client details BASED ON delivery_unit or Default client
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->client_name); //Consignee (ship to)
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->client_name); //Consignee - Mailing Name
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->client_addr); // Consignee - Address
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, "India"); // Consignee - Country
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->client_state); // Consignee - State
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->client_pin); // Consignee - Pincode
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->client_gst); // Consignee - GSTIN/UIN

                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $ledger_name); //Ledger Name
                $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $ledger_value); //Ledger Amount

                if($isGrnInvExport == true){
                    //inventory details
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, "cr"); //Ledger Amount Dr/Cr
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, ""); //Item Name
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, ""); //Billed Quantity
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, ""); //Item Rate
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, ""); //Item Rate per
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, ""); //Item Amount
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, ""); //Item Allocations - Order No.
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, ""); //Item Allocations - Order Due on
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, ""); //Accounting Allocation - Ledger
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, ""); //Accounting Allocation - Amount
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, "Item Invoice"); //Change Mode
                } else {
                    //vocher details
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, "cr"); //Ledger Amount Dr/Cr
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->supplier_address); //Supplier Address
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, "India"); // HARD CODED
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->supplier_state); // Supplier STATE
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, "PIN"); // Supplier PIN
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->supplier_gst); // Supplier GST
                    //buyers details
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, $grn_details->client_shifting_address); // Buyers address
                    $object->getActiveSheet()->setCellValueByColumnAndRow($dataRowNo++, $excel_row, " "); //Voucher Narration
                }

                //Details to be added to next rows
                $excel_row++;
                $rowNo++;
                


                if ($grn_part_details) {
                    foreach ($grn_part_details as $grn_parts) {
                        $legerTypeName = "Purchase Ims";
                        if(empty($grn_parts->cgst)) {
                            $legerTypeName = "Purchase Oms";
                        }
                        $grnPartRowNo = 24;
                        if($isGrnInvExport == true){
                            $grnPartRowNo = 25;
                        }

                        $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, $legerTypeName); //Ledger Name
                        $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, round($grn_parts->rate * $grn_parts->accept_qty, 2)); //Ledger Amount
                        $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, "dr"); //Ledger Amount Dr/Cr
                        if($isGrnInvExport == true){
                            $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, $grn_parts->part_number); //Item Name
                            $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, $grn_parts->accept_qty); //Billed Quantity
                            $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, $grn_parts->rate); //Item Rate
                            $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, $grn_parts->uom_name); //Item Rate per
                            $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, round($grn_parts->rate * $grn_parts->accept_qty, 2)); //Item Amount
                            $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, $grn_parts->poNumber); //Item Allocations - Order No.
                            $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, $this->getDateByFormat($grn_parts->expiry_po_date)); //Item Allocations - Order Due on PO Expiry date
                            $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, $legerTypeName); //Accounting Allocation - Ledger
                            $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, round($grn_parts->rate * $grn_parts->accept_qty, 2)); //Accounting Allocation - Amount
                        }
                        //Each individual item to be added to next rows
                        $excel_row++;
                        $rowNo++;
                    }
                }

                foreach ($leger_arr as $leger_entry) {
                        $name = $leger_entry["name"];
                        if($name != "SUPPLIER_NAME") {
                            $ledger_name = $leger_entry["name"];
                            $ledger_value = round($leger_entry["value"],2);
                            $grnPartRowNo = 24;
                            if ($isGrnInvExport == true) {
                                $grnPartRowNo = 25;
                            }


                            $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, $ledger_name); //Ledger Name
                            $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, $ledger_value); //Ledger Amount
                            $object->getActiveSheet()->setCellValueByColumnAndRow($grnPartRowNo++, $excel_row, "dr"); //Ledger Amount Dr/Cr
                            //Each individual item to be added to next rows
                            $excel_row++;
                            $rowNo++;

                        }
                    }
                $excel_row++;
                $rowNo++;
            }

            for ($i = 'A'; $i != $object->getActiveSheet()->getHighestColumn(); $i++) {
                $object->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
            }

            header('Content-Type: application/vnd.ms-excel');
            $filename = 'Tally_GRN-' . $this->current_date_time;

            header('Content-Disposition: attachment;filename="' . $filename . ".xls");
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            ob_end_clean();
            ob_start();
            $objWriter->save('php://output');
        } else {

            echo "<script>alert('ok');</script>";
        }

    }


    public function get_grn_details()
    {
        $searchYear = $this->input->post('search_year');
        $searchMonth = $this->input->post('search_month');
        $grn_ids = $this->input->post('grn_numbers');
        $searchYear++;
        if(!empty($searchMonth)) {
            $updaateSearchYear = 1;
            $monthOperator_1 = ">=";
            $monthOperator_2 = "<=";
            if($searchMonth < 4) {
                $updaateSearchYear = -1;
                $monthOperator_1 = "<=";
                $monthOperator_2 = ">=";              
            }
        }
        if (!empty($searchYear)) {
            $where_condition = "
							((inward.created_year = " . $searchYear . " AND inward.created_month ".$monthOperator_1." 4)
							OR
							(inward.created_year = " . ($searchYear + $updaateSearchYear) . " AND inward.created_month ".$monthOperator_2." 3)) ";
        }

        if (empty($grn_ids) && !empty($searchMonth)) {
            $where_condition = $where_condition . " AND inward.created_month = " . $searchMonth . " ";
        }
        if (!empty($grn_ids)) {
            if (strpos($grn_ids, '-') !== false) { //range selection
                $serial_range = explode("-", $grn_ids);
                $grnNo_condition = " GRN_SERIAL_NO between " . $serial_range[0] . " AND " . $serial_range[1];
            } else if (strpos($grn_ids, ',') !== false) { //specific search
                $serial_list = explode("-", $grn_ids);
                $grnNo_condition = " GRN_SERIAL_NO in ( " . $grn_ids . " )";
            } else if (strpos($grn_ids, '-') !== false && strpos($grn_ids, ',') !== false) {
                $this->session->set_userdata(['error_message' => "Incorrect GRN number criteria. Can't have both list and range."]);
                exit();
            } else { //individual sales no
                $grnNo_condition = " GRN_SERIAL_NO = " . $grn_ids;
            }
        }

        
        $isMultipleClientUnit = $this->session->userdata['isMultipleClientUnits'];
        if($isMultipleClientUnit == "false") {
            $fromClient = " client c ,";
        }else {
            $innerJoinClient = " INNER JOIN client c ON c.client_unit = inward.delivery_unit ";
        }
        
        $query = "SELECT * FROM  ( SELECT inward.id as inward_id,
						po.id as po_id, po.po_number, po.po_date, po.shipping_address as place_of_supply, 
						s.supplier_name, s.location as supplier_address, s.state as supplier_state, s.gst_number as supplier_gst,
                        s.payment_terms as credit_days, 
						CAST(SUBSTRING_INDEX(inward.grn_number, '/', -1) AS UNSIGNED) AS GRN_SERIAL_NO, 
						inward.created_date, inward.grn_date, inward.grn_number, inward.invoice_number, inward.invoice_date,
						c.shifting_address as client_addr, c.state as client_state, c.pin as client_pin, c.gst_number as client_gst,
						c.client_name, c.shifting_address as client_shifting_address
						FROM ".$fromClient." inwarding inward
                        INNER JOIN new_po po ON po.id = inward.po_id
						INNER JOIN supplier s ON po.supplier_id = s.id ".
                        $innerJoinClient.
                        " WHERE  po.clientid = ".$this->Unit->getSessionClientId()." 

                        AND inward.status = 'accept'  AND ";

        $query = $query . $where_condition . ' ) AS grn_view ';

        if (!empty($grnNo_condition)) {
            $query = $query . ' WHERE ' . $grnNo_condition . ' ORDER BY created_date desc';
        }

        $grn_detail_list = $this->Crud->customQuery($query);
        return $grn_detail_list;
    }

    public function grn_export()
    {

        $grn_detail_list = $this->get_grn_details();

        if (empty($grn_detail_list)) {
            $this->addWarningMessage('No records found for this export criteria.');
            $this->redirectMessage();
            exit();
        }
        if ($grn_detail_list) {
            foreach ($grn_detail_list as $grn_details) {
                $xmlstr = "<ENVELOPE xmlns:UDF='TallyUDF'></ENVELOPE>";
                // optionally you can specify a xml-stylesheet for presenting the results. just uncoment the following line and change the stylesheet name.
                /* "<?xml-stylesheet type='text/xsl' href='xml_style.xsl' ?>\n". */
                $xml = new SimpleXMLElement($xmlstr);
                // Add the HEADER section
                $header = $xml->addChild('HEADER');

                $header->addChild('TALLYREQUEST', 'Import Data');
                //$header->addChild('TYPE', 'Data');
                //$header->addChild('ID', 'YourID'); // Replace with your ID

                // Add the BODY section
                $body = $xml->addChild('BODY');
                $data = $body->addChild('IMPORTDATA');
                $data1 = $data->addChild('REQUESTDESC');
                $data1->addChild('REPORTNAME', 'Vouchers');
                $data2 = $data1->addChild("STATICVARIABLES");
                $data2->addChild('SVCURRENTCOMPANY', $this->getCustomerNameDetails());
                $request = $data->addChild('REQUESTDATA');
                $this->tallyMessageXML($request, $grn_details);
            }
        }

        /*
        IMPORTANT NOT SURE ON THIS --
        $TALLYMESSAGE_END = $request->addChild('TALLYMESSAGE');
        $COMPANY = $TALLYMESSAGE_END->addChild('COMPANY');
        $REMOTECMPINFO = $COMPANY->addChild('REMOTECMPINFO.LIST');
        $REMOTECMPINFO->addAttribute('MERGE', 'Yes');
        $REMOTECMPINFO->addChild('NAME', '3c9cfafd-3581-422c-b74a-b5deac32a8c8');
        $REMOTECMPINFO->addChild('REMOTECMPNAME', 'Super Polymers');
        $REMOTECMPINFO->addChild('REMOTECMPSTATE', 'Maharashtra');
         */

        $dom = dom_import_simplexml($xml)->ownerDocument;
        // Format the output with indentation and newlines
        $dom->preserveWhiteSpace = false;
        $dom->formatOutput = true;
        //$dom->loadXML($dom->saveXML(), LIBXML_NOXMLDECL);
        $xmlString = $dom->saveXML();
        $xmlStringWithoutDeclaration = preg_replace('/<\?xml version="1.0"\?>/', '', $xmlString);
        // Get the formatted XML as a string
        //$formattedXml = $dom->saveXML();
        $filename = 'Tally_GRN-' . $this->current_date_time . '.xml';
        header('Content-Type: application/xml');
        header('Content-Disposition: attachment; filename="' . $filename . '"');

        // Output the result
        echo $xmlStringWithoutDeclaration;

        // Output the XML
        //echo $xml->asXML();
        // Define the file path where you want to save the XML
        //echo "XML file has been saved as $filename";
        exit();
    }

    private function getTAXQueryData($grn_details)
    {
        $grn_part_details = $this->Crud->customQuery("SELECT grn.inwarding_id, inward.grn_number, grn.po_part_id, grn.po_number, inward.grn_date,
		 po.po_number as poNumber, po.supplier_id,s.supplier_name, po.expiry_po_date, po.po_date, part.part_number, part.part_description, part.hsn_code, u.uom_name,
			po_parts.tax_id, po_parts.part_id, po_parts.rate, grn.accept_qty,tax.igst, tax.sgst, tax.cgst,tax.tcs,tax.tcs_on_tax,
			ROUND(((grn.accept_qty * po_parts.rate) * tax.cgst) / 100,2) as cgst_amount,
			ROUND(((grn.accept_qty * po_parts.rate) * tax.sgst) / 100,2) as sgst_amount,
			ROUND(((grn.accept_qty * po_parts.rate) * tax.tcs) / 100,2) as tcs_amount,
			ROUND(((grn.accept_qty * po_parts.rate) * tax.igst) / 100,2) as igst_amount,
			po.loading_unloading, 	po.loading_unloading_gst, po.freight_amount, po.freight_amount_gst
			FROM grn_details grn
					INNER JOIN inwarding inward ON inward.id = grn.inwarding_id
					INNER JOIN po_parts po_parts ON po_parts.id = grn.po_part_id
					INNER JOIN new_po po ON po.id = grn.po_number
					INNER JOIN child_part part ON part.id = po_parts.part_id
					INNER JOIN uom u ON u.id = po_parts.uom_id
					INNER JOIN gst_structure tax ON tax.id = po_parts.tax_id
					INNER JOIN supplier s ON s.id = po.supplier_id
					WHERE  po.clientId = ".$this->Unit->getSessionClientId()." 

                    AND inward.id = " . $grn_details->inward_id);

        return $grn_part_details;

    }
    // Function to add sales data request
    public function tallyMessageXML($data, $grn_details)
    {
        // Format the DateTime object to the desired output format "Ymd"
        $dateString = '2024-02-24';
        $date = new DateTime($grn_details->po_date);
        $po_date = $date->format('Ymd');

        $tally_message = $data->addChild('TALLYMESSAGE');
        $grn_number = $grn_details->grn_number;

        //Get GUID and RANDOMID :
        $guidPartial = str_replace("-", "0", $grn_number);
        $guid = str_replace("/", "0", $guidPartial);

        $voucher_child = $tally_message->addChild('VOUCHER'); //HARD CODED
        $voucher_child->addAttribute('REMOTEID', $guid); //Fixed pattern - with sales number etc as this can be used for cancel too.
        $voucher_child->addAttribute('VCHKEY', $guid); //TO-DO : Check what should be added here..
        $voucher_child->addAttribute('VCHTYPE', 'Purchases With GST'); //Hard-Coded
        $voucher_child->addAttribute('OBJVIEW', 'Invoice Voucher View'); //Hard-Coded For detailed information

        //Hard coded values ??
        $address_list = $voucher_child->addChild('ADDRESS.LIST');
        $address_list->addAttribute('TYPE', 'String');
        $address_list->addChild('ADDRESS', $grn_details->location); //Address
        $address_list->addChild('ADDRESS', $grn_details->state); //Address

        $client = $this->Crud->customQuery('select * from client c');

        $basicbuy_address_list = $voucher_child->addChild('BASICBUYERADDRESS.LIST'); //HARD CODED
        $basicbuy_address_list->addAttribute('TYPE', 'String'); //HARD CODED
        $basicbuy_address_list->addChild('BASICBUYERADDRESS', $client[0]->address1); //Address
        $basicbuy_address_list->addChild('BASICBUYERADDRESS', $client[0]->location . ',' . $client[0]->state); //Address
        $basicbuy_address_list->addChild('BASICBUYERADDRESS', $client[0]->pin); //Address
        $basicbuy_address_list->addChild('BASICBUYERADDRESS', $client[0]->email);

        $oldAuditEntryID_list = $voucher_child->addChild('OLDAUDITENTRYIDS.LIST'); //HARD CODED
        $oldAuditEntryID_list->addAttribute('TYPE', 'Number'); //HARD CODED
        $oldAuditEntryID_list->addChild('OLDAUDITENTRYIDS', '-1'); //HARD CODED

        $voucher_child->addChild('DATE', $po_date);
        $voucher_child->addChild('REFERENCEDATE', $po_date);
        $voucher_child->addChild('VCHSTATUSDATE', $po_date);
        $voucher_child->addChild('GUID', $guid);
        $voucher_child->addChild('GSTREGISTRATIONTYPE', 'Regular'); //HARD CODED
        $voucher_child->addChild('VATDEALERTYPE', 'Regular'); //TO-DO - Not sure
        $voucher_child->addChild('STATENAME', $grn_details->state);
        $voucher_child->addChild('ENTEREDBY', $this->user_name);
        $voucher_child->addChild('OBJECTUPDATEACTION', 'Create'); //Need to check whether cancel is there or not
        $voucher_child->addChild('COUNTRYOFRESIDENCE', 'India'); //Future if comes from outside country
        $voucher_child->addChild('PARTYGSTIN', $grn_details->gst_number); //TO-DO -CROSS CHECK
        $voucher_child->addChild('PLACEOFSUPPLY', $client[0]->state); //TO-DO - SHOULD BE PER CLIENT STATE
        $voucher_child->addChild('PARTYNAME', $grn_details->supplier_name); // SUPPLIER_NAME
        $GSTREGISTRATION = $voucher_child->addChild('GSTREGISTRATION', $client[0]->state . ' Registration'); //Client_STATE
        $GSTREGISTRATION->addAttribute('TAXTYPE', 'GST'); //HARD CODED
        $GSTREGISTRATION->addAttribute('TAXREGISTRATION', $client[0]->gst_number); //Client GST

        $voucher_child->addChild('CMPGSTIN', $client[0]->gst_number); //TO-DO        //Client GST
        $voucher_child->addChild('VOUCHERTYPENAME', 'Purchases With GST'); //HARD CODED
        $voucher_child->addChild('PARTYLEDGERNAME', $grn_details->supplier_name); //SUPPLIER_NAME
        $voucher_child->addChild('VOUCHERNUMBER', $grn_details->grn_number); //GR\23-24\01106
        $voucher_child->addChild('BASICBUYERNAME', $client[0]->client_name); //CLIENT NAME
        $voucher_child->addChild('CMPGSTREGISTRATIONTYPE', 'Regular'); //HARD CODED
        $voucher_child->addChild('REFERENCE', $grn_number); //'GR-6709'
        $voucher_child->addChild('PARTYMAILINGNAME', $grn_details->supplier_name); //'STAINLESS BOLT INDUSTRIES');
        $voucher_child->addChild('PARTYPINCODE', $grn_details->pin); //IMPORTANT - '380023');//TO-DO - NEED TO HAVE THIS AS NEW FIELD
        $voucher_child->addChild('CONSIGNEEGSTIN', $grn_details->gst_number); //'27AANCS6031M1ZV');
        $voucher_child->addChild('CONSIGNEEMAILINGNAME', $client[0]->client_name); //'Sai Sound Control Systems Pvt Ltd');
        $voucher_child->addChild('CONSIGNEEPINCODE', $client[0]->pin); //'411060');
        $voucher_child->addChild('CONSIGNEESTATENAME', $client[0]->state); //'Maharashtra');
        $voucher_child->addChild('CMPGSTSTATE', $client[0]->state); //'Maharashtra');
        $voucher_child->addChild('CONSIGNEECOUNTRYNAME', 'India'); //TO-DO    NEED SUPPORT IN FUTURE
        $voucher_child->addChild('BASICBASEPARTYNAME', $grn_details->supplier_name); //'STAINLESS BOLT INDUSTRIES');
        $voucher_child->addChild('NUMBERINGSTYLE', 'Manual'); //HARD CODED
        $voucher_child->addChild('CSTFORMISSUETYPE', 'Not Applicable'); //HARD CODED
        $voucher_child->addChild('CSTFORMRECVTYPE', 'Not Applicable'); //$client[0]->state
        $voucher_child->addChild('CONSIGNEECSTNUMBER', '27575222066C'); //TO-DO        //NOT SURE ABOUT THIS IMPORTANT
        $voucher_child->addChild('FBTPAYMENTTYPE', 'Default'); //HARD CODED
        $voucher_child->addChild('PERSISTEDVIEW', 'Invoice Voucher View'); //HARD CODED - FOR DETAILED VIEW
        $voucher_child->addChild('VCHSTATUSTAXADJUSTMENT', 'Default'); //HARD CODED
        $voucher_child->addChild('VCHSTATUSVOUCHERTYPE', 'Purchases With GST'); //HARD CODED
        $voucher_child->addChild('VCHSTATUSTAXUNIT', $client[0]->state . ' Registration'); //'Maharashtra Registration');
        $voucher_child->addChild('VCHGSTCLASS', ' Not Applicable'); //HARD CODED
        $voucher_child->addChild('CONSIGNEEPINNUMBER', 'AANCS6031M'); //TO-DO    //NOT SURE ABOUT THIS - IMPORTANT
        $voucher_child->addChild('VCHENTRYMODE', 'Item Invoice'); //HARD CODED
        $voucher_child->addChild('DIFFACTUALQTY', 'No'); //HARD CODED
        $voucher_child->addChild('ISMSTFROMSYNC', 'No'); //HARD CODED
        $voucher_child->addChild('ISDELETED', 'No'); //HARD CODED
        $voucher_child->addChild('ISSECURITYONWHENENTERED', 'Yes'); //TO-DO        //NOT SURE ON THIS
        $voucher_child->addChild('ASORIGINAL', 'No'); //HARD CODED
        $voucher_child->addChild('AUDITED', 'No'); //HARD CODED
        $voucher_child->addChild('ISCOMMONPARTY', 'No'); //HARD CODED
        $voucher_child->addChild('FORJOBCOSTING', 'No'); //HARD CODED
        $voucher_child->addChild('ISOPTIONAL', 'No'); //HARD CODED
        $voucher_child->addChild('EFFECTIVEDATE', $po_date);

        $this->getHardCodedFields($voucher_child);

        $voucher_child->addChild('ALTERID', ' 162945'); //TO-DO    //NOT SURE ON THIS -- IMPORTANT
        $voucher_child->addChild('MASTERID', ' 67500'); //TO-DO    //NOT SURE ON THIS -- IMPORTANT
        $voucher_child->addChild('VOUCHERKEY', '194553428574288'); //TO-DO    //NOT SURE ON THIS -- IMPORTANT
        $voucher_child->addChild('VOUCHERRETAINKEY', '4941'); //TO-DO    //NOT SURE ON THIS -- IMPORTANT
        $voucher_child->addChild('VOUCHERNUMBERSERIES', 'Default'); //TO-DO    //HARD CODED
        //$voucher_child->addChild('UPDATEDDATETIME', '20240119105733000');            //TO-DO    //NOT SURE ON THIS -- IMPORTANT
        $voucher_child->addChild('EWAYBILLDETAILS.LIST', ''); //    HARD CODED
        $voucher_child->addChild('EXCLUDEDTAXATIONS.LIST', ''); //    HARD CODED
        $voucher_child->addChild('OLDAUDITENTRIES.LIST', ''); //    HARD CODED
        $voucher_child->addChild('ACCOUNTAUDITENTRIES.LIST', ''); //    HARD CODED
        $voucher_child->addChild('AUDITENTRIES.LIST', ''); //    HARD CODED
        $voucher_child->addChild('DUTYHEADDETAILS.LIST', ''); //    HARD CODED
        $voucher_child->addChild('GSTADVADJDETAILS.LIST', ''); //    HARD CODED

        $grn_part_details = $this->getTAXQueryData($grn_details);
        $leger_arr = $this->getTaxDetailsUsingTaxQuery($grn_part_details);

        if ($grn_part_details) {
            foreach ($grn_part_details as $grn_parts) {
                $this->allInventoryEntriesData($voucher_child, $grn_parts, $grn_details, $leger_arr);
            }
        }

        $voucher_child->addChild('CONTRITRANS.LIST', ''); //    HARD CODED
        $voucher_child->addChild('EWAYBILLERRORLIST.LIST', ''); //    HARD CODED
        $voucher_child->addChild('IRNERRORLIST.LIST', ''); //    HARD CODED
        $voucher_child->addChild('HARYANAVAT.LIST', ''); //    HARD CODED
        $voucher_child->addChild('SUPPLEMENTARYDUTYHEADDETAILS.LIST', ''); //    HARD CODED
        $INVOICEDELNOTES = $voucher_child->addChild('INVOICEDELNOTES.LIST', ''); //    HARD CODED
        $INVOICEDELNOTES->addChild('BASICSHIPPINGDATE', $po_date); //'20240108');
        $INVOICEDELNOTES->addChild('BASICSHIPDELIVERYNOTE', $grn_details->grn_number); //'GR\23-24\01106');

        $INVOICEORDERLIST = $voucher_child->addChild('INVOICEORDERLIST.LIST', ''); //    HARD CODED
        $INVOICEORDERLIST->addChild('BASICORDERDATE', $po_date); //'20240112');
        $INVOICEORDERLIST->addChild('BASICPURCHASEORDERNO', $grn_details->po_number); //'883');

        $voucher_child->addChild('INVOICEINDENTLIST.LIST', ''); //    HARD CODED
        $voucher_child->addChild('ATTENDANCEENTRIES.LIST', ''); //    HARD CODED
        $voucher_child->addChild('ORIGINVOICEDETAILS.LIST', ''); //    HARD CODED
        $voucher_child->addChild('INVOICEEXPORTLIST.LIST', ''); //    HARD CODED

        //There would be multiple entries here for ALLLEDGERENTRIES
        // Add ledger details
        foreach ($leger_arr as $leger_entry) {
            $this->grnLedgerEntries($voucher_child, $leger_entry, $grn_number);
        }

        $this->gstList($voucher_child, $grn_details);

        $voucher_child->addChild('PAYROLLMODEOFPAYMENT.LIST', ''); //HARD CODED
        $voucher_child->addChild('ATTDRECORDS.LIST', ''); //HARD CODED
        $voucher_child->addChild('GSTEWAYCONSIGNORADDRESS.LIST', ''); //HARD CODED
        $voucher_child->addChild('GSTEWAYCONSIGNEEADDRESS.LIST', ''); //HARD CODED
        $voucher_child->addChild('TEMPGSTRATEDETAILS.LIST', ''); //HARD CODED
        $voucher_child->addChild('TEMPGSTADVADJUSTED.LIST', ''); //HARD CODED

    }

    private function getTaxDetailsUsingTaxQuery($getTaxDetails)
    {
        $final_total = 0;
        $cgst_amount = 0;
        $sgst_amount = 0;
        $igst_amount = 0;
        $tcs_amount = 0;
        //$supplier_data = $this->Crud->get_data_by_id("supplier", $getTaxDetails[0]->supplier_id, "id");
        $loading_unloading_gst = $this->Crud->get_data_by_id("gst_structure", $getTaxDetails[0]->loading_unloading_gst, "id");
        $freight_amount_gst = $this->Crud->get_data_by_id("gst_structure", $getTaxDetails[0]->freight_amount_gst, "id");

        if (!empty($loading_unloading_gst)) {
            $loading_cgst_amount = ($loading_unloading_gst[0]->cgst * $getTaxDetails[0]->loading_unloading) / 100;
            $loading_sgst_amount = ($loading_unloading_gst[0]->sgst * $getTaxDetails[0]->loading_unloading) / 100;
            $loading_igst_amount = ($loading_unloading_gst[0]->igst * $getTaxDetails[0]->loading_unloading) / 100;

            $cgst_amount = $loading_cgst_amount;
            $sgst_amount = $loading_sgst_amount;
            $igst_amount = $loading_igst_amount;
        }
        if (!empty($freight_amount_gst)) {
            $freight_cgst_amount = ($freight_amount_gst[0]->cgst * $getTaxDetails[0]->freight_amount) / 100;
            $freight_sgst_cgst = ($freight_amount_gst[0]->sgst * $getTaxDetails[0]->freight_amount) / 100;
            $freight_igst_cgst = ($freight_amount_gst[0]->igst * $getTaxDetails[0]->freight_amount) / 100;
            $cgst_amount = $cgst_amount + $freight_cgst_amount;
            $sgst_amount = $sgst_amount + $freight_sgst_cgst;
            $igst_amount = $igst_amount + $freight_igst_cgst;
        }

        foreach ($getTaxDetails as $p) {
            if ($p->igst <= 0) {
                $total_cgst_sgst_amount = $p->cgst_amount + $p->sgst_amount;
                $gst = $p->cgst +  $p->sgst;
                $cgst = $p->cgst;
                $sgst =  $p->sgst;
                $tcs = $p->tcs;
                $tcs_on_tax = $p->tcs_on_tax;
                $igst = 0;
            } else {
                $total_igst_amount = $p->igst_amount;
                $gst = $p->igst;
                $cgst = 0;
                $sgst = 0;
                $tcs = (float) $p->tcs;
                $tcs_on_tax = $p->tcs_on_tax;
                $igst = $gst;
            }

            $part_rate_new = $p->rate;
            $total_amount = $p->accept_qty * $part_rate_new;
            $final_total = $final_total + $total_amount;

            $cgst_amount = $cgst_amount + $p->cgst_amount;
            $sgst_amount = $sgst_amount + $p->sgst_amount;
            $igst_amount = $igst_amount + $p->igst_amount;

            if ($tcs_on_tax == "no") {
                $tcs_amount = $tcs_amount + (($total_amount * $tcs) / 100);
            } else {
                $tcs_amount = $tcs_amount + ((((float) $p->cgst_amount + (float) $p->sgst_amount
                     + (float) $p->igst_amount + (float) $total_amount) * $tcs) / 100);
            }

        }

        $final_total = $final_total + $getTaxDetails[0]->loading_unloading + $getTaxDetails[0]->freight_amount;
        $final_final_amount = $final_total + $cgst_amount + $sgst_amount + $igst_amount + $tcs_amount;

        /**
         * Note: We have storing gst rates same as that of any part as 99.99% all the parts
         * which are having same tax brackets will be added to a PO.
         */
        $leger_arr = array(
            array(
                "name" => "SUPPLIER_NAME",
                "value" => round($final_final_amount, 2),
                "supplier_name" => $getTaxDetails[0]->supplier_name,
            ));

        if ($getTaxDetails[0]->freight_amount > 0) {
            // New entry to be added
            $newEntry = array(
                "name" => "P&F Charges",
                "value" => round($getTaxDetails[0]->freight_amount, 2),
                // "gstRate" => $tcs,
            );
            $leger_arr[] = $newEntry;
        }

        if ($getTaxDetails[0]->loading_unloading > 0) {
            // New entry to be added
            $newEntry = array(
                "name" => "Loading Unloading Charges",
                "value" => round($getTaxDetails[0]->loading_unloading, 2),
                // "gstRate" => $tcs,
            );
            $leger_arr[] = $newEntry;
        }


        if ($cgst_amount > 0) {
            // New entry to be added
            $newEntry = array(
                "name" => "CGST",
                "value" => round($cgst_amount, 2),
                "gstRate" => $cgst,
            );
            $leger_arr[] = $newEntry;
        }

        if ($sgst_amount > 0) {
            // New entry to be added
            $newEntry = array(
                "name" => "SGST",
                "value" => round($sgst_amount, 2),
                "gstRate" => $sgst,
            );
            $leger_arr[] = $newEntry;
        }

        if ($igst_amount > 0) {
            // New entry to be added
            $newEntry = array(
                "name" => "IGST",
                "value" => round($igst_amount, 2),
                "gstRate" => $igst,
            );
            $leger_arr[] = $newEntry;
        }

        if ($tcs_amount > 0) {
            // New entry to be added
            $newEntry = array(
                "name" => "TCS",
                "value" => round($tcs_amount, 2),
                "gstRate" => $tcs,
            );
            $leger_arr[] = $newEntry;
        }

		return $leger_arr;

    }

    /**
     * GST List PART
     */
    private function gstList($voucher_child, $grn_details)
    {
        $GST_LIST = $voucher_child->addChild('GST.LIST', ''); //HARD CODED
        $GST_LIST->addChild('PURPOSETYPE', 'GST'); //HARD CODED
        $STAT_LIST = $GST_LIST->addChild('STAT.LIST', ''); //HARD CODED
        $STAT_LIST->addChild('PURPOSETYPE', 'GST'); //HARD CODED
        $STAT_LIST->addChild('STATKEY', '202347188' . $grn_details->gst_number . 'Inward Invoice' . $grn_details->grn_number); //TO-DO    //NOT SURE WHAT IS THIS IMPORTANT
        $STAT_LIST->addChild('ISFETCHEDONLY', 'No'); //HARD CODED
        $STAT_LIST->addChild('ISDELETED', 'No'); //TO-DO    MAY CHANGE BASED ON DETAILS IMPORTANT
        $STAT_LIST->addChild('TALLYCONTENTUSER.LIST', ''); //HARD CODED
    }

    /**
     * Ledger entries for each part
     */
    private function grnLedgerEntries($voucher_child, $ledger_entry, $grn_number)
    {

        //Legder entries for each part ---
        $LEDGERENTRIES = $voucher_child->addChild('LEDGERENTRIES.LIST', ''); //HARD CODED
        $OLDAUDITENTRYIDS_list = $LEDGERENTRIES->addChild('OLDAUDITENTRYIDS.LIST', ''); //HARD CODED
        $OLDAUDITENTRYIDS_list->addAttribute('TYPE', 'Number'); //HARD CODED
        $OLDAUDITENTRYIDS_list->addChild('OLDAUDITENTRYIDS', '-1'); //HARD CODED

        $name = $ledger_entry["name"];
        $value = $ledger_entry["value"];
        $gstRate = $ledger_entry["gstRate"];

        if ($name == "SUPPLIER_NAME") {
            $LEDGERENTRIES->addChild('LEDGERNAME', $ledger_entry["supplier_name"]); //SUPPLIER NAME
            $LEDGERENTRIES->addChild('ISDEEMEDPOSITIVE', 'No'); //HARD CODED
            $LEDGERENTRIES->addChild('ISLASTDEEMEDPOSITIVE', 'No'); //HARD CODED
            $LEDGERENTRIES->addChild('ISPARTYLEDGER', 'Yes'); //HARD CODED
            $LEDGERENTRIES->addChild('AMOUNT', $value); //TO-DO

            $bill_allocations = $LEDGERENTRIES->addChild('BILLALLOCATIONS.LIST');
            $bill_allocations->addChild('NAME', $grn_number); //'12233');
            $bill_allocations->addChild('BILLTYPE', 'Total'); //New Ref
            $bill_allocations->addChild('TDSDEDUCTEEISSPECIALRATE', 'No'); //HARD CODED
            $bill_allocations->addChild('AMOUNT', $value);

            $LEDGERENTRIES->addChild('STBILLCATEGORIES.LIST', ''); //TO-DO

        } else {

            $LEDGERENTRIES->addChild('LEDGERNAME', $name); //TO-DO
            $LEDGERENTRIES->addChild('APPROPRIATEFOR', ' Not Applicable'); //HARD CODED
            $LEDGERENTRIES->addChild('ROUNDTYPE', 'Not Applicable'); //HARD CODED
            $LEDGERENTRIES->addChild('ISDEEMEDPOSITIVE', 'Yes'); //HARD CODED
            $LEDGERENTRIES->addChild('ISLASTDEEMEDPOSITIVE', 'Yes'); //HARD CODED
            $LEDGERENTRIES->addChild('ISPARTYLEDGER', 'No'); //HARD CODED
            $LEDGERENTRIES->addChild('AMOUNT', '-' . $value); //TO-DO
            $LEDGERENTRIES->addChild('VATEXPAMOUNT', '-' . $value); //TO-DO
            $LEDGERENTRIES->addChild('BILLALLOCATIONS.LIST', ''); //TO-DO
        }

        //Common for all the ledger entries...
        $LEDGERENTRIES->addChild('GSTCLASS', 'Not Applicable'); //TO-DO
        $LEDGERENTRIES->addChild('INTERESTCOLLECTION.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('SERVICETAXDETAILS.LIST', ''); //TO-DO

        $LEDGERENTRIES->addChild('BANKALLOCATIONS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('LEDGERFROMITEM', 'No'); //TO-DO
        $LEDGERENTRIES->addChild('REMOVEZEROENTRIES', 'No'); //TO-DO
        $LEDGERENTRIES->addChild('GSTOVERRIDDEN', 'No'); //TO-DO
        $LEDGERENTRIES->addChild('ISGSTASSESSABLEVALUEOVERRIDDEN', 'No'); //TO-DO
        $LEDGERENTRIES->addChild('STRDISGSTAPPLICABLE', 'No'); //TO-DO
        $LEDGERENTRIES->addChild('STRDGSTISPARTYLEDGER', 'No'); //TO-DO
        $LEDGERENTRIES->addChild('STRDGSTISDUTYLEDGER', 'No'); //TO-DO
        $LEDGERENTRIES->addChild('CONTENTNEGISPOS', 'No'); //TO-DO
        $LEDGERENTRIES->addChild('ISCAPVATTAXALTERED', 'No'); //TO-DO
        $LEDGERENTRIES->addChild('ISCAPVATNOTCLAIMED', 'No'); //TO-DO

        $LEDGERENTRIES->addChild('OLDAUDITENTRIES.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('ACCOUNTAUDITENTRIES.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('AUDITENTRIES.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('INPUTCRALLOCS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('DUTYHEADDETAILS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('EXCISEDUTYHEADDETAILS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('RATEDETAILS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('SUMMARYALLOCS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('CENVATDUTYALLOCATIONS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('STPYMTDETAILS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('EXCISEPAYMENTALLOCATIONS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('TAXBILLALLOCATIONS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('TAXOBJECTALLOCATIONS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('TDSEXPENSEALLOCATIONS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('VATSTATUTORYDETAILS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('COSTTRACKALLOCATIONS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('REFVOUCHERDETAILS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('INVOICEWISEDETAILS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('VATITCDETAILS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('ADVANCETAXDETAILS.LIST', ''); //TO-DO
        $LEDGERENTRIES->addChild('TAXTYPEALLOCATIONS.LIST', ''); //TO-DO
    }

    /**
     * All inventory entries - i.e. PO parts
     */
    private function allInventoryEntriesData($voucher_child, $grn_parts, $grn_details, $rate_entries)
    {

        //All inventory entries    - i.e ALL PART ENTRIES
        $ALLINVENTORYENTRIES = $voucher_child->addChild('ALLINVENTORYENTRIES.LIST', ''); //HARD CODE
        $ALLINVENTORYENTRIES->addChild('STOCKITEMNAME', $grn_parts->part_description); //'APL SS 304 HEX BOLT M14X50');  //TO-DO
        $ALLINVENTORYENTRIES->addChild('GSTOVRDNINELIGIBLEITC', ' Not Applicable'); //HARD CODE
        $ALLINVENTORYENTRIES->addChild('GSTOVRDNISREVCHARGEAPPL', ' Not Applicable'); //HARD CODE
        $ALLINVENTORYENTRIES->addChild('GSTOVRDNTAXABILITY', 'Taxable'); //HARD CODE
        $ALLINVENTORYENTRIES->addChild('GSTSOURCETYPE', 'Ledger'); //HARD CODE
        $ALLINVENTORYENTRIES->addChild('GSTLEDGERSOURCE', 'Purchase Oms'); //TO-DO    //NOT SURE ON THIS IMPORTANT
        $ALLINVENTORYENTRIES->addChild('HSNSOURCETYPE', 'Stock Item'); //HARD CODE
        $ALLINVENTORYENTRIES->addChild('HSNITEMSOURCE', $grn_parts->part_description); //'APL SS 304 HEX BOLT M14X50');    //TO-DO
        $ALLINVENTORYENTRIES->addChild('GSTOVRDNSTOREDNATURE', ''); //'Interstate Purchase - Taxable');//NEED TO CHECK ON THIS IMPORTANT
        $ALLINVENTORYENTRIES->addChild('GSTOVRDNTYPEOFSUPPLY', 'Goods'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('GSTRATEINFERAPPLICABILITY', 'As per Masters/Company'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('GSTHSNNAME', $grn_parts->hsn_code); //'7318');
        $ALLINVENTORYENTRIES->addChild('GSTHSNINFERAPPLICABILITY', 'As per Masters/Company'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('ISDEEMEDPOSITIVE', 'Yes'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('ISGSTASSESSABLEVALUEOVERRIDDEN', 'No'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('STRDISGSTAPPLICABLE', 'No'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('CONTENTNEGISPOS', 'No'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('ISLASTDEEMEDPOSITIVE', 'Yes'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('ISAUTONEGATE', 'No'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('ISCUSTOMSCLEARANCE', 'No'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('ISTRACKCOMPONENT', 'No'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('ISTRACKPRODUCTION', 'No'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('ISPRIMARYITEM', 'No'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('ISSCRAP', 'No'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('RATE', $grn_parts->rate . '/' . $grn_parts->uom_name); //'74.80/Nos.');//
        //$ALLINVENTORYENTRIES->addChild('DISCOUNT', ' 71');//TO-DO                        //NOT APPLICABLE IN AROM SO FAR
        $ALLINVENTORYENTRIES->addChild('AMOUNT', '-' . ($grn_parts->rate * $grn_parts->accept_qty)); //1084.60
        $ALLINVENTORYENTRIES->addChild('ACTUALQTY', $grn_parts->accept_qty . ' ' . $grn_parts->uom_name); //' 50.00 Nos.');
        $ALLINVENTORYENTRIES->addChild('BILLEDQTY', $grn_parts->accept_qty . ' ' . $grn_parts->uom_name); //' 50.00 Nos.');

        $BATCHALLOCATIONS = $ALLINVENTORYENTRIES->addChild('BATCHALLOCATIONS.LIST', ''); //HARD CODED
        $BATCHALLOCATIONS->addChild('GODOWNNAME', 'Main Location'); //HARD CODED
        $BATCHALLOCATIONS->addChild('BATCHNAME', 'Primary Batch'); //HARD CODED
        $BATCHALLOCATIONS->addChild('DESTINATIONGODOWNNAME', 'Main Location'); //TO-DO //HARD CODED
        $BATCHALLOCATIONS->addChild('INDENTNO', ' Not Applicable'); //TO-DO
        $BATCHALLOCATIONS->addChild('ORDERNO', $grn_details->po_number); //'883');
        $BATCHALLOCATIONS->addChild('TRACKINGNUMBER', $grn_details->grn_number); //'GR\23-24\01106');
        $BATCHALLOCATIONS->addChild('DYNAMICCSTISCLEARED', 'No'); //HARD CODED
        $BATCHALLOCATIONS->addChild('AMOUNT', '-' . ($grn_parts->rate * $grn_parts->accept_qty)); //'-1084.60');
        $BATCHALLOCATIONS->addChild('ACTUALQTY', $grn_parts->accept_qty . ' ' . $grn_parts->uom_name); //' 50.00 Nos.');
        $BATCHALLOCATIONS->addChild('BILLEDQTY', $grn_parts->accept_qty . ' ' . $grn_parts->uom_name); //' 50.00 Nos.');
        $ORDERDUEDATE = $BATCHALLOCATIONS->addChild('ORDERDUEDATE', $grn_details->po_date); //'8-Jan-24');
        $ORDERDUEDATE->addAttribute('JD', '45298'); //TO-DO -NOT SURE WHAT IS THIS IMPORTANT
        $ORDERDUEDATE->addAttribute('P', $grn_details->po_date); //'8-Jan-24');
        $BATCHALLOCATIONS->addChild('ADDITIONALDETAILS.LIST', ''); //HARD CODED
        $BATCHALLOCATIONS->addChild('VOUCHERCOMPONENTLIST.LIST', ''); //HARD CODED

        $ACCOUNTINGALLOCATIONS = $ALLINVENTORYENTRIES->addChild('ACCOUNTINGALLOCATIONS.LIST', ''); //HARD CODED
        $OLDAUDITENTRYIDS_new = $ACCOUNTINGALLOCATIONS->addChild('OLDAUDITENTRYIDS.LIST'); //HARD CODED
        $OLDAUDITENTRYIDS_new->addAttribute('TYPE', 'Number'); //HARD CODED
        $OLDAUDITENTRYIDS_new->addChild('OLDAUDITENTRYIDS', '-1'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('LEDGERNAME', 'Purchase Oms'); //TO-DO    WHAT IS THIS IMPORTANT ? Purchase GST PER TALLY DEFINED
        $ACCOUNTINGALLOCATIONS->addChild('GSTCLASS', ' Not Applicable'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('ISDEEMEDPOSITIVE', 'Yes'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('LEDGERFROMITEM', 'No'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('REMOVEZEROENTRIES', 'No'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('ISPARTYLEDGER', 'No'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('GSTOVERRIDDEN', 'No'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('ISGSTASSESSABLEVALUEOVERRIDDEN', 'No'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('STRDISGSTAPPLICABLE', 'No'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('STRDGSTISPARTYLEDGER', 'No'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('STRDGSTISDUTYLEDGER', 'No'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('CONTENTNEGISPOS', 'No'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('ISLASTDEEMEDPOSITIVE', 'Yes'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('ISCAPVATTAXALTERED', 'No'); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('ISCAPVATNOTCLAIMED', 'No'); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('AMOUNT', '-' . ($grn_parts->rate * $grn_parts->accept_qty)); //1084.60
        //$ACCOUNTINGALLOCATIONS->addChild('AMOUNT', '-1084.60');                                    //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('SERVICETAXDETAILS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('BANKALLOCATIONS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('BILLALLOCATIONS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('INTERESTCOLLECTION.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('OLDAUDITENTRIES.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('ACCOUNTAUDITENTRIES.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('AUDITENTRIES.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('INPUTCRALLOCS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('DUTYHEADDETAILS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('EXCISEDUTYHEADDETAILS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('RATEDETAILS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('SUMMARYALLOCS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('CENVATDUTYALLOCATIONS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('STPYMTDETAILS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('EXCISEPAYMENTALLOCATIONS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('TAXBILLALLOCATIONS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('TAXOBJECTALLOCATIONS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('TDSEXPENSEALLOCATIONS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('VATSTATUTORYDETAILS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('COSTTRACKALLOCATIONS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('REFVOUCHERDETAILS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('INVOICEWISEDETAILS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('VATITCDETAILS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('ADVANCETAXDETAILS.LIST', ''); //HARD CODED
        $ACCOUNTINGALLOCATIONS->addChild('TAXTYPEALLOCATIONS.LIST', ''); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('DUTYHEADDETAILS.LIST', ''); //HARD CODED

        if ($rate_entries != null) {
            foreach ($rate_entries as $rate) {
                if ("SUPPLIER_NAME" == $rate["name"]) {
                    continue;
                }

                $RATEDETAILS = $ALLINVENTORYENTRIES->addChild('RATEDETAILS.LIST', ''); //HARD CODED
                $RATEDETAILS->addChild('GSTRATEDUTYHEAD', $rate["name"]); //PER TAX NAME
                $RATEDETAILS->addChild('GSTRATEVALUATIONTYPE', 'Based on Value'); //HARD CODED
                $RATEDETAILS->addChild('GSTRATE', $rate["gstRate"]); //'18');
            }
        }

        $ALLINVENTORYENTRIES->addChild('SUPPLEMENTARYDUTYHEADDETAILS.LIST', ''); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('TAXOBJECTALLOCATIONS.LIST', ''); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('REFVOUCHERDETAILS.LIST', ''); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('EXCISEALLOCATIONS.LIST', ''); //HARD CODED
        $ALLINVENTORYENTRIES->addChild('EXPENSEALLOCATIONS.LIST', ''); //HARD CODED
    }

    private function getHardCodedFields($voucher_child)
    {
        $voucher_child->addChild('USEFOREXCISE', 'No'); //        HARD CODED
        $voucher_child->addChild('ISFORJOBWORKIN', 'No'); //    HARD CODED
        $voucher_child->addChild('ALLOWCONSUMPTION', 'No'); //    HARD CODED
        $voucher_child->addChild('USEFORINTEREST', 'No'); //    HARD CODED
        $voucher_child->addChild('USEFORGAINLOSS', 'No'); //    HARD CODED
        $voucher_child->addChild('USEFORGODOWNTRANSFER', 'No'); //    HARD CODED
        $voucher_child->addChild('USEFORCOMPOUND', 'No'); //    HARD CODED
        $voucher_child->addChild('USEFORSERVICETAX', 'No'); //    HARD CODED
        $voucher_child->addChild('ISREVERSECHARGEAPPLICABLE', 'No'); //    HARD CODED
        $voucher_child->addChild('ISSYSTEM', 'No'); //    HARD CODED
        $voucher_child->addChild('ISFETCHEDONLY', 'No'); //    HARD CODED
        $voucher_child->addChild('ISGSTOVERRIDDEN', 'No'); //    HARD CODED
        $voucher_child->addChild('ISCANCELLED', 'No'); //    HARD CODED
        $voucher_child->addChild('ISONHOLD', 'No'); //    HARD CODED
        $voucher_child->addChild('ISSUMMARY', 'No'); //
        $voucher_child->addChild('ISECOMMERCESUPPLY', 'No'); //    HARD CODED
        $voucher_child->addChild('ISBOENOTAPPLICABLE', 'No'); //    HARD CODED
        $voucher_child->addChild('ISGSTSECSEVENAPPLICABLE', 'No'); //    HARD CODED
        $voucher_child->addChild('IGNOREEINVVALIDATION', 'No'); //    HARD CODED
        $voucher_child->addChild('CMPGSTISOTHTERRITORYASSESSEE', 'No'); //    HARD CODED
        $voucher_child->addChild('PARTYGSTISOTHTERRITORYASSESSEE', 'No'); //    HARD CODED
        $voucher_child->addChild('IRNJSONEXPORTED', 'No'); //    HARD CODED
        $voucher_child->addChild('IRNCANCELLED', 'No'); //    HARD CODED
        $voucher_child->addChild('IGNOREGSTCONFLICTINMIG', 'No'); //    HARD CODED
        $voucher_child->addChild('ISOPBALTRANSACTION', 'No'); //    HARD CODED
        $voucher_child->addChild('IGNOREGSTFORMATVALIDATION', 'No'); //    HARD CODED
        $voucher_child->addChild('ISELIGIBLEFORITC', 'Yes'); //    HARD CODED
        $voucher_child->addChild('UPDATESUMMARYVALUES', 'No'); //    HARD CODED
        $voucher_child->addChild('ISEWAYBILLAPPLICABLE', 'No'); //    HARD CODED
        $voucher_child->addChild('ISDELETEDRETAINED', 'No'); //    HARD CODED
        $voucher_child->addChild('ISNULL', 'No'); //    HARD CODED
        $voucher_child->addChild('ISEXCISEVOUCHER', 'No'); //    HARD CODED
        $voucher_child->addChild('EXCISETAXOVERRIDE', 'No'); //    HARD CODED
        $voucher_child->addChild('USEFORTAXUNITTRANSFER', 'No'); //    HARD CODED
        $voucher_child->addChild('ISEXER1NOPOVERWRITE', 'No'); //    HARD CODED
        $voucher_child->addChild('ISEXF2NOPOVERWRITE', 'No'); //    HARD CODED
        $voucher_child->addChild('ISEXER3NOPOVERWRITE', 'No'); //    HARD CODED
        $voucher_child->addChild('IGNOREPOSVALIDATION', 'No'); //    HARD CODED
        $voucher_child->addChild('EXCISEOPENING', 'No'); //    HARD CODED
        $voucher_child->addChild('USEFORFINALPRODUCTION', 'No'); //    HARD CODED
        $voucher_child->addChild('ISTDSOVERRIDDEN', 'No'); //    HARD CODED
        $voucher_child->addChild('ISTCSOVERRIDDEN', 'No'); //    HARD CODED
        $voucher_child->addChild('ISTDSTCSCASHVCH', 'No'); //    HARD CODED
        $voucher_child->addChild('INCLUDEADVPYMTVCH', 'No'); //    HARD CODED
        $voucher_child->addChild('ISSUBWORKSCONTRACT', 'No'); //    HARD CODED
        $voucher_child->addChild('ISVATOVERRIDDEN', 'No'); //    HARD CODED
        $voucher_child->addChild('IGNOREORIGVCHDATE', 'No'); //    HARD CODED
        $voucher_child->addChild('ISVATPAIDATCUSTOMS', 'No'); //    HARD CODED
        $voucher_child->addChild('ISDECLAREDTOCUSTOMS', 'No'); //    HARD CODED
        $voucher_child->addChild('VATADVANCEPAYMENT', 'No'); //    HARD CODED
        $voucher_child->addChild('VATADVPAY', 'No'); //    HARD CODED
        $voucher_child->addChild('ISCSTDELCAREDGOODSSALES', 'No'); //    HARD CODED
        $voucher_child->addChild('ISVATRESTAXINV', 'No'); //    HARD CODED
        $voucher_child->addChild('ISSERVICETAXOVERRIDDEN', 'No'); //    HARD CODED
        $voucher_child->addChild('ISISDVOUCHER', 'No'); //    HARD CODED
        $voucher_child->addChild('ISEXCISEOVERRIDDEN', 'No'); //    HARD CODED
        $voucher_child->addChild('ISEXCISESUPPLYVCH', 'No'); //    HARD CODED
        $voucher_child->addChild('GSTNOTEXPORTED', 'No'); //    HARD CODED
        $voucher_child->addChild('IGNOREGSTINVALIDATION', 'No'); //    HARD CODED
        $voucher_child->addChild('ISGSTREFUND', 'No'); //    HARD CODED
        $voucher_child->addChild('OVRDNEWAYBILLAPPLICABILITY', 'No'); //    HARD CODED
        $voucher_child->addChild('ISVATPRINCIPALACCOUNT', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHSTATUSISVCHNUMUSED', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISINCLUDED', 'Yes'); //        HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISUNCERTAIN', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISEXCLUDED', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISAPPLICABLE', 'Yes'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BRECONCILED', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BONLYINPORTAL', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BONLYINBOOKS', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BMISMATCH', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BINDIFFPERIOD', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISRETEFFDATEOVERRDN', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISOVERRDN', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISSTATINDIFFDATE', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISRETINDIFFDATE', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSMAINSECTIONEXCLUDED', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISBRANCHTRANSFEROUT', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHGSTSTATUSISSYSTEMSUMMARY', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHSTATUSISUNREGISTEREDRCM', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHSTATUSISOPTIONAL', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHSTATUSISCANCELLED', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHSTATUSISDELETED', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHSTATUSISOPENINGBALANCE', 'No'); //    HARD CODED
        $voucher_child->addChild('VCHSTATUSISFETCHEDONLY', 'No'); //    HARD CODED
        $voucher_child->addChild('PAYMENTLINKHASMULTIREF', 'No'); //    HARD CODED
        $voucher_child->addChild('ISSHIPPINGWITHINSTATE', 'No'); //    HARD CODED
        $voucher_child->addChild('ISOVERSEASTOURISTTRANS', 'No'); //    HARD CODED
        $voucher_child->addChild('ISDESIGNATEDZONEPARTY', 'No'); //    HARD CODED
        $voucher_child->addChild('HASCASHFLOW', 'No'); //    HARD CODED
        $voucher_child->addChild('ISPOSTDATED', 'No'); //    HARD CODED
        $voucher_child->addChild('USETRACKINGNUMBER', 'No'); //    HARD CODED
        $voucher_child->addChild('ISINVOICE', 'Yes'); //    HARD CODED
        $voucher_child->addChild('MFGJOURNAL', 'No'); //    HARD CODED
        //$voucher_child->addChild('HASDISCOUNTS', 'Yes');//    HARD CODED
        $voucher_child->addChild('ASPAYSLIP', 'No'); //    HARD CODED
        $voucher_child->addChild('ISCOSTCENTRE', 'No'); //    HARD CODED
        $voucher_child->addChild('ISSTXNONREALIZEDVCH', 'No'); //    HARD CODED
        $voucher_child->addChild('ISEXCISEMANUFACTURERON', 'No'); //    HARD CODED
        $voucher_child->addChild('ISBLANKCHEQUE', 'No'); //    HARD CODED
        $voucher_child->addChild('ISVOID', 'No'); //    HARD CODED
        $voucher_child->addChild('ORDERLINESTATUS', 'No'); //    HARD CODED
        $voucher_child->addChild('VATISAGNSTCANCSALES', 'No'); //    HARD CODED
        $voucher_child->addChild('VATISPURCEXEMPTED', 'No'); //    HARD CODED
        $voucher_child->addChild('ISVATRESTAXINVOICE', 'No'); //    HARD CODED
        $voucher_child->addChild('VATISASSESABLECALCVCH', 'No'); //    HARD CODED
        $voucher_child->addChild('ISVATDUTYPAID', 'Yes'); //    HARD CODED
        $voucher_child->addChild('ISDELIVERYSAMEASCONSIGNEE', 'No'); //    HARD CODED
        $voucher_child->addChild('ISDISPATCHSAMEASCONSIGNOR', 'No'); //    HARD CODED
        $voucher_child->addChild('ISDELETEDVCHRETAINED', 'No'); //    HARD CODED
        $voucher_child->addChild('CHANGEVCHMODE', 'No'); //    HARD CODED
        $voucher_child->addChild('RESETIRNQRCODE', 'No'); //    HARD CODED

    }
    public function operation_bom_template_excel_export()
    {
        $this->load->library("excel");
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
         $sheet = $object->getActiveSheet()
        ->setCellValue('B1', 'Output Part Details') // This will be the common heading
        ->setCellValue('E1', 'Input Part Details'); // Another common heading

        // Merge cells for the common headings
        $object->getActiveSheet()->mergeCells('B1:D1'); // Merge for Customer Details
        $object->getActiveSheet()->mergeCells('E1:I1'); // Merge for Employee Details
       
        // Align the common headings to the center
        $object->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

        $sheet->setTitle('BOM Operation Template');

        // Set heading values
        $headings = ["Part Number", "Output Part Type", "Item Part Number", "Scrap Quantity", "Input Part Type" , "Input Item Part Number", "Qty(Number Only)", "Operation Number", "Operation Description"];

        // Set heading row with colors
        $sheet->fromArray([$headings], NULL, 'A2');
        $headingsStyle = array(
            'font' => array('bold' => true),
            'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F9C40E')), 
        );
        $sheet->getStyle('A2:I2')->applyFromArray($headingsStyle);

        //Output part headings
        $headingsStyle1 = array(
            'font' => array('bold' => true),
            'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'cce6ff')), 
        );
        $sheet->getStyle('B1:D1')->applyFromArray($headingsStyle1);

        //Input part headings
        $headingsStyle2 = array(
            'font' => array('bold' => true),
            'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'fff2cc')),
        );
        $sheet->getStyle('E1:I1')->applyFromArray($headingsStyle2);

        $object->getActiveSheet()->freezePane('A3'); // Freeze pane from row 3 (locks rows 1 and 2)
      
       //if ($grn_detail_list) {
            $excel_row = 2;
            $rowNo = 1;
       
            for ($i = 'A'; $i != $object->getActiveSheet()->getHighestColumn(); $i++) {
                $object->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);

                
            }

            // Add data validation (dropdown) to the OuputPart type column
                $objValidation = $object->getActiveSheet()->getCell('B3')->getDataValidation();
                $objValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
                $objValidation->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_STOP);
                $objValidation->setAllowBlank(false);
                $objValidation->setShowInputMessage(true);
                $objValidation->setShowErrorMessage(true);
                $objValidation->setShowDropDown(true);
                $objValidation->setFormula1('"Inhouse,Customer"'); // Setting the dropdown values

                // Apply the same validation to the entire B column (from B3 onwards)
                $object->getActiveSheet()->setDataValidation("B3:B100", $objValidation);

            // Add data validation (dropdown) to the Input Part type column
            $objValidation = $object->getActiveSheet()->getCell('E3')->getDataValidation();
            $objValidation->setType(PHPExcel_Cell_DataValidation::TYPE_LIST);
            $objValidation->setErrorStyle(PHPExcel_Cell_DataValidation::STYLE_STOP);
            $objValidation->setAllowBlank(false);
            $objValidation->setShowInputMessage(true);
            $objValidation->setShowErrorMessage(true);
            $objValidation->setShowDropDown(true);
            $objValidation->setFormula1('"Inhouse,Child"'); // Setting the dropdown values
            // Apply the same validation to the entire B column (from E3 onwards)
            $object->getActiveSheet()->setDataValidation("E3:E100", $objValidation);

                

            header('Content-Type: application/vnd.ms-excel');
            $filename = 'Operation_BOM_Customer_' . $this->current_date_time;

            header('Content-Disposition: attachment;filename="' . $filename . ".xls");
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            ob_end_clean();
            ob_start();
            $objWriter->save('php://output');
       // }

    }


    /**
     *  Import operation BOM
     */
    public function import_operation_bom(){
       $customer_id = $this->input->post('customer_id');
       $uploadedDoc = $this->input->post('uploadedDoc');
       $success = 0;
       $messages = "Something went wrong.";
       //only valid types are allowed.
       if($this->isValidUploadFileType()=="false"){
        $messages = "Only Excel sheets are allowed.";
            // $this->addErrorMessage("Only Excel sheets are allowed.");
       } else {
        if (!empty($_FILES["uploadedDoc"]["name"])) {
                $error;
                $inputFileName = $_FILES["uploadedDoc"]["tmp_name"];
                    try {
                        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFileName);
                        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                        $flag = true;
                        $i=1;

                        $part_number = ""; 
                        //$part_desc ="";
                        $out_part_type = "";
                        $out_part_no = "";
                        $out_part_qty = "";


                        foreach ($allDataInSheet as $rowNumber => $value) {
                            // Check if the row is empty
                            $rowNum = $i + 1;

                            if ($rowNumber >=2) { // Skip the first two rows
                                if (!empty(array_filter($value))) {
                                if($flag) {
                                    $flag =false;
                                    continue;
                                }
                                
                                $errorThisRow=null; 
                        
                                if(!$firstDone) { //not first done
                                    //echo "if block with rowNum: " . $rowNum;
                                    $part_number = empty($value['A']) ? $errorThisRow = $errorThisRow . " Main Part No. ," : trim($value['A']);
                                    //$part_desc = empty($value['']) ? $errorThisRow = $errorThisRow . " Main Part Description ," : trim($value['D']);
                                    $out_part_type = empty($value['B']) ? $errorThisRow = $errorThisRow . " Output Part Type ," : trim($value['B']);
                                    $out_part_no = empty($value['C']) ? $errorThisRow = $errorThisRow . " Output Part Number ," : trim($value['C']);
                                    $out_part_qty = !is_numeric($value['D']) ? $errorThisRow = $errorThisRow . " Output Part Scrap Qty ," : trim($value['D']);
                                    $firstDone = true;
                                }else{
                                   // echo "else block with rowNum: ".$rowNum;
                                    $part_number = empty($value['A']) ? $part_number : trim($value['A']);
                                    //$part_desc = empty($value['A']) ? $part_desc : trim($value['D']);
                                    $out_part_type = empty($value['B']) ? $out_part_type : trim($value['B']);
                                    $out_part_no = empty($value['C']) ? $out_part_no : trim($value['C']);
                                    $out_part_qty = !is_numeric($value['D']) ? $out_part_qty : trim($value['D']);
                                }
                               
                                $input_part_type = $value['E'];
                                $input_part_no = $value['F'];
                                $input_part_qty = empty($value['G']) ? "" : (!is_numeric($value['G']) ? $invalidQty = "Invalid Input Part Qty ," : trim($value['G']));
                                $input_op_name = $value['H'];
                                $input_op_desc = $value['I'];
                                
                                if(!empty($errorThisRow)) {
                                    $error = $error."<br>Row Number ".$rowNum." - Required Fields : ".$errorThisRow;
                                }

                                if (!empty($invalidQty)) {
                                    $error = $error . "<br>Row Number " . $rowNum . " - Invalid Qty : " . $invalidQty;
                                }

                                
                                $inserdata[$i]['row_no'] = $rowNum;
                                $inserdata[$i]['part_number'] = $part_number;
                                //$inserdata[$i]['part_desc'] = $part_desc;

                                $inserdata[$i]['out_part_type'] = $out_part_type;
                                $inserdata[$i]['out_part_no'] = $out_part_no;
                                $inserdata[$i]['out_part_qty'] = $out_part_qty;

                                $inserdata[$i]['input_part_type'] = $input_part_type;
                                $inserdata[$i]['input_part_no'] = $input_part_no;
                                $inserdata[$i]['input_part_qty'] = $input_part_qty;
                                $inserdata[$i]['input_op_name'] = $input_op_name;
                                $inserdata[$i]['input_op_desc'] = $input_op_desc;
                               
                            }
                          }
                          $i++;
                        }

                        foreach($inserdata as $bom_item) {
                            //echo "<br> bom_item: ".$bom_item['out_part_no'];
                        }

                    
                        if(empty($error)){
                            //there are no errors so lets move ahead with executing the file.
                                    foreach($inserdata as $bom_item) {
                                        $oldtest  = $bom_item['part_number'];
                                        $isOutputPartSame = true;
                                       
                                        if($oldMainPartNumber!=$bom_item['part_number']) {//Get it from DB if it is not same.
                                            $oldMainPartNumber = $bom_item['part_number'];
                                            $main_part = $this->Crud->customQuery("SELECT * FROM customer_part WHERE
                                                    part_number = '" . $bom_item['part_number'] . "'");
                                        }

                                        if(empty($main_part)) {
                                               $partMessage = '<br>Invalid Part details: Please check Column A from row : ' . $bom_item['row_no'];
                                        } else {
                                            $validPart = true;
                                            //main part exists
                                            //check output part details
                                            if($oldOutptPartType!=$bom_item['out_part_type'] ||
                                                    $oldOutptPartNo!=$bom_item['out_part_no']) {
                                                       
                                                $oldOutptPartType = $bom_item['out_part_type'];
                                                $oldOutptPartNo = $bom_item['out_part_no'];

                                                // echo "<br>bom_item['out_part_no']: ".$bom_item['out_part_no'];

                                                $isOutputPartSame = false;
                                                if ('Inhouse' == $bom_item['out_part_type']) {
                                                    $output_part = $this->InhouseParts->getInhousePartByPartNumber($bom_item['out_part_no']);
                                                    $output_part_table_name = 'inhouse_parts';
                                                } else if ('Customer' == $bom_item['out_part_type']) {
                                                    $output_part = $this->Crud->customQuery("SELECT * FROM customer_part WHERE
                                                                 part_number = '" . $bom_item['out_part_no'] . "'");
                                                    $output_part_table_name = 'customer_part';
                                                } else {
                                                    $partMessage = "<br>Invalid Output Part Type, should be 'Inhouse' OR 'Customer' for row : " . $bom_item['row_no'];
                                                }
                                            }

                                            
                                            if (empty($output_part)) {
                                                $partMessage = '<br>Invalid Ouput Part details in Item Part Number(Col F) for row : ' . $bom_item['row_no'];
                                                $validPart = false;
                                            }

                                            if(!empty($bom_item['input_part_type'])) { // input part is not required so need to skip this step.
                                                //check input part details
                                                if($oldInputPartType!=$bom_item['input_part_type'] ||
                                                        $oldInputPartNo!=$bom_item['input_part_no']) {
                                                    $oldInputPartType = $bom_item['input_part_type'];
                                                    $oldInputPartNo = $bom_item['input_part_no'];
                                                    if ('Inhouse' == $bom_item['input_part_type']) {
                                                        $input_part = $this->InhouseParts->getInhousePartByPartNumber($bom_item['input_part_no']);
                                                        $input_part_table_name = 'inhouse_parts';
                                                    } else if ('Child' == $bom_item['input_part_type']) {
                                                        $input_part = $this->Crud->customQuery("SELECT * FROM child_part WHERE part_number = '" . $bom_item['input_part_no'] . "'");
                                                        $input_part_table_name = 'child_part';
                                                    } else {
                                                        $partMessage = "<br>Invalid Input Part Type, should be 'Inhouse' OR 'Child' for row : " . $bom_item['row_no'];
                                                    }
                                                }

                                                if (empty($input_part)) {
                                                    $partMessage = '<br>Invalid Input Part details in Item Part Number(Col I) for row : ' . $bom_item['row_no'];
                                                    $validPart = false;
                                                }
                                            }

                                            //input and outpart is valid so move ahead
                                            // echo ", validPart: ".$validPart;

                                            if($validPart == true) {
                                                    $bom_data = array(
                                                        "customer_part_number" => $bom_item['part_number'],
                                                        "customer_id" => $customer_id,
                                                        "output_part_id" => $output_part[0]->id,
                                                        "output_part_table_name" => $output_part_table_name,
                                                    );
                                                    $bom_result = $this->Crud->get_data_by_id_multiple_condition("operations_bom", $bom_data);
                                                    if($bom_result) {
                                                        $bom_id = $bom_result[0]->id;
                                                    }

                                                    if ($isOutputPartSame == false) { //if it was not already checked then 
                                                        if($bom_result == false) {
                                                            $data = array(
                                                                "customer_part_number" => $bom_item['part_number'],
                                                                "output_part_id" => $output_part[0]->id,
                                                                "output_part_table_name" => $output_part_table_name,
                                                                "customer_id" => $customer_id,
                                                                "scrap_factor" => $bom_item['out_part_qty'],
                                                                "created_id" => $this->user_id,
                                                                "created_date" => $this->current_date,
                                                                "created_time" => $this->current_time,
                                                                "day" => $this->date,
                                                                "month" => $this->month,
                                                                "year" => $this->year
                                                            );

                                                            $bom_id = $this->Crud->insert_data("operations_bom", $data);
                                                            if (!$bom_id) {
                                                                $partMessage = 'Unable to add BOM Operation for row : ' . $bom_item['row_no'];
                                                            }
                                                        }
                                                    }
                                                        
                                                    if(!empty($bom_item['input_part_type'])) { // input part is not required so need to skip this step.
                                                            $inputCheck = array(
                                                                "operations_bom_id" => $bom_id,
                                                                "input_part_id" => $input_part[0]->id,
                                                                "input_part_table_name" => $input_part_table_name
                                                            );
                                                            
                                                            $check = $this->Crud->read_data_where("operations_bom_inputs", $inputCheck);
                                                            if ($check != 0) {
                                                                $isErrorPresent = true;
                                                                $failedCount = empty($failedCount) ? $bom_item['row_no'] : $failedCount . "," . $bom_item['row_no'];                                                        
                                                            }else {
                                                                $input_data = array(
                                                                    "operations_bom_id" => $bom_id,
                                                                    "input_part_id" => $input_part[0]->id,
                                                                    "input_part_table_name" => $input_part_table_name,
                                                                    "qty" => $bom_item['input_part_qty'],
                                                                    "operation_number" => $bom_item['input_op_name'],
                                                                    "operation_description" => $bom_item['input_op_desc'],
                                                                    "created_id" => $this->user_id,
                                                                    "created_date" => $this->current_date,
                                                                    "created_time" => $this->current_time,
                                                                    "day" => $this->date,
                                                                    "month" => $this->month,
                                                                    "year" => $this->year
                                                                );

                                                                $input_result = $this->Crud->insert_data("operations_bom_inputs", $input_data);
                                                                if (!$input_result) {
                                                                    $partMessage = 'Unable to add BOM Operation for input part for row : ' . $bom_item['row_no'];
                                                                }else{
                                                                    $successCount = empty($successCount) ? $bom_item['row_no'] : $successCount.",".$bom_item['row_no'];
                                                                }
                                                            }
                                                    }
                                            }
                                        }
                                        if (!empty($partMessage)) {
                                            $error = $error . $partMessage;
                                        }
                                    }
                                }
                        
                            if($error || $isErrorPresent){
                                if(!empty($failedCount)){
                                    $error = $error . "<br> Input Part already exists for rows : " . $failedCount;
                                }
                                if (!empty($successCount)) {
                                    $error = $error . "<br> Successfully added records for rows :" . $successCount;
                                }
                                $messages = $error;
                                // $this->addErrorMessage($error);
                            }else{
                                $messages = "Data imported successfully.";
                                $success = 1;
                                // $this->addSuccessMessage("Data imported successfully.");
                            }

                    } catch (Exception $e) {
                        $messages = 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME). '": ' .$e->getMessage();
                        // die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME). '": ' .$e->getMessage());
                    }
                
                }
                //for view pages
                $data['customers'] = $this->Crud->read_data("customer");              
            }
            $result = [];
            $result['messages'] = $messages;
            $result['success'] = $success;
            echo json_encode($result);
            exit();
            // $this->getPage('customer_master',$data);
    
    }
     /**
     * Export parts stock
     */
    function export_parts_stock() {
        $expType = $this->uri->segment('2');
        $this->load->library("excel");
        $clientId = $this->Unit->getSessionClientId();
        $unitName = $this->Unit->getSessionClientUnitName();
        
        $object = new PHPExcel();
        $object->setActiveSheetIndex(0);
        $sheet = $object->getActiveSheet();

        $headingsStyle = array(
            'font' => array('bold' => true),
            'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'cce6ff')), 
        );
        $sheet->getStyle('A1:C1')->applyFromArray($headingsStyle);

        $headingsStyle1 = array(
            'font' => array('bold' => true),
            'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID, 'startcolor' => array('rgb' => 'F9C40E')), 
        );
        
        if($expType != 'customer') {
            $table_columns = array("Part Number", "Part Description", "UOM", "Rate", "Stock");
            $sheet->getStyle('D1:E1')->applyFromArray($headingsStyle1);
            $sheet->getStyle('D:D')->applyFromArray($headingsStyle1);
            $sheet->getStyle('E:E')->applyFromArray($headingsStyle1);

        } else {
            $table_columns = array("Part Number", "Part Description", "Rate", "Stock");
            $sheet->getStyle('C1:D1')->applyFromArray($headingsStyle1);
            $sheet->getStyle('C:C')->applyFromArray($headingsStyle1);
            $sheet->getStyle('D:D')->applyFromArray($headingsStyle1);
        }

        $column = 0;
        foreach ($table_columns as $field) {
            $object->getActiveSheet()->setCellValueByColumnAndRow($column, 1, $field);
            $column++;
        }
        
        $sheet->fromArray([$headings], NULL, 'A1');
    
        switch ($expType){
            case 'supplier':
                    $sheet->setTitle('SupplierParts');
                    $select_sql="SELECT cp.part_number,cp.part_description, u.uom_name, cp.store_stock_rate as rate, cps.stock
                        FROM child_part cp
                        LEFT JOIN child_part_stock cps ON cp.id = cps.childPartId
                        INNER JOIN uom u ON cp.uom_id = u.id
                        AND cps.clientId = " . $clientId;
                    $fileName="Supplier_Parts_".$unitName.".xls";
                    break;
            case 'customer':
                    $sheet->setTitle('CustomerParts');
                    $select_sql = "SELECT cpm.part_number,cpm.part_description, cpm.fg_rate as rate, cpms.fg_stock as stock
                        FROM customer_parts_master cpm
                        LEFT JOIN customer_parts_master_stock cpms ON cpm.id = cpms.customer_parts_master_id
                        AND cpms.clientId = " . $clientId;
                    $fileName = "Customer_Parts_" . $unitName . ".xls";
                    break;
            case 'inhouse':
                    $sheet->setTitle('InhouseParts');
                    $select_sql = "SELECT ip.part_number,ip.part_description, u.uom_name, ip.store_stock_rate as rate, ips.production_qty as stock
                        FROM inhouse_parts ip
                        LEFT JOIN inhouse_parts_stock ips ON ip.id = ips.inhouse_parts_id
                        INNER JOIN uom u ON ip.uom_id = u.id
                        AND ips.clientId = " . $clientId;
                    $fileName = "Inhouse_Parts_" . $unitName . ".xls";
                    break;
        }

        $customer_parts = $this->Crud->customQuery($select_sql);
        
        if ($customer_parts) {
            $excel_row = 2;
            $rowNo = 1;
            
            foreach ($customer_parts as $p) {
                $colNo = 0;
                $object->getActiveSheet()->setCellValueByColumnAndRow($colNo++, $excel_row, $p->part_number);
                $object->getActiveSheet()->setCellValueByColumnAndRow($colNo++, $excel_row, $p->part_description);
                if($expType != 'customer'){
                    $object->getActiveSheet()->setCellValueByColumnAndRow($colNo++, $excel_row, $p->uom_name);
                }
                $object->getActiveSheet()->setCellValueByColumnAndRow($colNo++, $excel_row, $p->rate);
                $object->getActiveSheet()->setCellValueByColumnAndRow($colNo++, $excel_row, $p->stock);
                $excel_row++;
                $rowNo++;
            }

            for ($i = 'A'; $i !=  $object->getActiveSheet()->getHighestColumn(); $i++) {
                $object->getActiveSheet()->getColumnDimension($i)->setAutoSize(true);
            }

            
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename='.$fileName);
            header('Cache-Control: max-age=0');
            $objWriter = PHPExcel_IOFactory::createWriter($object, 'Excel5');
            ob_end_clean();
            ob_start();
            $objWriter->save('php://output');
        } else {
            // echo "<script>alert('No Child Part Found');document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
        }
    }


    /**
     *  Import parts stock
     */
    public function import_parts_stock(){
       $uploadedDoc = $this->input->post('uploadedDoc');
       $importType = $this->uri->segment('2');
       $clientId = $this->Unit->getSessionClientId();
       
       //only valid types are allowed.
       $messages = "Something went wron.";
       $success = 0;
       if($this->isValidUploadFileType()=="false"){
            $messages = "Only Excel sheets are allowed.";
            // $this->addErrorMessage("Only Excel sheets are allowed.");
       } else {
        if (!empty($_FILES["uploadedDoc"]["name"])) {
                $error;
                $inputFileName = $_FILES["uploadedDoc"]["tmp_name"];
                    try {
                        $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                        $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                        $objPHPExcel = $objReader->load($inputFileName);
                        $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
                        $flag = true;
                        $i=1;

                        $EXCEL_IMPORT_ITEM_COLUMN = 'A';
                        $EXCEL_IMPORT_ITEM_DESC_COLUMN = 'B';
                        if($importType != 'customer'){
                            $EXCEL_IMPORT_STOCK_RATE_COLUMN = 'D';
                            $EXCEL_IMPORT_STOCK_COLUMN = 'E';
                        }else{
                            $EXCEL_IMPORT_STOCK_RATE_COLUMN = 'C';
                            $EXCEL_IMPORT_STOCK_COLUMN = 'D';
                        }
                      
                        foreach ($allDataInSheet as $value) {
                            // Check if the row is empty
                                if (!empty(array_filter($value))) {
                                if($flag) {
                                    $flag =false;
                                    continue;
                                }

                                $rowNum = $i+1;
                                $errorThisRow=null; 
                                $errorCount;

                                $part_no = empty($value[$EXCEL_IMPORT_ITEM_COLUMN]) ? $errorThisRow = $errorThisRow." Part Number required," : trim($value[$EXCEL_IMPORT_ITEM_COLUMN]);
                                $part_description = empty($value[$EXCEL_IMPORT_ITEM_DESC_COLUMN]) ? $errorThisRow = $errorThisRow." Part Description required,": trim($value[$EXCEL_IMPORT_ITEM_DESC_COLUMN]);
                                
                                if(!is_numeric(trim($value[$EXCEL_IMPORT_STOCK_RATE_COLUMN]))){
                                    $errorThisRow = $errorThisRow." Invalid value for rate ,";
                                }else if(trim($value[$EXCEL_IMPORT_STOCK_RATE_COLUMN]) < 0){
                                    $errorThisRow = $errorThisRow."Rate should be greater than or equal to 0";
                                }else {
                                    $part_stock_rate = trim($value[$EXCEL_IMPORT_STOCK_RATE_COLUMN]);
                                }

                                if (!is_numeric(trim($value[$EXCEL_IMPORT_STOCK_COLUMN]))) {
                                    $errorThisRow = $errorThisRow . " Invalid value for rate ,";
                                } else if (trim($value[$EXCEL_IMPORT_STOCK_COLUMN]) < 0) {
                                    $errorThisRow = $errorThisRow . "Stock should be greater than or equal to 0";
                                } else {
                                    $part_stock = trim($value[$EXCEL_IMPORT_STOCK_COLUMN]);
                                }


                                if(!empty($errorThisRow)){
                                    $error = $error."<br>Row No: ".$rowNum." - ".$errorThisRow;
                                }
                                
                                $inserdata[$i]['part_no'] = $part_no;
                                $inserdata[$i]['row_no'] = $rowNum;
                                $inserdata[$i]['part_stock_rate'] = $part_stock_rate;
                                $inserdata[$i]['part_stock'] = $part_stock;
                                $i++;
                            }
                        }

                        
                        if(empty($error)){
                            //there are no errors so lets move ahead with executing the file.
                            foreach($inserdata as $po_item) {

                                switch ($importType){
                                    case 'supplier':
                                                $this->load->model('SupplierParts');
                                                $result = $this->SupplierParts->updateImportedStockDetails($clientId, $po_item['part_no'], $po_item['part_stock_rate'], $po_item['part_stock']);
                                                break;
                                    case 'customer':
                                                $this->load->model('CustomerPart');
                                                $result = $this->CustomerPart->updateImportedStockDetails($clientId, $po_item['part_no'], $po_item['part_stock_rate'], $po_item['part_stock']);
                                                break;
                                    case 'inhouse':
                                                $this->load->model('InhouseParts');
                                                $result = $this->InhouseParts->updateImportedStockDetails($clientId, $po_item['part_no'], $po_item['part_stock_rate'], $po_item['part_stock']);
                                                break;
                                }
                                        
                                if($result === false){
                                    $partMessage = $po_item['row_no'].",";
                                    $error = $error.$partMessage;
                                }
                            }

                            if($error){
                                $messages = $error;
                                // $this->addErrorMessage("Check Part No exists or record data already exists for row nos: ".$error);
                            }else{
                                $messages = "Data imported successfully.";
                                $success = 1;
                                // $this->addSuccessMessage("Data imported successfully.");
                            }

                        } else {
                            $messages = $error."<br>Please correct the data and import again.";
                            // $this->addErrorMessage($error);
                        }   

                    } catch (Exception $e) {
                    //     die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    // . '": ' .$e->getMessage());
                        $messages = 'Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                    . '": ' .$e->getMessage();
                    }
                
                }
            }
            $result = [];
            $result['messages'] = $messages;
            $result['success'] = $success;
            echo json_encode($result);
            exit();
           // $this->redirectToParent();
    }
    

}
