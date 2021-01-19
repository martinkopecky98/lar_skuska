<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DB;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $users = DB::select('Select * from users');
        // users.id, users.name, users.pozicia, users.email, users.user_zameranie, oddelenie.oddelenie_id, oddelenie.nazov, oddelenie.veduci
        
        // $users = DB::select('Select users.id, users.name, users.pozicia, users.email, users.user_zameranie, oddelenie.oddelenie_id, oddelenie.nazov, oddelenie.veduci 
        // from users join oddelenie on users.oddelenie_id = oddelenie.oddelenie_id');

        $users = DB::select('Select * from users');
        $projekty = DB::select('Select * from zaradenie join oddelenie on zaradenie.oddelenie_id = oddelenie.oddelenie_id');
        $projekty = DB::select('Select * from oddelenie');
        // $data = array(
        //     'users' => $users,
        //     'projekty' => $projekty
        // );
        // dd(compact('users', 'projekty'));
        // dd($users);
        
        // return view('users.users')->with("users", $users); 

        return view('users.users', compact('users','projekty')); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $user = new User;
        $max_id = DB::select('Select MAX(id) from users');
        $user->id = $max_id + 1;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->user_zameranie = $request->input('zameranie');
        $user->password = $user->id + $user->name;
        $user->save();
        // DB::
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!Auth::check()) {
            return redirect('users');
        }

        if(auth()->user()->pozicia == 'root' OR auth()->user()->pozicia == 'manazer')
        {
            // $user = User::find($id);
            $user = DB::select('Select * from users join oddelenie on users.oddelenie_id = oddelenie.oddelenie_id where users.id = ?', [$id]);
           
            // $user = DB::select('Select * from users join oddelenie on users.oddelenie_id = oddelenie.oddelenie_id 
            // join todos on todos.user_id = users.id where users.id = ?', [$id]);
            // if(empty($user)){       //ak nema ziadne oddelenie
            //     $user = DB::select('Select * from users join on todos.user_id = users.id where user.id = ?', [$id]);
            
            if(empty($user))
                {   // ak nema ani ziadne todo
                    $user = DB::select('Select * from users where id = ?', [$id]);
                }
           
                // }
            $todos = DB::select('Select * from todos where user_id = ? order by progres DESC', [$id]);
            // dd($user[0]->id);
            // dd($todos);

            return view('users.edit')->with('user', $user[0])->with('todos', $todos);

            // return view('users.edit', compact($user[0], $todos));
        }
        return redirect('todos');
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
        // treba doplnit overovanie ci som to naozaj ja !!!

        $oddelenie = DB::select('Select * from oddelenie where veduci = ?',[$request->veduci]);
        $user = DB::select('Select * from users where id = ?', [$id]);

        // dd($oddelenie);
        // dd($request);

        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->veduci == 'none') {$user->oddelenie_id = 0;}
        else {$user->oddelenie_id = $oddelenie[0]->oddelenie_id;}
        // $user->oddelenie_id = $oddelenie[0]->oddelenie_id;
        $user->pozicia = $request->pozicia;
        // $todo->subject = $request->subject;
        $user->save();
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!Auth::check()) { return redirect('/users')->with('error', 'Neprihlaseny pouzivatel'); }
        $data = User::find($id);
        if(auth()->user()->pozicia == 'root' OR auth()->user()->pozicia == 'manazer')
        {
            $data->delete();
            DB::delete('delete from todos where user_id = ?', [$data->id]);
            return redirect('/users')->with('succes', 'Pouzivatel bol odstraneny');
        }
        return redirect('/users')->with('error', 'Neopravneny pristup');
        
    }

    public function zmenaPozicie(Request $request)
    // public function zmenaPozicie()
    {
        // dd('zmena pozicieeeee backednd');
        // return('zmena pozicieeeee backednd');
        // dd($request);
        // return($request->params);
        if(!Auth::check()) { 
            return('zmena pozicieeeee backend neprihlaseny user');

            return redirect('/users')->with('error', 'Neprihlaseny pouzivatel'); 
        }
        $user = User::find($request->params);
        $zmena = False;
        // return('zmena pozicieeeee backednd');

        if ($user->pozicia == 'none' and $zmena == FALSE) {$user->pozicia = 'manazer'; $zmena = TRUE;}
        if ($user->pozicia == 'tester' and $zmena == FALSE) {$user->pozicia = 'none'; $zmena = TRUE;}
        if ($user->pozicia == 'developer' and $zmena == FALSE) {$user->pozicia = 'tester'; $zmena = TRUE;}
        if ($user->pozicia == 'manazer' and $zmena == FALSE) {$user->pozicia = 'developer'; $zmena = TRUE;}
        // if ($user->pozicia == 'root' and $zmena == FALSE) {$user->pozicia = 'manazer'; $zmena = TRUE;}
        // return('zmena pozicieeeee backednd vytiahnutie a prepisanie');
        $user->save();
        return($user->pozicia);
        return redirect('/users')->with('succes','pozicia zmenena');
    }
}
