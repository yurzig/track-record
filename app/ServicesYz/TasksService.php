<?php

namespace App\ServicesYz;

use App\Models\Tasks\Task;
use App\Yz\Services\Service;
use App\Yz\Services\Traits\ActionAfterSaving;
use App\Yz\Services\Traits\ACTIONS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class TasksService extends Service
{
    use ACTIONS, ActionAfterSaving;

    const TYPES = [
        'task'      => 'Задача',
        'subtask'   => 'Подзадача',
        'separator' => 'Разделитель',
    ];

    /**
     * Получить список задач
     */
    public function getAll(?int $perPage = null): object
    {
        $filter = self::getFilters();
        $sort = self::getSort(['id', 'asc']);

        $query = Task::query();

        if($filter) {
            foreach ($filter['val'] as $key => $item) {
                if (!is_null($item)) {
                    $query->where($key, $filter['op'][$key], $filter['op'][$key] === 'like' ? "%$item%" : $item);
                }
            }
        }
        $result = $query
            ->orderBy($sort[0], $sort[1])
            ->paginate($perPage);

        return $result;
    }

    /**
    * Сохранение задачи
    */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->input();
//dd($data);
        $this->saveValidate($data);

        $task = (new Task())->create($data);

        if (!$task) {

            return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
        }

        return $this->actionAfterSaving($task, $request);
    }

    /**
    * Обновить задачу
    */
    public function update(Request $request, Task $task): RedirectResponse
    {
        if (empty($task)) {

            return back()
                ->withErrors(['msg' => "Запись id=[{$task->id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        $this->saveValidate($data);

        $result = $task->update($data);

        if (!$result) {

            return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
        }

        return $this->actionAfterSaving($task, $request);
    }

    /**
    * Удалить задачу
    */
    public function delete (Task $task): RedirectResponse
    {
        $item = $task;

        $result = $task->delete();

        if (!$result) {

            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }

        return redirect()
            ->route('admin.tasks.task.index')
            ->with(['success' => "Удалена запись id[$item->id] - $item->title"]);
    }

    /**
    * Валидация
    */
    public function saveValidate(array $data): void
    {
        Validator::make($data, [
            'title' => 'required|max:200',
            'project_id' => 'required|integer',
        ])->validate();
    }

    /**
     * Получить список задач для вывода в выпадающем списке
     */
    public function getForSelect(): array
    {

        return Task::select('id', 'title')->toBase()->get();
    }

    /**
    * Получить массив типов
    */
    public function getTypes(): array
    {

        return self::TYPES;
    }

    /**
    * Получить тип
    */
    public function getType($type): string
    {

        return self::TYPES[$type];
    }

}
