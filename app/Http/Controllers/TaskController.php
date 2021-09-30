<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Events\SendMessage;
use Illuminate\Http\Request;
use App\Http\Requests\TaskRequest;
use App\Http\Requests\TaskRequestUpdate;
use App\Repositories\TaskRepository;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *@method GET
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = resolve(TaskRepository::class)->all();
        return view('message', compact('tasks'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('form');
    }

    /**
     * Store a newly created resource in storage.
     *@method POST
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskRequest $request)
    {
        $message = $request->message;
        resolve(TaskRepository::class)->create($message);
        event(new SendMessage($message));
        return back();
    }


    /**
     * Show the form for editing the specified resource.
     *@method GET
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $task = resolve(TaskRepository::class)->find($id);
        return view("edit", compact('task'));
    }

    /**
     * Update the specified resource in storage.
     * @method Patch | put
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskRequestUpdate $request, $id)
    {
        $message = $request->task;

        resolve(TaskRepository::class)->update($id, $message);
        event(new SendMessage($message));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Task::find($id);
        $category->delete();
        return back();
    }
}
