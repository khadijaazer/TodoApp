<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use Illuminate\Support\Facades\Validator;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all the todos in the index func  using all() 
        $todos=Todo::all();// storing them in $todos 
        return view('todo',compact('todos')); //passing the todos to the view  ---> utilise compact  
        //todo view , will have access to the all the todos..
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
        //validating the request
        $validator = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'title' => 'required', //validating that title is required always
        ]);
// if it ! prsnt--->  main page 
        if ($validator->fails()) {
            return redirect()->route('todos.index')->withErrors($validator);
        }
//If its present--->calling the Todo Model 
        Todo::create([
            'title' => $request->get('title')
        ]);

        return redirect()->route('todos.index')->with('success', 'Inserted');
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
        //

        $todo=Todo::where('id',$id)->first();
        return view('edit-todo',compact('todo'));
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


        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect()->route('todos.edit',['todo'=>$id])->withErrors($validator);
        }



        $todo=Todo::where('id',$id)->first();
        $todo->title=$request->get('title');
        $todo->is_completed=$request->get('is_completed');
        $todo->save();

        return redirect()->route('todos.index')->with('success', 'Updated Todo');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Todo::where('id',$id)->delete();
        return redirect()->route('todos.index')->with('success', 'Deleted Todo');
    }
}
