<?php


namespace App\Http\Controllers\Admin\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Tasks\TasksProject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class TasksProjectController extends Controller
{

    public function __construct()
    {
    }

    /**
     * Вывод списка проектов в виде дерева.
     */
    public function index(): View
    {

        return view('admin.tasks.projects.index');
    }

    /**
     * Добавление нового проекта (форма)
     */
    public function add($parent): View
    {

        return view('admin.tasks.projects.create', compact('parent'));
    }

    /**
     * Добавление нового проекта (сохранить)
     */
    public function store(Request $request): RedirectResponse
    {

        return projects()->store($request);
    }

    /**
     * Редактирование проекта (форма)
     */
    public function edit(TasksProject $project): View
    {
        $projects = projects()->getTree();

        return view('admin.tasks.projects.edit', compact('project', 'projects'));
    }

    /**
     * Редактирование проекта (сохранить)
     */
    public function update(Request $request, TasksProject $project): RedirectResponse
    {

        return projects()->update($request, $project);
    }

    /**
     * Удаление проекта.
     */
    //todo проверка на наличие разделов и задач перед удалением проекта
    public function destroy(TasksProject $project): RedirectResponse
    {

        return projects()->delete($project);
    }

    /**
     * Сортировка проектов.
     */
    public function sortable(Request $request): JsonResponse
    {
        postCategories()->setSortable($request);

        return response()->json('Ok');
    }

}
