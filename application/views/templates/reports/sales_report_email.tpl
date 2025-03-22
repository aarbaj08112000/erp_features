<table style="width: 100%; border-collapse: collapse; border: 0; border-spacing: 0; font-family: Arial, Helvetica, sans-serif; background-color: rgba(239, 239, 239, 1);">
    <tbody>
        <tr>
            <td align="center" style="padding: 3rem 11rem; vertical-align: top; width: 100%;">
                <table
                    style="
                        max-width: 700px;
                        border-collapse: collapse;
                        border-top: 0 solid rgba(0, 0, 255, 1);
                        border-right: 0;
                        border-bottom: 0;
                        border-left: 0;
                        border-spacing: 0;
                        text-align: left;
                        min-width: 600px;
                        font-size: 14px;
                        background-color: rgba(255, 255, 255, 1);
                    "
                >
                    <tbody>
                        <tr>
                            <td>
                                <div style="padding: 20px; background-color: rgba(255, 255, 255, 1);">
                                    <table width="700" border="0" cellspacing="0" cellpadding="5" align="left" bgcolor="#fff">
                                        <tbody>
                                            <tr>
                                                <td
                                                    align="center"
                                                    style="
                                                        padding: 0px ;
                                                        background-position: initial;
                                                        background-size: initial;
                                                        background-repeat: initial;
                                                        background-attachment: initial;
                                                        background-origin: initial;
                                                        background-clip: initial;
                                                        background-color: rgba(112, 187, 217, 1);
                                                    "
                                                >
                                                    <h1  style="
                                                        padding-top: 17px ;">Sales Report</h1>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding: 36px 30px 42px;">
                                                   <table class="table" style="width: 100%" border="5" cellpadding="10" cellspacing="0">
													 
													  <tbody>
													  	<tr>
													  		<td scope="col" rowspan="2">SR No</td>
													      <td scope="col" rowspan="2">Customer Name</td>
													      <td scope="col">Yesterdays <br>Sales Total</td>
													      <td scope="col">Current <br>Month Sales Total</td>
													  	</tr>
													  	<tr>
													      <td scope="col" align="center"><%$total_yeaster_day_sales %></td>
													      <td scope="col" align="center"><%$total_current_month_sales %></td>
													  	</tr>
													  	<%if (count($customer_report_data) > 0) %>
													  		<%foreach from=$customer_report_data key='key' item='value' %>
															  		<tr>
															      <th scope="row"><%$key+1 %></th>
															      <td><%$value['customer_name'] %></td>
															      <td><%$value['yeaster_day_sales'] %></td>
															      <td><%$value['current_month_sales'] %></td>
															    </tr>
															<%/foreach%>
													    <%else %>
													  		<tr><td colspan="4" style="text-align: center;">No Sales Data Found!</td></tr>
													  	<%/if%>
													    
													    
													  </tbody>
													</table>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>
