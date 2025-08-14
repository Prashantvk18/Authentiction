@include('User.header')

<style>
    /* Some basic styling for the demo */
    #contapner {
        margin: 20px;
    }
    select, input {
        margin-bottom: 10px;
    }
</style>
<?php
$array = [
    "" , "COMPANY_CODE", "CLIENT_ID", "clid", "TRADE_DATE", "MKT_TYPE", "SETTLEMENT_NO", "SCRIP_SYMBOL", "SCRIP_NAME", "BUY_SALE", "CONTRACT_NO",
    "TRADE_TYPE", "BILL_NO", "QUANTITY", "TurnOver", "MKT_PRICE", "MKT_Amount", "NET_PRICE", "BRK_RATE", "TOT_BRK", "USER_ID", "ORDER_NUMBER",
    "TRADE_DATETIME", "CUSTODIAN_CODE", "IS_MANUAL_BROKERAGE", "STP", "Confrom", "CNT", "INSTTRADES", "trade_col2", "USER_NOTES", "ROW_ID", "InstAutho",
    "ISIN", "TradeRndAmt", "STT_RND", "STT", "STTInclusiveamt", "TOC", "STAMP_DUTY", "CESS", "CGST", "SGST", "IGST", "UTT", "GST", "SEBI", "OTH", "OTH2",
    "OTH3", "OTH_Code", "OTH_Code2", "OTH_Code3", "NetBrokerage", "GSTValue", "GSTType", "CGSTp", "SGSTp", "IGSTp", "UTTp", "CessP", "BrokerState", "FromGSTIN",
    "ToGSTINNo", "ToGSTState", "PayinDate", "Instrument_Type", "Strike_Price", "Option_Type", "Expiry_date", "ScripSeries", "Finstyr", "LastOrderTime", "FirstOrderTime",
    "LastTradeTime", "FirstTradeTime", "DELIVERY_BROKERAGE_PER", "SCRIPGROUP", "TRADE_NUMBER", "STAX", "CLIENTGSTNUMBER", "TradeCheck", "ITEMPCODE", "ClNature",
    "cusi_Client", "STT_Inclusive", "TOC_Exclusive", "GST_Exclusive", "STD_Exclusive", "OTH_Exclusive", "fundpaidby", "Obligation", "ClientPost", "STP_FORMAT",
    "CSV_EXPORT_FORMATE", "ContractType", "LastProcessTime", "GST_Show", "STPISOSummary", "Inst_LastOrderTradeDetail", "First_ORDER_NO", "Last_ORDER_NO", "First_TRADE_NO",
    "Last_TRADE_NO", "Total_Exp", "AMTWITHSTT", "fINAL_Contract_Amt", "Contract_Amt", "Contract_Amt_aLL", "exchange", "CLIENT_NAME", "BROKER_CODE", "COMPANY_NAME",
    "SEBI_REG_NO", "DEPOSITORY", "SCRIPSHORTNAME", "GSTIN", "ExportTime", "ChangeMKtPrice", "NOOFLOTS", "LOTSIZE", "BLOOMBERTICKER", "ORGSCRIP_NAME", "Brk_Show", "CRTS_CODE",
    "Scheme_Short_Code", "SCRIP_NAME1", "InvoicePrefix", "InvoiceNo", "MANUAL_BRK_RATE", "CHG_IN_NETAMT", "CHG_IN_NETAMTRS", "STTRATEDIGIT", "SCRIP_NAME2", "SCRIP_NAME3",
    "SCRIP_NAME4", "SCRIP_NAME5", "SBIMFSHORTNAME", "SLP", "Scheme_Short_Code2", "STD_Show", "STP_ALWASESHOW_GST", "ORG_SETTLEMENT_NO", "STP_SHOW_STDIN_BRK", "TOT_BRK1",
    "STAMP_DUTY1", "GST_Exclusive_STDLess", "Trade_Product"
];
?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card p-5">
            <form action="#" class="dropzone" id="dropzoneForm">
    <div class="fallback">
        <input name="file" type="file" multiple />
    </div>
</form>
                <form id="createcsv">
                    <div class="row">
                        <h5 style="color:blue">------- File Name -------</h5>
                        <div class="col-md-4"> 
                            <label for="file_name" >File name :    </label>
                            <input type="text" name="file_name" id="file_name">  
                        </div>
                        <div class="col-md-2">
                            <label for="clientid">Client Id</label>
                            <input id="clientid" name="client_id" type="checkbox">
                        </div>
                        <div class="col-md-2">
                            <label for="clientname">Client Name</label>
                            <input id="clientname" name="client_name" type="checkbox">
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4 mt-4"> 
                            <label for="date_formate" >Date Formate : </label>
                            <select id="date_formate" name="dateformate" style="height:30px">
                                <option value="ddMMYYYY">DDMMYYYY</option>
                                <option value="MMDDYYYY">MMDDYYYY</option>
                                <option value="YYYYMMDD">YYYYMMDD</option>
                                <option value="date1">DD-MM-YYYY</option>
                                <option value="date2">YYYY-MM-DD</option>
                                <option value="trade_date">DD/MM/YYYY</option>
                            </select>
                        </div>
                        <div class="col-md-4">

                        </div>
                        <div class="col-md-4">
                        </div>
            
                    
                        <h5 style="color:blue">------- Create select query -------</h5>
                        <div class="col-md-8">
                            <div id="container">
                                <!-- <button onclick="addRow()">Add Row</button>
                                <button onclick="cancelRow()">Cancel Last Row</button> -->
                                <!-- Your HTML content -->
                            
                            <select  style="width:700px" multiple name="mySelect[]">
                               <?php 
                                for($i=0;$i < count($array) ; $i++){
                                    $value = $array[$i];
                                    echo "<option value='$value' >$array[$i]</option>";
                                }
                               ?>
                            </select>
                                <br><br>
                            </div>
                        </div>
                        <div class="col-md-4">
                        </div>
                        <h5 style="color:blue">------- Enter Excel Column Header Name -------</h5>
                        <div class="col-md-8">
                            <textarea style="width:100%" name="header"></textarea>
                        </div>
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                        <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal" class="btn btn-lg btn-success" onclick="create_csv();">Create CSV</button>
                        </div>
                    </div>
                </form>
            </div>   
        </div>

        <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog" style="width:1500px">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content" style="width:1000px" >
            <div class="modal-body" id="form_data" style="width:1000px">
            </div>
            <div class="modal-footer" style="width:600px">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
            </div>
        </div>
    </div>
            <!---/Modal--->   
    </div>

</div>
<script>
    // Initialize Dropzone
    Dropzone.options.dropzoneForm = {
        maxFiles: 2,  // Limit to 5 files
        dictMaxFilesExceeded: "You can only upload 2 files.",  // Custom message when max files are exceeded
    
    // Event listener for when a file is added
        addedfile: function(file) {
            // Check the number of files already uploaded
            if (this.files.length > 2) {
                // Show an alert if more than 2 files are uploaded
                alert("You can only upload a maximum of 2 files.");
                
                // Remove the file that was just added (optional, if you want to prevent uploading more than 2 files)
                this.removeFile(file);
            }
        }
    };
</script>

<script>
   var $input = $("select");
$input.select2();
// var count = 0;
// $(document).on('click', '.select2-selection__rendered', function() {
//                 count++
//                 console.log(count);
//             });


/*$("ul.select2-selection__rendered").sortable({
  containment: 'parent'
});*/
   /* var rowCounter = 0;
    function addRow() {
        event.preventDefault();
        var container = document.getElementById("container");
        var newRow = document.createElement("div");
        var selectId = "select_" + rowCounter;
        var inputId = "input_" + rowCounter;
        
        newRow.innerHTML = `
            <select id="${selectId}" name="${selectId} ">
                <option value="option1">Option 1</option>
                <option value="option2">nption 2</option>
                <option value="option3">Option 3</option>
            </select>
            <input type="text" id="${inputId}" name="${inputId}" placeholder="Enter something">
        `;
        
        container.insertBefore(newRow, container.firstChild);
        rowCounter++;
    }

    function cancelRow() {
        event.preventDefault();
        var container = document.getElementById("container");
        var rows = container.getElementsByTagName("div");
        
        if (rows.length > 1) {
            container.removeChild(rows[rows.length - 1]); // Remove the last added row
        } else {
            alert("No rows to cancel!");
        }
    }*/

    function create_csv(){
        event.preventDefault();
        var formdata = $("#createcsv").serialize();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url:"{{ url('create_csv')}}",
            type:"POST",
            data:formdata,
            success: function(response){
                $("#form_data").html(response.data);
            },
            error: function(response){

            }
        })
    }
</script>
    
@include('User.footer')