<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\V1\Ticket\TicketRequest;
use App\Http\Resources\Api\V1\Ticket\Ticket as TicketResource;
use App\Http\Resources\Api\V1\Ticket\TicketCollection;
use App\Models\Ticket;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if( auth()->user()->hasRole('100e82ba-e1c0-4153-8633-e1bd228f7399') ) {
            $tickets = Ticket::where('status', false)->latest()->paginate(10);
            return new TicketCollection($tickets);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        if( auth()->user()->hasRole('100e82ba-e1c0-4153-8633-e1bd228f7399') ) {
            return new TicketResource($ticket);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        if( auth()->user()->hasRole('100e82ba-e1c0-4153-8633-e1bd228f7399') ) {
            $ticket->delete();

            return response([
                'data' => 'تیکت با موفقیت حذف شد',
                'status' => 'success'
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendTicket(TicketRequest $request)
    {
        if( auth()->user() ) {

            if($request->hasFile('image')) {
                $image = $this->upload_image($request->file('image'));
                
                $ticket = auth()->user()->tickets()->create( array_merge($request->all(), [
                    'image' => $image
                    ]
                ));
            } else {
                $ticket = auth()->user()->tickets()->create( array_merge($request->all() ));
            }

            if( auth()->user()->hasRole('100e82ba-e1c0-4153-8633-e1bd228f7399') ) {
                $ticket->update([
                    'status' => true
                ]);
            }

            return response([
                'data' => 'تیکت شما با موفقیت ارسال شد',
                'status' => 'success'
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function ticketStatus(Ticket $ticket)
    {
        if( auth()->user()->hasRole('100e82ba-e1c0-4153-8633-e1bd228f7399') ) {
            $ticket->update([
                'status' => true
            ]);

            return response([
                'data' => "تیکت {$ticket->title} با موفقیت تایید شد",
                'status' => 'success'
            ]);
        }
    }
}
