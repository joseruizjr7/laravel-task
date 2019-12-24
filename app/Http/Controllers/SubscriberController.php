<?php

namespace App\Http\Controllers;

use App\Subscriber;
use App\Http\Resources\Subscriber as SubscriberResource;
use Illuminate\Http\Request;
use App\Http\Requests;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subs = Subscriber::orderBy('created_at', 'desc')->paginate(50);
        return SubscriberResource::collection($subs);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sub = $request->isMethod('put') ? Subscriber::findOrFail($request->subscriber_id) : new Subscriber;

        $sub->id = $request->input('subscriber_id');
        $sub->email = $request->input('email');
        $sub->name = $request->input('name');
        $sub->state = $request->input('state');

        if($sub->save()) {
            return new SubscriberResource($sub);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sub = Subscriber::findOrFail($id);
        return new SubscriberResource($sub);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function edit(Subscriber $subscriber)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subscriber $subscriber)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subscriber  $subscriber
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sub = Subscriber::findOrFail($id);

        if($sub->delete()) {
            return new SubscriberResource($sub);
        }
        
    }
}
