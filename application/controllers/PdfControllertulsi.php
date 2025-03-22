<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'libraries/phpqrcode/qrlib.php';
require_once 'CommonController.php';

class PdfControllertulsi extends CommonController
{

    public function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/karachi');
        $this->user_name = $this->session->userdata('user_name');
        $this->user_id = $this->session->userdata('user_id');
        $this->current_date = date('d-m-Y');
        $this->current_time = date('h:i:s');

        $d = date_parse_from_format("d-m-Y", $this->current_date);
        $this->date = $d["day"];
        $this->month = $d["month"];
        $this->year = $d["year"];
        $this->load->model('SupplierParts');
        require_once APPPATH . 'libraries/Pdf1.php';
    }

    public function view_challan_invoice()
    {
        $this->view_challan_pdf(false);
    }

    public function view_challan_pdf($isPdf = true)
    {
        $challan_id = $this->uri->segment('2');
        $copy = $this->uri->segment('3');
        $challan_data = $this->Crud->get_data_by_id("challan", $challan_id, "id");
        $challan_parts_data = $this->Crud->get_data_by_id("challan_parts", $challan_id, "challan_id");
        $supplier_data = $this->Crud->get_data_by_id("supplier", $challan_data[0]->supplier_id, "id");

        $client_data = $this->Unit->getClientUnitDetails();
        $shipping_data = $this->getShippingDetails($challan_data, $supplier_data);

        $i = 1;
        $row_data = '';
        $total_value = 0;
        $margin_top = "20%";

        if ($challan_parts_data) {
            foreach ($challan_parts_data as $cd) {
                $child_part_data = $this->SupplierParts->getSupplierPartById($cd->part_id);
                $uom_data = $this->Crud->get_data_by_id("uom", $child_part_data[0]->uom_id, "id");

                $total_value = $total_value + $cd->value;
                $row_data .= '
          <tr style="text-align:center;font-size:12px">
              <td>' . $i . '</td>
              <td>
                  ' . $child_part_data[0]->part_number . ' <br>
                  ' . $child_part_data[0]->part_description . '
              </td>
              <td>
                    ' . $cd->qty . ' ' . $uom_data[0]->uom_name . '<br>
              </td>
              <td>
                   ' . $cd->process . '

              </td>
              <td>
                   ' . $cd->hsn . '

              </td>
              <td>
                   ' . $cd->value . '

              </td>
          </tr>
          ';

                $i++;
            }
        }
        //  print_r($i); exit;
        if ($i == 3) {
            $margin_top = "16%";
        } else if ($i == 4) {
            $margin_top = "14%";
        } else if ($i == 5) {
            $margin_top = "12%";
        } else if ($i == 6) {
            $margin_top = "10%";
        } else if ($i == 7) {
            $margin_top = "8%";
        } else if ($i == 8) {
            $margin_top = "20px;";
        } else if ($i == 9) {
            $margin_top = "4%";
        }
        // else
        // {
        //   $margin_top="2%";
        // }

        $footer = '
    <tr style="text-align:right;font-size:12px">
        <th colspan="5">Total</th>
        <th style="text-align:center;font-size:12px">' . $total_value . '</th>
    </tr>
    <tr>
    <td colspan="6" style="text-align:left;font-size:12px">
    <b>Amount In Words: </b> ' . $this->getIndianCurrency(number_format((float) $total_value, 2, '.', '')) . '
    </td>
    </tr>
    <tr>
      <th colspan="3" style="text-align:left;font-size:12px">
        Transporter : ' . $challan_data[0]->transpoter . ' <br> <br>
        Vehicle No : ' . $challan_data[0]->vechical_number . '
        </th>
        <th colspan="3" style="text-align:center;font-size:12px">
        For ' . $this->getCustomerNameDetails() . '
        <br><br>
        <br>
        Authorized Signatory
        </th>
    </tr>
    <tr>
      <td colspan="6" style="text-align:center;font-size:12px">
      To be comleted by processor/job worker at the time despatches, back to the manufacturer
      Original copy to be retained by job-worker. Duplicate copy to be despatched along with goods
      </td>
    </tr>
    <tr >
      <td  colspan="6" style="text-align:left;font-size:12px">
         1. Date & time of despatch of finished goods to parent
      factory/another manufacturer and entry No. and date
      of receipt in the account in the processing factory.
      </td>
    </tr>
    <tr>
      <td colspan="6" style="text-align:left;font-size:12px">
      Part No.
      <br>
      Chal No.   <br>
      Date
      <br><br>
      </td>
      </tr>
    <tr>
      <td colspan="2" style="text-align:left;font-size:12px">
     2. Quantity despatched (Nos/Weight/Litre/Meter) and
     entered in Account.
      </td>
      <td colspan="4" style="text-align:left;font-size:12px">
      Qty <br>
      </td>
    </tr>
    <tr>
      <td colspan="6" style="text-align:left;font-size:12px">
     3. Nature of Processing/Manufacturing done
      </td>
    </tr>
    <tr>
      <td colspan="6" style="text-left:center;font-size:10px">
     4. Quantity of waste material returned to the parent
     factory of cleared for home consumption (Invoice No.
     & date quantum of duty paid (Both in Figure & Words)
      </td>
    </tr>
    <tr>
      <td colspan="6" style="text-align:left;font-size:12px">
        Place: <br>
        Date: <br>
        Name of the Factory & Address: <br>
      </td>
    </tr>
    <tr>

      <td colspan="6" style="text-align:right;font-size:10px">
      <br><br>
      Signature Of Processor
      </td>
    </tr>
    </table>
    ';

        $html_content = '

    <html>
    <head>
    <style>
    table.fixed { table-layout:fixed; }
   table.fixed td { overflow: hidden; }
    html { margin: 37.8px;font-size:18px}
    footer {
      margin-top:' . $margin_top . ';
      width: 100%;
      font-size:18px;
    }

    </style></head>
    <body>
    <table cellspacing="0" style="margin-right: 37.8px"  border="1px">

    <tr>

        <th colspan="6" style="text-align:right; font-size:10px">' . $copy . ' </th>

    </tr>
        <tr>
            <th colspan="6" style="text-align:center">CHALLAN</th>
        </tr>
        <tr>
            <th colspan="6" style="text-align:center;font-size:12px">
             ' . $client_data[0]->client_name . '

            </th>
        </tr>
        <tr>
        <td colspan="6" style="text-align:center;font-size:12px"> ' . $client_data[0]->billing_address . '</td>

        </tr>
        <tr>
            <td colspan="6" style="text-align:center;font-size:12px"> FOR MOVEMENT OF INPUT/CAPITAL GOODS OR PARTIALLY PROCESSED GOODS UNDER RULE4(6)A FROM ONE
            FACTORY TO ANOTHER FACTORY FOR FURTHER PROCESSING/OPERATION AND RETURN</td>
        </tr>

        <tr>
            <td colspan="2" style="text-align:center;font-size:12px">GSTIN : ' . $client_data[0]->gst_number . '</td>
            <td colspan="2" style="text-align:center;font-size:12px">STATE : ' . $client_data[0]->state . '</td>
            <td colspan="2" style="text-align:center;font-size:12px">STATE CODE : ' . $client_data[0]->state_no . '</td>
        </tr>
        <tr>
            <td colspan="3" style="text-align:left;font-size:14px">To, <br>
                 ' . $shipping_data['shipping_name'] . ' <br>
                 ' . $shipping_data['ship_address'] . ' <br>
               <b> GSTIN- </b>' . $shipping_data['gst_number'] . ' <br>
               <b>TELEPHONE No:  </b> ' . $shipping_data['phone_no'] . ' <br>
            </td>
            <td colspan="3" style="text-align:left;font-size:14px">
            Challan No : ' . $challan_data[0]->challan_number . ' <br>
            Challan Date : ' . $challan_data[0]->created_date . ' <br>
            Time Of Supply : ' . $challan_data[0]->created_time . ' <br>
            </td>
        </tr>
        <tr style="text-align:center;font-size:12px;">
            <th style="width:10px">Sr No</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Process</th>
            <th>HSN</th>
            <th>Value</th>
        </tr>
             ' . $row_data . '
          ' . $footer . '
        </body>
        </html>
       ';

        if ($isPdf) {
            $this->pdf->loadHtml($html_content);
            $this->pdf->render();
            $this->pdf->stream("Challan-" . $challan_id . ".pdf", array("Attachment" => 1));
        } else {
            echo $html_content;
        }
    }

    public function view_original_sales_invoice()
    {
        $new_sales_id = $this->uri->segment('2');
        $configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
        
                // echo $html_content_full;

                $new_sales_data = $this->Crud->get_data_by_id("new_sales", $new_sales_id, "id");
                $html_content_full = $this->for_print_download_generate_sales_invoice("ORIGINAL_FOR_RECIPIENT", $new_sales_id, $configuration);
                
                // pr($html_content_full,1);
                $filename = $this->generatePdf($html_content_full['middle_Content'],$html_content_full['heder_content'],$html_content_full['footer_content'],"ORIGINAL_FOR_RECIPIENT","F",$html_content_full['extra_condition']);

                $copy = "sales_invoive_ORIGINAL_FOR_RECIPIENT";
                $fileName = "dist/uploads/sales_invoice_print/".$copy.".pdf";
                $fileAbsolutePath = FCPATH.$fileName;
                    

                    // generate digital signature
                $signer = $configuration['signer'];
                $certpwd = $configuration['certpwd'];
                $certid = $configuration['certid'];
                $customerPrefix = $configuration['customerPrefix'];
                $digital_signature_url = $configuration['digital_signature_url'];
                $digitalSignature = $configuration['digitalSignature'];
                if($digitalSignature == "Yes"){
                    $sign_position = "[400:50]";
                    if($isEinvoicePresent){
                            $sign_position = "[400:40]";
                    }
                    digitalSignature($fileName,$sign_position,$signer,$certpwd,$certid,$customerPrefix,$digital_signature_url);
                }
                $fileDownloadPath = base_url().$fileName;
                header("Location: ".$fileDownloadPath);
                    
    }


    public function download_po()
    {
        $new_po_id = $this->uri->segment('2');
        $client_data = $this->Unit->getClientUnitDetails();
        $new_po_data = $this->Crud->get_data_by_id("new_po", $new_po_id, "id");
        $po_discount_type = $new_po_data[0]->po_discount_type;
        $discount_type = $new_po_data[0]->discount_type;
        $discount_value = $new_po_data[0]->discount;
        // pr($new_po_data['po_number'],1);
        // echo "<br>";
        $supplier_data = $this->Crud->get_data_by_id("supplier", $new_po_data[0]->supplier_id, "id");
        // 
        $discount = ($discount_value != null && $discount_value != "") ? $discount_value : "";

        // echo "<br>";
        $po_parts_data = $this->Crud->get_data_by_id("po_parts", $new_po_data[0]->id, "po_id");
        // print_r($po_parts_data);
        // echo "<br>";
        $parts_html = "";
        $final_total = 0;
        $cgst_amount = 0;
        $sgst_amount = 0;
        $igst_amount = 0;
        $tcs_amount = 0;
        $with_in_state = "";
        $i = 1;

        $loading_unloading_gst = $this->Crud->get_data_by_id("gst_structure", $new_po_data[0]->loading_unloading_gst, "id");
        $freight_amount_gst = $this->Crud->get_data_by_id("gst_structure", $new_po_data[0]->freight_amount_gst, "id");

        if (!empty($loading_unloading_gst)) {
            $loading_cgst_amount = ($loading_unloading_gst[0]->cgst * $new_po_data[0]->loading_unloading) / 100;
            $loading_sgst_amount = ($loading_unloading_gst[0]->sgst * $new_po_data[0]->loading_unloading) / 100;
            $loading_igst_amount = ($loading_unloading_gst[0]->igst * $new_po_data[0]->loading_unloading) / 100;

            $cgst_amount = $loading_cgst_amount;
            $sgst_amount = $loading_sgst_amount;
            $igst_amount = $loading_igst_amount;
        }
        if (!empty($freight_amount_gst)) {
            $freight_cgst_amount_ = ($freight_amount_gst[0]->cgst * $new_po_data[0]->freight_amount) / 100;
            $freight_sgst_cgst = ($freight_amount_gst[0]->sgst * $new_po_data[0]->freight_amount) / 100;
            $freight_igst_cgst = ($freight_amount_gst[0]->igst * $new_po_data[0]->freight_amount) / 100;
            $cgst_amount = $cgst_amount + $freight_cgst_amount_;
            $sgst_amount = $sgst_amount + $freight_sgst_cgst;
            $igst_amount = $igst_amount + $freight_igst_cgst;
        }



        $part_arr = [];
        // pr($po_parts_data,1);
        foreach ($po_parts_data as $p) {
            // pr($po_parts_data,1);
            $data = array(
                'supplier_id' => $supplier_data[0]->id,
                "child_part_id" => $p->part_id,
            );
            $part_data_new = $this->Crud->get_data_by_id_multiple_condition("child_part_master", $data);
            $with_in_state = $supplier_data[0]->with_in_state;
            // pr($with_in_state,1);
            $uom_data = $this->Crud->get_data_by_id("uom", $p->uom_id, "id");
            $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");

            $part_data_new2 = $this->SupplierParts->getSupplierPartOnlyById($p->part_id);

            $payment_terms = "";
            $payment_days = 0;
            if ($supplier_data) {
                $payment_terms = $supplier_data[0]->payment_terms;
                $payment_days = $supplier_data[0]->payment_days;
            }

            if ($part_data_new2) {
                $hsn_code = $part_data_new2[0]->hsn_code;
            } else {
                $hsn_code = "";
            }

            if ((int) $gst_structure_data[0]->igst === 0) {
                $gst = (float) $gst_structure_data[0]->cgst + (float) $gst_structure_data[0]->sgst;
                $cgst = (float) $gst_structure_data[0]->cgst;
                $sgst = (float) $gst_structure_data[0]->sgst;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $tcs_on_tax = $gst_structure_data[0]->tcs_on_tax;
                $igst = 0;
            } else {
                $gst = (float) $gst_structure_data[0]->igst;
                $cgst = 0;
                $sgst = 0;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $tcs_on_tax = $gst_structure_data[0]->tcs_on_tax;
                $igst = $gst;
            }

            $part_rate_new = 0;
            if (empty($p->rate)) {
                $part_rate_new = $part_data_new[0]->part_rate;
            } else {
                $part_rate_new = $p->rate;
            }
            $gst_amount = ($gst * $part_rate_new) / 100;
            $final_amount = $gst_amount + $part_rate_new;
            $final_row_amount = $final_amount * $p->qty;

            // $final_total = $final_total + $final_row_amount;

            $total_amount = $p->qty * $part_rate_new;
            $total_amount_with_discount = ($total_amount * $p->discount/100) > 0 ?  ($total_amount * $p->discount/100) : 0 ;
            $total_amount = $total_amount - $total_amount_with_discount;
            $final_total = $final_total + $total_amount;
            if($po_discount_type != "PO Level"){
                $cgst_amount = $cgst_amount + (($total_amount * $cgst) / 100);
                $sgst_amount = $sgst_amount + (($total_amount * $sgst) / 100);
                $igst_amount = $igst_amount + (($total_amount * $igst) / 100);

                if ($gst_structure_data[0]->tcs_on_tax == "no") {
                    $tcs_amount = $tcs_amount + (($total_amount * $tcs) / 100);
                } else {
                    //$tcs_amount =  $tcs_amount + ((($cgst_amount + $sgst_amount + $igst_amount + $total_amount) * $tcs) / 100);
                    $tcs_amount = $tcs_amount + ((((float) (($total_amount * $cgst) / 100) + (float) (($total_amount * $sgst) / 100) + (float) $igst_amount + (float) $total_amount) * $tcs) / 100);
                }
            }

            if ($with_in_state == "yes") {
                $part_arr[] = [
                    "part_number" =>$part_data_new[0]->part_number,
                    "part_description" => $part_data_new[0]->part_description,
                    "hsn_code" => $hsn_code,
                    "part_rate_new" => $part_rate_new,
                    "qty" => $p->qty,
                    "uom_name" =>$uom_data[0]->uom_name,
                    "cgst" => $cgst,
                    "sgst" => $sgst,
                    "total_amount" => number_format((float) $total_amount, 2, '.', ''),
                    "discount_amount" => ($part_rate_new * $p->discount/100) > 0 ?  $part_rate_new - ($part_rate_new * $p->discount/100) : 0 
                ];
                // $parts_html .= '
                //     <tr>
                //         <td>' . $i . '</td>
                //         <td colspan="3">' . $part_data_new[0]->part_number . ' / ' . $part_data_new[0]->part_description . '</td>
                //         <td>' . $hsn_code . '</td>
                //         <td>' . $part_rate_new . '</td>
                //         <td>' . $p->qty . '</td>
                //         <td>' . $uom_data[0]->uom_name . '</td>
                //         <td>' . $cgst . '</td>
                //         <td>' . $sgst . '</td>
                //         <td>' . number_format((float) $total_amount, 2, '.', '') . '</td>

                //     </tr>
                //     ';
            } else {
                // $parts_html .= '
                //     <tr>
                //         <td>' . $i . '</td>
                //         <td colspan=" 4 ">' . $part_data_new[0]->part_number . ' / ' . $part_data_new[0]->part_description . '</td>
                //         <td>' . $hsn_code . '</td>
                //         <td>' . $part_rate_new . '</td>
                //         <td>' . $p->qty . '</td>
                //         <td>' . $uom_data[0]->uom_name . '</td>
                //         <td>' . $igst . '</td>
                //         <td>' . number_format((float) $total_amount, 2, '.', '') . '</td>

                //     </tr>
                //     ';
                $part_arr[] = [
                    "part_number" =>$part_data_new[0]->part_number,
                    "part_description" => $part_data_new[0]->part_description,
                    "hsn_code" => $hsn_code,
                    "part_rate_new" => $part_rate_new,
                    "qty" => $p->qty,
                    "uom_name" =>$uom_data[0]->uom_name,
                    "cgst" => $cgst,
                    "sgst" => $sgst,
                    "total_amount" => number_format((float) $total_amount, 2, '.', ''),
                    "igst" =>$igst,
                    "discount_amount" => ($part_rate_new * $p->discount/100) > 0 ?  $part_rate_new - ($part_rate_new * $p->discount/100) : 0 
                ];
            }

            $i++;
        }

        // pr($final_total,1);
        $configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
        

        $po_formate_number = $configuration['PoFormateNumber'];
        $po_rev_number = $configuration['PoRevNo'];
        $po_rev_date = $configuration['PoRevDate'];
        $data['with_in_state'] = $with_in_state;
        $data['part_arr'] = $part_arr;
        $part_chunks_arr = [];
        $key_count = 0;
        foreach ($data['part_arr'] as $key => $value) {
           // pr(($key+1)%9 == 0);
           $part_chunks_arr[$key_count][$key] = $value;
            if(($key+1)%6 == 0){
             $key_count++;
           }
        }
         $data['part_arr'][0][] = $data['part_arr'][0][0];
        $data['part_arr'][0][] = $data['part_arr'][0][0];
        // pr($part_chunks_arr,1);
        $data['total_product'] = count($data['part_arr']);
        $data['part_arr'] = $part_chunks_arr;
        // pr($data,1);
      

        // $final_final_amount = $final_total + $cgst_amount + $sgst_amount + $igst_amount + $tcs_amount;

        $billing_address = $new_po_data[0]->billing_address;
        $shipping_address = $new_po_data[0]->shipping_address;

        $billing_address = $new_po_data[0]->billing_address;
        $shipping_address = $new_po_data[0]->shipping_address;

        if (empty($billing_address)) {
            $billing_address = $client_data[0]->billing_address."<br><b>GSTIN</b>: ".$client_data[0]->gst_number;
        }
        if (empty($shipping_address)) {
            $shipping_address = $client_data[0]->shifting_address."<br><b>GSTIN</b>: ".$client_data[0]->gst_number;
        }

        if(strlen($billing_address) < 140 && strlen($shipping_address) < 140) {
            $add_more_spacing = "<br>";
        }
        $sub_total_amount = $final_total;
        // pr($sub_total_amount);
        $discount_amount = 0;
        $discount_amount_after_subtotal = "";
       
        if($po_discount_type == "PO Level"){
            if($discount != ""){
                if($discount_type == "Percentage"){
                    $discount_amount = $final_total * $discount/100;
                    $discount .="%"; 
                }else{
                    $discount_amount = $discount;
                    $discount = number_format((float) $discount, 2, '.', '');
                }
            }

            $part_val = $po_parts_data[0];
            
            $final_total = $final_total - $discount_amount;
            // $final_final_amount = $final_final_amount - $discount_amount;
            $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $part_val->tax_id, "id");
            if ((int) $gst_structure_data[0]->igst === 0) {
                 // pr($gst_structure_data,1);
                $gst = (float) $gst_structure_data[0]->cgst + (float) $gst_structure_data[0]->sgst;
                $cgst = (float) $gst_structure_data[0]->cgst;
                $sgst = (float) $gst_structure_data[0]->sgst;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $tcs_on_tax = $gst_structure_data[0]->tcs_on_tax;
                $igst = 0;
            } else {
                $gst = (float) $gst_structure_data[0]->gst;
                $cgst = 0;
                $sgst = 0;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $tcs_on_tax = $gst_structure_data[0]->tcs_on_tax;
                $igst = $gst;
            }
            $cgst_amount +=  (($final_total * $cgst) / 100);
            $sgst_amount += (($final_total * $sgst) / 100);
            $igst_amount += (($final_total * $igst) / 100);
            if ($gst_structure_data[0]->tcs_on_tax == "no") {
                $tcs_amount += (($final_total * $tcs) / 100);
            } else {
                //$tcs_amount =  $tcs_amount + ((($cgst_amount + $sgst_amount + $igst_amount + $total_amount) * $tcs) / 100);
                $tcs_amount +=  ((((float) (($final_total * $cgst) / 100) + (float) (($final_total * $sgst) / 100) + (float) $igst_amount + (float) $final_total) * $tcs) / 100);
            }
            $final_total = $final_total + $new_po_data[0]->loading_unloading + $new_po_data[0]->freight_amount;
            $discount_amount_after_subtotal = ' 
                    <tr>
                        <td width="26.3%" style="text-align:left;font-size:10.3px;" >&nbsp;Sub Total After Discount (' . $discount . ')</td>
                            <td width="18.7%" style="text-align:center;font-size:10.3px;" >' . number_format((float) $final_total, 2, '.', '') . '</td>
                        </tr>';
            // pr($igst_amount,1);
        }else{
            $final_total = $final_total + $new_po_data[0]->loading_unloading + $new_po_data[0]->freight_amount;
        }
        
        $final_final_amount = $final_total + $cgst_amount + $sgst_amount + $igst_amount + $tcs_amount;

        // pr($discount_amount,1);

        
        
        $footer_gst = '
                <tr>
                    <td width="26.3%" style="text-align:left;font-size:10.3px;" >&nbsp;CGST Amount</td>
                    <td width="18.7%" style="text-align:center;font-size:10.3px;" ></td>
                </tr>
                <tr>
                    <td width="26.3%" style="text-align:left;font-size:10.3px;" >SGST Amount</td>
                    <td width="18.7%" style="text-align:center;font-size:10.3px;" ></td>
                </tr>';
        $gst_block_html = "";
        if ($with_in_state == "yes") {
            $footer_gst = '
                <tr>
                    <td width="26.3%" style="text-align:left;font-size:10.3px;" >&nbsp;CGST Amount</td>
                    <td width="18.7%" style="text-align:center;font-size:10.3px;" >' . number_format((float) $cgst_amount, 2, '.', '') . '</td>
                </tr>
                <tr>
                    <td width="26.3%" style="text-align:left;font-size:10.3px;" >&nbsp;SGST Amount</td>
                    <td width="18.7%" style="text-align:center;font-size:10.3px;" >' . number_format((float) $sgst_amount, 2, '.', '') . '</td>
                </tr>';
                } else {
                    
            $footer_gst = '
                <tr>
                    <td width="26.3%" style="text-align:left;font-size:10.3px;" >&nbsp;IGST Amount</td>
                    <td width="18.7%" style="text-align:center;font-size:10.3px;" >' . number_format((float) $igst_amount, 2, '.', '') . '</td>
                </tr>
                ';
                $gst_block_html = '<br><br>';
            ;

        }

        

        $notes = "  1.PDIR & MTC Required with each lot. Pls mention PO No. on Invoice.
          <br>
          2.Rejection if any will be debited to suppliers account
          <br>
          3. Inspection & Testing Requirements as per Customer drawing/ standard/ quality plan will be done at your end and reports will share to us.<br>
          <b> G. S. T.: </b> GST Extra. <br>
          <b> Delivery :</b>   Door Delivery. <br>

          <b> Validity :</b>  30 Days from date of purchase order <br>";
        // pr($new_po_data,1);
        if (!empty($new_po_data[0]->notes)) {
            $notes = $new_po_data[0]->notes;
        }   
        ob_start();
        // pr($new_po_data[0]->po_number,1);

        if($with_in_state == "yes"){
            $part_titel = ' <td width="6.333333333%" style="text-align:center;font-size:8.8px;">
                        <b>CGST 
                        <br>%</b>
                    </td>
                    <td width="6.333333333%" style="text-align:center;font-size:8.8px;">
                        <b>SGST<br> %</b>
                    </td>';
        }else{
            $part_titel = '<td width="12.666666666%" style="text-align:center;font-size:8.8px;">
                        <b>IGST<br> %</b>
                    </td>';
        }
        $discount_title = "";
        $data['po_discount_type'] = $po_discount_type;
        if($po_discount_type == "Part Level"){
            $part_titel = "";
            $discount_title = '<td width="12.666666666%" style="text-align:left;font-size:8.8px;" >
                            <b>DISCOUNT RATE</b>
                        </td>';
        }


       $header_html =  '
       <style>
             
            th, td ,b{ 
                font-family: "Poppins", sans-serif;
                line-height: 1.8
            }
           </style>
       <table cellspacing="0" cellpadding="4.4" border="1">
            <tbody>
                <tr>
                    <td width="70%" style="text-align:center;" rowspan="2" colspan="2">
                    <b style="font-size:12.8px;">PURCHASE ORDER</b><br>
                    <b style="font-size:15.8px;">'.$client_data[0]->client_name.'</b>
                    </td>
                    <td width="30%" style="text-align:left;font-size:10.6px;"><b>&nbsp;Format No : '.$po_formate_number.'</b></td>
                </tr>
                <tr>
                    <td width="30%" style="text-align:left;font-size:10.6px;"><b>&nbsp;Rev No : '.$po_rev_number.'</b></td>
                </tr>
                <tr>
                    <td width="40%" style="text-align:left;font-size:10.6px;"  colspan="2"><b>&nbsp;PO. NO.:</b>&nbsp;<span style="font-size:12.6px">' . $new_po_data[0]->po_number . '</span></td>
                    <td width="30%" style="text-align:left;font-size:10.6px;"  colspan="2"><b>&nbsp;PO DATE:</b> '.$new_po_data[0]->created_date.'</td>
                    <td width="30%" style="text-align:left;font-size:11.6px;"><b>&nbsp;Rev Date : '.$po_rev_date.'</b></td>
                </tr>
                <tr>
                    <td width="50%" style="text-align:left;font-size:10.6px;"><b>&nbsp;SUPPLIER:</b> ' . $supplier_data[0]->supplier_name . '</td>
                    <td width="16%" style="text-align:center;font-size:10.6px;"><b>&nbsp;PO TYPE </b></td>
                    <td width="18%" style="text-align:left;font-size:10.6px;"><b>&nbsp;PO Amendment No:</b></td>
                    <td width="16%" style="text-align:left;font-size:10.6px;"><b>&nbsp;' . $new_po_data[0]->amendment_no . '</b></td>
                </tr> 
                <tr>
                    <td width="50%" style="text-align:left;font-size:10.6px;height:85px;" rowspan="2">
                    <table cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td width="100%" style="text-align:left;font-size:10.6px;" >' . $supplier_data[0]->location . '</td>
                                    </tr>
                                    <tr>
                                        <td width="100%" style="text-align:left;font-size:10.6px;" ><b>GSTIN- </b>' . $supplier_data[0]->gst_number . '</td>
                                    </tr>
                                   
                                    <tr>
                                        <td width="100%" style="text-align:left;font-size:10.6px;" ><b>CONTACT No: </b>  ' . $supplier_data[0]->mobile_no  . '</td>
                                    </tr>
                                    

                    </table>

 </td>
                    <td width="16%" style="text-align:left;font-size:10.6px;" rowspan="2"><b></b></td>
                    <td width="18%" style="text-align:left;font-size:10.6px;"><b>&nbsp;PO Amendment Date:</b></td>
                    <td width="16%" style="text-align:left;font-size:10.6px;">' . $new_po_data[0]->amendment_date . '</td>
                </tr>  
                <tr>
                    <td width="18%" style="text-align:left;font-size:10.8px;"><b>&nbsp;&nbsp;PO Expiry  Date:</b></td>
                    <td width="16%" style="text-align:left;font-size:10.8px;">' . defaultDateFormat($new_po_data[0]->expiry_po_date) . '</td>
                </tr> 
                <tr>
                    <td width="50%" style="text-align:center;font-size:10.8px;" ><b>&nbsp;&nbsp;BILLING ADDRESS:  </b></td>
                    <td width="50%" style="text-align:center;font-size:10.8px;"><b>&nbsp;&nbsp;SHIPPING ADDRESS:</b></td>
                </tr> 
                <tr>
                    <td width="50%" style="text-align:left;font-size:10.8px;height:85px;" >
                        <table cellspacing="0" cellpadding="0" border="0" >
                                    <tr>
                                        <td width="100%" style="text-align:left;font-size:10.6px;" >' . $billing_address . ' </td>
                                    </tr>
                                    <tr>
                                        <td width="100%" style="text-align:left;font-size:10.6px;" ><b>GSTIN- </b>' . $client_data[0]->gst_number . '</td>
                                    </tr>
                                   
                                    <tr>
                                        <td width="100%" style="text-align:left;font-size:10.6px;" ><b>STATE: </b>  ' . $client_data[0]->state . '</td>
                                    </tr>
                                    

                        </table>
                       
                    </td>
                    <td width="50%" style="text-align:left;font-size:10.8px;">
                    <table cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td width="100%" style="text-align:left;font-size:10.6px;" >' . $shipping_address . ' </td>
                                    </tr>
                                    <tr>
                                        <td width="100%" style="text-align:left;font-size:10.6px;" ><b>GSTIN- </b>' . $client_data[0]->gst_number . '</td>
                                    </tr>
                                    <tr>
                                        <td width="100%" style="text-align:left;font-size:10.6px;" ><b>STATE: </b>  ' . $client_data[0]->state . '</td>
                                    </tr>
                                    

                        </table>
                        
                    </td>
                </tr> 
                <tr>
                    <td width="4%" style="text-align:left;font-size:8.8px;" >
                    <b>NO</b>
                    </td>
                    <td width="38%" style="text-align:left;font-size:8.8px;" >
                        <b>DESCRIPTION OF GOODS</b>
                    </td>
                    <td width="8%" style="text-align:center;font-size:8.8px;" >
                        <b>HSN</b>
                    </td>
                    <td width="10.333333333%" style="text-align:left;font-size:8.8px;" >
                        <b>RATE / UNIT</b>
                    </td>
                    '.$discount_title.'
                    
                    <td width="7.333333333%" style="text-align:center;font-size:8.8px;">
                    <b>QTY</b>
                    </td>
                    <td width="7.333333333%" style="text-align:center;font-size:8.8px;">
                    <b>UOM</b>
                    </td>

                    '.$part_titel.'
                    <td width="12.333333333%" style="text-align:center;font-size:8.8px;">
                        <b>TOTAL AMOUNT (Rs)</b>
                    </td>
                </tr>    
            </tbody>
        </table>';
            $footer_html  = '
            <style>
             
            th, td {
                    
                font-family: "Poppins", sans-serif;
                line-height: 1.4
            }
           </style>
            <table cellspacing="0" cellpadding="4" border="1">
                        <tr>
                            <td width="55%" style="text-left:center;font-size:10.3px;" rowspan="2">&nbsp;&nbsp;<b> Payment Days : </b> ' . $payment_days . ' days after GRN clearance <br>
                                <b> Payment Terms : </b> ' . $payment_terms . ' days after GRN clearance </td>
                            <td width="26.3%" style="text-align:left;font-size:10.3px;" >&nbsp;Sub Total</td>
                            <td width="18.7%" style="text-align:center;font-size:10.3px;" >' . number_format((float) $sub_total_amount, 2, '.', '') . '</td>
                        </tr>
                        <tr>
                            <td width="26.3%" style="text-align:left;font-size:10.3px;" >&nbsp;Loading / Unloading charges</td>
                            <td width="18.7%" style="text-align:center;font-size:10.3px;" >' . number_format((float) $new_po_data[0]->loading_unloading, 2, '.', '') . '</td>
                        </tr>
                        <tr>
                            <td width="55%" style="text-align:left;font-size:8px;" rowspan="11">'.$notes.' </td>
                             <td width="26.3%" style="text-align:left;font-size:10.3px;" >&nbsp;P&F Charges</td>
                            <td width="18.7%" style="text-align:center;font-size:10.3px;" >' . number_format((float) $new_po_data[0]->freight_amount, 2, '.', '') . '</td>
                        </tr>
                        
                        '.$discount_amount_after_subtotal.$footer_gst.'
                        <tr>
                            
                            <td width="26.3%" style="text-align:left;font-size:10.3px;" >&nbsp;TCS Amount</td>
                            <td width="18.7%" style="text-align:center;font-size:10.3px;" >' . number_format((float) $tcs_amount, 2, '.', '') . '</td>
                        </tr>
                       
                        <tr>
                            <td width="26.3%" style="text-align:left;font-size:10.3px;" ><b>&nbsp;GRAND TOTAL</b></td>
                            <td width="18.7%" style="text-align:center;font-size:10.3px;" >' . number_format((float) $final_final_amount, 2, '.', '') . '</td>
                        </tr>
                        '.$gst_block_html.'
                        <tr>
                            <td width="45%" style="text-align:center;font-size:10.3px;" >
                                <table cellspacing="0" cellpadding="0" border="0">
                                    <tr>
                                        <td width="100%" style="text-align:center;font-size:10.6px;" ><b>'.$this->getCustomerNameDetails().' </b></td>
                                    </tr>
                                    <tr>
                                        <td width="100%" style="text-align:center;font-size:10.6px;" >&nbsp;&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="100%" style="text-align:center;font-size:10.6px;" >&nbsp;&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="100%" style="text-align:center;font-size:10.6px;" >&nbsp;&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="100%" style="text-align:center;font-size:10.6px;" >&nbsp;&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="100%" style="text-align:center;font-size:10.6px;" >&nbsp;&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td width="100%" style="text-align:center;font-size:10.6px;" >Authorised Signatory </td>
                                    </tr>

                                </table>
                            </td>
                            
                        </tr>
            </table>
            ';
            // pr($data,1);
            // unset($data['part_arr'][0][1]);
            $html_content = $this->smarty->fetch('purchase/po_generate_pdf.tpl', $data, TRUE);
            // pr($html_content,1);
            // $pdf = new Pdf1(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new Pdf1('P', 'mm', 'A4', true, 'UTF-8', false,'',$header_html,$footer_html,4, -83.8);

            $pdf->SetMargins(5, 103.6, 5, 5);

        // set document information

        $pdf->SetCreator(PDF_CREATOR);

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        // set margins
        // $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT,0);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // add a page
        $pdf->AddPage();

        // set some text to print
        // $html = file_get_contents('path_to_html_file.html'); // Load your HTML content

        // output the HTML content
        $pdf->writeHTML($html_content, true, false, true, false, '');

        //Close and output PDF document
        $pdf->Output('po-'.$new_po_data[0]->po_number.'.pdf', 'D');
        ob_end_flush();
        
    }


    public function download_my_pdf_inspection_report()
    {
        $child_part_id = $this->uri->segment('2');
        $po_id = $this->uri->segment('3');
        $supplier_id = $this->uri->segment('4');
        $inwarding_id = $this->uri->segment('5');
        $accepted_qty = $this->uri->segment('6');
        $rejected_qty = $this->uri->segment('7');
        $child_part_id_table = $this->uri->segment('8');

        $child_part_query =  $this->db->query("
            SELECT c.*,cp.grade as grade
            FROM child_part_master as c
            LEFT JOIN child_part as cp ON cp.id = c.child_part_id
            WHERE c.id = '$child_part_id'
            AND c.admin_approve = 'accept'
            ORDER BY c.id DESC
        ");
        $data['child_part'] = $child_part_query->result();
        $inwarding_data = $this->Crud->get_data_by_id("inwarding", $inwarding_id, "id");
        $data['inwarding_data'] = $inwarding_data;

        $invoice_number = $inwarding_data[0]->invoice_number;
        $raw_material_inspection_master_query = $this->db->query("
            SELECT rmi.*,rmir.*
            FROM raw_material_inspection_master as rmi
            JOIN raw_material_inspection_report as rmir ON rmir.raw_material_inspection_master_id = rmi.id AND rmir.invoice_number = '$invoice_number'
            WHERE rmi.child_part_id = '$child_part_id_table'
            ORDER BY rmi.`id` DESC 
        ");
        $data['raw_material_inspection_master'] = $raw_material_inspection_master_query->result();

        // pr($data['raw_material_inspection_master'],1);
        
        
        // $data['raw_material_inspection_master'][9] = $data['raw_material_inspection_master'][0];
        // $data['raw_material_inspection_master'][10] = $data['raw_material_inspection_master'][0];
        // $data['raw_material_inspection_master'][11] = $data['raw_material_inspection_master'][0];

        $arr = array(
            'inwarding_id' => $inwarding_id,
            'part_id' => $child_part_id_table,
            'po_number' => $po_id,
            'invoice_number' => $inwarding_data[0]->invoice_number,
        );
        $grn_details_data = $this->Crud->get_data_by_id_multiple("grn_details", $arr);
        $data['lot_qty'] = $grn_details_data[0]->verified_qty;
        // $raw_material_inspection_master = $this->Crud->get_data_by_id("raw_material_inspection_master", $child_part_id_table, "child_part_id");
        // pr($this->db->last_query());
        $data['client_data'] = $this->Unit->getClientUnitDetails();
        

        $new_po_data = $this->Crud->get_data_by_id("new_po", $po_id, "id");
        // print_r($new_po_data);
        // echo "<br>";
        $data['supplier_data'] = $this->Crud->get_data_by_id("supplier", $supplier_id, "id");
        $data['inwardDocNumber'] = $this->inwardDocNumber();
        $data['inwardDocDate'] = $this->inwardDocDate();
        $data['inwardDocRevision'] = $this->inwardDocRevision();
       
        // print_r($supplier_data);
        // echo "<br>";
        // $po_parts_data = $this->Crud->get_data_by_id("po_parts", $new_po_data[0]->id, "po_id");
        // print_r($po_parts_data);
        // echo "<br>";
        $parts_html = "";
        $final_total = 0;
        $cgst_amount = 0;
        $sgst_amount = 0;
        $igst_amount = 0;
        $tcs_amount = 0;
        $with_in_state = "";
        $i = 1;

        $loading_unloading_gst = $this->Crud->get_data_by_id("gst_structure", $new_po_data[0]->loading_unloading_gst, "id");
        $freight_amount_gst = $this->Crud->get_data_by_id("gst_structure", $new_po_data[0]->freight_amount_gst, "id");

        if (!empty($loading_unloading_gst)) {
            $loading_cgst_amount = ($loading_unloading_gst[0]->cgst * $new_po_data[0]->loading_unloading) / 100;
            $loading_sgst_amount = ($loading_unloading_gst[0]->sgst * $new_po_data[0]->loading_unloading) / 100;
            $loading_igst_amount = ($loading_unloading_gst[0]->igst * $new_po_data[0]->loading_unloading) / 100;

            $cgst_amount = $loading_cgst_amount;
            $sgst_amount = $loading_sgst_amount;
            $igst_amount = $loading_igst_amount;
        }
        if (!empty($freight_amount_gst)) {
            $freight_cgst_amount_ = ($freight_amount_gst[0]->cgst * $new_po_data[0]->freight_amount) / 100;

            $freight_sgst_cgst = ($freight_amount_gst[0]->sgst * $new_po_data[0]->freight_amount) / 100;

            $freight_igst_cgst = ($freight_amount_gst[0]->igst * $new_po_data[0]->freight_amount) / 100;

            $cgst_amount = $cgst_amount + $freight_cgst_amount_;
            $sgst_amount = $sgst_amount + $freight_sgst_cgst;
            $igst_amount = $igst_amount + $freight_igst_cgst;
        }
       
        ob_start();
        $header_html =  '

        <table cellspacing="0" cellpadding="4" border="1">
                    <tr>
                        <td width="20%" style="text-align:center;font-size:14.8px;vertical-align:middle" rowspan="3">&nbsp;&nbsp;<br><b>'.$data["client_data"][0]->client_name.'</b></td>
                        <td width="60%" style="text-align:center;font-size:14.8px;" rowspan="3">&nbsp;&nbsp;<br><b>INWARD INSPECTION REPORT</b></td>
                        <td width="20%" style="text-align:left;font-size:14.8px;" ><b>&nbsp;&nbsp;Format No : '.$data["inwardDocNumber"].'</b></td>
                    </tr>
                    <tr>
                        <td width="20%" style="text-align:left;font-size:14.8px;" ><b>&nbsp;&nbsp;Rev No : '.$data["inwardDocRevision"].'</b></td>
                    </tr>
                    <tr>
                        <td width="20%" style="text-align:left;font-size:14.8px;" ><b>&nbsp;&nbsp;Rev Dt. : '.$data["inwardDocDate"].'</b></td>
                    </tr>
                    
                  </table>
                 <table cellspacing="0" cellpadding="6" border="1">
                    <tr>
                        <td width="20%" style="text-align:center;padding:20px;font-size:15px;" >Supplier Name</td>
                        <td width="26%" style="text-align:center;font-size:15px;height:50px;">'.$data["supplier_data"][0]->supplier_name.'</td>
                        <td width="18%" style="text-align:center;font-size:15px;">Part No & Description</td>
                        <td width="36%" style="text-align:center;font-size:15px;padding:20px;height:50px;" colspan="3">'.$data["child_part"][0]->part_number." / ".$data["child_part"][0]->part_description .'</td>
                        
                    </tr>
                    <tr>
                        <td width="20%" style="text-align:center;padding:20px;font-size:15px;" >Invoice No </td>
                        <td width="26%" style="text-align:center;font-size:15px;">'.$data["inwarding_data"][0]->invoice_number.'</td>
                        <td width="18%" style="text-align:center;font-size:15px;">Invoice Date</td>
                        <td width="18%" style="text-align:center;padding:20px;font-size:15px;" colspan="2">'.$data["inwarding_data"][0]->invoice_date.'</td>
                        <td width="9%" style="text-align:center;padding:20px;font-size:15px;" colspan="2">Lot Qty</td>
                        <td width="9%" style="text-align:center;padding:20px;font-size:15px;" colspan="2">'.$data["lot_qty"].'</td>
                        
                    </tr>
                    <tr>
                        <td width="20%" style="text-align:center;padding:20px;font-size:15px;" >Material Garde  </td>
                        <td width="26%" style="text-align:center;font-size:15px;">'.$data["child_part"][0]->grade.'</td>
                        <td width="18%" style="text-align:center;font-size:15px;">Inspection Date</td>
                        <td width="18%" style="text-align:center;padding:20px;font-size:15px;" colspan="2"></td>
                        <td width="9%" style="text-align:center;padding:20px;font-size:15px;" colspan="2">Rej Qty</td>
                        <td width="9%" style="text-align:center;padding:20px;font-size:15px;" colspan="2"></td>
                        
                    </tr>   
                    
                  </table>
                  <table cellspacing="0" cellpadding="6" border="1">
                    
                    <tr>
                        <td width="7%" style="text-align:center;padding:20px;font-size:15px;" >SR NO </td>
                        <td width="13%" style="text-align:center;padding:20px;font-size:15px;" >PARAMETER </td>
                        <td width="13%" style="text-align:center;font-size:15px;">SPECIFICATION</td>
                        <td width="13%" style="text-align:center;font-size:15px;">MEASUREMENT
TECHNIQUE </td>
                        <td width="9%" style="text-align:center;font-size:15px;">OBV-1</td>
                        <td width="9%" style="text-align:center;font-size:15px;">OBV-2</td>
                        <td width="9%" style="text-align:center;padding:20px;font-size:15px;" colspan="2">OBV-3</td>
                        <td width="9%" style="text-align:center;padding:20px;font-size:15px;" colspan="2">OBV-4</td>
                        <td width="9%" style="text-align:center;padding:20px;font-size:15px;" colspan="2">OBV-5</td>
                        <td width="9%" style="text-align:center;padding:20px;font-size:15px;" colspan="2">REMARKS</td>
                        
                    </tr>
                      
                    
                  </table>';
        $footer_html  = '

        <table cellspacing="0" cellpadding="9" border="1">
                    <tr>
                        <td width="40%" style="text-align:left;font-size:14.8px;" >Sampling Plan : As per IS0 2500</td>
                       <td width="60%" style="text-align:left;font-size:14.8px;" >Sampling Qty :</td>
                    </tr>
                    <tr>
                        <td width="100%" style="text-align:left;font-size:14.8px;" ><b>&nbsp;&nbsp;Inspected By :</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Verified By :</b></td>

                    </tr>
                    
                  </table>';

        $html_content = $this->smarty->fetch('quality/inward_inspection_pdf.tpl', $data, TRUE);
        
        // $pdf = new Pdf1(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $pdf = new Pdf1('L', 'mm', 'A4', true, 'UTF-8', false,'',$header_html,$footer_html,2.3,-24.8);

        $pdf->SetMargins(5, 70, 5, 5);

    // set document information

    $pdf->SetCreator(PDF_CREATOR);

    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    // set margins
    // $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT,0);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    // add a page
    $pdf->AddPage();

    // set some text to print
    $html = file_get_contents('path_to_html_file.html'); // Load your HTML content

    // output the HTML content
    $pdf->writeHTML($html_content, true, false, true, false, '');

    //Close and output PDF document
    $pdf->Output('inspection_report.pdf', 'D');
        ob_end_flush();
        // // pr($html_content,1);
        // $this->pdf->set_paper('A4', 'landscape');
        // $this->pdf->loadHtml($html_content);
        // $this->pdf->render();
        // $this->pdf->stream("inspection-report.pdf", array("Attachment" => 1));
    }

    public function print_sales_invoice()
    {
        $action = $_POST['action'];
        $configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
        $digitalSignature = "No";
        if(isset($configuration['digitalSignature'])){
            if($configuration['digitalSignature'] == "Yes"){
               $digitalSignature = "Yes"; 
            }


        }
        $new_sales_id = $this->uri->segment('2');
        if (isset($_POST['interests']) && is_array($_POST['interests'])) {
            $selectedInterests = $_POST['interests'];
            if (count($selectedInterests) === 0) {
                echo "No options selected.";
            } else {
                $html_content_header = '
        <html>
        <head>
    <style>
              html { margin: 15px }
              th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding-top: 1px;
                padding-bottom: 1px;
                padding-left: 5px;
                //padding-right: 4px;
                font-family: Poppins, sans-serif; 
                line-height: 1 
            }
            tr.part-box th,tr.part-box td {
                padding: 2px;
            }
          </style>
          <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap" >

</head>
          <body>
          ';
                $html_content_full = [];
                $html_content_full_html = "";
                    $isEinvoicePresent = false;
                    $einvoice_data = $this->Crud->get_data_by_id("einvoice_res", $new_sales_id, "new_sales_id");
                    $new_sales_data = $this->Crud->get_data_by_id("new_sales", $new_sales_id, "id");

                    if (!empty($einvoice_data[0]->Irn)) {
                        $isEinvoicePresent = true;
                    }
                    $file_names = [];
                    foreach ($selectedInterests as $interest) {
                        
                        $html_content_full_data = $html_content_full[] = $this->for_print_download_generate_sales_invoice($interest, $new_sales_id,$configuration);
                        $file_names[] = $this->generatePdf($html_content_full_data['middle_Content'],$html_content_full_data['heder_content'],$html_content_full_data['footer_content'],$interest,"",$html_content_full_data['extra_condition']);
                        
                    }
                   
                    require_once FCPATH.'fpdf/fpdf.php';
                    require_once  FCPATH.'fpdi/FPDI-2.3.7/src/autoload.php';
                    require_once  FCPATH.'fpdi/FPDI-2.3.7/src/Fpdi.php';

                    // pr(FCPATH,1);
                    // Create new FPDI instance
                    $pdf = new FPDI();

                    foreach ($file_names as $key => $value) {
                        $pageCount = $pdf->setSourceFile($value);
                        for ($pageNo = 1; $pageNo <= $pageCount; $pageNo++) {
                            $templateId = $pdf->importPage($pageNo);
                            $size = $pdf->getTemplateSize($templateId);

                            $pdf->AddPage($size['orientation'], $size);
                            $pdf->useTemplate($templateId);
                        }
                    }
                    $copy = "salesInvoicePrint";
                    $fileName = "dist/uploads/sales_invoice_print/".$copy.".pdf";
                    $fileAbsolutePath = FCPATH.$fileName;
                    

                    // Output the new PDF
                    $pdf->Output('F', $fileAbsolutePath);

                    // generate digital signature
                    $signer = $configuration['signer'];
                    $certpwd = $configuration['certpwd'];
                    $certid = $configuration['certid'];
                    $customerPrefix = $configuration['customerPrefix'];
                    $digital_signature_url = $configuration['digital_signature_url'];
                    if($digitalSignature == "Yes"){
                        $sign_position = "[400:50]";
                        if($isEinvoicePresent){
                            $sign_position = "[400:40]";
                        }
                        digitalSignature($fileName,$sign_position,$signer,$certpwd,$certid,$customerPrefix,$digital_signature_url);
                    }
                    $fileDownloadPath = base_url().$fileName;
                    if($action == "download"){
                        $pdf_content = file_get_contents($fileDownloadPath);
                        header("Content-Type: application/pdf");
                        header("Content-Disposition: attachment; filename=".$copy. ".pdf");
                        header("Content-Length: " . strlen($pdf_content));
                        echo $pdf_content;
                        exit();
                    }else if($action == ""){
                        header("Location: ".$fileDownloadPath);
                    }
                    if($action === "email" && $configuration['enable_email_notification'] == 'Yes'){
                        $new_sales_data = $this->Crud->get_data_by_id("new_sales", $new_sales_id, "id");
                        $customer_data = $this->Crud->get_data_by_id("customer", $new_sales_data[0]->customer_id, "id");
                        $emailAddr = $customer_data[0]->emailId;
                            if(empty($emailAddr)){
                                echo "Please add email address to Customer.";
                                die;
                            }

                        $filePath = $fileName;
                        $fileName = $copy.".pdf";
                        $customer_data = $this->Crud->get_data_by_id("customer", $new_sales_data[0]->customer_id, "id");
                        
                        $toEmailAddr = $customer_data[0]->emailId;
                        $data['sales_number'] = $new_sales_data[0]->sales_number;
                        $this->email_sender($data, $toEmailAddr, $configuration, $filePath, $fileName);
                    }else{
                        echo "Something went wrong";
                    }
                    
            }
        } else {
            echo "No Options Selected.";
        }
    }
     //send this Sales pdf as attachment
    public function email_sender($data = array(), $toEmailAddr = "", $configuration = [], $filePath, $fileName)
    {
        
        $data['base_url'] = $this->config->item('base_url');
        $mail = $this->phpmailer_lib->load();
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'arominfotech.com'; // 'smtp.gmail.com'; //'smtpout.secureserver.net';          // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = $configuration['SMTPUserName']; // SMTP username
        $mail->Password = $configuration['SMTPUserPassword']; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 25; //465; //587;                       // TCP port to connect to
        $mail->From = $configuration['SMTPUserName'];
        $mail->setFrom('no-reply@arominfotech.com', $configuration['customerNameDetails']); //TO-DO :this should be client address ?
        //$mail->FromName = $configuration['customerNameDetails']."- Sales Invoice";

        //TO address
        $toEmailAddr = explode(",", $toEmailAddr);
        foreach ($toEmailAddr as $key => $value) {
            $mail->addAddress($value);
        }

        $ccEmailAddr = $configuration['SalesInvoiceCCEmailAddress'];
        $ccEmailAddr = explode(",", $ccEmailAddr);
        foreach ($ccEmailAddr as $key => $value) {
            $mail->addCC($value);
        }
      
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = "Sales invoice {$data['sales_number']} from {$configuration['customerNameDetails']}"; //TO-DO : this will have client name
        if (!file_exists($filePath)) {
            echo "<script>alert('File Not Found to send! Please try again');window.close();document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            die;            
        }
        $mail->addAttachment($filePath, $fileName); // Attach the PDF

        $mail->Body = "Dear Sir/Madam,
          <p>Please find attached sales invoice <b>{$data['sales_number']}</b>.</p>
          <p>You may review the detailed breakdown of this invoice in the attached PDF.</p>
          <p>For any questions, feel free to reach out to us.</p>
          <br><p>With Regards,<br>{$configuration['customerNameDetails']}<br></p>
          <br><br><br><br>
          <p><small>Powered By <br>
          <a href='https://arominfotech.net'>AROM Infotech</a><small></p>";

        //pr($mail->send(),1);
        if (!$mail->send()) {

            echo "<script>alert('Failed to send email. <br>Mailer Error: ".$mail->ErrorInfo." Please try again.');window.close();document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            die;
        } else {

            echo "<script>alert('Message has been sent.');window.close();document.location='" . $_SERVER['HTTP_REFERER'] . "'</script>";
            die;
        }
    }

    /*
    public function test_pdf_loop(){
    $html = "<html>
    <head>
    <style type='text/css'>

    </style>
    </head>
    <body>";

    for($i=0;$i<5;$i++)
    {
    $html .= '<div style="page-break-after: always;"><p>Hello World! Page-.'.$i.'</p></div>';
    }
    $html .= '</body></html>';

    //  $dompdf = new DOMPDF();
    //$dompdf->load_html($html);

    $this->pdf->loadHtml($html);
    $this->pdf->render();
    $this->pdf->stream("Test_sales-report.pdf", array("Attachment" => 1));

    //$dompdf->render();
    //$dompdf->stream("Admit card.pdf",array("Attachment"=>0));
    //$dompdf->clear();
    } */



    public function for_print_download_generate_sales_invoice($copy = null, $new_sales_id = null,$configuration = [])
    {
        $downloadPDF = false;
        // pr($configuration,1);
        if (!isset($copy)) {
            $copy = $this->uri->segment('3');
        }
        if (!isset($new_sales_id)) {
            $new_sales_id = $this->uri->segment('2');
        }

        $new_sales_data = $this->Crud->get_data_by_id("new_sales", $new_sales_id, "id");

        $customer_data = $this->Crud->get_data_by_id("customer", $new_sales_data[0]->customer_id, "id");

        //get client data based on unit selection
        $client_data = $this->Crud->get_data_by_id("client", $new_sales_data[0]->clientId, "id");
        //get shipping details based on new sales data like customer or consignee address..
        $shipping_data = $this->getShippingDetails($new_sales_data, $customer_data);

        $einvoice_data = $this->Crud->get_data_by_id("einvoice_res", $new_sales_id, "new_sales_id");

        $transporter_data = $this->Crud->get_data_by_id("transporter", $new_sales_data[0]->transporter_id, "id");
        $po_parts_data = $this->Crud->get_data_by_id("sales_parts", $new_sales_id, "sales_id");
        $parts_html = '<style>
   .page-break { page-break-before: always; }
   body {
   line-height: 70px; /* Adjust this value for desired line spacing */
   }
</style><table cellspacing="0" cellpadding="1"   border="1">
        <tbody>';
        $final_total = 0;
        $cgst_amount = 0;
        $sgst_amount = 0;
        $igst_amount = 0;
        $tcs_amount = 0;
        $height = "350px";

        $i = 1;
        $itemCdPresent = false;


        /* per page count */
        // $einvoice_data[0]->Irn = "ds";
        $font_size ="11.59";
        // pr($einvoice_data,1);
        // $new_sales_data[0]->discountType = "tte";
        $height_of_each_row = 53.6;
        $type_pdf = "Normal";
        if (!empty($einvoice_data[0]->Irn) || $new_sales_data[0]->discountType!='NA') {
             $font_size ="11.4";
            if(!empty($einvoice_data[0]->Irn) && $new_sales_data[0]->discountType!='NA'){
                $page_count = "5";
                $height_of_each_row = 51.6;
                $type_pdf = "Both";
            }else if(!empty($einvoice_data[0]->Irn)){
                $page_count = "5";
                $height_of_each_row = 53.6;
                $type_pdf = "Invoice";
            }else{
                $page_count = "5";
                $height_of_each_row = 53.6;
                $type_pdf = "Discount";
            }
        }else{
            $page_count = "5";
        }
        
        $page_row_count = 1;
        // unset($po_parts_data[0]);
        // $po_parts_data[] = $po_parts_data[0];
        // $po_parts_data[] = $po_parts_data[0];
        // $po_parts_data[] = $po_parts_data[0];
        // $po_parts_data[] = $po_parts_data[0];
        // $po_parts_data[] = $po_parts_data[0];
        // $po_parts_data[] = $po_parts_data[0];
        foreach ($po_parts_data as $p) {

            $child_part_data = $this->Crud->get_data_by_id("customer_part", $p->part_id, "id");
            $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");
            $payment_terms = "";
            $hsn_code = $child_part_data[0]->hsn_code;
            $packaging_qty = $child_part_data[0]->packaging_qty;

            $packSize = $this->Common_admin_model->calculateAllFactorsForSticker($p->qty, $packaging_qty);

            if ((int) $gst_structure_data[0]->igst === 0) {
                $gst = (float) $gst_structure_data[0]->cgst + (float) $gst_structure_data[0]->sgst;
                $cgst = (float) $gst_structure_data[0]->cgst;
                $sgst = (float) $gst_structure_data[0]->sgst;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $igst = 0;
                $total_gst_percentage = $cgst + $sgst;
            } else {
                $gst = (float) $gst_structure_data[0]->igst;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $cgst = 0;
                $sgst = 0;
                $igst = $gst;
                $total_gst_percentage = $igst;
            }

            $subtotal = $p->total_rate - $p->gst_amount;
            $final_basic_total = $final_basic_total + $subtotal;

            $rate = round($subtotal / $p->qty, 2);
            $db_part_price = $p->part_price;
            if ($db_part_price > 0) {
                $rate = $db_part_price;
            }
            $row_total = (float) $p->total_rate + (float) $p->tcs_amount;
            $final_po_amount = (float) $final_po_amount + (float) $row_total;

            $gst_amount = ($gst * $rate) / 100;
            $part_total = $rate * $p->qty;
            $final_amount = $gst_amount + $rate;
            $final_row_amount = $final_amount * $p->qty;

            $total_amount = $p->qty * $rate;
            $final_total = $final_total + $total_amount;
            $cgst_amount = $cgst_amount + $p->cgst_amount;
            $sgst_amount = $sgst_amount + $p->sgst_amount;
            $igst_amount = $igst_amount + $p->igst_amount;
            $tcs_amount = $tcs_amount + $p->tcs_amount;
            
            // pr($packSize,1);
            $packagingQtyFactors = '';
            if ($packaging_qty > 0) {
                foreach ($packSize as $key=>$factor) {
                    $packagingQtyFactorsTemp = $factor['factor'] . ' X ' . $factor['count'] . '';
                    if($key == 0 && count($packSize) > 1){
                        $packagingQtyFactorsTemp .= "<br>";
                    }
                    $packagingQtyFactors = $packagingQtyFactors . $packagingQtyFactorsTemp;
                }
            }
            $packing_lenght = "20px";
            if(strlen($packagingQtyFactors) <= 11){
                $packing_lenght = "40px";
            }

            $custItemCd = $child_part_data[0]->itemCode;
            if(!empty($custItemCd)) {
                $custItemCd = "<b> <u><span style='background-color: lightgray;'>Item Code - ".$custItemCd."</span></u></b>";
                $itemCdPresent = true;
            }
            $parts_html .= '
        <tr style="font-size:11px;" class="part-box">   
         <td width="4%" style="text-align:center;line-height:40px;">' . $i . '</td>
         <td width="37.33%" style="text-align:left;line-height:1.4;height:'.$height_of_each_row.'px;font-size:10.5px;"> 
         <table cellpadding="0">
                <tr>
                <td>'.$child_part_data[0]->part_description .'<b style="width:800px !important;"><br>Part No - ' . wordwrap($child_part_data[0]->part_number, 12, "\n", true) .' '.$custItemCd.'</b>
                </td>
                </tr>
                </table>
         </td>
         <td width="8.66%" style="text-align:center;line-height:40px;font-size:11px;">' . $hsn_code . '</td>
         <td width="9.6%" style="text-align:center;line-height:'.$packing_lenght.';font-size:11px;"><span >' . $packagingQtyFactors . '</span></td>
         <td width="7%" style="text-align:center;line-height:40px;font-size:11px;">' . $p->uom_id . '</td>
         <td  width="8.33%" style="text-align:center;line-height:40px;">' . $p->qty . '</td>
         <td width="12.5%" style="text-align:center;line-height:40px;">' . $rate . '</td>
         <td width="12.6%" colspan="2" style="text-align:center;line-height:40px;">' . number_format($part_total, 2, '.', '') . '</td>
       </tr>
     ';
     
        // pr(count($po_parts_data).":".$page_row_count);

         if(count($po_parts_data) < $page_row_count+1){
            $parts_html .='</tbody></table><table cellspacing="0" cellpadding="1"   border="1">
            <tbody>';
         }else if($page_row_count%$page_count == 0 ){
                $parts_html .='</tbody></table><br pagebreak="true"/><table cellspacing="0" cellpadding="1"   border="1">
            <tbody>';
               
            }
         $page_row_count++;
         $i++;
        
          
        }

        $remaining_row = $page_count - count($po_parts_data) % $page_count;
       
        if( $remaining_row != 0 && (count($po_parts_data) % $page_count != 0)){
            if($type_pdf == "Normal"){
            // pr($remaining_row,1);
                switch ($remaining_row) {
                    case '6':
                       $height = 259.4;
                        break;
                    case '5':
                       $height = 216;
                        break;
                    case '4':
                       $height = 214;
                        break;
                    case '3':
                       $height = 160;
                        break;
                    case '2':
                       $height = 107;
                        break;
                    case '1':
                       $height = 53;
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }else if($type_pdf == "Discount"){
                switch ($remaining_row) {
                    case '6':
                       $height = 259.4;
                        break;
                    case '5':
                       $height = 216;
                        break;
                    case '4':
                       $height = 198;
                        break;
                    case '3':
                       $height = 148;
                        break;
                    case '2':
                       $height = 99;
                        break;
                    case '1':
                       $height = 49;
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }else if($type_pdf == "Both"){
                switch ($remaining_row) {
                    case '6':
                       $height = 259.4;
                        break;
                    case '5':
                       $height = 216;
                        break;
                    case '4':
                       $height = 205;
                        break;
                    case '3':
                       $height = 154;
                        break;
                    case '2':
                       $height = 103;
                        break;
                    case '1':
                       $height = 50;
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }else if($type_pdf == "Invoice"){
                switch ($remaining_row) {
                    case '6':
                       $height = 259.4;
                        break;
                    case '5':
                       $height = 216;
                        break;
                    case '4':
                       $height = 215;
                        break;
                    case '3':
                       $height = 160;
                        break;
                    case '2':
                       $height = 107;
                        break;
                    case '1':
                       $height = 53;
                        break;
                    
                    default:
                        # code...
                        break;
                }
            }

            // pr($type_pdf,1);
 
            $parts_html .='<tr style="font-size:11px;" class="part-box"><td style="height:'.$height.'px;">&nbsp;</td>
            </tr>';
            $parts_html .= '</tbody></table>';
        }



        
        

        //discount related things
        $isDiscount = false;
        
        if($new_sales_data[0]->discountType!='NA'){
                $isDiscount = true;
                $discountDetails = "";
                if($new_sales_data[0]->discountType==='Percentage'){
                    $discountDetails = $new_sales_data[0]->discount . " %";
                }              
        }

        $sales_total = $this->Crud->tax_calcuation($gst_structure_data[0], $final_basic_total, $new_sales_data[0]->discount_amount);
        $defaultColumns = "2";
        if ($isDiscount==true){
            $defaultColumns = "3";
            $discountSection =
            '<td colspan="3" style="text-align:left;margin-left:10px;"  width="22.95%;">&nbsp;&nbsp;&nbsp;DISCOUNT '.$discountDetails.'</td>
             <td colspan="2" style="text-align:center"  width="17.5%;"> (-) ' . $new_sales_data[0]->discount_amount . '</td>';
        }

        if($itemCdPresent){
            if ($i == 2) {
                $height = 240;
            } elseif ($i == 3) {
                $height = 210;
            } elseif ($i == 4) {
                $height = 155;
            } elseif ($i == 5) {
                $height = 95;
            } elseif ($i == 6) {
                $height = 50;
            } elseif ($i == 7) {
                $height = 10;
            } elseif ($i == 8) {
                $height = 0;
            } elseif ($i == 9) {
                $height = 20;
            }
        }else{

            if ($i == 2) {
                $height = 240;
            } elseif ($i == 3) {
                $height = 220;
            } elseif ($i == 4) {
                $height = 200;
            } elseif ($i == 5) {
                $height = 140;
            } elseif ($i == 6) {
                $height = 100;
            } elseif ($i == 7) {
                $height = 80;
            } elseif ($i == 8) {
                $height = 30;
            } elseif ($i == 9) {
                $height = 30;
            }
        }

       // $final_final_amount = $final_total + $cgst_amount + $sgst_amount + $igst_amount + $tcs_amount;
        $final_gst_value = $cgst_amount + $sgst_amount + $igst_amount + $tcs_amount;

        if ($new_sales_data[0]->mode == '1') {
            $md = 'Road';
        } elseif ($new_sales_data[0]->mode == '2') {
            $md = 'Rail';
        } elseif ($new_sales_data[0]->mode == '3') {
            $md = 'Air';
        } elseif ($new_sales_data[0]->mode == '4') {
            $md = 'Ship';
        }

        $isEinvoicePresent = false;
        if (!empty($einvoice_data[0]->Irn)) {
            $isEinvoicePresent = true;
        }else{
            // pr($i,1);
            if($itemCdPresent){
                if ($i == 2) {
                    $height += 30;
                } elseif ($i == 3) {
                   $height += 30;
                } elseif ($i == 4) {
                    $height += 30;
                } elseif ($i == 5) {
                    $height += 50;
                } elseif ($i == 6) {
                     $height += 50;
                } elseif ($i == 7) {
                     $height += 40;
                } elseif ($i == 8) {
                     $height += 0;
                }
                elseif ($i == 9) {
                    $height = 30;
                }
            }else{
                if ($i == 2) {
                    $height += 30;
                } elseif ($i == 3) {
                   $height += 30;
                } elseif ($i == 4) {
                    $height += 30;
                } elseif ($i == 5) {
                    $height += 50;
                } elseif ($i == 6) {
                     $height += 50;
                } elseif ($i == 7) {
                     $height += 40;
                } elseif ($i == 8) {
                     $height += 60;
                }
                elseif ($i == 9) {
                    $height = 30;
                }
            }
        }
        
        $height = $height."px";
        // pr($height,1);
        if ($isEinvoicePresent == true) {
            $file_nm = uniqid() . ".png";
            $fileName = "dist/uploads/sales_qr_code/".$file_nm;
            $fileAbsolutePath = FCPATH.$fileName;
            // Assuming $einvoice_data[0]->SignedQRCode contains your data
            $signedQRCodeData = $einvoice_data[0]->SignedQRCode;
            // Start output buffering
            ob_start();
            // Generate QR Code and output directly to the buffer
            QRcode::png($signedQRCodeData, $fileAbsolutePath, QR_ECLEVEL_L, 3, 2);
            // Get the buffered content as a string
            $qrCodeImageString = ob_get_contents();
            $qrCodeImageString = base_url().$fileName;
            // End and clean the buffer
            ob_end_clean();
        }

        // pr($qrCodeImageString,1);
        $company_logo = "";
        $company_logo_enable = "No";
        $row_col_span = '100';
        if(isset($configuration['companyLogoEnable']) && isset($configuration['companyLogo'])){
            if($configuration['companyLogoEnable'] == 'Yes' && $configuration['companyLogo'] != ''){
                 $company_logo = $configuration['companyLogo'];
                $company_logo_enable = "Yes";

                $company_logo = '<th  rowspan="3" style="width:20%;text-align:right;font-size:9px;padding:0px;text-align: center;">
                <br><br>
              <img src="'.base_url('').'/dist/img/company_logo/'.$company_logo.'"  style="width: 60px;padding: 0px;height:55px;">
           </th>';
                $row_col_span = '80';
            }
        }

        // pr($company_logo,1);
        $html_content =
        '
        <style>
             
            th, td ,b{ 
                font-family: "Poppins", sans-serif;
                line-height: 1.8;
                padding: 10px;
                margin: 10px;
            }
            table {
                padding: 0px;
            }

           </style>
        <table cellspacing="0" cellpadding="1"   border="1">
        <tbody>
        <tr >
           '.$company_logo.'
           
           <th style="width:'.$row_col_span.'%;text-align:right;font-size:9px;padding:0px;border-bottom: 1px solid black;">
              <b> ' . $copy . '</b>
           </th>
        </tr>
        <tr>
           <th style="text-align:center; font-size:13px;padding:6px;border-bottom: 0px solid black;">
              <b>TAX INVOICE</b>
           </th>
        </tr>
        <tr>
           <!-- Company Details -->
           <th style="font-size:9.4px;text-align:center;padding:5pxwidth:20%;border-top: 0px solid white;border-bottom: 1px solid black;">
              <b style="font-size:20px;margin-top:-100px;">' . $client_data[0]->client_name . '</b><br>
              <b><span>' . $client_data[0]->billing_address . '</span></b>
           </th>
        </tr>';
        
        if ($isEinvoicePresent == true) {
            $html_invoice_details = '
            <tr style="font-size:'.$font_size.'px" style="border-right-style:none;">
              <td width="50%" style="height:110px;">
                <b> PAN NO : </b> ' . $client_data[0]->pan_no . '<br>
                <b> GST NO : </b>' . $client_data[0]->gst_number . '<br>
                <b> STATE : </b> ' . $client_data[0]->state . '<br>
                <b> STATE CODE: </b> ' . $client_data[0]->state_no . '<br>
                <b> VENDOR CODE : </b>' . $customer_data[0]->vendor_code . '<br>
              </td>
              <td width="29%" style="height:110px;">
                <span style="font-size:'.$font_size.'px;"><b>INVOICE NO :&nbsp;&nbsp;' . $new_sales_data[0]->sales_number . '</b></span><br>
                <b>INVOICE DATE :</b> ' . $new_sales_data[0]->created_date . '<br>
                <b>PO NUMBER : </b>' . $po_parts_data[0]->po_number . '<br>
                <b>PO DATE : </b>' . defaultDateFormat($po_parts_data[0]->po_date) . '<br>
                <span style="font-size:8px">WHETHER TAX ON REVERSE CHARGE: NO</span>
              </td>
              <td width="20.9%" style="align-items:center;padding-top:5px;height:110px;" >
                  <img width="100em" height="80em" src="'.$qrCodeImageString.'" alt="QR Code">
                  <!-- <img width="100em" height="80em" src="http://localhost/extra_work/erp_converted/dist/uploads/ewayBill/231893735083.png" alt="QR Code"> -->
                 
                     <!--<img width="140em" height="100px" src="data:image/png;base64,' . base64_encode($qrCodeImageString) . '" alt="QR Code" alt="QR Code" width="140" height="100"> -->
              </td>
            </tr>
            <tr>
              <td width="100%" style="font-size:'.$font_size.'px;padding-top: 4px;height:10px;">
                <span><b>&nbsp;IRN No:</b> ' . $einvoice_data[0]->Irn . '<br>  </span>
                <span><b>&nbsp;ACK No:</b> ' . $einvoice_data[0]->AckNo . '</span>
                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> &nbsp;ACK Date/Time :</b> ' . $einvoice_data[0]->AckDt . '</span>
                <span style="text-align:right;">&nbsp;&nbsp;<b> &nbsp;EWAY-BILL NO :</b> ' . $einvoice_data[0]->EwbNo . '</span>
              </td>
            </tr>';
        } else {
            $html_invoice_details = '<tr style="font-size:'.$font_size.'px; ">
        <td width="50%" style="height:110px;" >
          <b>PAN NO : </b> ' . $client_data[0]->pan_no . '<br>
          <b>GST NO : </b>' . $client_data[0]->gst_number . '<br>
          <b>STATE : </b> ' . $client_data[0]->state . '<br>
          <b>STATE CODE : </b> ' . $client_data[0]->state_no . '<br>
          <b>VENDOR CODE : </b>' . $customer_data[0]->vendor_code . '<br>
        </td>
        <td width="50%" style="height:110px;">
          <span style="font-size:13px;"><b>INVOICE NO :&nbsp;&nbsp;' . $new_sales_data[0]->sales_number . '</b></span><br>
          <b>INVOICE DATE :</b> ' . $new_sales_data[0]->created_date . '<br>
          <b>PO NO : </b>' . $po_parts_data[0]->po_number . '<br>
          <b>PO DATE : </b>' . defaultDateFormat($po_parts_data[0]->po_date) . '<br>
          <b>TIME OF SUPPLY :</b> ' . $new_sales_data[0]->created_time . '<br>
          <span style="font-size:8px">WHETHER TAX ON REVERSE CHARGE: NO</span>
        </td>
        </tr>';
        }

        $html_content = $html_content . $html_invoice_details .
        '<tr style="font-size:'.$font_size.'px; " >
            <td width="50%" style="padding-top: 4px;height:138px;">
            <table cellspacing="0" cellpadding="0"   border="0" >
                <tr>
                <td style="padding-top: 4px;line-height:1.5;"><b>Details of Receiver (Billed To)</b><br><b>'. $customer_data[0]->customer_name .'</b><br>' . $customer_data[0]->billing_address . '<br><b>STATE :</b> ' . $customer_data[0]->state . '&nbsp;&nbsp;<b> &nbsp;STATE CODE :</b> ' . $customer_data[0]->state_no . '<br><b>PAN NO : </b>' . $customer_data[0]->pan_no . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>GST NO :</b> ' . $customer_data[0]->gst_number . '
                </td>
                </tr>
            </table>
            </td>
            <td width="50%" style="padding-top: 4px;height:138px;">
            <table cellspacing="0" cellpadding="0"   border="0" >
                <tr>
                <td style="padding-top: 4px;line-height:1.5;"><b>Details of Consignee (Shipped to)</b><br><b>' . $shipping_data['shipping_name'] . '</b><br>' . $shipping_data['ship_address'] . '<br><b>STATE : </b>' . $shipping_data['state'] . '&nbsp;&nbsp;<b> &nbsp;STATE CODE :</b> ' . $shipping_data['state_no'] . '<br><b>PAN NO : </b>' . $shipping_data['pan_no'] . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>GST NO : </b>' . $shipping_data['gst_number'] . '
                </td>
                </tr>
            </table>
            </td>
         </tr>
         <tr style="font-size:'.$font_size.'px;text-align:center;" width="100%">
          <td width="4%" ><b>Sr No</b></td>
          <td width="37.33%" style="text-align:left;"><b>&nbsp;Part Description</b></td>
          <td width="8.66%"><b>HSN / SAC</b> </td>
          <td width="9.6%;font-size:10.5px"><b>Packing</b></td>
          <td width="7%"><b>UOM</b></td>
          <td width="8.33%"><b>QTY</b></td>
          <td width="12.5%"><b>Rate</b></td>
          <td width="12.6%"><b>Amount (Rs)</b></td>
        </tr>
         </tbody>
        </table>
         
           ' ;
        // pr($html_content,1);
        $heder_html = $html_content;
        

        $footer_content = '
        <style>
             
              th, td ,b{ 
                font-family: "Poppins", sans-serif;
                line-height: 1.2;
                
            }
            table {
                padding: 0px;
            }


           </style>
        <table cellspacing="0" cellpadding="5"   border="1">
        <tbody>
            <tr style="font-size:'.$font_size.'px;">
                <td colspan="12">Remark : '.$new_sales_data[0]->remark.'</td>
           </tr>
           <tr style="font-size:'.$font_size.'px;">
                <td rowspan="'.$defaultColumns.'" colspan="7" width="59.60%;" style="line-height:19px;">
                    <b>&nbsp;Mode Of Transport : </b>' . $md . '&nbsp;&nbsp;&nbsp;&nbsp;<b>&nbsp;Vehicle No : </b>' . $new_sales_data[0]->vehicle_number . '&nbsp;&nbsp;&nbsp;&nbsp;<b><br><b>&nbsp;&nbsp;&nbsp;Transporter : </b>' . $transporter_data[0]->transporter_id . '&nbsp;&nbsp;&nbsp;L.R No : </b>' . $new_sales_data[0]->lr_number . '
                    
                </td>';
        
            if($isDiscount==true) {
                 $footer_content .=$discountSection.'
                 </tr><tr style="font-size:10px">';
            }
           
            $footer_content .='
                    <td colspan="3" style="text-align:left;margin-left:10px;" width="22.95%;">&nbsp;&nbsp;&nbsp;TAXABLE VALUE</td>
                    <td colspan="2" style="text-align:center" width="17.4%">' . $final_basic_total . '</td>
           </tr>
           <tr style="font-size:11.5px">
                <td colspan="3" style="text-align:left">&nbsp;&nbsp;&nbsp;IGST ' . $igst . '%</td>
                <td colspan="2" style="text-align:center">' . number_format($sales_total['sales_igst'],2) . '</td>
           </tr>
           <tr style="font-size:11.5px">
           <td rowspan="5" colspan="7">
           <table cellspacing="0" cellpadding="0"  >
                <tr>
                <td style="line-height:1.2;"><b>Payment Terms : ' . $customer_data[0]->payment_terms . '</b> <br><span><b>Bank Details : </b> ' . $client_data[0]->bank_details . '</span><br><b>Electronic Reference No.</b> <br><span><b>GST Value (In Words) : </b> ' . $this->numberToWords($sales_total['sales_gst']) . '</span><br><span><b>Invoice Value (In Words) : </b> ' . $this->numberToWords($sales_total['sales_total']) . '</span>
          
          </td></tr>
            </table>
            </td>
            <td colspan="3" style="text-align:left;margin-left:10px;">&nbsp;&nbsp;&nbsp;CGST ' . $cgst . '%</td>
            <td colspan="2" style="text-align:center">' . number_format($sales_total['sales_cgst'],2). '</td>
          </tr>
          <tr style="font-size:11.5px">
            <td colspan="3" style="text-align:left;margin-left:10px;">&nbsp;&nbsp;&nbsp;SGST  ' . $sgst . '%</td>
            <td colspan="2" style="text-align:center">' . number_format($sales_total['sales_sgst'],2) . '</td>
          </tr>
          <tr style="font-size:11.5px">
            <td colspan="3" style="text-align:left">&nbsp;&nbsp;&nbsp;TCS ' . $tcs . '%</td>
            <td colspan="2" style="text-align:center">' . number_format($sales_total['sales_tcs'],2). '</td>
          </tr>
          <tr style="font-size:11.5px">
            <td colspan="3" style="text-align:left;">&nbsp;&nbsp;&nbsp;P&F Charges</td>
            <td colspan="2" style="text-align:center">' . '0.00' . '</td>
          </tr>
          <tr style="font-size:11.5px">
            <td colspan="3" style="text-align:left;font-weight: bold">&nbsp;&nbsp;&nbsp;GRAND TOTAL(Rs) </td>
            <td colspan="2" style="text-align:center;font-weight: bold;">' . number_format($sales_total['sales_total'],2) . '</td>
          </tr>';
        $digitalSignature = "No";
        $signatureImageEnable = "No";
        $signatureImageUrl= "";
        if(isset($configuration['digitalSignature']) && $configuration['digitalSignature'] == "Yes"){
               $digitalSignature = "Yes"; 
        }else if(isset($configuration['SignatureImageEnable'])){
            if($configuration['SignatureImageEnable'] == "Yes" && $configuration['SignatureImage'] != ""){
               $signatureImageEnable = "Yes"; 
               $signatureImageUrl = base_url("dist/img/signature_image/").$configuration['SignatureImage'];
            }
        }
        
        $footer_content .= $this->getFooterWithSignatureForSales($digitalSignature,$signatureImageEnable,$signatureImageUrl);
        $return_arr = [
            "heder_content" => $heder_html,
            "footer_content" => $footer_content,
            "middle_Content" => $parts_html,
            "extra_condition" => ($isEinvoicePresent && $isDiscount) ? "both" : ($isEinvoicePresent ? "e_invoicing" : ($isDiscount ? "discount" : "normal")) 
        ];
        return $return_arr;
        
        
    }
    public function generatePdf($html_content = "",$header="",$footer="",$type="",$pdf_download_type="",$extra_condition ="normal"){
        if($extra_condition == "both"){
            $meddle_content =125.9;
            $footer_content =-98.5;
            $top_margin = 5.8;
        }else if($extra_condition == "e_invoicing"){
            $meddle_content =125.9;
            $footer_content =-95.5;
            $top_margin = 5.8;
        }else if($extra_condition == "discount"){
            $meddle_content =114.9;
            $footer_content =-112.3;
            $top_margin = 7;
        }else{
            $meddle_content =114.8;
            $footer_content =-106.5;
            $top_margin = 6.8;
        }
        // pr("ok",1);
        // $header = $this->smarty->fetch('sales/sales_pdf_generate.tpl', $data, TRUE);
            // pr($html_content,1);
            // $pdf = new Pdf1(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
            $pdf = new Pdf1('P', 'mm', 'A4', true, 'UTF-8', false,'',$header,$footer,$top_margin, $footer_content);

            $pdf->SetMargins(10, $meddle_content, 8, 5);

        // set document information

        $pdf->SetCreator(PDF_CREATOR);

        // set default header data
        $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 006', PDF_HEADER_STRING);

        // set header and footer fonts
        $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
        
        // set margins
        // $pdf->SetMargins(PDF_MARGIN_LEFT, 15, PDF_MARGIN_RIGHT,0);
        $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
        $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

        // set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        // set image scale factor
        $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // add a page
        $pdf->AddPage();

        // set some text to print
        // $html = file_get_contents('path_to_html_file.html'); // Load your HTML content

        // output the HTML content
        $pdf->writeHTML($html_content, true, false, true, false, '');

        if($pdf_download_type == "I"){
            $pdf->Output($fileAbsolutePath, 'I');
             ob_end_flush();
        }else{
            //Close and output PDF document
            $fileName = "dist/uploads/sales_invoice_print/sales_invoive_".$type.".pdf";
            $fileAbsolutePath = FCPATH.$fileName;
            // pr($fileAbsolutePath,1);
            $pdf->Output($fileAbsolutePath, 'F');
             ob_end_flush();
            return $fileAbsolutePath;
        }
        
       
    } 

    /**
     * Footer details for other than sales
     */
    public function getFooterWithSignature()
    {

        $footerDetails =
        '
        <tr style="font-size:9px">
            <td colspan="6">
            <span ><p>We hereby certify that my/our registration certificate under the Goods and Service Tax
                Act, 2017 is in force on the date on which the sale of the goods specified in this Tax
                invoice is made by me/us and that the transaction of sale covered by this taxinvoice has
                been effected by me/us and it shall be accounted for in the turnover of sales while filling
                of return and the due tax. If any, payable on the sale has been paid or shall be paid
                <br>
                Certified that the particulars given above are true.Interest @24% P.A. will be charged on all overdue invoices.<br>
    Subject To Pune Jurisdiction
    </p><p><br><br>
    <b>This is computer generated document. No signature required.</b>
              </p></span>
          </td>
          <td colspan="3" >
          <br>
          <br>
          <br>
          <br>
          <br>
          <br>
          <h4 style="text-align: left;margin-left:25px; font-size:11px"> Receiver Signature </h4>
          </td>
          <td colspan="3" >
          <h4 style="text-align: center;margin-right:10px; font-size:10px"> For, ' . $this->getCustomerNameDetails() . ' </h4>
          <h6 style="text-align: right">  </h6>
          <h6 style="text-align: right">  </h6>
          <h6 style="text-align: right">  </h6>
          <br>
          <br>
            <h4 style="text-align: center;margin-right:25px; font-size:11px"> Authorized Signatory </h4>
            <h6 style="text-align: right">  </h6>
          <h6 style="text-align: right">  </h6>
          </td>
        </tr>
        </table>' . $this->getFooter();
        return $footerDetails;
    }

    //download individual files...
    public function generate_sales_invoice()
    {
        
        $new_sales_id = $this->uri->segment('2');
        $copy = $this->uri->segment('3');
        // get company config data
        $criteria = []; //get only those fields which can be edited by Customers
        $configuration = $this->Crud->get_data_by_id_multiple_condition("global_configuration",$criteria);
        $configuration = array_column($configuration, "config_value","config_name");
        // pr($configuration,1);
        $company_logo = "";
        $company_logo_enable = "No";
        $row_col_span = '12';
        if(isset($configuration['companyLogoEnable']) && isset($configuration['companyLogo'])){
            if($configuration['companyLogoEnable'] == 'Yes' && $configuration['companyLogo'] != ''){
                 $company_logo = $configuration['companyLogo'];
                $company_logo_enable = "Yes";
                $company_logo = '<td width="10%" colspan="2" style="text-align:center;"><img src="'.base_url('').'/dist/img/company_logo/'.$company_logo.'"  style="width: 60px;padding: 0px;"></td>';
                $row_col_span = '10';
            }
        }
        
        $new_sales_data = $this->Crud->get_data_by_id("new_sales", $new_sales_id, "id");
        $customer_data = $this->Crud->get_data_by_id("customer", $new_sales_data[0]->customer_id, "id");

        //get client data based on unit selection
        $client_data = $this->Crud->get_data_by_id("client", $new_sales_data[0]->clientId, "id");
        //get shipping details based on new sales data like customer or consignee address..
        $shipping_data = $this->getShippingDetails($new_sales_data, $customer_data);

        $einvoice_data = $this->Crud->get_data_by_id("einvoice_res", $new_sales_id, "new_sales_id");

        $transporter_data = $this->Crud->get_data_by_id("transporter", $new_sales_data[0]->transporter_id, "id");
        $po_parts_data = $this->Crud->get_data_by_id("sales_parts", $new_sales_id, "sales_id");
        $parts_html = "";
        $final_total = 0;
        $cgst_amount = 0;
        $sgst_amount = 0;
        $igst_amount = 0;
        $tcs_amount = 0;
        $height = "350px";

        $i = 1;
        foreach ($po_parts_data as $p) {
            $child_part_data = $this->Crud->get_data_by_id("customer_part", $p->part_id, "id");
            $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $p->tax_id, "id");
            $payment_terms = "";
            $hsn_code = $child_part_data[0]->hsn_code;
            $packaging_qty = $child_part_data[0]->packaging_qty;
            $packSize = $this->Common_admin_model->calculateAllFactorsForSticker($p->qty, $packaging_qty);

            if ((int) $gst_structure_data[0]->igst === 0) {
                $gst = (float) $gst_structure_data[0]->cgst + (float) $gst_structure_data[0]->sgst;
                $cgst = (float) $gst_structure_data[0]->cgst;
                $sgst = (float) $gst_structure_data[0]->sgst;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $igst = 0;
                $total_gst_percentage = $cgst + $sgst;
            } else {
                $gst = (float) $gst_structure_data[0]->igst;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $cgst = 0;
                $sgst = 0;
                $igst = $gst;
                $total_gst_percentage = $igst;
            }

            $subtotal = $p->total_rate - $p->gst_amount;
            $rate = round($subtotal / $p->qty, 2);
            $db_part_price = $p->part_price;
            if ($db_part_price > 0) {
                $rate = $db_part_price;
            }
            $row_total = (float) $p->total_rate + (float) $p->tcs_amount;
            $final_po_amount = (float) $final_po_amount + (float) $row_total;

            $gst_amount = ($gst * $rate) / 100;
            $final_amount = $gst_amount + $rate;
            $final_row_amount = $final_amount * $p->qty;

            $total_amount = $p->qty * $rate;
            $final_total = $final_total + $total_amount;
            $cgst_amount = $cgst_amount + $p->cgst_amount;
            $sgst_amount = $sgst_amount + $p->sgst_amount;
            $igst_amount = $igst_amount + $p->igst_amount;
            $tcs_amount = $tcs_amount + $p->tcs_amount;

            $packagingQtyFactors = '';
            if ($packaging_qty > 0) {
                foreach ($packSize as $factor) {
                    $packagingQtyFactorsTemp = $factor['factor'] . ' X ' . $factor['count'] . '<br>';
                    $packagingQtyFactors = $packagingQtyFactors . $packagingQtyFactorsTemp;
                }
            }

            $custItemCd = $child_part_data[0]->itemCode;
            if(!empty($custItemCd)) {
                $custItemCd = "<b><u><span style='background-color: lightgray;'>Item Code - ".$custItemCd."</span></u></b>";
                $itemCdPresent = true;
            }

            $parts_html .= '
       <tr style="font-size:10px;">
        <td style="text-align:center;">' . $i . '</td>
        <td colspan="4" style="max-width:28px;word-wrap: break-word;text-align:left;">' . substr($child_part_data[0]->part_description, 0, 50) . '<br><b>' . wordwrap($child_part_data[0]->part_number, 12, "\n", true) .'<br>'.$custItemCd. '</b></td>
        <td style="text-align:center;">' . $hsn_code . '</td>
        <td style="text-align:center;"><span style="text-size:small">' . $packagingQtyFactors . '</span></td>
        <td style="text-align:center;">' . $p->uom_id . '</td>
        <td style="text-align:center;">' . $p->qty . '</td>
        <td style="text-align:center;">' . $rate . '</td>
        <td colspan="2" style="text-align:center;">' . number_format((float) $subtotal, 2, '.', '') . '</td>
     </tr>
    ';
            $i++;
        }

        // print_r($i); exit;

        if ($i == 2) {
            $height = "260px";
        } elseif ($i == 3) {
            $height = "220px";
        } elseif ($i == 4) {
            $height = "200px";
        } elseif ($i == 5) {
            $height = "140px";
        } elseif ($i == 6) {
            $height = "100px";
        } elseif ($i == 7) {
            $height = "80px";
        } elseif ($i == 8) {
            $height = "50px";
        }

        //$final_final_amount = $final_total + $cgst_amount + $sgst_amount + $igst_amount + $tcs_amount;
        $final_gst_value = $cgst_amount + $sgst_amount + $igst_amount + $tcs_amount;
        if ($new_sales_data[0]->mode == '1') {
            $md = 'Road';
        } elseif ($new_sales_data[0]->mode == '2') {
            $md = 'Rail';
        } elseif ($new_sales_data[0]->mode == '3') {
            $md = 'Air';
        } elseif ($new_sales_data[0]->mode == '4') {
            $md = 'Ship';
        }

        $isEinvoicePresent = false;
        if (!empty($einvoice_data[0]->Irn)) {
            $isEinvoicePresent = true;
        }

        if ($isEinvoicePresent == true) {
            $file_nm = uniqid() . ".png";
            $file_qr = './documents/qrcode/sales/' . $file_nm;

            // Assuming $einvoice_data[0]->SignedQRCode contains your data
            $signedQRCodeData = $einvoice_data[0]->SignedQRCode;
            // Start output buffering
            ob_start();
            // Generate QR Code and output directly to the buffer
            QRcode::png($signedQRCodeData, null, QR_ECLEVEL_L, 3, 2);
            // Get the buffered content as a string
            $qrCodeImageString = ob_get_contents();
            // End and clean the buffer
            ob_end_clean();
        }

        /*
        Generates QR Code and Stores it in directory given
        // $ecc stores error correction capability('L')
        $ecc = 'L';
        $pixel_Size = 10;
        $frame_size = 10;
        QRcode::png($einvoice_data[0]->SignedQRCode, $file_qr, $ecc, $pixel_Size, $frame_size);
        $imageString = file_get_contents($file_qr);
        // Convert the image string to base64
        $base64Image = base64_encode($imageString);
        // Create a data URI
        $dataUri = 'data:image/png;base64,' . $base64Image;
        echo $imageString; */

        //generate_sales_invoice
        //manojs
        $pdf_margin = "margin-right:10px;";
        if($isEinvoicePresent){
            $pdf_margin = 'margin-right:14px;';
        }
        $html_content = '
      <!DOCTYPE html>
        <style>
            html { margin: 15px}
            @media print
             {
                html, body {
                height:100%;
                margin:20px !important;
                padding:5px !important;
                overflow: hidden;
          }
        }

        th, td {
                  border: 1px solid black;
                  border-collapse: collapse;
                  padding-top: 1px;
                  padding-bottom: 1px;
                  padding-left: 5px;
                  //padding-right: 4px;
            font-family: "Poppins", sans-serif;
            line-height: 1.1
        }
       </style>

       <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&display=swap">
       </head>
       <body>
       <table cellspacing="0" border="1px" style="'.$pdf_margin.'">
        
        <tr style="font-size:11px" style="border-right-style:none;">
                '.$company_logo.'
                <td colspan="'.$row_col_span.'" style="    padding: 0px;">
                  <table cellspacing="0" border="0px" width="100%">
                    <tr>
                        <th style="border: 0px;text-align:right;font-size:9px;border-bottom: 2px solid black;padding:2px">
                        ' . $copy . '
                        </th>
                    </tr>
                    <tr>
                    <th style="border: 0px;text-align:center; font-size:13px;border-bottom: 2px solid black;padding:6px">TAX INVOICE</th>
                    </tr>
                    <tr>
                        <th style="border: 0px;font-size:9px;text-align:center;padding:5px">
                            <b style="margin-top:-100px;font-size:20px">' . $client_data[0]->client_name . '
                           </b><br>
                           <span>' . $client_data[0]->billing_address . '</span>
                        </th>
                    </tr>
                </table>
                </td>
        </tr>
        ';

        if ($isEinvoicePresent == true) {
            $html_invoice_details = '
              <tr style="font-size:11px" style="border-right-style:none;">
                <td colspan="5">
                  <b> &nbsp;PAN NO : </b> ' . $client_data[0]->pan_no . '<br>
                  <b> &nbsp;GST NO : </b>' . $client_data[0]->gst_number . '<br>
                  <b> &nbsp;STATE : </b> ' . $client_data[0]->state . '<br>
                  <b> &nbsp;STATE CODE: </b> ' . $client_data[0]->state_no . '<br>
                  <b> &nbsp;VENDOR CODE : </b>' . $customer_data[0]->vendor_code . '<br>
                </td>
                <td colspan="5">
                  <span style="font-size:15px;"> <b>INVOICE NO :' . $new_sales_data[0]->sales_number . '</b></span><br>
                  <b> &nbsp;INVOICE DATE :</b> ' . $new_sales_data[0]->created_date . '<br>
                  <b> &nbsp;PO NUMBER : </b>' . $po_parts_data[0]->po_number . '<br>
                  <b>&nbsp;PO DATE : </b>' . defaultDateFormat($po_parts_data[0]->po_date) . '<br>
                  <span style="font-size:8px;">WHETHER TAX ON REVERSE CHARGE: NO</span>
                </td>
                <td colspan="2" style="align-items:center;">
                    <!-- <img width="200em" height="200em" src="' . $dataUri . '"><br> -->
                    <img width="100em" height="100em" src="data:image/png;base64,' . base64_encode($qrCodeImageString) . '" alt="QR Code">
                </td>
              </tr>
              <tr>
                <td colspan="12" style="font-size:11px;padding-top: 4px;">
                  <span><b>&nbsp;IRN No:</b> ' . $einvoice_data[0]->Irn . '<br>  </span>
                  <span><b>&nbsp;ACK No:</b> ' . $einvoice_data[0]->AckNo . '</span>
                  <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> &nbsp;ACK Date/Time :</b> ' . $einvoice_data[0]->AckDt . '</span>
                  <span style="text-align:right;">&nbsp;&nbsp;<b> &nbsp;EWAY-BILL NO :</b> ' . $einvoice_data[0]->EwbNo . '<br></span>
                </td>
              </tr>';
        } else {
            $html_invoice_details = '<tr style="font-size:11px">
              <td colspan="5" >
                <b>&nbsp;PAN NO : </b> ' . $client_data[0]->pan_no . '<br>
                <b> &nbsp;GST NO : </b>' . $client_data[0]->gst_number . '<br>
                <b> &nbsp;STATE : </b> ' . $client_data[0]->state . '<br>
                <b> &nbsp;STATE CODE : </b> ' . $client_data[0]->state_no . '<br>
                <b> &nbsp;VENDOR CODE : </b>' . $customer_data[0]->vendor_code . '<br>
              </td>
              <td colspan="7">
               <span style="font-size:15px;"> <b>INVOICE NO :' . $new_sales_data[0]->sales_number . '</b></span><br>
              <b> &nbsp;INVOICE DATE :</b> ' . $new_sales_data[0]->created_date . '<br>
              <b> &nbsp;PO NUMBER : </b>' . $po_parts_data[0]->po_number . '<br>
              <b>&nbsp;PO DATE : </b>' . defaultDateFormat($po_parts_data[0]->po_date) . '<br>
              <b> &nbsp;TIME OF SUPPLY :</b> ' . $new_sales_data[0]->created_time . '<br>
              <span style="font-size:8px">WHETHER TAX ON REVERSE CHARGE: NO</span>
              </td>
          </tr>';
        }

        $html_content = $html_content . $html_invoice_details .
        '<tr style="font-size:11px;" style="padding-top: 4px;">
            <td colspan="5">
                <b>&nbsp;Details of Receiver (Billed To)</b><br>
                &nbsp;<b>' . $customer_data[0]->customer_name . '</b><br>
                &nbsp;' . $customer_data[0]->billing_address . '<br>
                <b> &nbsp;STATE :</b> ' . $customer_data[0]->state . '&nbsp;&nbsp;<b> &nbsp;STATE CODE :</b> ' . $customer_data[0]->state_no . '
                <br>
                <b> &nbsp;PAN NO : </b>' . $customer_data[0]->pan_no . '
                <br>
                <b> &nbsp;GST NO :</b> ' . $customer_data[0]->gst_number . '
            </td>
            <td colspan="7">
                <b>&nbsp;Details of Consignee (Shipped to)</b><br>
                &nbsp;<b>' . $shipping_data['shipping_name'] . '</b><br>
                &nbsp;' . $shipping_data['ship_address'] . '<br>
                <b> &nbsp;STATE : </b>' . $shipping_data['state'] . '&nbsp;&nbsp;<b> &nbsp;STATE CODE :</b> ' . $shipping_data['state_no'] . '<br>
                <b> &nbsp;PAN NO : </b> ' . $shipping_data['pan_no'] . '<br>
                <b> &nbsp;GST NO : </b> ' . $shipping_data['gst_number'] . '
            </td>
        </tr>
       <tr style="font-size:11px;text-align:center">
              <th style="width:20px;">Sr No</th>
              <th colspan="4" style="width:350px;text-align:left;">Part Description <br><i> Part Number</i></th>
              <th>HSN / SAC </th>
              <th>&nbsp;Packaging&nbsp;</th>
              <th>&nbsp;UOM&nbsp;</th>
              <th>&nbsp;QTY&nbsp;</th>
              <th>&nbsp;Rate&nbsp;</th>
              <th colspan="2">&nbsp;Amount (Rs)&nbsp;</th>
        </tr>
          ' . $parts_html . '

        <tr>
         <td colspan="12" VALIGN="BOTTOM" style="font-size:10px;height:' . $height . '">Remark: ' . $new_sales_data[0]->remark . '</td>
        </tr>
          <tr style="font-size:10px">
            <td rowspan="2" colspan="7">
              <b>&nbsp;Mode Of Transport : </b>' . $md . '&nbsp;&nbsp;&nbsp;&nbsp;<b>&nbsp;Vehicle No : </b>' . $new_sales_data[0]->vehicle_number . '&nbsp;&nbsp;&nbsp;&nbsp;<b>&nbsp;L.R No : </b>' . $new_sales_data[0]->lr_number . '
              <br><b>&nbsp;Transporter : </b>' . $transporter_data[0]->transporter_id . '<br>
            </td>
            <td colspan="2" style="text-align:center;margin-left:10px;">SUB TOTAL </td>
            <td colspan="3" style="text-align:center">' . number_format((float) $final_total, 2, '.', '') . '</td>
          </tr>
          <tr style="font-size:10px">
            <td colspan="2" style="text-align:center">IGST ' . $igst . '%</td>
            <td colspan="3" style="text-align:center">' . number_format((float) $igst_amount, 2, '.', '') . '</td>
         </tr>
          <tr style="font-size:10px">
          <td rowspan="5" colspan="7">
            <b> &nbsp;Payment Terms : ' . $customer_data[0]->payment_terms . '</b> <br>
            <span><b> &nbsp;Bank Details : </b> ' . $client_data[0]->bank_details . '</span><br>
            <b> &nbsp;Electronic Reference No.</b> <br>
            <span> <b> &nbsp;GST Value (In Words) : </b> ' . $this->numberToWords(number_format((float) $final_gst_value, 2, '.', '')) . '</span><br>
            <span> <b> &nbsp;Invoice Value (In Words) : </b> ' . $this->numberToWords(number_format((float) $final_po_amount, 2, '.', '')) . '</span>
            </td>
            <td colspan="2" style="text-align:center;margin-left:10px;">CGST ' . $cgst . '%</td>
            <td colspan="3" style="text-align:center">' . number_format((float) $cgst_amount, 2, '.', '') . '</td>
        </tr>
          <tr style="font-size:10px">
            <td colspan="2" style="text-align:center;margin-left:10px;">SGST  ' . $sgst . '%</td>
            <td colspan="3" style="text-align:center">' . number_format((float) $sgst_amount, 2, '.', '') . '</td>
          </tr>
          <tr style="font-size:10px">
            <td colspan="2" style="text-align:center">TCS ' . $tcs . '%</td>
            <td colspan="3" style="text-align:center">' . number_format((float) $tcs_amount, 2, '.', '') . '</td>
          </tr>
          <tr style="font-size:10px">
            <td colspan="2 style="text-align:center;margin-left:10px;">P&F Charges</td>
            <td colspan="3" style="text-align:center">' . '0.00' . '</td>
          </tr>
          <tr style="font-size:10px">
            <th colspan="2" style="text-align:center">GRAND TOTAL (Rs) </th>
            <th colspan="3" style="text-align:center">' . number_format((float) $final_po_amount, 2, '.', '') . '</th>
          </tr>';
        $digitalSignature = "No";
        $signatureImageEnable = "No";
        $signatureImageUrl= "";
        if(isset($configuration['digitalSignature']) && $configuration['digitalSignature'] == "Yes"){
               $digitalSignature = "Yes"; 
        }else if(isset($configuration['SignatureImageEnable'])){
            if($configuration['SignatureImageEnable'] == "Yes" && $configuration['SignatureImage'] != ""){
               $signatureImageEnable = "Yes"; 
               $signatureImageUrl = base_url("dist/img/signature_image/").$configuration['SignatureImage'];
            }
        }
        
        $html_content = $html_content . $this->getFooterWithSignatureForSales($digitalSignature,$signatureImageEnable,$signatureImageUrl);

        // pr($html_content,1);
        $pdfName = 'Sales-Invoice-' . $new_sales_data[0]->sales_number . '-' . $copy . '.pdf';

        //Aarbaj
        // pr($html_content,1);
        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        if($digitalSignature== "Yes"){
                $output = $this->pdf->output();
                $fileName = "dist/uploads/sales_invoice/".$copy.".pdf";
                $fileAbsolutePath = FCPATH.$fileName;

                // upload pdf
                file_put_contents($fileAbsolutePath, $output);

                // generate digital signature
                $signer = $configuration['signer'];
                $certpwd = $configuration['certpwd'];
                $certid = $configuration['certid'];
                $customerPrefix = $configuration['customerPrefix'];
                $digital_signature_url = $configuration['digital_signature_url'];
                $SignaturePostion = '[440:72]';
                if($isEinvoicePresent){
                    $SignaturePostion = '[440:55]';
                }
                digitalSignature($fileName,$SignaturePostion,$signer,$certpwd,$certid,$customerPrefix,$digital_signature_url);
                
                $fileDownloadPath = base_url().$fileName;
                $pdf_content = file_get_contents($fileDownloadPath);
                header("Content-Type: application/pdf");
                header("Content-Disposition: attachment; filename=".$copy.".pdf");
                header("Content-Length: " . strlen($pdf_content));
                echo $pdf_content;
                exit();
        }else{
            $this->pdf->stream($pdfName, array("Attachment" => 1));
        }
        
    }

    public function create_debit_note()
    {
        $debit_note_id = $this->uri->segment('2');
        $client_data = $this->Unit->getClientUnitDetails();
        $rejection_flow_data = $this->Crud->get_data_by_id("rejection_flow", $debit_note_id, "id");
        $invoice_data = $this->Crud->get_data_by_id("inwarding", $rejection_flow_data[0]->grn_number, "grn_number");
        $rejection_flow_data[0]->invoice_number = $invoice_data[0]->invoice_number;
        $type = "";
        if ($rejection_flow_data[0]->type == "stock_rejection") {
            $type = "Stock Rejection";
        } else if ($rejection_flow_data[0]->type == "MDR") {
            $type = "MDR";
        } else if ($rejection_flow_data[0]->type == "grn_rejection") {
            $type = "GRN Rejection";
        }
        // print_r($new_po_data);
        // echo "<br>";
        $supplier = $this->Crud->get_data_by_id("supplier", $rejection_flow_data[0]->supplier_id, "id");
        // print_r($supplier_data);
        // echo "<br>";
        // print_r($po_parts_data);
        // echo "<br>";
        $parts_html = "";
        $final_total = 0;
        $cgst_amount = 0;
        $sgst_amount = 0;
        $igst_amount = 0;
        $tcs_amount = 0;
        $height = "310px";
        $payment_terms = "";

        // $supplier_data = $this->Crud->get_data_by_id("supplier", $part_data_new[0]->supplier_id, "id");
        // $payment_terms = "";
        // if ($supplier_data) {
        //   $payment_terms = $supplier_data[0]->payment_terms;
        // }

        $i = 1;
        foreach ($rejection_flow_data as $p) {
            $p->part_id;
            if($p->part_id > 0){
            $child_part_data = $this->SupplierParts->getSupplierPartById($p->part_id);
            }else{
                $child_part_data = [];
            }
            $data_old = array(
                'supplier_id' => $rejection_flow_data[0]->supplier_id,
                'child_part_id' => $p->part_id,

            );

            $child_part_master_data = $this->Common_admin_model->get_data_by_id_multiple_condition("child_part_master", $data_old);

            $uom_data = $this->Crud->get_data_by_id("uom", $child_part_data[0]->uom_id, "id");

            // print_r($child_part_master_data);
            $customer_part_rate = (float) $child_part_master_data[0]->part_rate;
            $gst_structure_data = $this->Crud->get_data_by_id("gst_structure", $child_part_master_data[0]->gst_id, "id");
            // $gst_structure_data = $child_part_master_data[0]->gst_id;
            $hsn_code = $child_part_data[0]->hsn_code;
            if ((int) $gst_structure_data[0]->igst === 0) {
                $gst = (float) $gst_structure_data[0]->cgst + (float) $gst_structure_data[0]->sgst;
                $cgst = (float) $gst_structure_data[0]->cgst;
                $sgst = (float) $gst_structure_data[0]->sgst;
                $igst = 0;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $tcs_on_tax = $gst_structure_data[0]->tcs_on_tax;
                $total_gst_percentage = $cgst + $sgst;
            } else {
                $gst = (float) $gst_structure_data[0]->igst;
                $cgst = 0;
                $sgst = 0;
                $igst = $gst;
                $tcs = (float) $gst_structure_data[0]->tcs;
                $tcs_on_tax = $gst_structure_data[0]->tcs_on_tax;

                $total_gst_percentage = $igst;
            }
            $gst_amount = ($gst * $customer_part_rate) / 100;
            $final_amount = $gst_amount + $customer_part_rate;
            $final_row_amount = $final_amount * $p->qty;
            // $final_total = $final_total + $final_row_amount;
            $total_amount = $p->qty * $customer_part_rate;
            $final_total = $final_total + $total_amount;
            $cgst_amount = $cgst_amount + (($total_amount * $cgst) / 100);
            $sgst_amount = $sgst_amount + (($total_amount * $sgst) / 100);
            $igst_amount = $igst_amount + (($total_amount * $igst) / 100);

            if ($gst_structure_data[0]->tcs_on_tax == "no") {
                $tcs_amount = $tcs_amount + (($total_amount * $tcs) / 100);
            } else {
                $tcs_amount = $tcs_amount + ((($cgst_amount + $sgst_amount + $igst_amount + $total_amount) * $tcs) / 100);
            }

            $parts_html .= '
    <tr style="font-size:10px">
        <td>' . $i . '</td>
        <td>' . $child_part_data[0]->part_number . '</td>
        <td>' . $child_part_data[0]->part_description . '</td>
        <td>' . $hsn_code . '</td>
        <td>' . $customer_part_rate . '</td>
        <td>' . $p->qty . '</td>
        <td>' . $uom_data[0]->uom_name . '</td>

        <td>' . $cgst . '</td>
        <td>' . $sgst . '</td>
        <td>' . $igst . '</td>
        <td>' . $tcs . '</td>
        <td>' . number_format((float) $total_amount, 2, '.', '') . '</td>

    </tr>
    ';
            $i++;
        }

        if ($i == 2) {
            $height = "300px";
        }
        if ($i == 3) {
            $height = "250px";
        }
        if ($i == 4) {
            $height = "250px";
        }
        if ($i == 5) {
            $height = "280px";
        }
        if ($i == 6) {
            $height = "200px";
        }
        if ($i == ' . $colspan1 . ') {
            $height = "180px";
        }
        if ($i == 8) {
            $height = "160px";
        }
        if ($i == 9) {
            $height = "140px";
        }
        if ($i == 10) {
            $height = "120px";
        }

        $final_final_amount = $final_total + $cgst_amount + $sgst_amount + $igst_amount + $tcs_amount;

        if ($new_sales_data[0]->mode == '1') {
            $md = 'Road';
        } elseif ($new_sales_data[0]->mode == '2') {
            $md = 'Rail';
        } elseif ($new_sales_data[0]->mode == '3') {
            $md = 'Air';
        } elseif ($new_sales_data[0]->mode == '4') {
            $md = 'Ship';
        }

        //     <tr>
        // <th>
        //     </th>
        // </tr>

        $html_content = '



        <html>
        <head>
        <style>
        html { margin: 0px}
        </style></head>
        <body>

        <table border="1px" cellspacing="1px">
        <tr style="font-size:12px">
        <th colspan="12" style="text-align:center;font-size:12px">Debit Note :' . $type . ' / ' . $rejection_flow_data[0]->id . ' </th>

        </tr>
        <tr style="font-size:12px">
                   <th colspan="2" rowspan="2" style="text-align:center">


                   </th>
                   <th colspan="6" rowspan="2">
                   <b style="margin-top:-100px">' . $client_data[0]->client_name . '
                   ,
                   ' . $client_data[0]->billing_address . '</b>

                   </th>

                   </th>
                   <th colspan="4"></th>


        </tr>
        <tr style="font-size:12px">
              <td colspan="4" >

        <b>GST NO</b> : ' . $client_data[0]->gst_number . '
        <br>
        <b>STATE</b> : ' . $client_data[0]->state . '
        <br>
        <b>STATE CODE</b> : ' . $client_data[0]->state_no . '
        <br>

        </td>
        </tr>

        <tr style="font-size:12px">
        <td colspan="7"><b>Mode Of Transpot :</b> By Road <br>
        <b>Vehicle No : </b><br>
        <b>Date & Time : </b> <br>
        </td>
        <td colspan="5"><b>INVOICE NO. </b>:-' . $rejection_flow_data[0]->invoice_number . '
        <br>
        <b> INVOICE DATE . ' . $rejection_flow_data[0]->po_date . '</b>:<br>
        <b> P.O. NO : ' . $rejection_flow_data[0]->po_number . '</b><br>
        <b> PO DATE . ' . $rejection_flow_data[0]->po_date . ':</b><br>
        </td>

        </tr>
        <tr style="font-size:12px">
        <td colspan="4">
        <b>Details Of Receivers( Billed To )</b>
        <br>
        ' . $supplier[0]->supplier_name . '<br>
        ' . $supplier[0]->location . '
        </td>
        <td colspan="4">
        <b>PAN NO : ' . $supplier[0]->pan_card . '</b>
        <br>
        <b>GST NO : </b>' . $supplier[0]->gst_number . '
        <br>
        <b>State : </b>' . $supplier[0]->state . '
        <br>
        <br>
        </td>
        <td colspan="4">
        <b>Details Of Consignee (Ship To)</b> ,
        <br>
        ' . $supplier[0]->supplier_name . '<br>
        ' . $supplier[0]->location . '
        </td>

        </tr>

        <tr style="font-size:10px">
              <td><b> Sr No</b></td>
              <td><b>Part Number</b> </td>
              <td><b>Part Description</b>  </td>
              <td><b> HSN Code</b> </td>
              <td><b> Rate/Unit </b> </td>
              <td><b>QTY</b>  </td>
              <td><b>UOM</b> </td>
              <td><b>CGST %</b </td>
              <td><b>SGST %</b> </td>
              <td><b>IGST %</b> </td>
              <td><b>TCS % </b></td>
              <td><b>Total Amount (Rs)</b></td>
        </tr>

          ' . $parts_html . '
          <tr style="border=0px">
          <td colspan="12" style="height:' . $height . '"></td>
          </tr>
          <tr style="font-size:10px">
            <td rowspan="6" colspan="6">
            <span><b>GST Amount In Words :</b>  ' . $this->getIndianCurrency(number_format((float) $cgst_amount + $sgst_amount + $igst_amount, 2, '.', '')) . '</span>

            <br><br>
            <span><b>Grand Total Amount In Words :</b>  ' . $this->getIndianCurrency(number_format((float) $final_final_amount, 2, '.', '')) . '</span>

            <span></span>
              <br><br>
            <b>Payment Terms In Days : </b>' . $supplier[0]->payment_terms . '
              <br><br>
            <b>Bank Details : </b>' . $client_data[0]->bank_details . '
            </td>
            <th colspan="5" style="text-align:right">Subtotal </th>
            <th>' . number_format((float) $final_total, 2, '.', '') . '</th>
          </tr>
          <tr style="font-size:10px">
            <th colspan="5" style="text-align:right"> CGST ' . $cgst . '%</th>
            <th>' . number_format((float) $cgst_amount, 2, '.', '') . '</th>
          </tr>

          <tr style="font-size:10px">
            <th colspan="5" style="text-align:right">SGST  ' . $sgst . '%</th>
            <th>' . number_format((float) $sgst_amount, 2, '.', '') . '</th>
          </tr>
          <tr style="font-size:10px">
            <th colspan="5" style="text-align:right">IGST ' . $igst . '%</th>
            <th>' . number_format((float) $igst_amount, 2, '.', '') . '</th>
          </tr>
          <tr style="font-size:10px">
            <th colspan="5" style="text-align:right">TCS  ' . $tcs . '%</th>
            <th>' . number_format((float) $tcs_amount, 2, '.', '') . '</th>
          </tr>

          <tr style="font-size:10px">
            <th colspan="5" style="text-align:right"><b>Grand Total (Rs)</b>  </th>
            <th><b>' . number_format((float) $final_final_amount, 2, '.', '') . '</b> </th>
          </tr>';
        $html_content = $html_content . $this->getFooterWithSignature();

        // echo $html_content;

        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        $this->pdf->stream("Debit-Note.pdf", array("Attachment" => 1));
    }

    public function numberToWords(float $number)
    {
        $ones = array(
            0 => '', 1 => 'One', 2 => 'Two', 3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six', 7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve', 13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen', 16 => 'Sixteen', 17 => 'Seventeen',
            18 => 'Eighteen', 19 => 'Nineteen',
        );
        $tens = array(
            0 => 'Twenty', 1 => 'Thirty', 2 => 'Forty', 3 => 'Fifty', 4 => 'Sixty', 5 => 'Seventy', 6 => 'Eighty', 7 => 'Ninety',
        );

        $number = number_format($number, 2, '.', '');
        $parts = explode('.', $number);
        $wholeNumber = (int) $parts[0];
        $fraction = isset($parts[1]) ? (int) $parts[1] : 0;

        $wholeNumberInWords = '';
        if ($wholeNumber >= 10000000) {
            $wholeNumberInWords .= $this->numberToWords(floor($wholeNumber / 10000000)) . ' Crore ';
            $wholeNumber %= 10000000;
        }
        if ($wholeNumber >= 100000) {
            $wholeNumberInWords .= $this->numberToWords(floor($wholeNumber / 100000)) . ' Lakh ';
            $wholeNumber %= 100000;
        }
        if ($wholeNumber >= 1000) {
            $wholeNumberInWords .= $this->numberToWords(floor($wholeNumber / 1000)) . ' Thousand ';
            $wholeNumber %= 1000;
        }
        if ($wholeNumber >= 100) {
            $wholeNumberInWords .= $this->numberToWords(floor($wholeNumber / 100)) . ' Hundred ';
            $wholeNumber %= 100;
        }
        if ($wholeNumber >= 20) {
            $wholeNumberInWords .= $tens[floor($wholeNumber / 10) - 2] . ' ';
            $wholeNumber %= 10;
        }
        if ($wholeNumber > 0) {
            $wholeNumberInWords .= $ones[$wholeNumber];
        }

        $fractionInWords = '';
        if ($fraction > 0) {
            $fractionInWords = ' Rupees ';
            if ($fraction >= 20) {
                $fractionInWords .= $tens[floor($fraction / 10) - 2] . ' ';
                $fraction %= 10;
            }
            if ($fraction > 0) {
                $fractionInWords .= $ones[$fraction];
            }
            $fractionInWords .= ' Paise';
        }

        return $wholeNumberInWords . $fractionInWords;
    }

    public function getIndianCurrency(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(
            0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety',
        );
        $digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
        while ($i < $digits_length) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
            } else {
                $str[] = null;
            }

        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }

    public function generate_job_card()
    {
        $job_card_id = $this->uri->segment('2');
        $job_card = $this->Crud->get_data_by_id("job_card", $job_card_id, "id");
        $customer_part_data = $this->Crud->get_data_by_id("customer_part", $job_card[0]->customer_part_id, "id");
        $customer_part_drawing = $this->Crud->get_data_by_id("customer_part_drawing", $job_card[0]->customer_part_id, "customer_master_id");
        $customer_part_operation = $this->Crud->get_data_by_id("customer_part_operation", $job_card[0]->customer_part_id, "customer_master_id");
        $customer_part_operation_data = $this->Crud->get_data_by_id("customer_part_operation_data", $customer_part_operation[0]->id, "customer_part_operation_id");
        // $uom = $this->Crud->get_data_by_id("uom", $customer_part_data[0]->uom, "id");
        $customer_data = $this->Crud->get_data_by_id("customer", $customer_part_data[0]->customer_id, "id");
        $bom_data = $this->Crud->get_data_by_id("bom", $job_card[0]->customer_part_id, "customer_part_id");
        // $customer_part_master = $this->Crud->get_data_by_id("child_part_master", $customer_part_data[0]->part_number, "part_number");
        $number = $this->getCustomerPrefix() . "/" . $customer_part_data[0]->part_family . "/0000" . $job_card_id;

        $role_management_data = $this->db->query('SELECT operation_id,id  FROM `customer_part_operation` WHERE customer_master_id = ' . $job_card[0]->customer_part_id . ' ORDER BY `operation_id` ASC');
        // $data['operations_new'] = $role_management_data->result();
        // $role_management_data = $this->db->query('SELECT DISTINCT operation_id  FROM `customer_part_operation` WHERE customer_master_id = ' . $job_card[0]->customer_part_id . ' ORDER BY `id` DESC');
        $customer_part_operation = $role_management_data->result();
        $table1 = '';
        $table2 = '';

        if ($bom_data) {
            $i = 1;
            foreach ($bom_data as $b) {
                if (true) {
                    $child_part_data = $this->SupplierParts->getSupplierPartById($b->child_part_id);
                    $uom_data = $this->Crud->get_data_by_id("uom", $child_part_data[0]->uom_id, "id");

                    $table2 .= '
          <tr style="font-size:10px">
            <td>' . $i . '</td>
            <td>' . $child_part_data[0]->part_number . '</td>
            <td>' . $child_part_data[0]->part_description . '</td>
            <td>' . $child_part_data[0]->store_rack_location . '</td>

            <td>' . $b->quantity . '</td>
            <td>' . $job_card[0]->req_qty * $b->quantity . '</td>
            <td>' . $uom_data[0]->uom_name . '</td>
            <td></td>
            <td></td>



          </tr>';
                    $i++;
                }
            }
        }

        $table1 = '';
        if ($customer_part_operation) {
            $i = 1;

            if ($customer_part_operation) {

                foreach ($customer_part_operation as $b) {

                    $customer_part_operation_view = $this->Crud->get_data_by_id("customer_part_operation", $b->id, "id");
                    $operations = $this->Crud->get_data_by_id("operations", $b->operation_id, "id");

                    $customer_part_operation_data = $this->Crud->get_data_by_id_asc("customer_part_operation_data", $customer_part_operation_view[0]->id, "customer_part_operation_id");
                    if ($customer_part_operation_data) {
                        foreach ($customer_part_operation_data as $cd) {

                            $table1 .= '
                    <tr style="font-size:12px">
                        <td></td>
                        <td></td>
                        <td>' . $customer_part_operation_view[0]->name . '</td>
                        <td>' . $customer_part_operation_view[0]->mfg . '</td>
                        <td>' . $i . '</td>
                        <td>' . $cd->product . '</td>
                        <td>' . $cd->process . '</td>
                        <td>' . $cd->specification_tolerance . '</td>
                        <td>' . $cd->evalution . '</td>
                        <td>' . $cd->size . '</td>
                        <td>' . $cd->frequency . '</td>
                        <td style="width:60px"></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>


                    </tr>
                    ';

                            $i++;
                        }
                    }
                }
            }
            // }
        }

        $html_content = '
    <html>
    <head>
    <style>
    html { margin: 2px}
    table{
      width: 100%;
    }
    table, th, td {
     border: 1px solid black;
   }

   td {
     text-align: center;
     vertical-align:middle;

   }

   th {
     text-align: center;
   }
   table.fixed { table-layout:fixed; }
   table.fixed td { overflow: hidden; }

    </style></head>
    <body>

    <table cellspacing="0">
        <tr style="font-size:12px">
            <td rowspan="3" colspan="2"><img width="47.5px" height="60px"   src="tulasi.jpg" alt="cart-image"></td>
            <td rowspan="3" colspan="3">
            <h2>JOB ROUTE CARD </h2>
            </td>
            <td>Job Card No</td>
            <td>' . $number . '</td>
          <td></td>
          <td></td>


            <td>Doc No.</td>
            <td>TUH/QA/002</td>

        </tr>
        <tr style="font-size:12px">
            <td>Issue Date</td>

            <td>' . $job_card[0]->issue_date . '</td>
            <td>Completion Date</td>

            <td style=""></td>

            <td>Rev No</td>
            <td>01</td>
        </tr>
        <tr style="font-size:12px">
            <td>Lot Qty</td>

            <td>' . $job_card[0]->req_qty . '</td>
            <td>UOM</td>

            <td>' . $customer_part_data[0]->uom . '</td>

            <td>Rev Date</td>
            <td>14/09/2021</td>
        </tr>
        <tr style="font-size:12px">
            <td>Customer</td>
            <td>' . $customer_data[0]->customer_name . '</td>
            <td></td>
            <td></td>
            <td></td>
            <td>Lead Time</td>
            <td></td>
            <td></td>

            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr style="font-size:12px">
            <td>Part NO</td>
            <td>' . $customer_part_data[0]->part_number . '</td>
            <td></td>
            <td></td>
            <td></td>
            <td>P.O. NO</td>
            <td></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr style="font-size:12px">
            <td>Rev No</td>
            <td>' . $customer_part_drawing[0]->revision_no . '</td>
            <td></td>
            <td></td>
            <td></td>
            <td>P.O. Date</td>
            <td></td>

            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
      <span style="text-align: center;margin-left:50%">Bill Of Material </span>
        <table cellspacing="0">

    <tr style="font-size:12px">

        <td>Sr. No.</td>
        <td>Item Number</td>
        <td>Item Description</td>
        <td>Store Location</td>
        <td>BOM Qty</td>
        <td>REQ Qty</td>
        <td>UOM</td>
        <td>GRN NO </td>
        <td>HOSE Make/Mfg.Date </td>
        </tr>

        </tr>

        ' . $table2 . '



        </table>




        <table cellspacing="0">



        <thead>

        <tr style="font-size:12px;text-align:left">
            <td rowspan="2">Date</td>
            <td rowspan="2">Op No.</td>
            <td rowspan="2">Process/ Operation Name</td>
            <td rowspan="2">M/c Device, Jigs,Tools For Mfg</td>
            <td colspan="3">Characteristics</td>
            <td rowspan="2">Product Specification / Tolerance</td>
            <td rowspan="2">Evaluation / Measurement Techn.</td>
            <td rowspan="2">Size</td>
            <td rowspan="2">Freq</td>
            <td colspan="2">Set  Up  Approval</td>
            <td colspan="4">In Process Observation</td>
            <td>Last Price</td>
            <td>Qty</td>
            <td>Qty</td>
            <td style="text-align:left;">Remark</td>
            <td></td>

        </tr>
        <tr style="font-size:12px;text-align:left;vertical-align: middle;padding:5px;">

            <td style="padding:5px;" valign="middle">No</td>
            <td>Product</td>
            <td>Process</td>
            <td>1</td>
            <td>2</td>
            <td>3</td>
            <td>4</td>
            <td>5</td>
            <td>6</td>
            <td>7</td>
            <td>Prod</td>
            <td>Acc</td>
            <td></td>
            <td></td>

        </tr>
    </thead>

    <tbody style="margin-top:50px">
    ' . $table1 . '
    </tbody>




        </table>
        <table class="fixed" cellspacing="0" width="100%">
        <col width="30px" />
        <col width="30px" />
        <col width="30px" />
        <col width="30px" />
        <col width="30px" />
        <col width="30px" />
        <col width="30px" />
        <col width="30px" />
        <tr style="font-size:12px">

            <td>Lot Qty</td>
            <td>' . $job_card[0]->req_qty . '</td>
            <td>Accepted Qty</td>
            <td></td>
            <td>Rejected Qty</td>
            <td></td>
            <td>Rework Qty</td>
            <td></td>
        </tr>
        <tr style="font-size:12px">
          <td>Note (if any)</td>
          <td colspan="7"></td>
        </tr>
        <tr style="font-size:12px">

            <td>Issued By</td>
            <td></td>
            <td>Inspected By</td>
            <td></td>
            <td>Approved By</td>
            <td colspan="3"></td>

        </tr>

        </table>


        </body>
        </html>

        ';

        // print_r($html_content);
        $this->pdf->set_paper('A4', 'landscape');

        $this->pdf->loadHtml($html_content);
        $this->pdf->render();
        $this->pdf->stream("Job_card.pdf", array("Attachment" => 1));
    }

    /*
    Footer details with Signature etc.
     */
    public function getFooterWithSignatureForSales($digitalSignature =  'No',$signatureImageEnable='No',$signatureImageUrl = '')
    {
        $rowspan = "2";
        
        
        $footerDetails =

        '
        <tr style="font-size:9.5px">
            <td colspan="5">
            <table cellpadding="0">
                <tr>
                <td>We hereby certify that my/our registration certificate under the Goods and Service Tax
                Act, 2017 is in force on the date on which the sale of the goods specified in this Tax
                invoice is made by me/us and that the transaction of sale covered by this taxinvoice has
                been effected by me/us and it shall be accounted for in the turnover of sales while filling
                of return and the due tax. If any, payable on the sale has been paid or shall be paid
                <br>Certified that the particulars given above are true.Interest @24% P.A. will be charged on all overdue invoices.<br>Subject To Pune Jurisdiction
                </td>
                </tr>
                </table>
            </td>
            <td colspan="'.$rowspan.'" style="text-align:center;vertical-align: bottom;font-weight: bold;font-size:11px">
              Receiver Signature 
            </td>';

        if($digitalSignature == 'Yes'){
            $footerDetails .= '<td colspan="5" style="text-align:center;font-size:11px;min-width:100px;"></td>';
        }else if($signatureImageEnable == 'Yes' && $signatureImageUrl != ''){
            $footerDetails .= '<td colspan="5" style="text-align:center;font-size:11px;min-width:100px;background: white;font-weight: bold;font-size:12px">
<br><br>
                 For, ' . $this->getCustomerNameDetails() . ' 
            <br>
                 <br>
                <img src="'.$signatureImageUrl.'"  style="background: white;width:150px;height:85px">
                <h4 style="white-space:nowrap;"> Authorized Signatory</h4>
            </td>';
        }else{
            $footerDetails .= '<td colspan="5" style="text-align:center;font-size:11px;min-width:100px;font-weight: bold;font-size:12px">
                 For, ' . $this->getCustomerNameDetails() . ' 
                <br><br><br><br>
                <h4 style="white-space:nowrap;"> Authorized Signatory</h4>
            </td>';
        }
            
        $footerDetails.='</tr>
            </table>' ;

            // . $this->getFooter()
        return $footerDetails;
    }

    /*
    Footer details with Signature etc.
     */
    public function getSignature()
    {

        $footerDetails =
        '<tr style="font-size:9px">
            <td colspan="6">
            <span style="padding-left:5px">
            <p>We hereby certify that my/our registration certificate under the Goods and Service Tax
                Act, 2017 is in force on the date on which the sale of the goods specified in this Tax
                invoice is made by me/us and that the transaction of sale covered by this taxinvoice has
                been effected by me/us and it shall be accounted for in the turnover of sales while filling
                of return and the due tax. If any, payable on the sale has been paid or shall be paid
                <br>
                Certified that the particulars given above are true.Interest @24% P.A. will be charged on all overdue invoices.<br>
    Subject To Pune Jurisdiction
    </p><p><br><br>
    <b>This is computer generated document. No signature required.</b>
              </p></span>
          </td>
          <td colspan="3" style="text-align:center;vertical-align: bottom;">
          <h4 style="font-size:11px"> Receiver Signature </h4>
          </td>
          <td colspan="3" style="text-align:center;font-size:11px;">
            <h4> For, ' . $this->getCustomerNameDetails() . ' </h4>
            <br><br><br><br><br><br>
            <h4> Authorized Signatory</h4>
          </td>
        </tr>
        </table>';
        return $footerDetails;
    }

    public function getFooter()
    {
        return "</body></html>";
    }

    public function print_challan_invoice()
    {
        $challan_id = $this->uri->segment('2');
        if (isset($_POST['interests']) && is_array($_POST['interests'])) {
            $selectedInterests = $_POST['interests'];
            if (count($selectedInterests) === 0) {
                echo "No Options selected.";
            } else {
                $html_content_header = '
        <!DOCTYPE html>
          <style>
              html { margin: 10px }
              th, td {
                border: 1px solid black;
                border-collapse: collapse;
                padding-top: 2px;
                padding-bottom: 2px;
                padding-left: 5px;
                padding-right: 5px;
            }

            @media print {
                .container{
                  width: 95%;
                  height: auto;
                  margin: 50px auto;
                }

              @page
              {
                size: auto;   /* auto is the initial value */
                margin: 5mm;  /* this affects the margin in the printer settings */
              }
              body {
                margin-top: 5mm;
                margin-left: 2mm;
                margin-bottom: 5mm;
                margin-right: 2mm
            }
          }

         </style>
         <link rel="stylesheet" href="' . base_url('') . 'dist/css/arom.css">
      </head><body>
      <script>
        function printSection() {
            var printContent = document.getElementById("print-section").innerHTML;
            var originalContent = document.body.innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = originalContent;
        }
        </script>
    <div>
    <button class="print-button" onclick="printSection()"><span class="print-icon"></span></button>
        </div>
    <br>
        <div id="print-section">
      ';
                $html_content_full = $html_content_header;

                foreach ($selectedInterests as $interest) {
                    $html_content_full .= '<div style="page-break-after: always;"><p>' . $this->print_challan_invoice_pdf($interest, $challan_id) . '</p></div>';
                }
                $html_content_full .= $this->getFooter();
                echo $html_content_full;
            }

            $html_content_header .= '</div>';
        } else {
            echo "No Options Selected.";
        }
    }

    public function print_challan_invoice_pdf($copy = null, $challan_id = null)
    {

        if (!isset($copy)) {
            $copy = $this->uri->segment('3');
        }
        if (!isset($challan_id)) {
            $challan_id = $this->uri->segment('2');
        }

        $challan_data = $this->Crud->get_data_by_id("challan", $challan_id, "id");
        $challan_parts_data = $this->Crud->get_data_by_id("challan_parts", $challan_id, "challan_id");
        $supplier_data = $this->Crud->get_data_by_id("supplier", $challan_data[0]->supplier_id, "id");

        $clientUnit = $this->session->userdata['clientUnit'];
        $client_data = $this->Crud->get_data_by_id("client", $clientUnit, "id");
        $shipping_data = $this->getShippingDetails($challan_data, $supplier_data);

        $i = 1;

        $row_data = '';
        $total_value = 0;
        $margin_top = "20%";

        if ($challan_parts_data) {
            // $i = 1;
            foreach ($challan_parts_data as $cd) {
                $child_part_data = $this->SupplierParts->getSupplierPartById($cd->part_id);
                $uom_data = $this->Crud->get_data_by_id("uom", $child_part_data[0]->uom_id, "id");

                $total_value = $total_value + $cd->value;
                $row_data .= '
          <tr style="text-align:center;font-size:12px">
              <td>' . $i . '</td>
              <td>
                  ' . $child_part_data[0]->part_number . ' <br>
                  ' . $child_part_data[0]->part_description . '
              </td>
              <td>
                    ' . $cd->qty . ' ' . $uom_data[0]->uom_name . '<br>
              </td>
              <td>
                   ' . $cd->process . '

              </td>
              <td>
                   ' . $cd->hsn . '

              </td>
              <td>
                   ' . $cd->value . '
              </td>
          </tr>
          ';

                $i++;
            }
        }
        $height = "330px";

        //  print_r($i); exit;
        if ($i == 2) {
            $height = "230px";
        }
        if ($i == 3) {
            $margin_top = "16%";
            $height = "200px";
        } else if ($i == 4) {
            $margin_top = "14%";
            $height = "160px";
        } else if ($i == 5) {
            $margin_top = "12%";
            $height = "120px";
        } else if ($i == 6) {
            $margin_top = "10%";
            $height = "100px";
        } else if ($i == 7) {
            $margin_top = "8%";
            $height = "30px";
        } else if ($i == 8) {
            $margin_top = "20px;";
            $height = "0px";
        } else if ($i == 9) {
            $margin_top = "4%";
            $height = "0px";
        }

        $footer = '
    <tr>
         <td colspan="12" VALIGN="BOTTOM" style="font-size:15px;height:' . $height . '">&nbsp;</td>
    </tr>
    <tr style="text-align:right;font-size:12px">
        <th colspan="5">Total</th>
        <th style="text-align:center;font-size:12px">' . $total_value . '</th>
    </tr>
    <tr>
    <td colspan="6" style="text-align:left;font-size:12px">
    <b>Amount In Words: </b> ' . $this->getIndianCurrency(number_format((float) $total_value, 2, '.', '')) . '
    </td>
    </tr>
    <tr>
        <th colspan="3" style="text-align:left;font-size:12px">
        Transporter : ' . $challan_data[0]->transpoter . ' <br> <br>
        Vehicle No : ' . $challan_data[0]->vechical_number . '
        </th>
        <th colspan="3" style="text-align:center;font-size:12px">
        For ' . $this->getCustomerNameDetails() . '
        <br><br>

        <br>
        Authorized Signatory
        </th>
    </tr>
    <tr>
      <td colspan="6" style="text-align:center;font-size:12px">
      To be comleted by processor/job worker at the time despatches, back to the manufacturer
      Original copy to be retained by job-worker. Duplicate copy to be despatched along with goods
      </td>
    </tr>
    <tr >
      <td  colspan="6" style="text-align:left;font-size:12px">
         1. Date & time of despatch of finished goods to parent
      factory/another manufacturer and entry No. and date
      of receipt in the account in the processing factory.
      </td>
    </tr>
    <tr>
      <td colspan="6" style="text-align:left;font-size:12px">
      Part No.
      <br>
      Chal No.   <br>
      Date
      <br><br>
      </td>
      </tr>
    <tr>
      <td colspan="2" style="text-align:left;font-size:12px">
     2. Quantity despatched (Nos/Weight/Litre/Meter) and
     entered in Account.
      </td>
      <td colspan="4" style="text-align:left;font-size:12px">
      Qty <br>
      </td>
   </tr>
    <tr>
      <td colspan="6" style="text-align:left;font-size:12px">
     3. Nature of Processing/Manufacturing done
      </td>
    </tr>
    <tr>
      <td colspan="6" style="text-left:center;font-size:10px">
     4. Quantity of waste material returned to the parent
     factory of cleared for home consumption (Invoice No.
     & date quantum of duty paid (Both in Figure & Words)
      </td>
    </tr>
    <tr>
      <td colspan="6" style="text-align:left;font-size:12px">
        Place: <br>
        Date: <br>
        Name of the Factory & Address: <br>
      </td>
    </tr>
    <tr>
      <td colspan="6" style="text-align:right;font-size:10px">
      <br><br>
      Signature Of Processor
      </td>
    </tr>
    </table>
    ';

        $html_content = '
    <table cellspacing="0" style="margin-right: 5px"  border="1px">
    <tr>
        <th colspan="6" style="text-align:right; font-size:10px">' . $copy . ' </th>
    </tr>
    <tr>
        <th colspan="6" style="text-align:center">CHALLAN</th>
    </tr>
    <tr>
            <th colspan="6" style="text-align:center;font-size:12px">
             ' . $client_data[0]->client_name . '
            </th>
        </tr>
        <tr>
        <td colspan="6" style="text-align:center;font-size:12px"> ' . $client_data[0]->billing_address . '</td>

        </tr>
        <tr>
            <td colspan="6" style="text-align:center;font-size:12px"> FOR MOVEMENT OF INPUT/CAPITAL GOODS OR PARTIALLY PROCESSED GOODS UNDER RULE4(6)A FROM ONE
            FACTORY TO ANOTHER FACTORY FOR FURTHER PROCESSING/OPERATION AND RETURN</td>
        </tr>

        <tr>
            <td colspan="2" style="text-align:center;font-size:12px">GSTIN : ' . $client_data[0]->gst_number . '</td>
            <td colspan="2" style="text-align:center;font-size:12px">STATE : ' . $client_data[0]->state . '</td>
            <td colspan="2" style="text-align:center;font-size:12px">STATE CODE : ' . $client_data[0]->state_no . '</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:left;font-size:14px">To, <br>
                 ' . $shipping_data['shipping_name'] . ' <br>
               ' . $shipping_data['ship_address'] . ' <br>
               <b> GSTIN- </b>' . $shipping_data['gst_number'] . ' <br>
               <b>TELEPHONE No:  </b> ' . $shipping_data['phone_no'] . ' <br>
            </td>
            <td colspan="4" style="text-align:left;font-size:14px">
              Challan No : ' . $challan_data[0]->challan_number . ' <br>
              Challan Date : ' . $challan_data[0]->created_date . ' <br>
              Time Of Supply : ' . $challan_data[0]->created_time . ' <br>
            </td>
        </tr>
        <tr style="text-align:center;font-size:12px;">
            <th style="width:10px">Sr No</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Process</th>
            <th>HSN</th>
            <th>Value</th>
        </tr>
             ' . $row_data . '

          <footer>
          ' . $footer . '
          </footer>
       ';

        return $html_content;
    }
    
}
