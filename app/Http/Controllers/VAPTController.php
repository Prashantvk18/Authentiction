<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\VAPT;
use TCPDF;

use Illuminate\Http\Request;

class VAPTController extends Controller
{
    //
    public function vapt_index() {
        $user = \Auth::user();
        $vapt_data = VAPT::where('user_id',$user->id)
            ->orderBy('created_at', 'desc')->paginate(10);
        return view('VAPT.index',['vapt_data' => $vapt_data]);
    }

    public function vapt_model() {
        $edit = $_GET['edit'];
        $view = $_GET['view'];
        $vapt_data = VAPT::where('ticket_no', $edit)->first();
        return response()->json(
            ['data' => view('VAPT.vapt_model',['vapt_data' => $vapt_data , 'edit' =>$edit , 'view' => $view])->render()]);
    }

    public function vapt_save(Request $request) {
        $array = (array) $request->all();
        $exclude_key = ['ticket_no','client_name','recieve_date','forword_date'];
        $checkbox_array = [];
        foreach ($array as $key => $value) {
            if( !in_array($key , $exclude_key) ){
                $checkbox_array[] = $key;
            }
        };
        $checkbox_str = implode( ',' , $checkbox_array );
        $rules = [
            'ticket_no' => 'required|string|max:255',
        ];

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        $user = \Auth::user();
        $vapt = new VAPT();
        if(isset($request->edit) && $request->edit > 0){
            $vapt = VAPT::where('ticket_no', $request->edit)->first();
        }
        $vapt->ticket_no = $request->ticket_no;
        $vapt->Client_name = $request->client_name;
        $vapt->updatation_data = $checkbox_str;
        $vapt->start_date = $request->recieve_date;
        $vapt->End_date = $request->forword_date;
        $vapt->user_id = $user->id;
        $vapt->main_ip = $request->main_ip;
        $vapt->web_ip = $request->web_ip;
        $vapt->rms_ip = $request->rms_ip;
        $vapt->description = $request->description;
        $vapt->save();
        return response()->json(['message' => 'Form submitted successfully']);
    }

    public function exportpdf() {

        // Fetch data from database or any other source
        $vapt_data = VAPT::all(); // Replace with your actual model and query
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
                    <th>Client Name</th>
                    <th>Status</th>
                    <th>Start Date</th>
                    <th>End Date</th>
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

            </tr>';
        }

        $html .= '
            </tbody>
        </table>';

        // Output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output the PDF
        return $pdf->Output('ticket_list.pdf','D'); // 'D' to download the file
    }
}
