
<table cellpadding="5" cellspacing="0" style="width:100%; " border="0">
        <thead>
            <tr>
                <th style="text-align:left;border-bottom:2px solid black;" width="30%"><h2><%$title%> <br></h2></th>
                <th style="text-align:right;border-bottom:2px solid black;line-height: 40px;" width="45%"><h4> Date : </h4></th>
                <th style="text-align:left;border-bottom:2px solid black;line-height: 40px;"  width="25%"><%$date%></th>
            </tr>
        </thead>

    </table>
    <table cellpadding="5" cellspacing="0" style="width:100%; " border="1">
        <thead>
            <tr>
                <%foreach $column as $row%>
                    <%assign var='position' value='left' %>
                    <%if $row['className'] == 'dt-right' %>
                        <%assign var='position' value='right' %>
                    <%else if $row['className'] == 'dt-center' %>
                        <%assign var='position' value='center' %>
                    <%/if%>
                    <th style="text-align:<%$position%>;"><%$row['title']%></th>
                <%/foreach%>
            </tr>
        </thead>
        <tbody>

            <%foreach $sales_data as $val%>
                <tr>
                     <%foreach $column as $row%>
                            <%assign var='position' value='left' %>
                            <%if $row['className'] == 'dt-right' %>
                                <%assign var='position' value='right' %>
                            <%else if $row['className'] == 'dt-center' %>
                                <%assign var='position' value='center' %>
                            <%/if%>

                             <td style="text-align:<%$position%>;"><%$val[$row['data']]%></td>
                     <%/foreach%>
                </tr>
               
            <%/foreach%>
        </tbody>
    </table>