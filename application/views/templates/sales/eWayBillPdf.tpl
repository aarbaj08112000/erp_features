<table cellpadding="5" cellspacing="0" border="1" >
    <tr>
        <td colspan="12" style="text-align:center; font-size:18px;"><b>e - Way Bill</b></td>
    </tr>
    <tr>
        <td colspan="8" style="vertical-align:top;">
        	 Doc No: <b><%$new_sales_data[0]->sales_number%></b><br>  Date: <b><%$new_sales_data[0]->created_date%></b><br>  Generated Date: <b><%$EwbDt%></b><br>  Valid Upto: <b><%$EwbValidTill%></b>
        	 <br>
        	 <br>
        IRN:  <span style="font-size:11px;padding-top: 4px;"><b><%$IRNNo%></b></span>
        </td>
        <td colspan="4" style="text-align:center;">
            <img src="<%$qr_code%>" width="180" height="120" />
        </td>
    </tr>
    <tr>
        <td colspan="12" style="text-align:left; font-size:16px;"><b>1. e - Way Bill Details</b></td>
    </tr>
    <tr>
        <td colspan="6" style="vertical-align:top;font-size:14px;">
            e - Way Bill No: <b><%$EwbNo%></b><br>
            Generated By: <b><%$client_data[0]->gst_number%></b><br>
            Supply Type: <b>Outward - Supply</b>
        </td>
        <td colspan="6" style="vertical-align:top;font-size:14px;">
            Mode: <b><%$new_sales_data[0]->mode%></b><br>
            Approx Distance: <b><%$new_sales_data[0]->distance%> KM</b><br>
            Transaction Type: <b>Regular</b>
        </td>
    </tr>
    <tr>
        <td colspan="12" style="text-align:left; font-size:16px;"><b>2. Address Details</b></td>
    </tr>
    <tr>
        <td colspan="6" style="vertical-align:top;font-size:13px;margin: 10px;">
        	<table >
        		<tr>
        			<td><b>From:</b><br><%$client_data[0]->client_name%><br><%$client_data[0]->address1%>,<%$client_data[0]->state%><%$client_data[0]->pin%><br>GSTIN: <%$client_data[0]->gst_number%>
        			</td>
        		</tr>
        	</table>
		
        </td>
        <td colspan="6" style="vertical-align:top;font-size:13px;padding: 20px;">
        	<table >
        		<tr>
        			<td><b>To:</b><br><%$shipping_data['shipping_name']%><br><%$shipping_data['ship_address']%>, <%$shipping_data['state']%> <%$shipping_data['pin_code']%><br>GSTIN: <%$shipping_data['gst_number']%>
            		</td>
        		</tr>
        	</table>
        </td>
    </tr>
    <tr>
        <td colspan="6" style="vertical-align:top;font-size:13px;">
        	<table >
        		<tr>
        			<td><b>Dispatched From:</b><br><%$client_data[0]->client_name%><br><%$client_data[0]->address1%>, <%$client_data[0]->state%> <%$client_data[0]->pin%><br>GSTIN: <%$client_data[0]->gst_number%>
        			</td>
        		</tr>
        	</table>
        </td>
        <td colspan="6" style="vertical-align:top;font-size:13px;">
        	<table >
        		<tr>
        			<td><b>Ship To:</b><br><%$shipping_data['shipping_name']%><br><%$shipping_data['ship_address']%>, <%$shipping_data['state']%> <%$shipping_data['pin_code']%><br>GSTIN: <%$shipping_data['gst_number']%>
        				</td>
        		</tr>
        	</table>
        </td>
    </tr>
    <tr>
        <td colspan="12" style="text-align:left; font-size:16px;"><b>3. Goods Details</b></td>
    </tr>
    <tr style="font-size:12px;text-align:center;">
        <th width="10%">HSN Code</th>
        <th width="18%">Product Name</th>
        <th width="38%" colspan="6" style="text-align:left;">Product Description</th>
        <th width="10%">Quantity</th>
        <th width="12%">Taxable Amt</th>
        <th width="12%" colspan="2">Rate</th>
    </tr>

    <%foreach from=$part_arr item=part%>
    <tr  style="font-size:12.8px;text-align:center;">
        <td><%$part['hsn_codes']%></td>
        <td><%$part['part_number']%></td>
        <td colspan="6" style="text-align:left;"><%$part['part_description']%></td>
        <td><%$part['qty']%></td>
        <td><%$part['subtotal']%></td>
        <td colspan="2"><%$part['gst']%></td>
    </tr>
    <%/foreach%>
   
    
    <tr>
        <td colspan="4" width="28%" style="font-size:14px;"> Discount(): <b><%$new_sales_data[0]->discount_amount%></b><br> Tot.Taxable Amt: <b><%$final_basic_total%></b>
        </td>
        <td colspan="4" width="38%" style="font-size:14px;"> CGST Amt: <b><%$sales_cgst%></b><br> SGST Amt: <b><%$sales_sgst%></b><%if $sales_igst gt 0%><br> IGST Amt: <b><%$sales_igst%></b><%/if%>
        </td>
        <td colspan="4" width="34%" style="font-size:14px;">Total Inv Amt: <b><%$final_po_amount%></b>
        </td>
    </tr>
    <tr>
        <td colspan="12" style="text-align:left; font-size:16px;"><b>4. Transportation Details</b></td>
    </tr>
    <tr>
        <td colspan="12" style="vertical-align:top;font-size:13px;">Transporter ID: <b><%$transporter_data[0]->transporter_id%></b>
             &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Name: <b><%$transporter_data[0]->name%></b>
        </td>
    </tr>
    <tr>
        <td colspan="12" style="text-align:left; font-size:16px;"><b>5. Vehicle Details</b></td>
    </tr>
    <tr style="font-size:13px;">
        <td colspan="4" align="top">Vehicle No: <b><%$new_sales_data[0]->vehicle_number%></b></td>
        <td colspan="4" align="top">From: </td>
        <td colspan="4" align="top">CEWB No: </td>
    </tr>
</table>