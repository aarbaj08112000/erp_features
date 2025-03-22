<style>
   table.fixed { table-layout:fixed; }
   table.fixed td { overflow: hidden; }
   html { margin: 15.8px;font-size:18px}
   footer {
   margin-top:20%;
   width: 100%;
   font-size:18px;
   }
    th, td {
            font-family: sans-serif !important;
                    }

</style>
<table cellspacing="0" style="" border="1px" cellpadding="5">
   <tbody>
      <tr>
         <th colspan="7" style="text-align:right; font-size:10px"><%$type%> </th>
      </tr>
      <tr>
         <th colspan="7" style="text-align:center">DELIVERY CHALLAN</th>
      </tr>
      <tr>
         <th colspan="7" style="text-align:center;font-size:12px">
            <%$client_data['client_name']%>
         </th>
      </tr>
      <tr>
         <td colspan="7	" style="text-align:center;font-size:12px"> <b><%$client_data['billing_address']%></b></td>
      </tr>
      <tr>
         <td colspan="7" style="text-align:center;font-size:12px"> FOR MOVEMENT OF INPUT/CAPITAL GOODS OR PARTIALLY PROCESSED GOODS UNDER RULE4(6)A FROM ONE
            FACTORY TO ANOTHER FACTORY FOR FURTHER PROCESSING/OPERATION AND RETURN
         </td>
      </tr>
      <tr>
         <td colspan="2" style="text-align:center;font-size:12px"><b>GSTIN :</b> <%$client_data['gst_number']%></td>
         <td colspan="2" style="text-align:center;font-size:12px"><b>STATE :</b> <%$client_data['state']%></td>
         <td colspan="3" style="text-align:center;font-size:12px"><b>STATE CODE :</b> <%$client_data['state_no']%></td>
      </tr>
      <tr>
         <td colspan="3" style="text-align:left;font-size:14px">To, <br>
            <span><%$customer_data['customer_name']%> </span><br>
            <span><%$customer_data['billing_address']%> </span><br>
            <b> GSTIN- </b><span><%$customer_data['gst_number']%></span> <br>
            <b>PAN NO:  </b> <span><%$customer_data['pan_no']%></span> <br>
         </td>
         <td colspan="4" style="text-align:left;font-size:14px">
            <b>Challan No : </b> <%$customer_challan_return_part['grn_code']%> <br>
            <b>Challan Date :</b> <%$customer_challan_return_part['created_date']%> <br>
            <b>Time Of Supply :</b> <%$customer_challan_return_part['created_time']%> <br>
            <b>Customer Challan Ref. : </b> <%$customer_challan_return_part['customer_challan_no']%> <br>
         </td>
      </tr>
      <tr style="text-align:center;font-size:12px;" >
         <th style="width: 1%;">Sr  No</th>
         <th style="width: 20%;">Part Number</th>
         <th style="width: 30%;">Part Description</th>
         <th style="width: 8%;">Quantity</th>
         <th style="width: 8%;">HSN</th>
         <th style="width: 7%;">Price</th>
         <th style="width: 15%;">Total Price</th>
      </tr>
      
      	<%assign var='total_price'  value=0 %>
      		<%foreach from=$customer_challan_return_part_details key=key item=value %> 
      			<%assign var='total_price'  value=$total_price+$value['total_rate']%>
	      		<tr style="text-align:center;font-size:12px;">
	      		<td style="height: 50px;"><%$key+1%></td>
		         <td>
		            <%$value['part_number']%>
		         </td>
		         <td>
		            <%$value['part_description']%>
		         </td>
		         <td>
		            <%number_format($value['qty'],2)%>
		         </td>
		         <td>
		           <%$value['hsn_code']%>
		         </td>
		         <td>
		            <%number_format($value['part_price'],2)%>
		         </td>
		         <td>
		            <%number_format($value['total_rate'],2)%>
		         </td>
		      </tr>
         
         
	      	<%/foreach%>

      	<%assign var='total_row' value=8-count($customer_challan_return_part_details) %>
      	<%for $foo=0 to $total_row-1 %>
		   <tr style="text-align:right;font-size:12px;">
      			<td colspan="7" style="border-bottom:none;border-top: none;height: 50px;">&nbsp;</td>
      		</tr>
		<%/for%>
      	
      	
      	
      	

         
      <tr style="text-align:right;font-size:12px">
         <th colspan="6">Total</th>
         <th style="text-align:center;font-size:12px"><%number_format($total_price,2)%></th>
      </tr>
      <tr>
         <td colspan="7" style="text-align:left;font-size:12px;height: 25px">
            <b>Amount In Words: </b> <%numberToWords($total_price)%>
         </td>
      </tr>
      <tr>
         <th colspan="3" style="text-align:left;font-size:12px;padding-left: 20px;">
            Transporter : <%$customer_challan_return_part['transporter_name']%> <br> <br>
            Vehicle No : <%$customer_challan_return_part['vehicle_number']%>
         </th>
         <%if ($signatureImageEnable =="Yes" && $signatureImageUrl != "") %>
         	<th colspan="4" style="text-align:center;font-size:12px;height: 85px;padding: 0px;padding-bottom: 2px;">
         		<br>
	            For <%$client_data['client_name']%>
	            <br><br>
	            <img src="<%$signatureImageUrl %>" height="80" width="170" style="background: white;">
	            <br>
	            Authorized Signatory
	            <br>
	         </th>
         <%else if ($digitalSignature == "Yes") %>
         	<th colspan="4" style="text-align:center;font-size:12px;height: 130px;">
            
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br>
           
         </th>

         <%else%>
         <th colspan="4" style="text-align:center;font-size:12px;height: 140px;">
            For <%$client_data['client_name'] %>
            <br><br>
            <br><br>
            <br><br>
            <br>
            Authorized Signatory
         </th>

     	<%/if%>
      </tr>
      
   </tbody>
</table>