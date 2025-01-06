<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Blood_Camp;
use TCPDF;
use Illuminate\Support\Facades\Session; // Import the Session facade


class BloodCampController extends Controller
{
    //
    public function blood(Request $request){
       
        
        // $response = Http::get('http://127.0.0.1:8000/api/apidata');
        // die($response);
        $is_gainer = 0;
        if(isset($request->gainer_view)){
            $is_gainer = 1;
        }
        $user = \Auth::user();
        $is_admin = $user->is_admin;
        //requets->page when u use pagination
        if(isset($request->page) && $request->page > 0){
            $page = $request->page;
            $request = Session::get('request');
            $request = (object) $request;
            $request->page = $page;
        }
        $blood_total_data = Blood_Camp::where('is_delete','0');
        if(isset($request->check_default) && isset($request->filter_value)){
            $store_request = (isset($request->page)) ? $request : $request->all();
            Session::put('request', $store_request);
            if($request->filter_name == 'Donar_name' || $request->filter_name == 'address'|| $request->filter_name == 'mobile_no'){
                $blood_total_data = $blood_total_data->where($request->filter_name ,'like', $request->filter_value . '%');
            }else if($request->filter_name == 'blood_grp' ){
                $blood_total_data = $blood_total_data->whereIn($request->filter_name , $request->filter_value);
            }else{
                $blood_total_data = $blood_total_data->where($request->filter_name , $request->filter_value);
            }
        }
        
        if(isset($request->frm_date) && isset($request->to_date) && $request->frm_date != $request->to_date){
            $blood_total_data = $blood_total_data->whereBetween('created_at' , [$request->frm_date,$request->to_date]);
        }
        //if created_at and to date from date are same
        if(isset($request->frm_date) && isset($request->to_date) && $request->frm_date == $request->to_date){
            $blood_total_data = $blood_total_data->whereDate('created_at' , [$request->frm_date,$request->to_date]);
        }
        if($is_gainer == 1){
            $blood_total_data =  $blood_total_data->where('gainer','1')->orderBy('created_at', 'desc');  
        }else{
            $blood_total_data =  $blood_total_data->where('gainer','0')->orderBy('created_at', 'desc');
        }
        
        $data_count['data_total_count'] =$data_count['success_count'] = $data_count['reject_count']=$data_count['pending_count'] =0;
        $success = $reject = $total = $pending =  0;
        foreach($blood_total_data->get() as $data){
            $data_count['data_total_count'] = ++$total;
            $data_count['success_count'] = $data->is_success == 'S' ? ++$success : $success;
            $data_count['pending_count'] = $data->is_success == 'N' ? ++$pending : $pending;
            $data_count['reject_count'] = $data->is_success == 'R' ? ++$reject : $reject;   
        }
        
        if(isset($request->export_pdf) && $request->export_pdf == 1){
            $blood_total_data_pdf = Session::get('blood_total_data');
            $result = $this->export_pdf($blood_total_data_pdf , $is_gainer);
            $request->export_pdf = 0;
            return true;
        }
        if(!isset($request->check_default)){
            $store_request = (isset($request->page)) ? $request : $request->all();
            Session::put('request', $store_request);
        }
        Session::put('blood_total_data', $blood_total_data->get());
        $blood_data = $blood_total_data->paginate(10);
        
        return view('Blood.index' , ['is_admin' => $is_admin,'is_gainer' => $is_gainer,'blood_data' => $blood_data , 'count' => $data_count , 'request' => $request]);
    }

    public function blood_modal() {
        $user = \Auth::user();
        $is_admin = $user->is_admin;
        $edit = $_GET['edit'];
        $view = $_GET['view'];
        $del = $_GET['del'];
        $gainer = $_GET['gainer'];
        if($del > 0){
            $blood_data = Blood_Camp::where('id', $del)->first();
            $blood_data->update_by = $user->id;
            $blood_data->is_delete = 1;
            $blood_data->save();
            return response()->json(['message' => 'Deleted successfully']);
        }
        $blood_data = Blood_Camp::where('id', $edit)->first();
        return response()->json([
            'data' => view('Blood.model' , ['is_admin' => $is_admin ,'gainer' => $gainer ,'view' => $view,'edit' => $edit,'blood_data' => $blood_data])->render()
        ]);
    }

    public function save_blood(Request $request) {
        
        $rules = [
            'donar_name' => 'required|string|max:255',
            'mobile_no' => 'required|string|regex:/^[0-9]{10}$/',
            'gender' => 'required|string|max:10',
            
        ];
        if(isset($request->recieved)){
            $rules=[
                'blood_grp' => 'required|string|max:10'
            ];
        }

        // Validate the request
        $validator = Validator::make($request->all(), $rules);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }
        
        try{
            $user = \Auth::user();
            $donar_data = new Blood_Camp();
            if(isset($request->edit) && $request->edit > 0){
                $donar_data = Blood_Camp::where('id' , $request->edit)->first();
                $donar_data->update_by = $user->id;
            }
            if(isset($request->submission) && $request->submission == 1){
                $donar_data->hospital = $request->hospital;
                $donar_data->product = $request->product;
                $donar_data->reference = $request->reference; 
                $donar_data->gainer = 1; 

            }else{
                $donar_data->address = $request->donar_address;
                $donar_data->weight = $request->weight;
                $donar_data->occupation = $request->occupation; 
                $donar_data->is_success = 
                isset($request->recieved) ? 'S': (isset($request->reject) ? 'R' : 'N'); 
                $donar_data->reason = isset($request->recieved) ? null : $request->reason; 
            }
            $donar_data->Donar_name = $request->donar_name;
            $donar_data->mobile_no = $request->mobile_no;
            $donar_data->gender = $request->gender;  
            $donar_data->DOB = $request->dob; 
            $donar_data->blood_grp = $request->blood_grp; 
            $donar_data->is_delete = 0;
            $donar_data->added_by = $user->id; 
            $donar_data->save();
            return response()->json(['message' => 'Donar updated successfully']);
        } 
        catch(Exception $e)
        {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        };
    }

    public function export_pdf($data, $is_gainer = 0) {
     
        $date = date('d-m-Y');
        // Fetch data from database or any other source
        // $vapt_data = VAPT::all(); // Replace with your actual model and query
        $pdf = new TCPDF();
        
        // Set document information
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Prashant Jain');
        $pdf->SetTitle('Donar List');
        $pdf->SetSubject('PDF Export');

        // Set default header and footer fonts
        $pdf->setHeaderFont(Array('helvetica', '', 12));
        $pdf->setFooterFont(Array('helvetica', '', 10));

        // Set margins
        $pdf->SetMargins(5, 5,5);
        $pdf->SetHeaderMargin(5);
        $pdf->SetFooterMargin(5);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(TRUE, 10);

        // Set font
        $pdf->SetFont('helvetica', '', 10);

        // Add a page
        $pdf->AddPage();
        $count = 0;
        // HTML content
        if($is_gainer == 1){
            $html = '
            <h1>Gainer List </h1>
            <table border="0.5" cellpadding="2" cellspacing="">
                <thead>
                    <tr>
                        <th style="width: 50px;">Sr. No.</th>
                        <th>Date</th>
                        <th style="width: 150px;">Patient Name</th>
                        <th>Mobile No</th>
                        <th>Hospital</th>
                        <th style="width: 50px;">Product</th>
                        <th style="width: 50px;">Blood Group</th>
                        
                    </tr>
                </thead>
                <tbody>';

            foreach ($data as $val) {
                $count++;
                $gender = ($val->gender == 'M') ? 'Male' : 'Female';
                $html .= '
                <tr>
                <td style="line-height: 15px; width: 50px;">' . $count . '</td>
                <td style="line-height: 15px;">' . htmlspecialchars($val->DOB) . '</td>
                <td style="line-height: 15px; width: 150px;">' . htmlspecialchars($val->Donar_name) . '</td>
                <td style="line-height: 15px;">' . htmlspecialchars($val->mobile_no) . '</td>
                <td style="line-height: 15px;">' . htmlspecialchars($val->hospital) . '</td>
                <td style="line-height: 15px;  width: 50px;">' . htmlspecialchars($val->product) . '</td>
                <td style="line-height: 15px;  width: 50px;">' . htmlspecialchars($val->blood_grp) . '</td>
               
            </tr>';
            }
        }
        else{
            $html = '
            <h1>Donar List </h1>
            <table border="0.5" cellpadding="2" cellspacing="">
                <thead>
                    <tr>
                        <th style="width: 50px;">Sr. No.</th>
                        <th style="width: 110px;">Donar Name</th>
                        <th>Mobile No</th>
                        <th>DOB</th>
                        <th style="width: 50px;">Gender</th>
                        <th style="width: 50px;">Blood Group</th>
                        <th>Date of Donation</th>
                    </tr>
                </thead>
                <tbody>';

            foreach ($data as $val) {
                $count++;
                $gender = ($val->gender == 'M') ? 'Male' : 'Female';
                $html .= '
                <tr>
                <td style="line-height: 15px; width: 50px;">' . $count . '</td>
                <td style="line-height: 15px; width: 110px;">' . htmlspecialchars($val->Donar_name) . '</td>
                <td style="line-height: 15px;">' . htmlspecialchars($val->mobile_no) . '</td>
                <td style="line-height: 15px;">' . htmlspecialchars($val->DOB) . '</td>
                <td style="line-height: 15px;  width: 50px;">' . htmlspecialchars($gender) . '</td>
                <td style="line-height: 15px;  width: 50px;">' . htmlspecialchars($val->blood_grp) . '</td>
                <td style="line-height: 15px;">' . htmlspecialchars($val->created_at->format('d-m-Y')) . '</td>
            </tr>';
            }
        }
        $html .= '
            </tbody>
        </table>';

        // Output the HTML content
        $pdf->writeHTML($html, true, false, true, false, '');
        
        // Output the PDF
        return $pdf->Output('Donar_list_'.$date.'.pdf' ); // 'D' to download the file
    }

    public function apidata() {
        $data = Blood_Camp::where('is_delete' , '0')->get();
        return response()->json([
            'data' => $data
        ]);
    }

    public function get_user_data(){
        $mobile_no = $_GET['mobile_no'];

        if ($mobile_no == '') {
            return response()->json(['errors' => "Mobile No required"], 400);
        }
        $data = Blood_Camp::where('mobile_no' ,$mobile_no)->where('gainer',0)->first();
        if($data == ''){
            $data = '';
        }
        return response()->json(['data' => $data]);
    }
}
