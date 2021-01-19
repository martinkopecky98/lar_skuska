<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Todo;
use Auth;
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
        
        if (!Auth::check()) {
            return redirect('/')->with('error', 'Neprihlaseny user');
        }
        // dd(auth()->user()->id);
        // $todos = Todo::all();
        $todos = DB::select('Select * from users join todos on users.id = todos.user_id
         where users.id = ? order by todos.progres DESC',[auth()->user()->id]);
        // dd($todos);
        return view('todos.todo')->with("todos" , $todos);
        // return view('todos.todo')->with(["todos" => $todos, "users" => $users]);
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
        return redirect('/todos')->with('success', 'Prvok bol ulozeny');
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
        // $todo = Todo::find($id);
        // dd($id);
        $todo = DB::select('Select * from todos where todo_id = ?',[$id]);
        // dd($id);

        return view('todos.edit')->with('todo', $todo[0]);
        
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
        // $todo = Todo::find($id);
        $todo = DB::select('select * from todos where todo_id = ?',[$id]);
        if(auth()->user()->pozicia != 'root')
        {
            if($todo[0]->user_id !== auth()->user()->id){
                return redirect('./')->with('error', 'Neopravneny pristup');
            }
        }
        // $todo = Todo::find($id);
        $todo[0]->title = $request->title;
        $todo[0]->subject = $request->subject;
        $todo[0]->body = $request->input('body');
        // $todo->subject = $request->subject;
        // $todo->save();
        DB::update('update todos set title = ?, subject = ?, body = ? where todo_id = ?',
                    [$todo[0]->title, $todo[0]->subject, $todo[0]->body, $todo[0]->todo_id ]);
        
        return redirect('/todos')->with('success', 'Prvok bol upraveny');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = DB::select('select * from todos where todo_id = ?',[$id]);
        // dd('som tuuuu');

        if(!Auth::check()) {return redirect('./')->with('error', 'Neprihlaseny user');}
        if(auth()->user()->pozicia != 'root')
        {
            if($data[0]->user_id != auth()->user()->id){
                return redirect('./')->with('error', 'Neopravneny pristup');
            }
        }
        DB::delete('delete from todos where todo_id = ?',[$data[0]->todo_id]);
        // $data->delete();
        return redirect('/todos')->with('success', 'Prvok bol odstraneny');
    }
    public function storeJS(){
        dd("todos storeJS");
        $data = request()->validate([
            "text" => "required"
        ]);
        Auth::user()->todos()->create($data);
        return Auth::user()->todos;
    }

    public function DeleteJS($id)
    // public function DeleteJS(Request $request)
    {
        // return('controller delete js');
        // $todo = Todo::find($request->params);
        // $todo.delete();
        // return($id);

        // DB:delete('delete from todos where todo_id = ?',[$request->params]);
        DB::delete('delete from todos where todo_id = ?',[$id]);
        // $todo = Todo::where('todo_id', $id)->first()->delete();

        return('todo bolo vymazane');
    }

    public function zmenaProgresu(Request $request)
    // public function DeleteJS(Request $request)
    {
        // return('controller delete js');
        // $todo = Todo::find($request->params);
        // $todo.delete();
        // return($request->params);

        if(!Auth::check()) { 
            return('zmena progresu backend neprihlaseny user');

            return redirect('/todos')->with('error', 'Neprihlaseny pouzivatel'); 
        }
        $todo = DB::select('select * from todos where todo_id = ?',[$request->params]);
        $zmena = False;
        // return($todo);
        // return('zmena progresu backednd');

        if ($todo[0]->progres == 'zacate' and $zmena == FALSE) {$todo[0]->progres = 'prebiehajuce'; $zmena = TRUE;}
        if ($todo[0]->progres == 'prebiehajuce' and $zmena == FALSE) {$todo[0]->progres = 'dokoncene'; $zmena = TRUE;}
        if ($todo[0]->progres == 'dokoncene' and $zmena == FALSE) {$todo[0]->progres = 'zacate'; $zmena = TRUE;}
        // return('zmena progresu backednd vytiahnutie a prepisanie');
        DB::update('update todos set progres = ? where todo_id = ?',[$todo[0]->progres, $todo[0]->todo_id]);
        return('uspesne update todo progres');
        
    }
}
