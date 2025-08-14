<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CsvController extends Controller
{
    public function csv_view() {
        return view('CSV.csv_view');
    }


    public function create_csv(Request $request){
        die($request);
        return response()->json(['data' => view('CSV.csv_result' , ['result' => $request->all()])->render()]);
    }


     public function generate(Request $request)
    {
        $fileName = $request->input('file_name');
        $headers = $request->input('headers');
        $sql = $request->input('sql');
       
        // CFM Template Content
       $cfmContent = '
<Cfset FName1 ="'.$fileName.'">
<cftry>
    <CFFILE ACTION="DELETE" FILE="#FName1#">
<cfcatch></cfcatch>
</cftry>
<CFQUERY NAME="GetLoop" datasource="#Client.database#">
'.$sql.'
</CFQUERY>

<Cfset Ex1="">
<Cfif GetLoop.recordcount gt 0>
    <cfset sObj=SpreadsheetNew()>
    <cfset SpreadsheetAddRow(sObj, "'.$headers.'")>
    <cfset SpreadsheetFormatRow(sObj, {alignment="Right"}, 1)>
    <cfset SpreadsheetAddRows(sObj, GetLoop)>
    <cfspreadsheet action="write" name="sObj" filename="#replace(FName1,\'\\\\\',\'/\',\'all\')#" sheetname="Contract">
</Cfif>
';


        $tempFile = storage_path('app/generated_query.cfm');
        file_put_contents($tempFile, $cfmContent);

        return response($cfmContent)
    ->header('Content-Type', 'application/octet-stream')
    ->header('Content-Disposition', 'attachment; filename="generate_file.cfm"');//Response::download($tempFile, 'generated_query.cfm')->deleteFileAfterSend(true);
    }
}


