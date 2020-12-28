<?php

namespace App\Http\Controllers\Web\Staff;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Http\Requests\Staff\StaffTaskRequest;
use App\Models\Task;

class StaffTaskController extends BaseController
{
    const TASKS_PER_PAGE = 5;
    //
    protected $guard = 'staff';

    public function __construct()
    {
        $this->middleware('auth:staff');
    }

    /**
     * Show dashboard.
     * 
     * @return void
     */
    public function dashboard()
    {
      //  return view('staff.index');
        return view('staff.dashboard');
    }

    /**
     * Show all index
     * 
     * @return void
     */
    public function index(string $type = null)
    {
        if(is_null($type))
        {
            return redirect()->route('staff.tasks.index', ['type' => Task::getStatus('Active')]);
        }

        $staff = $this->getAuthorizedUser('staff');

        $data = [
                'active'    => [
                    'tasks'    => $staff->tasksByStatus('Active')->paginate(self::TASKS_PER_PAGE),
                    'isActive' => $type == Task::getStatus('Active'),
                    'oppositeStatus' => Task::getStatus('Completed'),
                    'labels'   => [
                        'mark'  => 'Oznacz jako zakończone',
                        'empty' => 'Wszystkie zadania są zakończone ;)',
                        'nav'   => 'Aktywne'
                    ]
                ],
                'completed' => [
                    'tasks' => $staff->tasksByStatus('Completed')->paginate(self::TASKS_PER_PAGE),
                    'isActive' => $type == Task::getStatus('Completed'),
                    'oppositeStatus' => Task::getStatus('Active'),
                    'labels' => [
                        'mark'  => 'Oznacz jako aktywne',
                        'empty' => 'Tutaj pojawią się Twoje zadania ;)',
                        'nav'   => 'Zakończone'
                    ]
                ]
        ];

        if(!array_key_exists($type, $data)) 
        {
            return redirect()->route('staff.tasks.index', ['type' => Task::getStatus('Active')]);
        }

        return view('staff.tasks.index', [
            'tasks'      => $data[$type]['tasks'],
            'tasksData'  => $data[$type],
            'data'       => $data
        ]);
    }

    /**
     * Show add task form.
     * 
     * @return void
     */
    public function add()
    {
        return view('staff.tasks.add');
    }

    /**
     * Store new task
     * 
     * @return void
     */
    public function store(StaffTaskRequest $request)
    {
        //$task = Task::create($request->validated());  
        $task = $this->getAuthorizedUser('staff')->tasks()->save(new Task($request->validated()));

        if ($task) {
            //wiadomość flash o sukcesie
            $request->session()->flash('status', [
                'success' => true,
                'message' => 'Twoje zadanie zostało dodane.'
            ]);
        } else {
            //wiadomość flash o błędzie
            $request->session()->flash('status', [
                'success' => false,
                'message' => 'Wystąpił błąd podczas dodawania Twojego zadania. :('
            ]);
        }

        return redirect(
            route(
                'staff.tasks.show',
                ['task' => $task]
            )
        );
    }

    /**
     * Show single task details.
     *
     * @param Task $task
     * @return void
     */
    public function show(Task $task)
    {
        if ($task->owner->id != $this->getAuthorizedUser('staff')->id) {
            return abort(403);
        }

        return view('staff.tasks.show', [
            'task' => $task
        ]);
    }

    /**
     * Show edit task form.
     *
     * @param Task $task
     * @return void
     */
    public function edit(Task $task)
    {
        //    dd($task->owner());

        if ($task->owner->id != $this->getAuthorizedUser('staff')->id)
        //    if($task->owner->isCurrentlyAuthorized())
        {
            return abort(403);
        }

        return view('staff.tasks.edit', [
            'task' => $task
        ]);
    }

    /**
     * Update task.
     *
     * @param Task $task
     * @return void
     */
    public function update(StaffTaskRequest $request, Task $task)
    {
        if ($task->owner->id != $this->getAuthorizedUser('staff')->id) {
            return abort(403);
        }

        if ($task->update($request->validated())) {
            //wiadomość flash o sukcesie
            $request->session()->flash('status', [
                'success' => true,
                'message' => __('staffTask.alerts.updated.success')
            ]);
        } else {
            //wiadomość flash o błędzie
            $request->session()->flash('status', [
                'success' => false,
                'message' => __('staffTask.alerts.updated.fail')
            ]);
        }

        return redirect(
            route(
                'staff.tasks.show',
                ['task' => $task]
            )
        );
    }

    /**
     * Delete task.
     *
     * @param Task $task
     * @return void
     */
    public function delete(Request $request, Task $task)
    {
        if ($task->owner->id != $this->getAuthorizedUser('staff')->id) {
            return abort(403);
        }

        if ($task->delete()) {
            //wiadomość flash o sukcesie
            $request->session()->flash('status', [
                'success' => true,
                'message' => 'Twoje zadanie zostało usunięte.'
            ]);
        } else {
            //wiadomość flash o błędzie
            $request->session()->flash('status', [
                'success' => false,
                'message' => 'Wystąpił błąd podczas usuwania Twojego zadania. :('
            ]);
        }

        return redirect(
            route('staff.tasks.index')
        );
    }

}
