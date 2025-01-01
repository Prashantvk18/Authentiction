<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use TCPDF;
use App\Models\ExpanseData;
use App\Models\TripData;
use App\Models\UserData;
use App\Models\UserContro;

class ExportPdfController extends Controller
{
    public function admin_permission($id){
        $user = \Auth::user();
        $created_by = TripData::where('id',$id)->pluck('created_by')->first();
        $trip_id_arr = UserData::where('mobile_no', $user->mobile_no)->pluck('trip_id')->toArray();
        if($user->id == $created_by || in_array($id , $trip_id_arr)) {
           return true;
        }
        return false;
    }

    public function export_pdf(Request $request) {
            
            $trip_id = $request->tid;
            $permission = $this->admin_permission($trip_id);
            if($permission){
                    $date = date('d-m-Y');
                // Fetch data from database or any other source
                // $vapt_data = VAPT::all(); // Replace with your actual model and query
                $pdf = new TCPDF();
                
                // Set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Prashant Jain');
                $pdf->SetTitle('Expanse List');
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
                $expanse_data = ExpanseData::where('trip_id', $trip_id)->orderby
                ('date','asc')->get();
                $trip_name = TripData::where('id', $trip_id)->first();
                $count = 0;
                $html = '
                <h1>'.$trip_name->trip_name.' Expanse List  ('.$trip_name->start_date.' - '.$trip_name->End_date.')</h1>
                <table border="0.5" cellpadding="2" cellspacing="">
                    <thead>
                        <tr>
                            <th style="width: 50px;">Sr. No.</th>
                            <th>Expanse Name</th>
                            <th style="width: 150px;">Expanse Detail</th>
                            <th>Expanse Amount</th>
                            <th>Exclude</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $total_expanse = 0;
                foreach ($expanse_data as $val) {
                    $user_name = '';
                    if($val->user_id != ''){
                        $user_id_array = explode(',' , $val->user_id);
                        $user_name_arr = UserData::whereIn('id' , $user_id_array)->pluck('user_name')->toArray();
                        $user_name = implode(',' ,$user_name_arr);
                    }
                    $total_expanse = $total_expanse + $val->expanse_amount ;
                    $count++;
                    $html .= '
                    <tr>
                    <td style="line-height: 15px; width: 50px;">' . $count . '</td>
                    <td style="line-height: 15px;">' . htmlspecialchars($val->expanse_name) . '</td>
                    <td style="line-height: 15px; width: 150px;">' . htmlspecialchars($val->desc) . '</td>
                    <td style="line-height: 15px;">' . htmlspecialchars($val->expanse_amount) . '</td>
                    <td style="line-height: 15px;">' . $user_name . '</td>
                </tr>';
                }
                $html .= '
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td></td>
                    <td style="color:red">Total Expanse :</td>
                    <td style="color:red">'. $total_expanse .'</td>
                    <td></td>
                </tr>
                </tfoot>
                </table>';
                // Output the HTML content
                $pdf->writeHTML($html, true, false, true, false, '');
                
                // Output the PDF
                return $pdf->Output($trip_name->trip_name.'_Expanse.pdf'); // 'D' to download the file
            }
            
            Die("You are not member of this trip");
        
    }

    public function export_user_contro_pdf(Request $request){
            $trip_id = $request->tid;
            $uid = $request->uid;
            $permission = $this->admin_permission($trip_id);
            if($permission){
                    $date = date('d-m-Y');
                // Fetch data from database or any other source
                // $vapt_data = VAPT::all(); // Replace with your actual model and query
                $pdf = new TCPDF();
                
                // Set document information
                $pdf->SetCreator(PDF_CREATOR);
                $pdf->SetAuthor('Prashant Jain');
                $pdf->SetTitle('Contro List');
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
                $expanse_data = UserContro::where('user_id', $uid)->get();
                $trip_name = TripData::where('id', $trip_id)->first();
                $user_name = UserData::where('id' , $uid)->first();
                $user_data = UserData::where('trip_id', $trip_id)
                ->pluck('user_name', 'id')
                ->toArray();
                $count = 0;
                $html = '
                <h1>'.$trip_name->trip_name.'  Trip '.$user_name->user_name.' contro list ('.$trip_name->start_date.' - '.$trip_name->End_date.')</h1>
                <table border="0.5" cellpadding="2" cellspacing="">
                    <thead>
                        <tr>
                            <th style="width: 50px;">Sr. No.</th>
                            <th>Contro Name</th>
                            <th>Contro Amount</th>
                        </tr>
                    </thead>
                    <tbody>';
                    $total_contro = 0;
                foreach ($expanse_data as $val) {
                    ;
                    $msg = '';
                    if($val->to_user > 0){
                        $msg = " from ";
                        if($val->split == 'contro'){
                            $msg = " to ";
                        }
                        $msg .= $user_data[$val->to_user];
                    }
                    $count++;
                    $html .= '
                    <tr>
                    <td style="line-height: 15px; width: 50px;">' . $count . '</td>
                    <td style="line-height: 15px;">' . htmlspecialchars($val->contro_name) . $msg .'</td>
                    <td style="line-height: 15px;">' . htmlspecialchars($val->contro_amount) . '</td>
                </tr>';
                }
                
                $html .= '
                </tbody>
                <tfoot>
                <tr>
                    <td></td>
                    <td style="color:red">Total Contro :</td>
                    <td style="color:red">'. $user_name->total_contro .'</td>
                </tr>
                </tfoot>
                </table>';
                // Output the HTML content
                $pdf->writeHTML($html, true, false, true, false, '');
                
                // Output the PDF
                return $pdf->Output($user_name->user_name.'_'.$trip_name->trip_name.'_Contro.pdf'); // 'D' to download the file
            }
            
            Die("You are not member of this trip");
    }

    public function export_user_expanse_pdf(Request $request){
        $trip_id = $request->tid;
        $uid = $request->uid;
        $permission = $this->admin_permission($trip_id);
        if($permission){
                $date = date('d-m-Y');
            // Fetch data from database or any other source
            // $vapt_data = VAPT::all(); // Replace with your actual model and query
            $pdf = new TCPDF();
            
            // Set document information
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('Prashant Jain');
            $pdf->SetTitle('Per User Expanse List');
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
            $expanse_data = UserContro::where('user_id', $uid)->get();
            $trip_name = TripData::where('id', $trip_id)->first();
            $user_name = UserData::where('id' , $uid)->first();
            $count = 0;
            $html = '
            <h1>'.$trip_name->trip_name.'  Trip '.$user_name->user_name.' Expanse list ('.$trip_name->start_date.' - '.$trip_name->End_date.')</h1>
            <table border="0.5" cellpadding="2" cellspacing="">
                <thead>
                    <tr>
                        <th style="width: 50px;">Sr. No.</th>
                        <th>Expanse Name</th>
                        <th>Expanse Detail</th>
                        <th>Expanse Amount</th>
                        <th>Your Expanse</th>
                    </tr>
                </thead>
                <tbody>';
                $total_contro = 0;

            $expanse_data = ExpanseData::where('trip_id',$trip_id)->get();
            $user_data = UserData::where('trip_id' , $trip_id)->get();
            $user_array=[];
            foreach ($user_data as $data1) {
                $user_array[$data1->id] = 0;
            }
            $user_array_count = count($user_array);
            $total_contro = 0;
            foreach ($expanse_data as $data){
                $exclude_arr = [];
                if($data->include_all == 0){
                    $exclude_arr = $data->user_id != null ? explode(",", $data->user_id) : [];
                }
             
                $contro_user_count = $user_array_count - count($exclude_arr);
                $contro_distrtibute = $data->expanse_amount / $contro_user_count;
                $per_user_contro = 0;
                
                if(!in_array($uid,$exclude_arr)){
                    $per_user_contro =  $contro_distrtibute;
                    
                }
                $total_contro = $total_contro + $per_user_contro;
                $count++;
                $html .= '
                <tr>
                    <td style="line-height: 15px; width: 50px;">' . $count . '</td>
                    <td style="line-height: 15px;">' . htmlspecialchars($data->expanse_name) . '</td>
                    <td style="line-height: 15px;">' . htmlspecialchars($data->desc) . '</td>
                    <td style="line-height: 15px;">' . htmlspecialchars($data->expanse_amount) . '</td>
                    <td style="line-height: 15px;">' . htmlspecialchars($per_user_contro) . '</td>
                    
                 </tr>';
                
            }
            
            $html .= '
            </tbody>
            <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="color:red">Total Contro :</td>
                <td style="color:red">'.$total_contro.'</td>
            </tr>
            </tfoot>
            </table>';
            // Output the HTML content
            $pdf->writeHTML($html, true, false, true, false, '');
            
            // Output the PDF
            return $pdf->Output($user_name->user_name.'_'.$trip_name->trip_name.'_expanse.pdf' ); // 'D' to download the file
        }
        
        Die("You are not member of this trip");
    }
}

