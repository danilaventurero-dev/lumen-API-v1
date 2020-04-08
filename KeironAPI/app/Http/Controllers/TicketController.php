<?php

namespace App\Http\Controllers;

use App\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Firebase\JWT\JWT;


class TicketController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function index()
    {
     
     $tickets = Ticket::with('user')->get();
     return response()->json([
            'data'=> $tickets,
            'message'=>'success',
        ]);

    }

     public function create(Request $request)
     {
        $ticket = new Ticket;
        $ticket = Ticket::create($request->all());
        return response()->json([
            'data'=> $ticket,
            'message'=>'success',
        ]);
     }

     public function show($id)
     {
        $ticket = Ticket::with('user')->find($id);
        return response()->json([
            'data'=> $ticket,
            'message'=>'success',
        ]);
     }

     public function update(Request $request, $id)
     { 
        $ticket= Ticket::find($id);
        $ticket->User_id = $request->input('User_id');
        $ticket->ticket_pedido = $request->input('ticket_pedido');
        $ticket->save();
        return response()->json([
            'data'=> $ticket,
            'message'=>'success',
        ]);
     }

     public function destroy($id)
     {
        $ticket = Ticket::find($id);
        $ticket->delete();

         return response()->json('Usuario borrado con exito!');
     }


    }