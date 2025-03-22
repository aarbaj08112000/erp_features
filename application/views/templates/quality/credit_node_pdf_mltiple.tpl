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
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;700&amp;display=swap">
<table cellspacing="0" border="1px" style="margin-right:10px;">
   <tbody>
   	<%foreach from=$copies key=key item=value %>
      <tr style="font-size:11px">
         <%$company_logo %>
         <td colspan="<%if $company_logo neq ''%>10<%else%>12<%/if%>" style="    padding: 0px;">
            <table cellspacing="0" border="0px" width="100%">
               <tbody>
                  <tr>
                     <th style="border: 0px;text-align:right;font-size:9px;border-bottom: 2px solid black;padding:2px">
                        <%$value%>
                     </th>
                  </tr>
                  <tr>
                     <th style="border: 0px;text-align:center; font-size:13px;border-bottom: 2px solid black;padding:6px"><%$pdf_title%></th>
                  </tr>
                  <tr>
                     <th style="border: 0px;font-size:9px;text-align:center;padding:5px">
                        <b style="margin-top:-100px;font-size:20px"><%$client_data->client_name%>
                        </b><br>
                        <span><%$client_data->billing_address%></span>
                     </th>
                  </tr>
               </tbody>
            </table>
         </td>
      </tr>
      <tr style="font-size:11px">
         <td colspan="3" style="width:80px;text-align:left;">
            <b>&nbsp;PAN NO : </b> <%$client_data->pan_no%><br>
            <b> &nbsp;GST NO : </b><%$client_data->gst_number%><br>
            <b> &nbsp;STATE : </b> <%$client_data->state%><br>
            <b> &nbsp;STATE CODE : </b> <%$client_data->state_no%><br>
            <b> &nbsp;VENDOR CODE : </b><%$customer_data->vendor_code%><br>
         </td>
         <td colspan="2"  style="width:115px;text-align:left;">
            <b>&nbsp;INVOICE NO : </b> <%$rejection_sales_invoice->sales_invoice_number%><br>
            <b> &nbsp;INVOICE DATE : </b><%$rejection_sales_invoice->client_invoice_date%><br>
            <b> &nbsp;PO NUMBER : </b> <%$po_number%><br>
            <b> &nbsp;PO DATE: </b> <%$po_date%><br>
            <br>
            <br>
         </td>
         <td colspan="7"  style="width:375px;">
            <span style="font-size:15px;"> <b>
            	<%if ($rejection_sales_invoice->type == "DebitNote")%>DEBIT NOTE NO<%else if ($rejection_sales_invoice->type == "ProformaInvoice")%>PROFORMA INVOICE NO<%else %>CREDIT NOTE NO<%/if%> :<%$rejection_sales_invoice->rejection_invoice_no%></b></span><br>
            <b> &nbsp;<%if ($rejection_sales_invoice->type == "DebitNote") %>DEBIT NOTE DATE <%else if ($rejection_sales_invoice->type == "ProformaInvoice")%>PROFORMA INVOICE DAT <%else %>CREDIT NOTE DATE<%/if%> :</b> <%$rejection_sales_invoice->created_date %><br>
            <b> &nbsp;CUSTOMER DEBIT NOTE NO : </b> <%$rejection_sales_invoice->document_number%><br>
            <b>&nbsp;CUSTOMER DEBIT NOTE DATE : </b> <%$rejection_sales_invoice->debit_note_date %><br>
            <span style="font-size:8px">WHETHER TAX ON REVERSE CHARGE: NO</span>
         </td>
      </tr>
      <tr style="font-size:11px;">
	               <td colspan="5">
	                  <b>&nbsp;Details of Receiver (Billed To)</b><br>
	                  &nbsp;<b><%$customer_data->customer_name%></b><br>
	                  &nbsp;<%$customer_data->billing_address%><br>
	                  <b> &nbsp;STATE :</b> <%$customer_data->state%>&nbsp;&nbsp;<b> &nbsp;STATE CODE :</b> <%$customer_data->state_no %>
	                  <br>
	                  <b> &nbsp;PAN NO : </b><%$customer_data->pan_no %>
	                  <br>
	                  <b> &nbsp;GST NO :</b> <%$customer_data->gst_number %>
	               </td>
	               <td colspan="7">
	                  <b>&nbsp;Details of customer (Shipped to)</b><br>
	                  &nbsp;<b><%$shipping_data['shipping_name'] %></b><br>
	                  &nbsp;<%$shipping_data['ship_address'] %><br>
	                  <b> &nbsp;STATE : </b><%$shipping_data['state']%>&nbsp;&nbsp;<b> &nbsp;STATE CODE :</b> <%$shipping_data['state_no']%><br>
	                  <b> &nbsp;PAN NO : </b> <%$shipping_data['pan_no'] %><br>
	                  <b> &nbsp;GST NO : </b> <%$shipping_data['gst_number'] %>
	               </td>
	            </tr>
     
      <tr style="font-size:11px;text-align:center">
         <th style="width:20px;">Sr No</th>
         <th colspan="4" style="width:350px;text-align:left;">Part Description <br><i> Part Number</i></th>
         <th>HSN / SAC </th>
         <th>Packaging&nbsp;</th>
         <th>&nbsp;UOM&nbsp;</th>
         <th>&nbsp;QTY&nbsp;</th>
         <th>&nbsp;Rate&nbsp;</th>
         <th colspan="2">&nbsp;Amount (Rs)&nbsp;</th>
      </tr>
       	 <%assign var='total_value' value=0%>
       	 <%assign var='cgst_amount' value=0%>
       	 <%assign var='sgst_amount' value=0%>
       	 <%assign var='igst_amount' value=0%>
       	 <%assign var='gst_amount' value=0%>
       	 <%assign var='tcs_amount' value=0%>
       	 <%assign var='total_amount' value=0%>
         <%foreach from=$parts_rejection_sales_invoice key=key item=value %>
         	 <%assign var='total_amount' value=$value->basic_total%>
	         <%assign var='total_value' value=$total_value + $total_amount%>
	       	 <%assign var='cgst_amount' value=$cgst_amount + $value->cgst_amount%>
	       	 <%assign var='sgst_amount' value=$sgst_amount + $value->sgst_amount%>
	       	 <%assign var='igst_amount' value=$igst_amount + $value->igst_amount%>
	       	 <%assign var='gst_amount' value=$gst_amount + $value->gst_amount%>
	       	 <%assign var='tcs_amount' value=$tcs_amount + $value->tcs_amount%>
	       
      <tr style="font-size:10px;">
         <td style="text-align:center;"><%$key+1%></td>
         <td colspan="4" style="max-width:28px;word-wrap: break-word;text-align:left;"><%$value->part_description %><br><b><%$value->part_number %></b></td>
         <td style="text-align:center;"><%$value->hsn_code %></td>
         <td style="text-align:center;"><span style="text-size:small"><%$value->packagingQtyFactors %><br></span></td>
         <td style="text-align:center;"><%$value->uom%></td>
         <td style="text-align:center;"><%number_format($value->qty,2)%></td>
         <td  style="text-align:center;"><%number_format($value->part_price,2) %></td>
         <td colspan="2" style="text-align:center;"><%$value->qty*$value->part_price %></td>
      </tr>
      <%/foreach%>
      <tr>
         <td colspan="12" valign="BOTTOM" style="font-size:10px;height:<%$height%>">Remark: <%$rejection_sales_invoice->remark %></td>
      </tr>
      <tr style="font-size:10px">
         <td rowspan="2" colspan="7">
            <b>&nbsp;Mode Of Transport : </b><%$mode[$rejection_sales_invoice->mode]%>&nbsp;&nbsp;&nbsp;&nbsp;<b>&nbsp;Vehicle No : </b><%$rejection_sales_invoice->vehicle_number %>&nbsp;&nbsp;&nbsp;&nbsp;<b>&nbsp;L.R No : </b><%$rejection_sales_invoice->lr_number %>
            <br><b>&nbsp;Transporter : </b><%$rejection_sales_invoice->transporter_id %><br>
         </td>
         <td colspan="2" style="text-align:center;margin-left:10px;">SUB TOTAL </td>
         <td colspan="3" style="text-align:center"><%$total_value %></td>
      </tr>
      <tr style="font-size:10px">
         <td colspan="2" style="text-align:center">IGST <%if ($parts_rejection_sales_invoice[0]->igst == '')%>0<%else %> <%$parts_rejection_sales_invoice[0]->igst%><%/if%>%</td>
         <td colspan="3" style="text-align:center"><%$igst_amount %></td>
      </tr>
      <%assign var="final_gst_value" value=$cgst_amount + $sgst_amount + $igst_amount + $tcs_amount%>
      <%assign var="final_gst_value" value=numberToWords(number_format((float) $final_gst_value, 2, '.', ''))%>
      <%assign var="final_amount_val" value=$total_value+$cgst_amount + $sgst_amount + $igst_amount + $tcs_amount%>
      <%assign var="final_amount_val" value=numberToWords(number_format((float) $final_amount_val, 2, '.', ''))%>
      <tr style="font-size:10px">
         <td rowspan="5" colspan="7">
            <b> &nbsp;Payment Terms : <%$customer_data->payment_terms %></b> <br>
            <span><b> &nbsp;Bank Details : </b> <%$customer_data->bank_details %></span><br>
            <b> &nbsp;Electronic Reference No.</b> <br>
            <span> <b> &nbsp;GST Value (In Words) : </b> <%$final_gst_value %> </span><br>
            <span> <b> &nbsp;Invoice Value (In Words) : </b> <%$final_amount_val %> </span>
         </td>
         <td colspan="2" style="text-align:center;margin-left:10px;">CGST <%if ($parts_rejection_sales_invoice[0]->cgst == '')%>0<%else%><%$parts_rejection_sales_invoice[0]->cgst%><%/if%>%</td>
         <td colspan="3" style="text-align:center"><%$cgst_amount%></td>
      </tr>
      <tr style="font-size:10px">
         <td colspan="2" style="text-align:center;margin-left:10px;">SGST  <%if ($parts_rejection_sales_invoice[0]->sgst == '')%>0<%else%>><%$parts_rejection_sales_invoice[0]->sgst%><%/if%>%</td>
         <td colspan="3" style="text-align:center"><%$sgst_amount %></td>
      </tr>
      <tr style="font-size:10px">
         <td colspan="2" style="text-align:center">TCS <%if ($parts_rejection_sales_invoice[0]->tcs == '')%>0<%else%><%$parts_rejection_sales_invoice[0]->tcs%><%/if%>%</td>
         <td colspan="3" style="text-align:center"><%$igst_amount %></td>
      </tr>
      <tr style="font-size:10px">
         <td colspan="2 style=" text-align:center;margin-left:10px;">P&F Charges</td>
         <td colspan="3" style="text-align:center"><%$rejection_sales_invoice->freight_charges %></td>
      </tr>
      <tr style="font-size:10px">
         <th colspan="2" style="text-align:center">GRAND TOTAL (Rs) </th>
         <th colspan="3" style="text-align:center"><%$rejection_sales_invoice->freight_charges+$total_value+$igst_amount+$cgst_amount+$sgst_amount+$igst_amount %></th>
      </tr>
      <%$footer_html%>
      <%/foreach%>
   </tbody>
</table>