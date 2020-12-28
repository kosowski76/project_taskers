<?php

namespace App\Jobs;

use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Str;

use App\Models\Task;

class CreateUniqueTaskSlug
{
    use Dispatchable, SerializesModels;

    protected $task;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $slug = $this->getCurrentTaskSlug();

        $relatedTasks = $this->getRelatedTask($slug);

        $relatedTaskExist = $relatedTasks->contains(
            Task::where('slug', $slug)->first()
        );

        if($relatedTaskExist)
        {
            $slug = "$slug-{$relatedTasks->count()}";
        }
        
        $this->task->slug = $slug;
    }

    protected function getCurrentTaskSlug()
    {
        return Str::slug($this->task->title);
    }

    protected function getRelatedTask(string $slug)
    {
/*        return Task::select('slug')
            ->where('slug', 'LIKE', "$slug%")
            ->where('id', '<>', $this->task->id)
            ->get(); */

        return Task::where('slug', 'LIKE', "$slug%")
            ->where('id', '<>', $this->task->id)
            ->get();
    }
}
