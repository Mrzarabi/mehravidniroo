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
        $tickets = Ticket::all();
        return new TicketCollection($tickets);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Ticket $ticket)
    {
        return new TicketResource($ticket);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return response([
            'data' => 'تیکت با موفقیت حذف شد',
            'status' => 'success'
        ]);
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
        $ticket = new Ticket();
        if($request->hasFile('image')) {
            $image = $this->upload_image($request->file('image'));
        } 
        $ticket->create( array_merge($request->all(), [
            'image' => $image
            ]
        ));

        return response([
            'data' => 'تیکت شما با موفقیت ارسال شد',
            'status' => 'success'
        ]);
    }
}
