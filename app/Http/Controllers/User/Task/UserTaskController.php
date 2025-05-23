<?php

namespace App\Http\Controllers\User\Task;

use Illuminate\View\View;

class UserTaskController
{
    public function index(): View
    {
        return view('user.task.pages.index');
    }
}
