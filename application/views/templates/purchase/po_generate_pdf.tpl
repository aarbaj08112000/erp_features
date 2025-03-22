<style>
   .page-break { page-break-before: always; }
   body {
   line-height: 20px; /* Adjust this value for desired line spacing */
   }
</style>
	<%foreach from=$part_arr key=key_val item=val %>
		<table cellspacing="0" cellpadding="6.5" border="1">
		   <tbody>
		     <%foreach from=$val key=key item=value %>
			      <tr>
			         <td width="4%" style="text-align:center;padding:20px;font-size:9.6px;height:47.7px"><%$key+1 %></td>
			         <td width="38%" style="text-align:left;padding:20px;font-size:9.6px;height: 64.6px"><%$value['part_number']%>/<%$value['part_description'] %> </td>
			         <td width="8%" style="text-align:center;font-size:9.6px;"><%$value['hsn_code'] %></td>
			         <td width="10.333333333%" style="text-align:center;font-size:9.6px;"><%$value['part_rate_new'] %></td>
			         <%if ($po_discount_type == 'Part Level') %>
			         <td width="12.666666666%" style="text-align:center;padding:20px;font-size:9.6px;" colspan="2"><%$value['discount_amount']%></td>
			         <%/if%>
			         <td width="7.333333333%" style="text-align:center;font-size:9.6px;"><%$value['qty'] %></td>
			         <td width="7.333333333%" style="text-align:center;font-size:9.6px;"><%$value['uom_name'] %></td>
			         <%if ($po_discount_type != 'Part Level')%>
			            <%if ($with_in_state == 'yes') %>
					         <td width="6.333333333%" style="text-align:center;padding:20px;font-size:9.6px;" colspan="2"><%$value['cgst'] %></td>
					         <td width="6.333333333%" style="text-align:center;padding:20px;font-size:9.6px;" colspan="2"><%$value['sgst']%></td>
				        <%else %>
					         <td width="12.666666666%" style="text-align:center;padding:20px;font-size:9.6px;" colspan="2"><%$value['igst'] %></td>
					    <%/if%>
			            
			        <%/if%>
			         <td width="12.333333333%" style="text-align:center;padding:20px;font-size:9.6px;" colspan="2"><%$value['total_amount'] %></td>
			      </tr>
		      <%/foreach%>
		   </tbody>
		</table>
		<style>
		   th, td ,b{ 
		   font-family: "Poppins", sans-serif;
		   line-height: 1.8
		   }
		</style>
		<%if (count($part_arr) != ($key_val+1)) %>
		     <br pagebreak="true"/>
		<%/if%>
   
   <%/foreach%>
	<%assign var=remaining_value  value=$total_product%6 %>
	<%assign var=remaining_count  value=6 - $remaining_value %>
   
   <%assign var=sapce value=0%>
   	<%if ($remaining_count == 1)%>
   		<%assign var=sapce  value=19 %>
   	<%else if ($remaining_count == 2)%>
   		<%assign var=sapce  value=19 %>
   	<%else if ($remaining_count == 3)%>
   		<%assign var=sapce  value=19 %>
   	<%else if ($remaining_count == 3)%>
   		<%assign var=sapce  value=10.3 %>
   	<%else if ($remaining_count == 4)%>
   		<%assign var=sapce  value=19 %>
   	<%else if ($remaining_count == 5)%>
   		<%assign var=sapce  value=18.9 %>
   	<%else if ($remaining_count == 6)%>
   		<%assign var=sapce  value=18.3 %>
   	<%else if ($remaining_count == 7)%>
   		<%assign var=sapce  value=10.3 %>
   	<%else if ($remaining_count == 8)%>
   		<%assign var=sapce  value=16.2 %>
   	<%/if%>
<%if ($remaining_count < 6 ) %>
	<table cellspacing="0" cellpadding="<%$sapce %>" style="" border="0" style="border-bottom-width: 0px;border-left-width: 1px solid #000;border-right-width: 1px solid #000;">
		<%for $foo=1 to $remaining_count %>
		    <tr >
		      <td width="100%" style="" colspan="0" >&nbsp;</td>
		   </tr>
		<%/for%>
	</table>
<%/if%>