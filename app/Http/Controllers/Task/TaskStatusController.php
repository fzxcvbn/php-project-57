<?php

namespace App\Http\Controllers\Task;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreTaskStatusRequest;
use App\Http\Requests\Task\UpdateTaskStatusRequest;
use App\Models\TaskStatus;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class TaskStatusController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(TaskStatus::class);
    }

    public function index(): View
    {
        $taskStatuses = TaskStatus::all()->sortBy('id');

        return view('task_statuses.index', compact('taskStatuses'));
    }

    public function create(): View
    {
        $taskStatus = new TaskStatus();

        return view('task_statuses.create', compact('taskStatus'));
    }

    public function store(StoreTaskStatusRequest $request): RedirectResponse
    {
        $taskStatus = new TaskStatus();
        $taskStatus->fill($request->validated());
        $taskStatus->save();

        flash(__('task-status.created-successfully'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function edit(TaskStatus $taskStatus): View
    {
        return view('task_statuses.edit', compact('taskStatus'));
    }

    public function update(UpdateTaskStatusRequest $request, TaskStatus $taskStatus): RedirectResponse
    {
        $taskStatus->fill($request->validated());
        $taskStatus->save();

        flash(__('task-status.changed-successfully'))->success();

        return redirect()->route('task_statuses.index');
    }

    public function destroy(TaskStatus $taskStatus): RedirectResponse
    {
        if ($taskStatus->tasks()->exists()) {
            flash(__('task-status.deleted-fail-is-used'))->error();
            return back();
        }

        $taskStatus->delete();

        flash(__('task-status.deleted-successfully'))->success();

        return redirect()->route('task_statuses.index');
    }
}
