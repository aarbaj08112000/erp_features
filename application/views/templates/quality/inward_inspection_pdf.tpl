
       <%assign var='padding' value="" %>
       <%if count($raw_material_inspection_master)%8 == 0 %>
       	<%assign var='padding' value=8 %>
       <%/if%>
       <table cellspacing="0" cellpadding="4" border="1">
                    
            
            <%assign var='remaining_count' value=count($raw_material_inspection_master)%8 %>
            <%assign var='i' value=1 %>
            <%foreach from=$raw_material_inspection_master key=key item=value %>
                    <tr>
                        <td width="7%" style="text-align:center;padding:20px;font-size:14px;height: 50.9px;" ><%$i %></td>
                        <td width="13%" style="text-align:center;padding:20px;font-size:14px;" ><%$value->parameter %> </td>
                        <td width="13%" style="text-align:center;font-size:14px;"><%$value->specification %></td>
                        <td width="13%" style="text-align:center;font-size:14px;"><%$value->evalution_mesaurement_technique %></td>
                        <td width="9%" style="text-align:center;font-size:14px;"><%$value->observation %></td>
                        <td width="9%" style="text-align:center;font-size:14px;"><%$value->observation2 %></td>
                        <td width="9%" style="text-align:center;padding:20px;font-size:14px;" colspan="2"><%$value->observation3 %></td>
                        <td width="9%" style="text-align:center;padding:20px;font-size:14px;" colspan="2"><%$value->observation4 %></td>
                        <td width="9%" style="text-align:center;padding:20px;font-size:14px;" colspan="2"><%$value->observation5 %></td>
                        <td width="9%" style="text-align:center;padding:20px;font-size:14px;" colspan="2"><%$value->remark %></td>
                        
                    </tr>
                   
            <%assign var='i' value=$i+1 %>
            <%/foreach%>
            </table>

                <%if ($remaining_count < 9 && $remaining_count >= 1) %>
                   <%assign var='remaining_count' value=8 - $remaining_count %>
                   <%assign var='sapce' value=0 %>
                   	<%if ($remaining_count eq 1)%>
                   		<%assign var='sapce' value=5 %>
                   	<%else if ($remaining_count eq 2)%>
                   		<%assign var='sapce' value=8.9 %>
                   	<%else if ($remaining_count eq 3)%>
                   		<%assign var='sapce' value=10.7 %>
                   	<%else if ($remaining_count eq 4)%>
                   		<%assign var='sapce' value=11.7 %>
                   	<%else if ($remaining_count eq 5)%>
                   		<%assign var='sapce' value=12.3 %>
                   	<%else if ($remaining_count eq 6)%>
                   		<%assign var='sapce' value=12.6 %>
                   	<%else if ($remaining_count eq 7)%>
                   		<%assign var='sapce' value=13 %>
                   	<%else if ($remaining_count eq 8)%>
                   		<%assign var='sapce' value=13.1 %>
                   <%/if%>
               
                <%if ($remaining_count < 9 && $remaining_count >= 1) %>
            
                  <table cellspacing="0" cellpadding="<%$sapce %>" style="" border="0" style="border-bottom-width: 1.5px;border-left-width: 1.5px;border-right-width: 1.5px;" border=1>
                  	<%for $foo=1 to $remaining_count %>
					    <tr >
	                       <td width="100%" style="" colspan="0" style="height: 50.9px;">&nbsp;</td> 
	                    </tr> 
					<%/for%>

                  </table>

                <%/if%>

                <%/if%>
           