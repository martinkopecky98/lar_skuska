<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use DB;


class TodosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $todos = Todo::all();
        $users = DB::select('Select * from users');
        
        return view('todo')->with(["todos" => $todos, "users" => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $todo = new Todo;
        $todo->title = $request->input('title');
        $todo->body = $request->input('body');
        $todo->user_id = auth()->user()->id;
        $todo->save();
        return redirect('/todos');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $todo =  Todo::find($id);
        return $todo;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = Todo::find($id);
        return view('todos.edit')->with('todo', $todo);
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $todo = Todo::find($id);
        if($todo->user_id !== auth()->user()->id){
            return redirect('./')->with('error', 'Neopravneny pristup');
        }
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->body = $request->input('body');
        $todo->save();
        return redirect('/todos');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Todo::find($id);
        if($data->user_id !== auth()->user()->id){
            return redirect('./')->with('error', 'Neopravneny pristup');
        }
        $data->delete();
        return redirect('/todos');
    }
}
