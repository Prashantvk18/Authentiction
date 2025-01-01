// routes/web.php
Route::get('/export-pdf', [App\Http\Controllers\PdfController::class, 'exportPdf'])->name('export.pdf');


<?php

// namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;

class PdfController extends Controller
{
    public function exportPdf()
    {
        // Fetch data from database or any other source
        $vapt_data = \App\Models\VaptData::all(); // Replace with your actual model and query

        // Create new PDF document
        $pdf = new TCPDF();
        
        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Name');
        $pdf->SetTitle('Ticket List');
        $pdf->SetSubject('PDF Export');

        // Set default header and footer fonts
        $pdf->setHeaderFont(Array('helvetica', '', 12));
        $pdf->setFooterFont(Array('helvetica', '', 10));

        // Set margins
        $pdf->SetMargins(10, 30, 10);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add a page
        $pdf->AddPage();

        // HTML content
        $html = '
        <h1>Ticket List</h1>
        <table border="1" cellpadding="5" cellspacing="0">
            <thead>
                <tr>
                    <th>Ticket Id</th>
                    <th style="width:450px;">Client Name</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>';

        foreach ($vapt_data as $data) {
            $status = isset($data->End_date) ? '<p style="color:green;">Completed</p>' : '<p style="color:red;">Pending</p>';
            $html .= '
            <tr>
                <td>' . htmlspecialchars($data->ticket_no) . '</td>
                <td>' . htmlspecialchars($data->Client_name) . '</td>
                <td>' . $status . '</td>
                <td>' . htmlspecialchars($data->start_date) . '</td>
                <td>' . htmlspecialchars($data->End_date) . '</td>
                <td>
                    <button type="button" class="btn btn-primary">Edit</button>
                    <button type="button" class="btn btn-info">View</button>
                </td>
            </tr>';
        }

        $html .= '
            </tbody>
        </table>';

        // Output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output the PDF
        return $pdf->download('ticket_list.pdf'); // 'D' to download the file
    }
}


// <!-- In your Blade view -->
// <a href="{{ route('vapt.pdf') }}" class="btn btn-success">Export to PDF</a>
