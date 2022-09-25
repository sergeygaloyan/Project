<?php

namespace App\Http\Controllers;

use App\Http\Requests\TrainerRequest;
use App\Models\Trainer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trainers = Trainer::all();
        return response()->json(['trainers' => $trainers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TrainerRequest $request)
    {
        $trainer = new Trainer();
        $trainer->name = $request->input('name');
        $trainer->email = $request->input('email');
        $trainer->role_id = $request->input('role_id');
        $trainer->password = $request->input('password');
        $trainer->phone = $request->input('phone');
        $trainer->save();
        return response()->json(['trainer' => $trainer]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $trainer = Trainer::find($id);
        $today = Carbon::parse()->toDayDateTimeString();
        $created_day = Carbon::parse($trainer->created_at);
        $time = $today - $created_day;
        return response()->json([
            'name' => $trainer->name,
            'email' => $trainer->email,
            'phone' => $trainer->phone,
            'role' => $trainer->role_id,
            'time' => $time
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function edit(Trainer $trainer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function update(TrainerRequest $request, $id)
    {
        $teacher = Trainer::find($id);
        $teacher->name = $request->input('name');
        $teacher->email = $request->input('email');
        $teacher->role_id = $request->input('role');
        $teacher->password = $request->input('password');
        $teacher->phone = $request->input('phone');
        $teacher->save();
        return response()->json(['teacher' => $teacher]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Trainer  $trainer
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Trainer::find($id)->delete();
        return response()->json('Deleted');
    }
}
