<?php

namespace App\Http\Controllers;
use App\Models\User;
use Carbon\Carbon;
use App\Models\TicektTracker;
use App\Models\TicketLog;
use Illuminate\Http\Request;

class TicektTrackerController extends Controller
{
    //
    public function ticket_tracker(){
        $user = \Auth::user();
        $assign_by = User::whereIn('is_admin' , ['1' , '3'])->where('is_active' , 1)->pluck('name', 'id')->toArray();
        $ticket_data = TicektTracker::where('assign_to' , $user->id)->get();
        $assigned_ticket = TicektTracker::where('assign_by' , $user->id)->get();
        return view('TicketTracker.home' , ['ticket_data' => $ticket_data , 'assign_by' => $assign_by , 'assigned_ticket'=> $assigned_ticket , 'ticket_data1' => $ticket_data ]);
    }

    public function create_ticket_model(){
        $assign_to = User::whereIn('is_admin' , ['1' , '3'])->where('is_active' , 1)->pluck('name', 'id')->toArray();
        return response()->json(
            ['data' => view('TicketTracker.ticket_model',['assign_to' => $assign_to])->render()]
        );
        
    }

    public function ticket_view($id){
        $ticket_data = TicektTracker::where('id' ,$id)->first();
        $ticket_log_data = TicketLog::where('ticket_id' , $id)->get();
        $assign_by = User::whereIn('is_admin' , ['1' , '3'])->where('is_active' , 1)->pluck('name', 'id')->toArray();
        return view('TicketTracker.ticket_view',['ticket_data' => $ticket_data ,'assign_by' => $assign_by , 'ticket_log_data' => $ticket_log_data]);
    }

    public function ticket_save(Request $request){
        $user = \Auth::user();
        $ticket_data = new TicektTracker();
        $ticket_data->create_by = $user->id;
        $ticket_data->subject = $request->subject;
        $ticket_data->description = $request->description;
        $ticket_data->assign_to = $request->assignto ;
        $ticket_data->assign_by = $user->id;
        $ticket_data->assign_date = now();

        $ticket_log = new TicketLog();
        $ticket_log->log = $request->subject;
        $ticket_log->assign_to = $request->assignto;
        $ticket_log->assign_by = $user->id;
        $ticket_log->status = 'P';
        $ticket_log->assign_date = now();

        $ticket_data->save();
        $ticket_log->save();
    }

    public function log_data_save(Request $request){
        $user = \Auth::user();
        $ticket_data = TicektTracker::where('id' , $request->tid)->first();
        
        $ticket_data->assign_to = $request->assignto ;
        $ticket_data->assign_by = $user->id;
        $ticket_data->status =$request->status;
        $ticket_data->assign_date = now();
        $ticket_data->save();
        $ticket_log = new TicketLog();
        $ticket_log->log = $request->log;
        $ticket_log->ticket_id =$request->tid;
        $ticket_log->assign_to = $request->assignto;
        $ticket_log->assign_by = $user->id;
        $ticket_log->status = $request->status;
        $ticket_log->assign_date = now();
        $ticket_log->save();

        return response()->json(['message' => 'Form submitted successfully']);
        
    }
}
