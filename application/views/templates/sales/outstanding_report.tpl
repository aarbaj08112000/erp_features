
<table cellpadding="5" cellspacing="0" style="width:100%; " border="0">
        <thead>
            <tr>
                <th style="text-align:left;border-bottom:2px solid black;" width="50%"><h2>Outstanding Report <br><span style="font-size: 14px;font-weight: normal;line-height: 15px;">(<%$date_filter%>)</span></h2></th>
                <th style="text-align:right;border-bottom:2px solid black;line-height: 40px;" width="36%"><h4>Generated Date : </h4></th>
                <th style="text-align:left;border-bottom:2px solid black;line-height: 40px;"  width="14%"><%defaultDateFormat(date("Y/m/d"))%></th>
            </tr>
        </thead>

    </table>
    <table cellpadding="5" cellspacing="0" style="width:100%; " border="0">
        <thead>
            <tr>
                <th style="text-align:left;border-bottom:2px solid black;border-top:2px solid black;">Bill No</th>
                <th style="text-align:center;border-bottom:2px solid black;border-top:2px solid black;">Bill Date</th>
                <th style="text-align:center;border-bottom:2px solid black;border-top:2px solid black;">Receivable Amount</th>
                <th style="text-align:center;border-bottom:2px solid black;border-top:2px solid black;">Payable Amount</th>
                <th style="text-align:center;border-bottom:2px solid black;border-top:2px solid black;">Due Date</th>
                <th style="text-align:center;border-bottom:2px solid black;border-top:2px solid black;">Due Days</th> 
            </tr>
        </thead>
        <tbody>

            <%foreach $merge_arr as $val%>
                <tr>
                    <td style="text-align:left;" width="70%" colspan="6"><h3><%$val[0]['party_name']%></h3></td>
                    <td style="text-align:left;" width="30%" colspan="6">Phone Number : <%$val[0]['mobile_no']%></td>
                </tr>
                <tr>
                    <td style="text-align:left;font-size: 15px;" width="100%" colspan="6"><%$val[0]['billing_address']%> </td>
                </tr>
                
                <%assign var='total_Amount' value=0%>
                <%assign var='type' value=$val[0]['type']%>
                <%foreach $val as $row%>
                    <tr>
                        <td style="text-align:left;"><%$row['invoice_number']%></td>
                        <td style="text-align:center;"><%defaultDateFormat($row['created_date_val'])%></td>
                        <td style="text-align:center;"><%display_no_character($row['bal_amnt'])%></td>
                        <td style="text-align:center;"><%display_no_character($row['bal_paybele_amnt'])%></td>
                        <td style="text-align:center;"><%display_no_character($row['due_date'])%></td>
                        <td style="text-align:center;"><%display_no_character($row['due_days'])%></td>
                    </tr>
                    <%if $type == "recive"%>
                        <%assign var='total_Amount' value=$total_Amount+$row['bal_amnt']%>
                    <%else%>
                        <%assign var='total_Amount' value=$total_Amount+$row['bal_paybele_amnt']%>
                    <%/if%>
                    
                 <%/foreach%>
                 <tr >
                        <td style="text-align:center;border-bottom:2px solid black;"><br><br></td>
                        <td style="text-align:center;border-bottom:2px solid black;"><b>Total</b></td>
                        <td style="text-align:center;border-bottom:2px solid black;"><b><%if $type == "recive"%><%$total_Amount%><%/if%></b></td>
                        <td style="text-align:center;border-bottom:2px solid black;"><b><%if $type == "pay"%><%$total_Amount%><%/if%></b></td>
                        <td style="text-align:center;border-bottom:2px solid black;"><br></td>
                        <td style="text-align:center;border-bottom:2px solid black;"><br></td>
                </tr>
                 

            <%/foreach%>
        </tbody>
    </table>