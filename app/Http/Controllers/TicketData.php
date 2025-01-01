<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\TicketDatas;
use Illuminate\Support\Facades\Session;
class TicketData extends Controller
{
    public function ticket_view(Request $request){
        $search_id = '';
        if($request->check_default > 0){
            $search_id = $request->search_id;
            Session::put('search_id', $search_id);
        }else{
            $search_id = Session::get('search_id');
        }
        $user = \Auth::user();
       
        if(isset($search_id)){
            $ticket_data = TicketDatas::where('user_id',$user->id)
            ->where('ticket_no', 'like', $search_id . '%')
            ->orderBy('created_at', 'desc');
            $count=$ticket_data->count();
        }else{

            $ticket_data = TicketDatas::where('user_id',$user->id)
            ->orderBy('created_at', 'desc');
            
            $data = TicketDatas::where('user_id',$user->id);
            $count=$data->count();
        }
        
       $ticket_data = $ticket_data->paginate(10);
       
        return view('User.Ticket.ticketView',
        [ 'datas' => $ticket_data,
         'count'  => $count,
         'search_id' => $search_id
        ]);
    }

 
    public function add_ticket (Request $request) { 
       
        $edit = $_GET['edit'];
        $view = $_GET['view'];
        $t_data = TicketDatas::where('id',$edit)
        ->first();
        return response()->json(['data' => view('User.Ticket.ticketView_Model',['t_data' => $t_data , 'edit' => $edit , 'view' => $view])->render()]);
    }



    public function ticket_submit(Request $request)
    {
        // Validation rules
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
        $ticket = new TicketDatas();
        if($request->edit > 0){
            $ticket = TicketDatas::where('id', $request->edit)->first();
        }
        $ticket->ticket_no  = $request->ticket_no;
        $ticket->ticket_sub = $request->sub;
        $ticket->ticket_description = $request->descrip;
        $ticket->receive_from = $request->recieve;
        $ticket->forword_to = $request->forword;
        $ticket->start_date = $request->recieve_date;
        $ticket->End_date = $request->forword_date;
        $ticket->user_id =  $user->id;
        $ticket->save();
        return response()->json(['message' => 'Form submitted successfully']);
    }
}
