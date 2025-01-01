<?php
    $file_name = '';
    $header_name = '';
    $select_clm = '*';
    
    if(array_key_exists('mySelect',$result)){
        $select_clm = implode(',' , $result['mySelect']);
    }
    die($select_clm);
    if(array_key_exists('client_id' , $result) 
    && array_key_exists('file_name' , $result))
    {
        $file_name =  $result['file_name']."_"."#Client_id#";
    }
    elseif(array_key_exists('client_name' , $result) 
    && array_key_exists('file_name' , $result))
    {
        $file_name =  $result['file_name']."_"."#Client_name#";
    }
    elseif(array_key_exists('file_name' , $result))
    {
        $file_name = $result['file_name'];
    }
    if(array_key_exists('header' , $result))
    {
        $header_name = $result['header'];
    }
    $date_formate = $result['dateformate'];
    if(in_array('ddMMYYYY',$result) )
    {
        $date_formate = "replace(#File_Date#,'/','',all))";
    }
   
?>
<span>
        &lt;cfset FName1 ="#Dir#\{{$file_name}}_#{{$date_formate}}#.xls"&gt;<br>
        &lt;cftry&gt;<br>
            &emsp;&lt;CFFILE ACTION="DELETE" FILE="#FName1#"&gt;<br>
        &lt;cfcatch&gt;&lt;/cfcatch&gt;<br>
        &lt;/cftry&gt;<br>
        &lt;CFQUERY NAME="GetLoop" datasource="#Client.database#"&gt;<br>
            &emsp;SELECT {{$select_clm}}<br>
            &emsp; FROM NINST_TRADE_VIEW A, [NINST_MASTER] B<br>
            &emsp; WHERE a.company_code=b.company_code<br>
            &emsp; and a.ITEMPCODE=b.ITEMPCODE<br>
            &emsp;and TRADE_DATE=convert(datetime,'#File_Date#',103)<br>
            &emsp;AND COMPANY_CODE = '#COMPANY_CODE#'<br>
            &emsp;AND TRADE_DATE ='#TRADE_DATE#'<br>
            &emsp;and row_id in(#Row_id#)<br>
            &emsp;AND CLIENT_ID IN(<br>
            &emsp;&emsp;&emsp;select distinct CLIENT_ID<br>
            &emsp;&emsp;&emsp;from  NInst_Trade<br>
            &emsp;&emsp;&emsp;WHERE TRADE_DATE=	convert(datetime,'#File_Date#',103)<br>
            &emsp;&emsp;&emsp;and row_id in(#Row_id#)<br>
            &emsp;&emsp;)<br>
            order by ORGSCRIP_NAME
        &lt;/CFQUERY&gt;<br>
        &lt;Cfset Ex1=""&gt;<br>
        &lt;Cfif GetLoop.recordcount gt 0&gt;<br>
            &emsp;&lt;cfset sObj=SpreadsheetNew()&gt;<br>
            &emsp;&lt;cfset SpreadsheetAddRow(sObj, "{{$header_name}}")&gt;<br>
            &emsp;&lt;cfset SpreadsheetFormatRow(sObj, {bold=TRUE, alignment="left"}, 1)&gt;<br>
            &emsp;&lt;cfset SpreadsheetAddRows(sObj, GetLoop)&gt;<br>
            &emsp;&lt;cfspreadsheet action="write" name="sObj" filename="#replace(FName1,'\','/','all')#" sheetname="Contract"&gt;<br>
        &lt;/Cfif&gt;<br>
    </span>


