<?php

namespace App\Http\Controllers\Admin\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Tasks\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    private int $perPage;

    public function __construct()
    {
        $this->perPage = 25;
    }

    /**
     * Список задач
     */
    public function index(): View
    {
        $items = tasks()->getAll($this->perPage);

        return view('admin.tasks.tasks.index', compact('items'));
    }

    /**
     * Создание задачи (форма)
     */
    public function create(): View
    {

        return view('admin.tasks.tasks.create');
    }

    /**
     * Создание задачи (сохранение)
     */
    public function store(Request $request): RedirectResponse
    {

        return tasks()->store($request);
    }

    /**
     * Редактирование задачи (форма)
     */
    public function edit(Task $task): View
    {

        return view('admin.tasks.tasks.edit', compact('task'));
    }

    /**
     * Редактирование задачи (сохранение)
     */
    public function update(Request $request, Task $task): RedirectResponse
    {

        return tasks()->update($request, $task);
    }

    /**
     * Удаление задачи.
     */
    public function destroy(Task $task): RedirectResponse
    {

        return tasks()->delete($task);
    }

    /**
     * Сохранение в сессии списка видимых колонок.
     */
    public function columns(Request $request): RedirectResponse
    {
        tasks()->setColumns($request->fields);

        return to_route('admin.tasks.index');
    }

    /**
     * Сохранение в сессии примененных фильтров.
     */
    public function filter(Request $request): RedirectResponse
    {
        tasks()->setFilters($request->filters);

        return to_route('admin.tasks.index');
    }

    /**
     * Сброс и сохранение в сессии примененных фильтров.
     */
    public function resetFilters(): RedirectResponse
    {
        tasks()->resetFilters();

        return to_route('admin.tasks.index');
    }

    /**
     * Сохранение в сессии поля и направления сортировки.
     */
    public function sort(Request $request): RedirectResponse
    {
        tasks()->setSort($request);

        return to_route('admin.tasks.index');
    }

}
