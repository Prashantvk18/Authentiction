<?php
// Hardcoded tables and columns
$tables = [
    'NINST_TRADE_VIEW' => ["COMPANY_CODE", "CLIENT_ID", "clid", "TRADE_DATE", "MKT_TYPE", "SETTLEMENT_NO", "SCRIP_SYMBOL", "SCRIP_NAME", "BUY_SALE", "CONTRACT_NO",
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
    "STAMP_DUTY1", "GST_Exclusive_STDLess", "Trade_Product"],

    'CLIENT_MASTER' =>  ["COMPANY_CODE","CLIENT_ID","CLIENT_NAME","DELIVERY_CLIENT_ID","BRANCH_CODE","REMESHIRE_GROUP","REGISTRATION_DATE","LAST_MODIFIED_DATE","PRO","CLIENT_NATURE","CLIENT_TYPE","REF_NO","MIN_CASH_MARGIN","FAMILY_GROUP","NOTE1","NOTE2","NOTE3","WebAC","WebPassword","Client_WebXID","FLG_PMS","Unique_Cl_Id","PrintContract","PrintBill","FLG_ContractNoOptionInst","FLG_BrkDebitedToInst","FLG_STTDebitedToInst","FLG_APPLIEDSTT","FIRST_NAME","MIDDLE_NAME","LAST_NAME","FLG_INSERT_REVERSE_TRADE","FLG_REVERSETRADE_ROUNDING","CLIENTRISKVALUE","DR_INTEREST","CR_INTEREST","POOL_HOLD_CHARGE","BEN_HOLD_CHARGE","INTER_SETTLEMENT_CHARGE","BEN_TO_MARK_CHARGE","REMOTE_ADDR","LASTMODIFY_USER_ID","Payment_Request","Contract_Option","IsFamilyHead","HTML_Contract","Custodian_Id","Custodian_Part_Code","Courier_ID","IsInternetTrading","BTST_CLIENT","TURNOVER_BRK","Internet_Trading_ID","Client_Hold_Debit_LedgerLimit","Agreement_date","IBT_FLAG","IBT_CHARGE","IBT_Sub_Chgs","IBT_Brk_Chgs","ModuleNo","CHEKING","INST_GROSS_ROUNDING","INST_NET_ROUNDING","INST_PRINTSTT","RelationshipOfficer_CODE","RelationManager_CODE","Dealer_CODE","Introducer_CODE","pmr","NBFCCLIENT","AUTOAGEINGPROCESS","AUTOPMSPROCESS","AUTOINTERESTPROCESS","AUTOSTOCKFIFO","CUSI_CLIENT","CHECKER","CHECK_DATETIME","CHECKER_IPADDDRESS","INST_ROUNDINLGK","Client_InstNo","IBT_CHGSDROption","TriPartiateDt","Person_verify","NOW_CATEGORY","IVRS_CODE","IVRS_PIN","CROSS_MARGIN","CUSTODIAN_LIST","Pan_Name","ADD_INTEREST","INT_AMOUNT_RANGE","FIX_INT_AMT","Profit_Share_Per","TDS_Per","LastPasswardChange","Cl_DELI_B_TO","Cl_DELI_S_TO","Cl_Trd_TO","Cl_Gross_TO","NOW_CATEGORY_GLOBAL","Csc_flg","Risk_catg","Risk_Narr","CSC_Narr","IBT_AGREE_DATE","BTST_W","Approved_Loan","Loan_Approved_Date","NBFC_Start_Date","NBFC_Reg_Date","CLFundTrf","Person_verify_Name","Person_verify_Designation","UCC_REG_DATE","INPERSON_DATE","Sebi_Expiry_Date","Institute_type","Associate_Client_List","MOBILE_AGREE_DATE","DIGI_COMM_STDATE","NEW_KYC_REC_DATE","IBTScheme","BrokerageCompanywise","BrokerageGlobally","INSTSTTREV","CONSIDER_SOH_MARGIN","MTM_LIMIT_PER","MARGIN_PER","MTM_LIMIT_MORE_THEN_AMOUNT","MARGIN_MORE_THEN_AMOUNT","Stp_File_Generate","Profit_Share_PerType","Application_No","GROUP_CODE","loginattempted","loginattemptedacc","BTM_PER","BTM_MIN","BTM_MAX","BTM_CHARGE","BTC_PER","BTC_MIN","BTC_MAX","BTC_CHARGE","BTB_PER","BTB_MIN","BTB_MAX","BTB_CHARGE","EXPENSE_MERGE","TDSforCrInterest","CashInterest_PER","SERVICE_SHOW","EXPORT_DONE_UCC","UCC_STATUS","CCS_CL","IBT_SHARING_CLIENT_CODE","IBT_SHARING","TRUSTBASEPAYIN","NbfcClientLoanRequestLetter","NbfcCallonloanLetter","NbfcclientPANcopy","NbfcOthersPAN","NbfcOthersAddressProof","NbfcClientBankStatement","NbfcUndatedCheques","NbfcPromissaryNote","NbfcSTOPPaymentLetter","NbfcCompanyDeedDeclaration","NbfcCompanyIncorporationcert","NbfcCompanyBoardResolution","NbfcShareholdingpattern","NbfclistofAuthorisedDirector","NbfcIncomeTaxReturns","NbfcBalanceSheet","NbfcLoanAgreement","NbfcAddressProofClient","NbfcLISTofDirector","NACHFLAG","NACHRECEAMT","IBT_SHARING_TYPE","IBT_SHARING_CLIENT_CODE1","IBT_SHARING_CL1","NACHUMRNO","IBT_SHARING_TILLDATE","Client_Cust_InstNo","CL_OP_CHGS_CHQ","Remeshire_Interest","CL_OP_CHGS_DEBITED","Inst_UserID","Inst_Time","Inst_IP","Up_UserID","Up_Time","Up_IP","MIN_OP_CHARGES","OBLCUST","BRKAVGRATE","MODIFIED_DATE_EXPORT","Terminalid","UCLIENT_ID","Dealer_Commodity","MARGINPOSTPER","UCCFLG","UCC_DATE","WELCOME_LETTER","KYC_EXPORT","KYC_EXPORT_DATE","UCC_Response","UCC_Response_Date","NOTE4","Ipv_emp_code","Ipv_emp_place","Remeshire_Interest_MTF","MTF_Form_Activation_Dt"],

    'NINST_MASTER' =>  ["COMPANY_CODE","ITEMPCODE","ITEMPNAME","EQ_PER","EQ_MIN","FUT_PER","FUT_MIN","FUT_LOT","OPT_PER","OPT_MIN","OPT_LOT","GrossRateLogic","GrossRateDigit","BrkRateLogic","BrkRateDigit","BrkOnAmt","BrkOnAmtLogic","BrkOnAmtDigit","STT_Charge","fundpaidby","STT_Inclusive","TOC_Exclusive","GST_Exclusive","STD_Exclusive","OTH_Exclusive","OTH_CODE1","OTH_PER1","OTH_CODE2","OTH_PER2","OTH_CODE3","OTH_PER3","STP_FORMAT","CSV_EXPORT_FORMATE","ContractType","GST_Show","STPISOSummary","Inst_LastOrderTradeDetail","Row_id","Lock","Insert_IP","Insert_Time","Insert_User","Update_IP","Update_Time","Update_User","BrkRateWithGST","EmailID","MktOnAmtLogic","BrkRateLogic2","Brk_Show","BrkAmtWithGST","Chg_In_NetAmt","STTRateDigit","Templatebrkcode","shownetasmarket","FUT_PER1","FUT_MIN1","FUT_LOT1","OPT_PER1","OPT_MIN1","OPT_LOT1","STTRateLogic","Contract_ShowInclusive","Templatebrkname","Max_Brk_Contract","B_EQ_PER","B_EQ_MIN","B_FUT_PER","B_FUT_MIN","B_FUT_LOT","B_OPT_PER","B_OPT_MIN","B_OPT_LOT","B_FUT_PER1","B_FUT_MIN1","B_FUT_LOT1","B_OPT_PER1","B_OPT_MIN1","B_OPT_LOT1","STD_Show","BrkAmtWithGSTSTD","CSV_EXPORT_FORMATE2","CSV_EXPORT_FORMATE3","CSV_EXPORT_FORMATE4","CSV_EXPORT_FORMATE5","STP_AlwaseShow_GST","MIN_BRK_CONTRACT","BccEmailID","STP_SHOW_STDIN_BRK","PDF_EXPORT_FORMATE","CUSTODIAN_CLEARING","GST_Exclusive_STDLess","STDRateLogic","Stamp_duty_actual_chrg","BSECM_TOC_CHARGE","NSECM_TOC_CHARGE","NSEFO_TOC_CHARGE","NSEFO_TOC_CHARGE_OPTION","BSEFO_TOC_CHARGE","BSEFO_TOC_CHARGE_OPTION","STP_BRKLESSGST","STP_SEBI_IPFT_charg","Module_GSTType","NOTTOCHRGEGST"]
];
?>
@include('User.header')

    <style>
        .column-btn {
            margin: 4px;
        }
        .selected {
            background-color: #0d6efd !important;
            color: white;
        }
        .columns-container {
            margin-top: 20px;
        }
        textarea {
            font-family: monospace;
        }
        .scroll-x {
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            background: #f8f9fa;
        }
    </style>
</head>
<body class="bg-light py-4">

<div class="container">
    <h2 class="mb-4">📊 Dynamic SQL Query Builder</h2>

    <div class="row">
        <!-- Table selection -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-3">
                <div class="card-header bg-primary text-white">Select Tables</div>
                <div class="card-body">
                    <?php foreach ($tables as $tableName => $columns): ?>
                        <div class="form-check">
                            <input class="form-check-input table-checkbox" type="checkbox" value="<?php echo $tableName ?>" id="<?php echo $tableName ?>">
                            <label class="form-check-label" for="<?php echo $tableName ?>"><?php echo $tableName ?></label>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>

        <!-- Column selection -->
        <div class="col-md-8" style="overflow-y: hidden; overflow-x: auto;">
            <div id="columnsContainer" class="columns-container"></div>
        </div>
    </div>
<!-- File Name and Header Inputs -->
<div class="card shadow-sm mb-4">
    <div class="card-header bg-warning text-dark">CFM File Details</div>
    <div class="card-body">
        <div class="mb-3">
            <label class="form-label">CFM/Excel File Name (with ColdFusion vars): copy_this </label>
            <input type="text" id="fileNameInput" class="form-control" placeholder="e.g., #Dir#\Cash_EOD_#replace(File_Date,'/','','all')#.xls">
        </div>
        <div class="mb-3">
            <label class="form-label">Excel Header Row (comma-separated):</label>
            <textarea id="headerRowInput" class="form-control" rows="2" placeholder="e.g., Broker Name,Trade Date,Settlement Date,..."></textarea>
        </div>
    </div>
</div>

    <!-- SQL Query Output -->
    <div class="card shadow-sm mt-4">
        <div class="card-header bg-success text-white">Generated SQL Query</div>
        <div class="card-body">
            <textarea id="sqlTextarea" class="form-control" rows="10" placeholder="Your SQL will appear here..."></textarea>
        </div>
    </div>

   <div class="text-end mt-3">
    <button class="btn btn-outline-success" id="generateBtn">💾 Generate .CFM File</button>
</div>

</div>

<script>
    const tables = <?php echo json_encode($tables); ?>;
    const columnsContainer = document.getElementById('columnsContainer');
    const sqlTextarea = document.getElementById('sqlTextarea');

    let selectedTables = new Set();
    let selectedColumns = new Map(); // table => Set(columns)

    document.querySelectorAll('.table-checkbox').forEach(chk => {
        chk.addEventListener('change', function () {
            const table = this.value;
            if (this.checked) {
                selectedTables.add(table);
                selectedColumns.set(table, new Set());
            } else {
                selectedTables.delete(table);
                selectedColumns.delete(table);
            }
            renderColumns();
            updateSQL();
        });
    });

    function renderColumns() {
    columnsContainer.innerHTML = '';
    selectedTables.forEach(table => {
        const cols = tables[table];

        // Card structure
        const card = document.createElement('div');
        card.className = 'card mb-3';
        card.innerHTML = `
            <div class="card-header">${table} Columns</div>
            <div class="card-body">
                <input type="text" class="form-control mb-3" placeholder="🔍 Search columns..." oninput="filterColumns(this, '${table}')">
                <div class="scroll-x" id="column-buttons-${table}"></div>
            </div>`;
        
        const scrollArea = card.querySelector(`#column-buttons-${table}`);

        cols.forEach(col => {
            const btn = document.createElement('button');
            btn.className = 'btn btn-outline-secondary btn-sm column-btn';
            btn.textContent = col;
            if (selectedColumns.get(table).has(col)) {
                btn.classList.add('selected');
            }

            btn.onclick = () => {
                toggleColumn(table, col);
                btn.classList.toggle('selected');
            };

            scrollArea.appendChild(btn);
        });

        columnsContainer.appendChild(card);
    });
}

function filterColumns(input, table) {
    const filter = input.value.toLowerCase();
    const container = document.getElementById(`column-buttons-${table}`);
    const buttons = container.querySelectorAll('button');

    buttons.forEach(btn => {
        const text = btn.textContent.toLowerCase();
        btn.style.display = text.includes(filter) ? 'inline-block' : 'none';
    });
}

    function toggleColumn(table, column) {
        const colsSet = selectedColumns.get(table);
        if (colsSet.has(column)) {
            colsSet.delete(column);
        } else {
            colsSet.add(column);
        }
        updateSQL();
    }

    function updateSQL() {
    if (selectedTables.size === 0) {
        sqlTextarea.value = '';
        return;
    }

    // Build SELECT
    let selectParts = [];
    selectedColumns.forEach((colsSet, table) => {
        const alias = getAlias(table);
        colsSet.forEach(col => {
            selectParts.push(`${alias}.${col}`);
        });
    });

    let selectClause = selectParts.length > 0
        ? 'SELECT ' + selectParts.join(', ') + '\n'
        : 'SELECT *\n';

    // FROM + JOIN
    let fromClause = '';
    const tArr = Array.from(selectedTables);
    const hasTrade = tArr.includes('NINST_TRADE_VIEW');
    const hasMaster = tArr.includes('NINST_MASTER');
    const hasClient = tArr.includes('CLIENT_MASTER');

    if (hasTrade) {
        fromClause = 'FROM NINST_TRADE_VIEW A\n';
        if (hasMaster) {
            fromClause += 'JOIN NINST_MASTER B ON A.company_code = B.company_code AND A.ITEMPCODE = B.ITEMPCODE\n';
        }
        if (hasClient) {
            fromClause += 'JOIN CLIENT_MASTER C ON A.CLIENT_ID = C.CLIENT_ID AND A.company_code = c.company_code\n';
        }
    } else if (hasMaster) {
        fromClause = 'FROM NINST_MASTER B\n';
    } else if (hasClient) {
        fromClause = 'FROM CLIENT_MASTER C\n';
    }

    // Default WHERE + ORDER BY
    const whereClause = `WHERE A.TRADE_DATE = convert(datetime,'#File_Date#',103)
    AND A.row_id IN (#Row_id#)
    AND A.COMPANY_CODE = '#COMPANY_CODE#'
    AND A.TRADE_DATE = '#TRADE_DATE#'
    AND A.CLIENT_ID IN (
        SELECT DISTINCT CLIENT_ID
        FROM NInst_Trade
        WHERE TRADE_DATE = convert(datetime,'#File_Date#',103)
        AND row_id IN (#Row_id#)
    )
ORDER BY ORGSCRIP_NAME`;

    // Final SQL
    sqlTextarea.value = `${selectClause}${fromClause}${whereClause}`;
}


    function getAlias(table) {
        if (table === 'NINST_TRADE_VIEW') return 'A';
        if (table === 'NINST_MASTER') return 'B';
        if (table === 'CLIENT_MASTER') return 'C';
        return table.charAt(0); // fallback
    }

    document.getElementById('generateBtn').addEventListener('click', function () {
    const fileName = document.getElementById('fileNameInput').value.trim();
    const headers = document.getElementById('headerRowInput').value.trim();
    const sql = document.getElementById('sqlTextarea').value.trim();

    if (!fileName || !headers || !sql) {
        alert("Please fill in the file name, headers, and ensure SQL is generated.");
        return;
    }

    fetch('/generate-cfm', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: JSON.stringify({ file_name: fileName, headers: headers, sql: sql })
    })
    .then(response => response.blob())
    .then(blob => {
        const url = window.URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = "generated_query.cfm";
        a.click();
        window.URL.revokeObjectURL(url);
    })
    .catch(error => {
        console.error('CFM Generation Failed:', error);
        alert("Something went wrong generating the file.");
    });
});

</script>

@include('User.footer')
