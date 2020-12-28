<?php

namespace App\Observers;

//use Illuminate\Support\Facades\Mail;
//use App\Mail\TaskCreated;
use App\Jobs\CreateUniqueTaskSlug;
use App\Models\Task;

class TaskObserver
{
    public function creating(Task $task)
    {
        // wyniesc smieci -> wyniesc-smieci-1
        CreateUniqueTaskSlug::dispatch($task);

    // mail send
    //     Mail::to('k.kosowski76@gmail.com')
    //         ->send(
    //              new TaskCreated($task)
    //         );  

    }

    public function updating(Task $task)
    {
        CreateUniqueTaskSlug::dispatch($task);       
    }

}
