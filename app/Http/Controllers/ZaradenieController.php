<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Zaradenie;

class ZaradenieController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        // $data = DB::select('Select * from zaradenie');
        $data = DB::select('Select users.id users.name, users.email, users.user_zameranie, oddelenie.nazov, oddelenie.veduci from users
                join zaradenie on users.id = zaradenie.zamestnanec_id
                join oddelenie on zaradenie.oddelenie_id = oddelenie.id
        ');
        dd($data);
        // return view('zaradenia.zaradenia')->with(["data", $data]);
        return view('zaradenia.zaradenia', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todos.create');
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
        $todo->subject = $request->input('subject');
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
        if(auth()->user()->id != 10)
        {
            if($todo->user_id !== auth()->user()->id){
                return redirect('./')->with('error', 'Neopravneny pristup');
            }
        }
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->subject = $request->subject;
        $todo->body = $request->input('body');
        // $todo->subject = $request->subject;
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
        if(auth()->user()->id != 10)
        {
            if($todo->user_id !== auth()->user()->id){
                return redirect('./')->with('error', 'Neopravneny pristup');
            }
        }
        $data->delete();
        return redirect('/todos');
    }
}
