<?php if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
require_once 'CommonController.php';
#require_once APPPATH . 'libraries/PHPExcel/IOFactory.php';

class TallyExportController extends CommonController
{

    const VIEW_PATH = "sales/";

    public function __construct()
    {
        parent::__construct();
    }

    private function getViewPath()
    {
        return self::VIEW_PATH;
    }

    private function getPage($viewPage, $viewData)
    {
        $this->getHeaderPage();
        $this->load->view($this->getViewPath() . $viewPage, $viewData);
        $this->load->view('footer.php');
    }

    public function sales_report()
    {
		checkGroupAccess("sales_report","list","Yes");
        if (isset($_POST['export'])) {
			$success = 0;
	        $message = '';
            $searchYear = $this->input->post('search_year');
            $searchMonth = $this->input->post('search_month');
            $sales_ids = $this->input->post('sale_numbers');

            $where_condition = "AND sales.clientId = " . $this->Unit->getSessionClientId() . "  ";
            if (!empty($searchYear)) {
                $where_condition = $where_condition . "
					AND ((sales.created_year = " . $searchYear . " AND sales.created_month >= 4)
					OR
					(sales.created_year = " . ($searchYear + 1) . " AND sales.created_month <= 3)) ";
            }

            if (empty($sales_ids) && !empty($searchMonth)) {
                $where_condition = $where_condition . " AND sales.created_month = " . $searchMonth . " ";
            }

            if (!empty($sales_ids)) {
                if (strpos($sales_ids, '-') !== false) { //range selection
                    //echo "<br>range selection";
                    $serial_range = explode("-", $sales_ids);
                    $saleNo_condition = " AND sales.actualSalesNo between " . $serial_range[0] . " AND " . $serial_range[1];
                } else if (strpos($sales_ids, ',') !== false) { //specific search
                    //echo "<br>list search";
                    $serial_list = explode("-", $sales_ids);
                    $saleNo_condition = " AND sales.actualSalesNo in ( " . $sales_ids . " )";
                    /*foreach($serial_list as $list){
                    $list_in = $list.",";
                    }*/
                    //$where_condition = $where_condition.$list_in.")";
                } else if (strpos($sales_ids, '-') !== false && strpos($sales_ids, ',') !== false) {
					$message = "Incorrect sales number criteria. Can't have both list and range.";
					// echo "<script>alert('Incorrect sales number criteria. Can't have both list and range.');</script>";
					// exit();

                } else { //individual sales no
                    $saleNo_condition = " AND sales.actualSalesNo = " . $sales_ids;
                }
            }

            //combine all the conditions
            $where_condition = $where_condition . $saleNo_condition;

            $xmlstr = "<ENVELOPE xmlns:UDF='TallyUDF'></ENVELOPE>";
            // optionally you can specify a xml-stylesheet for presenting the results. just uncoment the following line and change the stylesheet name.
            /* "<?xml-stylesheet type='text/xsl' href='xml_style.xsl' ?>\n". */
            $xml = new SimpleXMLElement($xmlstr);
            // Add the HEADER section
            $header = $xml->addChild('HEADER');

            $header->addChild('TALLYREQUEST', 'Export Data');
            //$header->addChild('TYPE', 'Data');
            //$header->addChild('ID', 'YourID'); // Replace with your ID

            // Add the BODY section
            $body = $xml->addChild('BODY');
            $data = $body->addChild('EXPORTDATA');
            $data1 = $data->addChild('REQUESTDESC');
            $data1->addChild('REPORTNAME', 'Vouchers');
            $data2 = $data1->addChild("STATICVARIABLES");
            $data2->addChild('SVCURRENTCOMPANY', "TESTING"); //$this->getCustomerNameDetails()
            $request = $data->addChild('REQUESTDATA');

            $sales_details = $this->Crud->customQuery('SELECT parts.sales_id, parts.sales_number, sales.created_date, customer_name, payment_terms,
			ROUND(sum(total_rate),2) as Total, ROUND(sum(cgst_amount),2) as CGST_AMT, ROUND(sum(sgst_amount),2) as SGST_AMT,
			ROUND(sum(igst_amount),2) as IGST_AMT ,ROUND(sum(tcs_amount),2) as TCS_AMT, ROUND(sum(gst_amount),2) as GST_AMT,
			tax.cgst, tax.sgst, tax.igst, tax.tcs, tax.tcs_on_tax, sales.status,sales.discount_amount,sales.discount, 
            sc.category_name as tally_category
            FROM  sales_parts as parts, gst_structure tax, customer, new_sales as sales
            LEFT JOIN sales_category as sc ON sc.sales_category_id = sales.tally_category
            WHERE sales.status in ("lock")
			AND parts.sales_id =  sales.id
			AND parts.tax_id = tax.id
			AND customer.id = parts.customer_id ' .
                $where_condition .
                ' GROUP BY parts.sales_id '
            );
			// pr($this->db->last_query(),1);

			if(empty($sales_details)){
				$message = "No records found for this export criteria.";
            }
            if ($sales_details) {
                foreach ($sales_details as $sale_details) {
                    $this->requestSalesXML($request, $sale_details);
                }
            }

			if($message != ""){

				$return_arr = array(
			        'message' => $message,
			        'success' => 0
			    );

			    echo json_encode($return_arr);
			    exit();
			}
            // Set the Content-Type header to specify XML
            //header('Content-Type: text/xml');

            // Convert the XML to a string
            //$xmlString = $xml->asXML();
            // Remove the XML declaration manually

            $dom = dom_import_simplexml($xml)->ownerDocument;
            // Format the output with indentation and newlines
            $dom->preserveWhiteSpace = false;
            $dom->formatOutput = true;
            //$dom->loadXML($dom->saveXML(), LIBXML_NOXMLDECL);
            $xmlString = $dom->saveXML();
            $xmlStringWithoutDeclaration = preg_replace('/<\?xml version="1.0"\?>/', '', $xmlString);

			$filename = $filename = 'dist/uploads/sales_export_tally/tally_sales_'.date(d_m_Y).'.xml';

			file_put_contents($filename, $xmlStringWithoutDeclaration);
			
			$return_arr = array(
			        'pdf_utl' => $this->config->item("base_url").$filename,
			        'message' => "Export successfully.",
			        'pdf_url_file' => 'tally_sales_'.date(d_m_Y).'.xml',
			        'success' => 1
			);

			echo json_encode($return_arr);
			exit();
            // Output the XML
            //echo $xml->asXML();
            // Define the file path where you want to save the XML
            //echo "XML file has been saved as $filename";
            exit();
		}else{

		$created_month  = $this->input->post("created_month");
		$created_year  = $this->input->post("created_year");

		if (empty($created_year)) {
			$created_year = $this->year;
		}
		if (empty($created_month)) {
			$created_month = $this->month;
		}

		$data['created_year'] = $created_year;
		$data['created_month'] = $created_month;
		$data['fincYears'] = $this->Common_admin_model->getFinancialYears();
		for ($i = 1; $i <= 12; $i++) {
			$data['month_data'][$i] = $this->Common_admin_model->get_month($i);
			$data['month_number'][$i] = $this->Common_admin_model->get_month_number($data['month_data'][$i]);
		}
		
		$column[] = [
            "data" => "customer_name",
            "title" => "CUSTOMER NAME",
            "width" => "14%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "po_number",
            "title" => "Customer PO No",
            "width" => "16%",
            "className" => "dt-left",
        ];
        $column[] = [
            "data" => "salesNumber",
            "title" => "SALES INV NO",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "sales_date",
            "title" => "SALES INV DATE",
            "width" => "10%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "status",
            "title" => "SALES STATUS",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "part_number",
            "title" => "PART NO",
            "width" => "17%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "part_description",
            "title" => "PART NAME",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "hsn_code",
            "title" => "HSN",
            "width" => "7%",
            "className" => "dt-center status-row",
        ];
        $column[] = [
            "data" => "qty",
            "title" => "QTY",
            "width" => "17%",
            "className" => "dt-center",
        ];
       
        $column[] = [
            "data" => "uom_id",
            "title" => "UOM",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "rate",
            "title" => "Part Price",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "sales_discount",
            "title" => "Discount",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "subtotal",
            "title" => "Taxable Amount",
            "width" => "7%",
            "className" => "dt-center",
            'orderable' => false
        ];
        
        $column[] = [
            "data" => "sgst_amount",
            "title" => "SGST",
            "width" => "7%",
            "className" => "dt-center",
        ];
        $column[] = [
            "data" => "cgst_amount",
            "title" => "CGST",
            "width" => "7%",
            "className" => "dt-center",
        ];
		$column[] = [
            "data" => "igst_amount",
            "title" => "IGST",
            "width" => "7%",
            "className" => "dt-center",
        ];
		
		$column[] = [
            "data" => "tcs_amount",
            "title" => "TCS",
            "width" => "7%",
            "className" => "dt-center",
        ];
		$column[] = [
            "data" => "gst_amount",
            "title" => "TOTAL GST",
            "width" => "7%",
            "className" => "dt-center",
        ];
		$column[] = [
            "data" => "row_total",
            "title" => "TOTAL WITH GS",
            "width" => "7%",
            "className" => "dt-center",
        ];
		
		$date_filter = date("Y/m/01") ." - ". date("Y/m/d");
        $date_filter =  explode((" - "),$date_filter);
        $data['start_date'] = $date_filter[0];
        $data['end_date'] = $date_filter[1];
        $data["data"] = $column;
        $data["is_searching_enable"] = true;
        $data["is_paging_enable"] = true;
        $data["is_serverSide"] = true;
        $data["is_ordering"] = true;
        $data["is_heading_color"] = "#a18f72";
        $data["no_data_message"] =
            '<div class="p-3 no-data-found-block"><img class="p-2" src="' .
            base_url() .
            'public/assets/images/images/no_data_found_new.png" height="150" width="150"><br> No Employee data found..!</div>';
        $data["is_top_searching_enable"] = true;
        $data["sorting_column"] = json_encode([[2, 'desc']]);
        $data["page_length_arr"] = [[10,50,100,200,500,1000,2500], [10,50,100,200,500,1000,2500]];
        $data["admin_url"] = base_url();
        $data["base_url"] = base_url();
		$this->loadView('reports/sales_reports', $data);
		}
	}
	
    
    
    // Function to add sales data request
    public function requestSalesXML($data, $sales_details)
    {

		$isWithInventory = false;
		$isSalesExportWithInventory = $this->GlobalConfig->readConfiguration("isSalesExportWithInventory", "No");
		if (strcasecmp($isSalesExportWithInventory, "Yes") == 0) {
			$isWithInventory = true;
		}
		

        $isCreate = true;
        if ($sales_details->status == 'Cancelled') {
            $isCreate = false;
        }
        $voucher = $data->addChild('TALLYMESSAGE');
        // Encode special characters
        $customer_name = htmlspecialchars($sales_details->customer_name, ENT_XML1 | ENT_COMPAT, 'UTF-8');

        //$customer_name  = $sales_details->customer_name;
        $sales_number = $sales_details->sales_number;

		// Create a DateTime object using the input date and the specified format
        $dateTimeObject = DateTime::createFromFormat('d/m/Y', $sales_details->created_date);
        // Format the DateTime object to the desired output format "Ymd"
        $sales_date = $dateTimeObject->format('Ymd');

        //Get GUID and RANDOMID :
        $guid = str_replace("-", "0", $sales_number);
        $guid = str_replace("/", "0", $guid);

        $voucher_child = $voucher->addChild('VOUCHER');
        $voucher_child->addAttribute('REMOTEID', $guid); //Fixed pattern - with sales number etc as this can be used for cancel too.
        $voucher_child->addAttribute('VCHTYPE', 'Sales'); //Hard-Coded
        if ($isWithInventory) {
			if($isCreate){
				$voucher_child->addAttribute('ACTION', 'Create');
			}
			$voucher_child->addAttribute('OBJVIEW', 'Invoice Voucher View'); //Hard-Coded
	    }

        if ($isWithInventory && $isCreate) {

            //get the address details
            $addressDetails = $this->Crud->customQuery("SELECT 
                            CASE 
                                WHEN sales.shipping_addressType = 'customer' THEN cust.shifting_address
                                WHEN sales.shipping_addressType = 'consignee' THEN adm.address
                            END AS shippingAddress,
                            CASE 
                                WHEN sales.shipping_addressType = 'customer' THEN cust.customer_name
                                WHEN sales.shipping_addressType = 'consignee' THEN cons.consignee_name
                            END AS consigneeName,
                            CASE 
                                WHEN sales.shipping_addressType = 'customer' THEN cust.state
                                WHEN sales.shipping_addressType = 'consignee' THEN adm.state
                            END AS consignee_state,
                            CASE 
                                WHEN sales.shipping_addressType = 'customer' THEN cust.gst_number
                                WHEN sales.shipping_addressType = 'consignee' THEN cons.gst_number
                            END AS consignee_gst_number,
                            cust.billing_address as billing_address,
                            cust.state as billing_state,
                            cust.pan_no as cust_pan_no,
                            cust.gst_number as billing_GSTIN
                        FROM 
                            new_sales sales
                        INNER JOIN 
                            customer cust ON cust.id = sales.customer_id
                        LEFT JOIN 
                            consignee cons ON cons.id = sales.consignee_id
                        LEFT JOIN 
                            address_master adm ON adm.id = cons.address_id
                        WHERE 
                            sales.id = ".$sales_details->sales_id);

            if ($sales_details) {
               $shippingAddress = $addressDetails[0]->shippingAddress;
               $billingAddress = $addressDetails[0]->billing_address;
               $billing_GSTIN = $addressDetails[0]->billing_GSTIN;
               $billing_state = $addressDetails[0]->billing_state;
               $customer_pan_no = $addressDetails[0]->cust_pan_no;
               $consigneeName = $addressDetails[0]->consigneeName;
               $consignee_state = $addressDetails[0]->consignee_state;
               $consignee_gst_number = $addressDetails[0]->consignee_gst_number;
            }

            //client data 
            $client = $this->Unit->getClientUnitDetails();
            
            $addr_type = $voucher_child->addChild('ADDRESS.LIST'); //bill to address
            $addr_type->addAttribute('TYPE', 'String'); //Hard-Coded
            $addr_type->addChild('ADDRESS',$billingAddress);

            $basicbuyaddr_type = $voucher_child->addChild('BASICBUYERADDRESS.LIST');//ship to address
            $basicbuyaddr_type->addAttribute('TYPE', 'String'); //Hard-Coded
            $basicbuyaddr_type->addChild('BASICBUYERADDRESS', $shippingAddress);

            /** <BASICORDERTERMS.LIST TYPE="String">
             *  <BASICORDERTERMS>By Road</BASICORDERTERMS>
             *  </BASICORDERTERMS.LIST> */

            $voucher_child->addChild('DATE', $sales_date);
			$voucher_child->addChild('VCHSTATUSDATE', $sales_date);		
			$voucher_child->addChild('GUID', $guid);

            $voucher_child->addChild('GSTREGISTRATIONTYPE', 'Regular'); //Hard-Coded ?
            $voucher_child->addChild('VATDEALERTYPE', 'Regular'); //Hard-Coded ?
            $voucher_child->addChild('STATENAME', $billing_state); //TO-DO		- Customer state ?
            $voucher_child->addChild('ENTEREDBY', 'admin'); //TO-DO
			$voucher_child->addChild('COUNTRYOFRESIDENCE', 'India'); //TO-DO	
            $voucher_child->addChild('PARTYGSTIN', $billing_GSTIN);
			$voucher_child->addChild('PLACEOFSUPPLY', $billing_state); //TO-DO		- Customer state ?
			$voucher_child->addChild('PARTYNAME', $customer_name);
            
			$gst_registration = $voucher_child->addChild('GSTREGISTRATION',$client[0]->state); //TO-DO
			$gst_registration->addAttribute('TAXTYPE', 'GST');
			$gst_registration->addAttribute('TAXREGISTRATION', $client[0]->gst_number);
            $voucher_child->addChild('CMPGSTIN', $client[0]->gst_number);

			$voucher_child->addChild('VOUCHERTYPENAME', 'Sales'); //Hard coded
			$voucher_child->addChild('PARTYLEDGERNAME', $customer_name);

			$voucher_child->addChild('VOUCHERNUMBER', $sales_details->sales_number); 
            $voucher_child->addChild('BASICBUYERNAME',$consigneeName); //ship to buyer name
            $voucher_child->addChild('CMPGSTREGISTRATIONTYPE', 'Regular'); 
            $voucher_child->addChild('PARTYMAILINGNAME', $customer_name); 
            $voucher_child->addChild('CONSIGNEEGSTIN', $consignee_gst_number);
            $voucher_child->addChild('CONSIGNEEMAILINGNAME', $consigneeName);
            $voucher_child->addChild('CONSIGNEESTATENAME',$consignee_state);
            $voucher_child->addChild('CMPGSTSTATE', 'Maharashtra'); //TO-DO
            $voucher_child->addChild('CONSIGNEECOUNTRYNAME', 'India'); //TO-DO
            $voucher_child->addChild('BASICBASEPARTYNAME', $consigneeName);
            $voucher_child->addChild('NUMBERINGSTYLE', 'Auto Retain1'); //Hard Coded
            $voucher_child->addChild('CSTFORMISSUETYPE', 'Not Applicable'); //Hard Coded
            $voucher_child->addChild('CSTFORMRECVTYPE', 'Not Applicable'); //Hard Coded

            $voucher_child->addChild('FBTPAYMENTTYPE', 'Default'); //Hard Coded
            $voucher_child->addChild('PERSISTEDVIEW', 'Invoice Voucher View'); //Hard Coded
            $voucher_child->addChild('VCHSTATUSTAXADJUSTMENT', 'Default'); //Hard Coded
            $voucher_child->addChild('VCHSTATUSVOUCHERTYPE', 'Sales'); //Hard Coded
            $voucher_child->addChild('VCHSTATUSTAXUNIT', $billing_state); //TO-DO Maharashtra Registration
            $voucher_child->addChild('VCHGSTCLASS', 'Not Applicable'); //Hard Coded
            $voucher_child->addChild('CONSIGNEEPINNUMBER', $customer_pan_no); //TO-DO CUSTOMER PAN NO 
            $voucher_child->addChild('VCHENTRYMODE', 'Item Invoice'); //Hard Coded	
            $voucher_child->addChild('EFFECTIVEDATE', $sales_date); 
            $voucher_child->addChild('DIFFACTUALQTY', 'No'); // Hard Coded
            $voucher_child->addChild('ISMSTFROMSYNC', 'No'); // Hard Coded

            $voucher_child->addChild('HASDISCOUNTS', ($sales_details->discount_amount >0) ? 'Yes' :'No');

            $this->vocher_inventory_default_fields($voucher_child);
        }else{
			$voucher_child->addChild('ISOPTIONAL', 'No');
			$voucher_child->addChild('USEFORGAINLOSS', 'No');
			$voucher_child->addChild('USEFORCOMPOUND', 'No');
			$voucher_child->addChild('VOUCHERTYPENAME', 'Sales');
			$voucher_child->addChild('DATE', $sales_date);
			$voucher_child->addChild('EFFECTIVEDATE', $sales_date);

			$voucher_child->addChild('USETRACKINGNUMBER', 'No');
			$voucher_child->addChild('ISPOSTDATED', 'No');
			$voucher_child->addChild('ISINVOICE', 'No');

		}
        

        if ($isCreate == true) {
            //There would be multiple entries here for INVENTORYENTRIES
                $inventory_details = $this->Crud->customQuery("select cp.part_number, part.uom_id, part.hsn_code, part.qty, part.part_price,
												(part.total_rate - part.gst_amount) as part_amount, discounted_amount,
												part.sales_number, part.tax_id, part.total_rate as Total, part.basic_total ,part.cgst_amount, part.sgst_amount, part.igst_amount, 
												part.tcs_amount, part.gst_amount, tax.cgst, tax.sgst, tax.igst, tax.tcs, tax.tcs_on_tax
												FROM sales_parts part
												INNER JOIN customer_part cp ON cp.id = part.part_id
												INNER JOIN gst_structure tax ON tax.id = part.tax_id
												WHERE part.sales_id = " . $sales_details->sales_id);

			//vocher without inventory details
            if (!$isWithInventory) {			
				$voucher_child->addAttribute('ACTION', 'Create'); //Hard Coded
				$voucher_child->addChild('ISCANCELLED', 'No'); //Hard Coded
				$voucher_child->addChild('DIFFACTUALQTY', 'Yes'); //Hard Coded
				$voucher_child->addChild('VOUCHERNUMBER', $sales_details->sales_number);
				$voucher_child->addChild('REFERENCE', $sales_details->sales_number);
				$voucher_child->addChild('PARTYLEDGERNAME', $customer_name);
				$voucher_child->addChild('NARRATION', 'Invoice No. ' . $sales_details->sales_number);
				$voucher_child->addChild('ASPAYSLIP', 'No'); //Hard Coded
				$voucher_child->addChild('GUID', $guid);
				$voucher_child->addChild('ALTERID', '1'); //TO-D0 For isWithInventory ??

				//What is this ? Need TO-DO action
				$haryanavat_list = $voucher_child->addChild('HARYANAVAT.LIST'); //Hard Coded
				$haryanavat_list->addAttribute('DESC', '`HARYANAVAT`'); //Hard Coded

				$this->inoviceExportForCreate($voucher_child, $sales_details,$customer_name, $guid,$isWithInventory);

				/*if ($inventory_details) {
					foreach ($inventory_details as $inventory_part) {
						$inventory = $voucher_child->addChild('INVENTORYENTRIES.LIST');
						$inventory->addChild('STOCKITEMNAME', $inventory_part->part_number); 
						$inventory->addChild('ISDEEMEDPOSITIVE', 'No'); //Hard Coded
						$inventory->addChild('RATE', $inventory_part->part_price);
						$inventory->addChild('DISCOUNT', $sales_details->discount); //DISCOUNT IS IN PERCENTAGE
						$inventory->addChild('AMOUNT', $inventory_part->part_amount);
						$inventory->addChild('ACTUALQTY', $inventory_part->qty);
						$inventory->addChild('BILLEDQTY', $inventory_part->qty);
						$inventory->addChild('UOM', $inventory_part->uom_id);
					}
				}*/
			}else{
				//vocher with inventory details
                if ($inventory_details) {
                    foreach ($inventory_details as $inventory_part) {
                        $inventory = $voucher_child->addChild('ALLINVENTORYENTRIES.LIST');
                        $inventory->addChild('STOCKITEMNAME', $inventory_part->part_number);					
						$inventory->addChild('GSTOVRDNISREVCHARGEAPPL', 'Not Applicable'); //Hard Coded
						$inventory->addChild('GSTOVRDNTAXABILITY', 'Taxable'); //Hard Coded
						$inventory->addChild('GSTSOURCETYPE', 'Stock Item'); //Hard Coded
						$inventory->addChild('GSTITEMSOURCE', $inventory_part->part_number);
						$inventory->addChild('HSNSOURCETYPE', 'Stock Item'); //Hard Coded
						$inventory->addChild('HSNITEMSOURCE', $inventory_part->part_number);
						$inventory->addChild('GSTOVRDNSTOREDNATURE', ''); //Hard Coded

						$inventory->addChild('GSTOVRDNTYPEOFSUPPLY', 'Goods'); //Hard Coded
						$inventory->addChild('GSTRATEINFERAPPLICABILITY', 'As per Masters/Company'); //Hard Coded
						$inventory->addChild('GSTHSNNAME', $inventory_part->hsn_code); //TO-DO
						$inventory->addChild('GSTHSNINFERAPPLICABILITY', 'As per Masters/Company'); //Hard Coded
						$inventory->addChild('ISDEEMEDPOSITIVE', 'No'); //Hard Coded
						$inventory->addChild('ISGSTASSESSABLEVALUEOVERRIDDEN', 'No'); //Hard Coded
						$inventory->addChild('STRDISGSTAPPLICABLE', 'No'); //Hard Coded
						$inventory->addChild('CONTENTNEGISPOS', 'No'); //Hard Coded
						$inventory->addChild('ISLASTDEEMEDPOSITIVE', 'No'); //Hard Coded
						$inventory->addChild('ISAUTONEGATE', 'No'); //Hard Coded
						$inventory->addChild('ISCUSTOMSCLEARANCE', 'No'); //Hard Coded
						$inventory->addChild('ISTRACKCOMPONENT', 'No'); //Hard Coded
						$inventory->addChild('ISTRACKPRODUCTION', 'No'); //Hard Coded
						$inventory->addChild('ISPRIMARYITEM', 'No'); //Hard Coded
						$inventory->addChild('ISSCRAP', 'No'); //Hard Coded


                        $inventory->addChild('RATE', $inventory_part->part_price.'/'.$inventory_part->uom_id);
						$inventory->addChild('AMOUNT', $inventory_part->part_amount);
						$inventory->addChild('DISCOUNT', $sales_details->discount); //DISCOUNT IS IN PERCENTAGE
						$inventory->addChild('ACTUALQTY', $inventory_part->qty.' '.$inventory_part->uom_id);
						$inventory->addChild('BILLEDQTY', $inventory_part->qty.' '.$inventory_part->uom_id);
                        $inventory->addChild('UOM', $inventory_part->uom_id);

						$batchAllocations = $inventory->addChild('BATCHALLOCATIONS.LIST');
						$batchAllocations->addChild('GODOWNNAME', 'Main Location'); //Hard Coded
						$batchAllocations->addChild('BATCHNAME', 'Primary Batch'); //Hard Coded
                        $batchAllocations->addChild('DESTINATIONGODOWNNAME', 'Main Location'); //Hard Coded
						$batchAllocations->addChild('INDENTNO', 'Not Applicable'); //Hard Coded
						$batchAllocations->addChild('ORDERNO', 'Not Applicable'); //Hard Coded
						//$batchAllocations->addChild('TRACKINGNUMBER', 'Not Applicable'); //Hard Coded
						$batchAllocations->addChild('DYNAMICCSTISCLEARED', 'No'); //Hard Coded
						$batchAllocations->addChild('AMOUNT', $inventory_part->part_amount); //Hard Coded
						$batchAllocations->addChild('DISCOUNT', $sales_details->discount); 
						$batchAllocations->addChild('ACTUALQTY', $inventory_part->qty.' '.$inventory_part->uom_id); //Hard Coded
						$batchAllocations->addChild('BILLEDQTY', $inventory_part->qty.' '.$inventory_part->uom_id); //Hard Coded
						$batchAllocations->addChild('ADDITIONALDETAILS.LIST', ''); //Hard Coded
						$batchAllocations->addChild('VOUCHERCOMPONENTLIST.LIST', ''); //Hard Coded


						$acctingAllocations = $inventory->addChild('ACCOUNTINGALLOCATIONS.LIST');
                        $acctingAllocations->addChild('LEDGERNAME', $sales_details->tally_category); //tally category
                        $acctingAllocations->addChild('GSTCLASS', 'Not Applicable'); //Hard Coded
						$acctingAllocations->addChild('ISDEEMEDPOSITIVE', 'No'); //Hard Coded
						$acctingAllocations->addChild('LEDGERFROMITEM', 'No'); //Hard Coded
						$acctingAllocations->addChild('REMOVEZEROENTRIES', 'No'); //Hard Coded
						$acctingAllocations->addChild('ISPARTYLEDGER', 'No'); //Hard Coded
						$acctingAllocations->addChild('GSTOVERRIDDEN', 'No'); //Hard Coded
						$acctingAllocations->addChild('ISGSTASSESSABLEVALUEOVERRIDDEN', 'No'); //Hard Coded
						$acctingAllocations->addChild('STRDISGSTAPPLICABLE', 'No'); //Hard Coded
						$acctingAllocations->addChild('STRDGSTISPARTYLEDGER', 'No'); //Hard Coded
						$acctingAllocations->addChild('STRDGSTISDUTYLEDGER', 'No'); //Hard Coded
						$acctingAllocations->addChild('CONTENTNEGISPOS', 'No'); //Hard Coded
						$acctingAllocations->addChild('ISLASTDEEMEDPOSITIVE', 'No'); //Hard Coded
						$acctingAllocations->addChild('ISCAPVATTAXALTERED', 'No'); //Hard Coded
						$acctingAllocations->addChild('ISCAPVATNOTCLAIMED', 'No'); //Hard Coded
						$acctingAllocations->addChild('AMOUNT', $inventory_part->part_amount);

                        $acctingAllocations->addChild('SERVICETAXDETAILS.LIST');
                        $acctingAllocations->addChild('BANKALLOCATIONS.LIST');
                        $acctingAllocations->addChild('BILLALLOCATIONS.LIST');
                        $acctingAllocations->addChild('INTERESTCOLLECTION.LIST');
                        $acctingAllocations->addChild('OLDAUDITENTRIES.LIST');
                        $acctingAllocations->addChild('ACCOUNTAUDITENTRIES.LIST');
                        $acctingAllocations->addChild('AUDITENTRIES.LIST');
                        $acctingAllocations->addChild('INPUTCRALLOCS.LIST');
                        $acctingAllocations->addChild('DUTYHEADDETAILS.LIST');
                        $acctingAllocations->addChild('EXCISEDUTYHEADDETAILS.LIST');
                        $acctingAllocations->addChild('RATEDETAILS.LIST');
                        $acctingAllocations->addChild('SUMMARYALLOCS.LIST');
                        $acctingAllocations->addChild('CENVATDUTYALLOCATIONS.LIST');
                        $acctingAllocations->addChild('STPYMTDETAILS.LIST');
                        $acctingAllocations->addChild('EXCISEPAYMENTALLOCATIONS.LIST');
                        $acctingAllocations->addChild('TAXBILLALLOCATIONS.LIST');
                        $acctingAllocations->addChild('TAXOBJECTALLOCATIONS.LIST');

                        $acctingAllocations->addChild('TDSEXPENSEALLOCATIONS.LIST');


                        $acctingAllocations->addChild('VATSTATUTORYDETAILS.LIST');
                        $acctingAllocations->addChild('COSTTRACKALLOCATIONS.LIST');
                        $acctingAllocations->addChild('REFVOUCHERDETAILS.LIST');
                        $acctingAllocations->addChild('INVOICEWISEDETAILS.LIST');
                        $acctingAllocations->addChild('VATITCDETAILS.LIST');
                        $acctingAllocations->addChild('ADVANCETAXDETAILS.LIST');
                        $acctingAllocations->addChild('TAXTYPEALLOCATIONS.LIST');


                        $inventory->addChild('DUTYHEADDETAILS.LIST');//Hard Coded

						//RATEDETAILS
						$this->inventoriesExportForCreate($inventory, $inventory_part, $customer_name, $guid,$isWithInventory);
                       
                        $inventory->addChild('SUPPLEMENTARYDUTYHEADDETAILS.LIST');//Hard Coded
                        $inventory->addChild('TAXOBJECTALLOCATIONS.LIST');//Hard Coded
                        $inventory->addChild('REFVOUCHERDETAILS.LIST');//Hard Coded
                        $inventory->addChild('EXCISEALLOCATIONS.LIST');//Hard Coded
                        $inventory->addChild('EXPENSEALLOCATIONS.LIST');//Hard Coded
				    }
                }

				//last part of vocher
				$this->vocher_withInventories_after_inventories_defaults($voucher_child);

				//ledger with Inventories
				$this->ledgerWithInventories($voucher_child,$sales_details,$leger_arr,$customer_name,$inventory_part->part_amount);

				$gst_list = $voucher_child->addChild('GST.LIST');
				$gst_list->addChild('PURPOSETYPE', 'GST'); //Hard Coded
				$stat_gst_list = $gst_list->addChild('STAT.LIST');
				$stat_gst_list->addChild('PURPOSETYPE', 'GST'); //Hard Coded
				$stat_gst_list->addChild('STATKEY', $sales_date.'Invoice'.$sales_number); //Hard Coded
				$stat_gst_list->addChild('ISFETCHEDONLY', 'No'); //Hard Coded
				$stat_gst_list->addChild('ISDELETED', 'No'); //Hard Coded
				$stat_gst_list->addChild('TALLYCONTENTUSER', ''); //Hard Coded
            }

        } else {
            $this->inoviceExportForCancel($voucher_child, $guid);
        }
    }

	private function vocher_withInventories_after_inventories_defaults($voucher_child){
		$voucher_child->addChild('CONTRITRANS.LIST', ''); //Hard Coded
		$voucher_child->addChild('EWAYBILLERRORLIST.LIST', ''); //Hard Coded
		$voucher_child->addChild('IRNERRORLIST.LIST', ''); //Hard Coded
		$voucher_child->addChild('HARYANAVAT.LIST', ''); //Hard Coded
		$voucher_child->addChild('SUPPLEMENTARYDUTYHEADDETAILS.LIST', ''); //Hard Coded
		$voucher_child->addChild('INVOICEDELNOTES.LIST', ''); //Hard Coded
		$voucher_child->addChild('INVOICEORDERLIST.LIST', ''); //Hard Coded
		$voucher_child->addChild('INVOICEINDENTLIST.LIST', ''); //Hard Coded
		$voucher_child->addChild('ATTENDANCEENTRIES.LIST', ''); //Hard Coded
		$voucher_child->addChild('ORIGINVOICEDETAILS.LIST', ''); //Hard Coded
		$voucher_child->addChild('INVOICEEXPORTLIST.LIST', ''); //Hard Coded

	}
    /**
     * Cancel invoice specific fields
     */
    private function inoviceExportForCancel($voucher_child, $guid)
    {
        $voucher_child->addAttribute('ACTION', 'Cancel');
        $voucher_child->addChild('ISCANCELLED', 'Yes');
        $voucher_child->addChild('VOUCHERNUMBER');
        $voucher_child->addChild('REFERENCE');
        $voucher_child->addChild('ASPAYSLIP', 'No');
        $voucher_child->addChild('GUID', $guid);
        $voucher_child->addChild('ALTERID', '1');
        $haryanavat_list = $voucher_child->addChild('HARYANAVAT.LIST');
        $haryanavat_list->addAttribute('DESC', '`HARYANAVAT`');
    }

    /**
     * Create invoice specific fields
     */
    private function inoviceExportForCreate($voucher_child, $sales_details, $customer_name, $guid, $isWithInventory)
    {
        $gst_percntg = $sales_details->cgst + $sales_details->sgst + $sales_details->igst + $sales_details->tcs;
        $gst_all = $sales_details->CGST_AMT + $sales_details->SGST_AMT + $sales_details->IGST_AMT + $sales_details->TCS_AMT;
        $gst_on_amount = ($sales_details->Total - $gst_all);

		$leger_arr = array(
				"Total" => $sales_details->Total + $sales_details->TCS_AMT, // Entire amount
				"SALES GST @ " . $gst_percntg . "%" => $gst_on_amount, //<LEDGERNAME>SALES GST @ 28%</LEDGERNAME>
				"OUTPUT CGST @ " . $sales_details->cgst . "%" => $sales_details->CGST_AMT, //<LEDGERNAME>OUTPUT CGST @ 14%</LEDGERNAME>
				"OUTPUT SGST @ " . $sales_details->sgst . "%" => $sales_details->SGST_AMT, //<LEDGERNAME>OUTPUT SGST @ 14%</LEDGERNAME>
				"OUTPUT TCS @ " . $sales_details->tcs . "%" => $sales_details->TCS_AMT, //<LEDGERNAME>OUTPUT TCS @ 0%</LEDGERNAME>
				"OUTPUT IGST @ " . $sales_details->igst . "%" => $sales_details->IGST_AMT, //<LEDGERNAME>OUTPUT IGST @ 28%</LEDGERNAME>
		);

		//remove those items which are with 0 values.
        foreach ($leger_arr as $key => $value) {
            if ($value < 0.01) {
                unset($leger_arr[$key]);
            }
        }

        //There would be multiple entries here for ALLLEDGERENTRIES
        // Add ledger details for vocher without inventories
		$this->ledger_WithoutInventories($voucher_child, $sales_details, $leger_arr, $customer_name);
    }

	private function ledger_WithoutInventories($voucher_child,$sales_details,$leger_arr,$customer_name) {
	   foreach ($leger_arr as $key => $value) {
            $ledger_entries = $voucher_child->addChild('ALLLEDGERENTRIES.LIST');
            //Hard Coded
            $ledger_entries->addChild('REMOVEZEROENTRIES', 'No');

            //Should be replaced with appr values
            if ($key == "Total") {
                $ledger_entries->addChild('ISDEEMEDPOSITIVE', 'Yes'); // <!-- Specifies whether the ledger entry is positive or negative (e.g., "Yes" for positive). -->
                $ledger_entries->addChild('LEDGERFROMITEM', 'No');
                $ledger_entries->addChild('LEDGERNAME', $customer_name); // Replace with the customer's ledger name
                $ledger_entries->addChild('AMOUNT', "-" . $value);

                $bill_allocations = $ledger_entries->addChild('BILLALLOCATIONS.LIST');
                $bill_allocations->addChild('NAME', $sales_details->sales_number);
                $bill_allocations->addChild('BILLTYPE', $key);
                if (!empty($sales_details->payment_terms)) {
                    $bill_creditperiod = $bill_allocations->addChild('BILLCREDITPERIOD', $sales_details->payment_terms . " Days");
                    $bill_creditperiod->addAttribute('P', $sales_details->payment_terms . " Days");
                }
                $bill_allocations->addChild('AMOUNT', "-" . $value);
            } else {
                $ledger_entries->addChild('ISDEEMEDPOSITIVE', 'No');
                $ledger_entries->addChild('LEDGERFROMITEM', 'No');
                $ledger_entries->addChild('LEDGERNAME', $key); // Replace with the customer's ledger name
                $ledger_entries->addChild('AMOUNT', $value);
            }
        }
	}
	

	private function inventoriesExportForCreate($inventory, $inventory_part, $customer_name, $guid)
    {
		$leger_arr = array(
				"CGST" => $inventory_part->cgst, 
				"SGST/UTGST" => $inventory_part->sgst,
				//"TCS" => $inventory_part->tcs, 
				"IGST" => $inventory_part->igst
			);
	    
		//remove those items which are with 0 values.
        foreach ($leger_arr as $key => $value) {
            if ($value < 0.01) {
                unset($leger_arr[$key]);
            }
        }

        $this->ledger_Inventories($inventory, $leger_arr);
    }


    private function ledger_Inventories($inventory, $leger_arr) {
	   foreach ($leger_arr as $key => $value) {
			$rateDetails = $inventory->addChild('RATEDETAILS.LIST');
			$rateDetails->addChild('GSTRATEDUTYHEAD', $key); 
			$rateDetails->addChild('GSTRATEVALUATIONTYPE', 'Based on Value'); 
			$rateDetails->addChild('GSTRATE', $value);
	     }
         
        $rateDetails = $inventory->addChild('RATEDETAILS.LIST');
		$rateDetails->addChild('GSTRATEDUTYHEAD', 'Cess'); 
		$rateDetails->addChild('GSTRATEVALUATIONTYPE', 'Not Applicable'); 

        $rateDetails = $inventory->addChild('RATEDETAILS.LIST');
        $rateDetails->addChild('GSTRATEDUTYHEAD', 'State Cess');
        $rateDetails->addChild('GSTRATEVALUATIONTYPE', 'Based on Value');
    }

	/**
	 * Vocher with inventories ledger
	 */
	private function ledgerWithInventories($voucher_child,$sales_details,$leger_arr,$customer_name,$inventory_amount) {
		$gst_percntg = $sales_details->cgst + $sales_details->sgst + $sales_details->igst + $sales_details->tcs;
        $gst_all = $sales_details->CGST_AMT + $sales_details->SGST_AMT + $sales_details->IGST_AMT + $sales_details->TCS_AMT;
        $gst_on_amount = ($sales_details->Total - $gst_all);

		$leger_arr = array(
				"Total" => $sales_details->Total + $sales_details->TCS_AMT,
				"CGST"  => $sales_details->CGST_AMT,
				"SGST"  => $sales_details->SGST_AMT,
				"TCS"   => $sales_details->TCS_AMT, 
				"IGST"  => $sales_details->IGST_AMT,
		);

    
       //remove those items which are with 0 values.
        foreach ($leger_arr as $key => $value) {
            if ($value < 0.01) {
                unset($leger_arr[$key]);
            }
        }

        if($sales_details->TCS_AMT > 0.01){
            $tcsAmountPresent = true;
        }

       foreach ($leger_arr as $key => $value) {
            $ledger_entries = $voucher_child->addChild('LEDGERENTRIES.LIST');
            if ($key == "Total") {
                $ledger_entries->addChild('LEDGERNAME', $customer_name); 
				$this->legder_entries_defaults1($ledger_entries);

				$ledger_entries->addChild('AMOUNT', "-" . $value);
				$ledger_entries->addChild('SERVICETAXDETAILS.LIST', ''); //Hard Coded
				$ledger_entries->addChild('BANKALLOCATIONS.LIST', ''); //Hard Coded
              
                $bill_allocations = $ledger_entries->addChild('BILLALLOCATIONS.LIST');
                $bill_allocations->addChild('NAME', $sales_details->sales_number);
                if(!empty($sales_details->payment_terms)){
                    $bill_creditperiod = $bill_allocations->addChild('BILLCREDITPERIOD',$sales_details->payment_terms . " Days");
                    $bill_creditperiod->addAttribute('P', $sales_details->payment_terms . " Days");
                }
                $bill_allocations->addChild('BILLTYPE', 'New Ref');	//New Ref
                $bill_allocations->addChild('TDSDEDUCTEEISSPECIALRATE', 'No');
                $bill_allocations->addChild('AMOUNT', "-" . $value);
                $bill_allocations->addChild('INTERESTCOLLECTION.LIST', ''); //Hard Coded
                $bill_allocations->addChild('STBILLCATEGORIES.LIST', ''); //Hard Coded
                    
                if($tcsAmountPresent == true){
                    $ledger_entries->addChild('OLDAUDITENTRIES.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('ACCOUNTAUDITENTRIES.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('AUDITENTRIES.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('INPUTCRALLOCS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('DUTYHEADDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('EXCISEDUTYHEADDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('RATEDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('SUMMARYALLOCS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('CENVATDUTYALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('STPYMTDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('EXCISEPAYMENTALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('TAXBILLALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('TAXOBJECTALLOCATIONS.LIST', ''); //Hard Coded


                    $tax_obj_allocations = $ledger_entries->addChild('TAXOBJECTALLOCATIONS.LIST');
                    $tax_obj_allocations->addChild('CATEGORY','Sale of Goods');
                    $tax_obj_allocations->addChild('TAXTYPE','TCS');
                    $tax_obj_allocations->addChild('PARTYLEDGER',$customer_name);
                    //$tax_obj_allocations->addChild('EXPENSES','Central GST (CGST)');    //TODO  - WHAT IF THE IGST IS THERE ?
                    $tax_obj_allocations->addChild('REFTYPE','New Ref');
                    $tax_obj_allocations->addChild('ISOPTIONAL','No');
                    $tax_obj_allocations->addChild('ISBASEDONREALIZATION','No');
                    $tax_obj_allocations->addChild('ISPANVALID','No');
                    $tax_obj_allocations->addChild('ZERORATED', 'No');
                    $tax_obj_allocations->addChild('EXEMPTED','No');
                    $tax_obj_allocations->addChild('ISSPECIALRATE','No');
                    $tax_obj_allocations->addChild('ISDEDUCTNOW','No');
                    $tax_obj_allocations->addChild('ISPANNOTAVAILABLE','No');
                    $tax_obj_allocations->addChild('ISSUPPLEMENTARY','No');
                    $tax_obj_allocations->addChild('ISPUREAGENT','No');
                    $tax_obj_allocations->addChild('HASINPUTCREDIT','No');
                    $tax_obj_allocations->addChild('ISTDSDEDUCTED', 'No');

                    $sub_cate_allocations = $tax_obj_allocations->addChild('SUBCATEGORYALLOCATION.LIST');
                    $sub_cate_allocations->addChild('SUBCATEGORY', 'Income Tax');
                    $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                    $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                    $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');

                    $tax_value_for_this = $leger_arr['CGST'] + $leger_arr['SGST']  + $leger_arr['IGST'];
                    $sub_cate_allocations->addChild('ASSESSABLEAMOUNT', $tax_value_for_this);
                    
                    $sub_cate_allocations = $tax_obj_allocations->addChild('SUBCATEGORYALLOCATION.LIST');
                    $sub_cate_allocations->addChild('SUBCATEGORY', 'Surcharge');
                    $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                    $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                    $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');

                    $sub_cate_allocations = $tax_obj_allocations->addChild('SUBCATEGORYALLOCATION.LIST');
                    $sub_cate_allocations->addChild('SUBCATEGORY', 'Education Cess');
                    $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                    $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                    $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');

                    $sub_cate_allocations = $tax_obj_allocations->addChild('SUBCATEGORYALLOCATION.LIST');
                    $sub_cate_allocations->addChild('SUBCATEGORY', 'Secondary Education Cess');
                    $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                    $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                    $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');

                    $ledger_entries->addChild('TDSEXPENSEALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('VATSTATUTORYDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('COSTTRACKALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('REFVOUCHERDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('INVOICEWISEDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('VATITCDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('ADVANCETAXDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('TAXTYPEALLOCATIONS.LIST', ''); //Hard Coded
                }
				//$this->legder_entries_defaults2($ledger_entries);
				                
            } else {
                $ledger_entries->addChild('APPROPRIATEFOR', 'Not Applicable');

                if ($key === "TCS") {
                    $ledger_entries->addChild('ROUNDTYPE', 'Normal Rounding');
                    $ledger_entries->addChild('LEDGERNAME', 'TCS TAX');
                    $ledger_entries->addChild('METHODTYPE', 'TCS');
                    $ledger_entries->addChild('GSTCLASS', 'Not Applicable');
                }else{
                    $ledger_entries->addChild('ROUNDTYPE', 'Not Applicable');
                    $ledger_entries->addChild('LEDGERNAME', $key); // Replace with the customer's ledger name
                    $ledger_entries->addChild('METHODTYPE', 'GST');
                    $ledger_entries->addChild('GSTCLASS', 'Not Applicable');
                }
                    $ledger_entries->addChild('ISDEEMEDPOSITIVE', 'No');
                    $ledger_entries->addChild('LEDGERFROMITEM', 'No');
                    $ledger_entries->addChild('REMOVEZEROENTRIES', 'Yes');
                    $ledger_entries->addChild('ISPARTYLEDGER', 'No');
                    $ledger_entries->addChild('GSTOVERRIDDEN', 'No');
                    $ledger_entries->addChild('ISGSTASSESSABLEVALUEOVERRIDDEN', 'No');
                    $ledger_entries->addChild('STRDISGSTAPPLICABLE', 'No');
                    $ledger_entries->addChild('STRDGSTISPARTYLEDGER', 'No');
                    $ledger_entries->addChild('STRDGSTISDUTYLEDGER', 'No');
                    $ledger_entries->addChild('CONTENTNEGISPOS', 'No');
                    $ledger_entries->addChild('ISLASTDEEMEDPOSITIVE', 'No');
                    $ledger_entries->addChild('ISCAPVATTAXALTERED', 'No');
                    $ledger_entries->addChild('ISCAPVATNOTCLAIMED', 'No');
                    $ledger_entries->addChild('AMOUNT', $value);
                    $ledger_entries->addChild('VATEXPAMOUNT', $value);

                    $ledger_entries->addChild('SERVICETAXDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('BANKALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('BILLALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('INTERESTCOLLECTION.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('OLDAUDITENTRIES.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('ACCOUNTAUDITENTRIES.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('AUDITENTRIES.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('INPUTCRALLOCS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('DUTYHEADDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('EXCISEDUTYHEADDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('RATEDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('SUMMARYALLOCS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('CENVATDUTYALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('STPYMTDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('EXCISEPAYMENTALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('TAXBILLALLOCATIONS.LIST', ''); //Hard Coded

                    $tax_obj_allocations_tcs = $ledger_entries->addChild('TAXOBJECTALLOCATIONS.LIST');

                    if ($key === "TCS") {
                        //tally import category - budhale uses this and other can also use it
                        $tax_obj_allocations_tcs->addChild('CATEGORY', $sales_details->tally_category);
                        $tax_obj_allocations_tcs->addChild('TAXTYPE','TCS');
                        $tax_obj_allocations_tcs->addChild('PARTYLEDGER', $customer_name);
                        $tax_obj_allocations_tcs->addChild('EXPENSES', $sales_details->tally_category);
                        $tax_obj_allocations_tcs->addChild('REFTYPE', 'New Ref');//Hard coded
                        $tax_obj_allocations_tcs->addChild('ISOPTIONAL', 'No');
                        $tax_obj_allocations_tcs->addChild('ISBASEDONREALIZATION', 'No');
                        $tax_obj_allocations_tcs->addChild('ISPANVALID', 'No');
                        $tax_obj_allocations_tcs->addChild('ZERORATED', 'No');
                        $tax_obj_allocations_tcs->addChild('EXEMPTED', 'No');
                        $tax_obj_allocations_tcs->addChild('ISSPECIALRATE','No');
                        $tax_obj_allocations_tcs->addChild('ISDEDUCTNOW', 'No');
                        $tax_obj_allocations_tcs->addChild('ISPANNOTAVAILABLE', 'No');
                        $tax_obj_allocations_tcs->addChild('ISSUPPLEMENTARY', 'No');
                        $tax_obj_allocations_tcs->addChild('ISPUREAGENT', 'No');
                        $tax_obj_allocations_tcs->addChild('HASINPUTCREDIT', 'No');
                        $tax_obj_allocations_tcs->addChild('ISTDSDEDUCTED', 'No');
                        $tax_obj_allocations_tcs->addChild('OLDAUDITENTRIES.LIST');
                        $tax_obj_allocations_tcs->addChild('ACCOUNTAUDITENTRIES.LIST');
                        $tax_obj_allocations_tcs->addChild('AUDITENTRIES.LIST');

                        $sub_cate_allocations = $tax_obj_allocations_tcs->addChild('SUBCATEGORYALLOCATION.LIST');
                        $sub_cate_allocations->addChild('SUBCATEGORY', 'Income Tax');
                        $sub_cate_allocations->addChild('DUTYLEDGER', 'TCS TAX');
                        $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                        $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                        $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');
                    
                        $sub_cate_allocations->addChild('TAXRATE', $sales_details->tcs);//TO-DO : TCS: tax rate should be added
                        $sub_cate_allocations->addChild('ASSESSABLEAMOUNT', $inventory_amount);//TO-DO TOTAL TAXABLE VALUE 
                        $sub_cate_allocations->addChild('TAX', $value); //TCS VALUE

                        $sub_cate_allocations = $tax_obj_allocations_tcs->addChild('SUBCATEGORYALLOCATION.LIST');
                        $sub_cate_allocations->addChild('SUBCATEGORY', 'Surcharge');
                        $sub_cate_allocations->addChild('DUTYLEDGER', 'TCS TAX');
                        $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                        $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                        $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');
                        $sub_cate_allocations->addChild('ASSESSABLEAMOUNT', $value); //TO-DO: TCS: TOTAL TAXABLE VALUE

                        $sub_cate_allocations = $tax_obj_allocations_tcs->addChild('SUBCATEGORYALLOCATION.LIST');
                        $sub_cate_allocations->addChild('SUBCATEGORY', 'Education Cess');
                        $sub_cate_allocations->addChild('DUTYLEDGER', 'TCS TAX');
                        $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                        $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                        $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');
                        $sub_cate_allocations->addChild('ASSESSABLEAMOUNT', $value); //TO-DO: TCS: TOTAL TAXABLE VALUE

                        $sub_cate_allocations = $tax_obj_allocations_tcs->addChild('SUBCATEGORYALLOCATION.LIST');
                        $sub_cate_allocations->addChild('SUBCATEGORY', 'Secondary Education Cess');
                        $sub_cate_allocations->addChild('DUTYLEDGER', 'TCS TAX');
                        $sub_cate_allocations->addChild('SUBCATZERORATED', 'No');
                        $sub_cate_allocations->addChild('SUBCATEXEMPTED', 'No');
                        $sub_cate_allocations->addChild('SUBCATISSPECIALRATE', 'No');
                        $sub_cate_allocations->addChild('ASSESSABLEAMOUNT', $value); //TO-DO: TCS: TOTAL TAXABLE VALUE
                    }

                    $ledger_entries->addChild('TDSEXPENSEALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('VATSTATUTORYDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('COSTTRACKALLOCATIONS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('REFVOUCHERDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('INVOICEWISEDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('VATITCDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('ADVANCETAXDETAILS.LIST', ''); //Hard Coded
                    $ledger_entries->addChild('TAXTYPEALLOCATIONS.LIST', ''); //Hard Coded
                
            }
        }
	}

	private function legder_entries_defaults1($ledger_entries){
			$ledger_entries->addChild('GSTCLASS', 'Not Applicable'); //Hard Coded
			$ledger_entries->addChild('ISDEEMEDPOSITIVE', 'Yes'); // <!-- Specifies whether the ledger entry is positive or negative (e.g., "Yes" for positive). -->
			$ledger_entries->addChild('LEDGERFROMITEM', 'No'); //Hard Coded
			$ledger_entries->addChild('REMOVEZEROENTRIES', 'No'); //Hard Coded
			$ledger_entries->addChild('ISPARTYLEDGER', 'Yes'); //TO-DO
			$ledger_entries->addChild('GSTOVERRIDDEN', 'No'); //Hard Coded
			$ledger_entries->addChild('ISGSTASSESSABLEVALUEOVERRIDDEN', 'No'); //Hard Coded
			$ledger_entries->addChild('STRDISGSTAPPLICABLE', 'No'); //Hard Coded
			$ledger_entries->addChild('STRDGSTISPARTYLEDGER', 'No'); //Hard Coded
			$ledger_entries->addChild('STRDGSTISDUTYLEDGER', 'No'); //Hard Coded
			$ledger_entries->addChild('CONTENTNEGISPOS', 'No'); //Hard Coded
			$ledger_entries->addChild('ISLASTDEEMEDPOSITIVE', 'Yes'); //Hard Coded
			$ledger_entries->addChild('ISCAPVATTAXALTERED', 'No'); //Hard Coded
			$ledger_entries->addChild('ISCAPVATNOTCLAIMED', 'No'); //Hard Coded
	}

	private function legder_entries_defaults2($ledger_entries){
		$ledger_entries->addChild('INTERESTCOLLECTION.LIST', ''); //Hard Coded
		$ledger_entries->addChild('OLDAUDITENTRIES.LIST', ''); //Hard Coded
		$ledger_entries->addChild('ACCOUNTAUDITENTRIES.LIST', ''); //Hard Coded
		$ledger_entries->addChild('AUDITENTRIES.LIST', ''); //Hard Coded
		$ledger_entries->addChild('INPUTCRALLOCS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('DUTYHEADDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('EXCISEDUTYHEADDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('RATEDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('SUMMARYALLOCS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('CENVATDUTYALLOCATIONS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('STPYMTDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('EXCISEPAYMENTALLOCATIONS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('TAXBILLALLOCATIONS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('TAXOBJECTALLOCATIONS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('TDSEXPENSEALLOCATIONS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('VATSTATUTORYDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('COSTTRACKALLOCATIONS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('REFVOUCHERDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('INVOICEWISEDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('VATITCDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('ADVANCETAXDETAILS.LIST', ''); //Hard Coded
		$ledger_entries->addChild('TAXTYPEALLOCATIONS.LIST', ''); //Hard Coded
	}

    /**
     * Inventory specific voucher child default fields
     */
    private function vocher_inventory_default_fields($voucher_child)
    {
        
        $voucher_child->addChild('ISDELETED', 'No'); //Hard Coded
        $voucher_child->addChild('ISSECURITYONWHENENTERED', 'No'); //Hard Coded
        $voucher_child->addChild('ASORIGINAL', 'No');//Hard Coded
        $voucher_child->addChild('AUDITED', 'No');//Hard Coded
        $voucher_child->addChild('ISCOMMONPARTY', 'No');//Hard Coded
        $voucher_child->addChild('FORJOBCOSTING', 'No');//Hard Coded
		$voucher_child->addChild('ISOPTIONAL', 'No');//Hard Coded

        $voucher_child->addChild('USEFOREXCISE', 'No');//Hard Coded
        $voucher_child->addChild('ISFORJOBWORKIN', 'No');//Hard Coded
        $voucher_child->addChild('ALLOWCONSUMPTION', 'No');//Hard Coded
        $voucher_child->addChild('USEFORINTEREST', 'No');//Hard Coded
		$voucher_child->addChild('USEFORGAINLOSS', 'No');//Hard Coded
        $voucher_child->addChild('USEFORGODOWNTRANSFER', 'No');//Hard Coded
		$voucher_child->addChild('USEFORCOMPOUND', 'No');//Hard Coded
        $voucher_child->addChild('USEFORSERVICETAX', 'No');//Hard Coded
        $voucher_child->addChild('ISREVERSECHARGEAPPLICABLE', 'No');//Hard Coded
        $voucher_child->addChild('ISSYSTEM', 'No');//Hard Coded
        $voucher_child->addChild('ISFETCHEDONLY', 'No');//Hard Coded
        $voucher_child->addChild('ISGSTOVERRIDDEN', 'No');//Hard Coded
		$voucher_child->addChild('ISCANCELLED', 'No');//Hard Coded
        $voucher_child->addChild('ISONHOLD', 'No');//Hard Coded
        $voucher_child->addChild('ISSUMMARY', 'No');//Hard Coded
        $voucher_child->addChild('ISECOMMERCESUPPLY', 'No');//Hard Coded
        $voucher_child->addChild('ISBOENOTAPPLICABLE', 'No');//Hard Coded
        $voucher_child->addChild('ISGSTSECSEVENAPPLICABLE', 'No');//Hard Coded
        $voucher_child->addChild('IGNOREEINVVALIDATION', 'No');//Hard Coded
        $voucher_child->addChild('CMPGSTISOTHTERRITORYASSESSEE', 'No');//Hard Coded

        $voucher_child->addChild('PARTYGSTISOTHTERRITORYASSESSEE', 'No');//Hard Coded
        $voucher_child->addChild('IRNJSONEXPORTED', 'No');//Hard Coded
		$voucher_child->addChild('IRNCANCELLED', 'No'); //Hard Coded
        $voucher_child->addChild('IGNOREGSTCONFLICTINMIG', 'No');//Hard Coded
        $voucher_child->addChild('ISOPBALTRANSACTION', 'No');//Hard Coded
        $voucher_child->addChild('IGNOREGSTFORMATVALIDATION', 'No');//Hard Coded
        $voucher_child->addChild('ISELIGIBLEFORITC', 'Yes'); //TO-DO

        $voucher_child->addChild('UPDATESUMMARYVALUES', 'No');//Hard Coded
		$voucher_child->addChild('ISEWAYBILLAPPLICABLE', 'No'); //Hard Coded

		$voucher_child->addChild('ISDELETEDRETAINED', 'No'); //Hard Coded
        $voucher_child->addChild('ISNULL', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXCISEVOUCHER', 'No'); //Hard Coded
        $voucher_child->addChild('EXCISETAXOVERRIDE', 'No'); //Hard Coded
        $voucher_child->addChild('USEFORTAXUNITTRANSFER', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXER1NOPOVERWRITE', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXF2NOPOVERWRITE', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXER3NOPOVERWRITE', 'No'); //Hard Coded
        $voucher_child->addChild('IGNOREPOSVALIDATION', 'No'); //Hard Coded
        $voucher_child->addChild('EXCISEOPENING', 'No'); //Hard Coded
        $voucher_child->addChild('USEFORFINALPRODUCTION', 'No'); //Hard Coded
        $voucher_child->addChild('ISTDSOVERRIDDEN', 'No'); //Hard Coded
        $voucher_child->addChild('ISTCSOVERRIDDEN', 'No'); //Hard Coded
        $voucher_child->addChild('ISTDSTCSCASHVCH', 'No'); //Hard Coded
        $voucher_child->addChild('INCLUDEADVPYMTVCH', 'No'); //Hard Coded
        $voucher_child->addChild('ISSUBWORKSCONTRACT', 'No'); //Hard Coded
        $voucher_child->addChild('ISVATOVERRIDDEN', 'No'); //Hard Coded
        $voucher_child->addChild('IGNOREORIGVCHDATE', 'No'); //Hard Coded
        $voucher_child->addChild('ISVATPAIDATCUSTOMS', 'No'); //Hard Coded
        $voucher_child->addChild('ISDECLAREDTOCUSTOMS', 'No'); //Hard Coded
        $voucher_child->addChild('VATADVANCEPAYMENT', 'No'); //Hard Coded
        $voucher_child->addChild('VATADVPAY', 'No'); //Hard Coded
        $voucher_child->addChild('ISCSTDELCAREDGOODSSALES', 'No'); //Hard Coded
        $voucher_child->addChild('ISVATRESTAXINV', 'No'); //Hard Coded
        $voucher_child->addChild('ISSERVICETAXOVERRIDDEN', 'No'); //Hard Coded
        $voucher_child->addChild('ISISDVOUCHER', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXCISEOVERRIDDEN', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXCISESUPPLYVCH', 'No'); //Hard Coded
        $voucher_child->addChild('GSTNOTEXPORTED', 'No'); //Hard Coded
        $voucher_child->addChild('IGNOREGSTINVALIDATION', 'No'); //Hard Coded
        $voucher_child->addChild('ISGSTREFUND', 'No'); //Hard Coded
        $voucher_child->addChild('OVRDNEWAYBILLAPPLICABILITY', 'No'); //Hard Coded
        $voucher_child->addChild('ISVATPRINCIPALACCOUNT', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISVCHNUMUSED', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISINCLUDED', 'Yes'); //TO-DO
		$voucher_child->addChild('VCHGSTSTATUSISUNCERTAIN', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISEXCLUDED', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISAPPLICABLE', 'Yes'); //TO-DO
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BRECONCILED', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BONLYINPORTAL', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BONLYINBOOKS', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BMISMATCH', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISGSTR2BINDIFFPERIOD', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISRETEFFDATEOVERRDN', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISOVERRDN', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISSTATINDIFFDATE', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISRETINDIFFDATE', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSMAINSECTIONEXCLUDED', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISBRANCHTRANSFEROUT', 'No'); //Hard Coded
        $voucher_child->addChild('VCHGSTSTATUSISSYSTEMSUMMARY', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISUNREGISTEREDRCM', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISOPTIONAL', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISCANCELLED', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISDELETED', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISOPENINGBALANCE', 'No'); //Hard Coded
        $voucher_child->addChild('VCHSTATUSISFETCHEDONLY', 'No'); //Hard Coded
        $voucher_child->addChild('PAYMENTLINKHASMULTIREF', 'No'); //Hard Coded
        $voucher_child->addChild('ISSHIPPINGWITHINSTATE', 'No'); //Hard Coded
        $voucher_child->addChild('ISOVERSEASTOURISTTRANS', 'No'); //Hard Coded
        $voucher_child->addChild('ISDESIGNATEDZONEPARTY', 'No'); //Hard Coded
        $voucher_child->addChild('HASCASHFLOW', 'No'); //Hard Coded
		
		$voucher_child->addChild('ISPOSTDATED', 'No'); //Hard Coded
		$voucher_child->addChild('USETRACKINGNUMBER', 'No'); //Hard Coded
		$voucher_child->addChild('ISINVOICE', 'Yes'); //TO-DO

        $voucher_child->addChild('MFGJOURNAL', 'No'); //Hard Coded
        $voucher_child->addChild('HASDISCOUNTS', 'No');  //Hard Coded
		$voucher_child->addChild('ASPAYSLIP', 'No'); //Hard Coded
		$voucher_child->addChild('ISCOSTCENTRE', 'No');  //Hard Coded
        $voucher_child->addChild('ISSTXNONREALIZEDVCH', 'No'); //Hard Coded
        $voucher_child->addChild('ISEXCISEMANUFACTURERON', 'No');  //Hard Coded
        $voucher_child->addChild('ISBLANKCHEQUE', 'No');  //Hard Coded
        $voucher_child->addChild('ISVOID', 'No');  //Hard Coded
        $voucher_child->addChild('ORDERLINESTATUS', 'No');  //Hard Coded
        $voucher_child->addChild('VATISAGNSTCANCSALES', 'No');  //Hard Coded
        $voucher_child->addChild('VATISPURCEXEMPTED', 'No');  //Hard Coded
        $voucher_child->addChild('ISVATRESTAXINVOICE', 'No');  //Hard Coded
        $voucher_child->addChild('VATISASSESABLECALCVCH', 'No');  //Hard Coded
		$voucher_child->addChild('ISVATDUTYPAID', 'Yes'); //TO-DO
        $voucher_child->addChild('ISDELIVERYSAMEASCONSIGNEE', 'No');  //Hard Coded
        $voucher_child->addChild('ISDISPATCHSAMEASCONSIGNOR', 'No');  //Hard Coded
        $voucher_child->addChild('ISDELETEDVCHRETAINED', 'No');  //Hard Coded
        $voucher_child->addChild('CHANGEVCHMODE', 'No');  //Hard Coded
        $voucher_child->addChild('RESETIRNQRCODE', 'No');  //Hard Coded

		//$voucher_child->addChild('ALTERID', '5'); //TO-D0 For isWithInventory ??
		//$voucher_child->addChild('MASTERID', '1'); //TO-DO
		//$voucher_child->addChild('VOUCHERKEY', '194914205827080'); //TO-DO
		//$voucher_child->addChild('VOUCHERRETAINKEY', '1'); //TO-DO
		$voucher_child->addChild('VOUCHERNUMBERSERIES', 'Default'); //TO-DO

        $voucher_child->addChild('EWAYBILLDETAILS.LIST'); //Hard Coded
        $voucher_child->addChild('EXCLUDEDTAXATIONS.LIST'); //Hard Coded
        $voucher_child->addChild('OLDAUDITENTRIES.LIST'); //Hard Coded
        $voucher_child->addChild('ACCOUNTAUDITENTRIES.LIST'); //Hard Coded
        $voucher_child->addChild('AUDITENTRIES.LIST'); //Hard Coded
        $voucher_child->addChild('DUTYHEADDETAILS.LIST'); //Hard Coded
        $voucher_child->addChild('GSTADVADJDETAILS.LIST'); //Hard Coded





    }

}

