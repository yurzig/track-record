<?php

namespace App\ServicesYz;

use App\Models\Tasks\TaskSection;
use App\Yz\Services\Service;
use App\Yz\Services\Traits\ActionAfterSaving;
use App\Yz\Services\Traits\ACTIONS;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class TaskSectionsService extends Service
{
    use ACTIONS, ActionAfterSaving;

    /**
     * Получить список разделов
     */
    public function getAll(?int $perPage = null): object
    {
        $filter = self::getFilters();
        $sort = self::getSort(['id', 'asc']);

        $query = TaskSection::query();

        if($filter) {
            foreach ($filter['val'] as $key => $item) {
                if (!is_null($item)) {
                    $query->where($key, $filter['op'][$key], $filter['op'][$key] === 'like' ? "%$item%" : $item);
                }
            }
        }

        return $query
            ->orderBy($sort[0], $sort[1])
            ->paginate($perPage);
    }

    /**
     * Сохранение раздела
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->input();

        $this->saveValidate($data);

        $section = (new TaskSection())->create($data);

        if (!$section) {

            return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
        }

        return $this->actionAfterSaving($section, $request);
    }

    /**
     * Обновить раздел
     */
    public function update(Request $request, TaskSection $section): RedirectResponse
    {
        if (empty($section)) {

            return back()
                ->withErrors(['msg' => "Запись id=[{$section->id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        $this->saveValidate($data);

        $result = $section->update($data);

        if (!$result) {

            return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
        }

        return $this->actionAfterSaving($section, $request);
    }

    /**
     * Удалить раздел
     */
    //todo проверить наличие задач перед удалением раздела
    public function delete (TaskSection $section): RedirectResponse
    {
        $item = $section;

        $result = $section->delete();

        if (!$result) {

            return back()->withErrors(['msg' => 'Ошибка удаления']);
        }

        return redirect()
            ->route('admin.task.sections.index')
            ->with(['success' => "Удалена запись id[$item->id] - $item->title"]);
    }

    /**
     * Валидация
     * @throws ValidationException
     */
    public function saveValidate( array $data ): void
    {
        Validator::make( $data, [
            'title' => 'required|max:200',
            'project_id' => 'required|integer',
        ])->validate();
    }

    /**
     * Получить список разделов для вывода в выпадающем списке
     */
    public function getForSelect(): Collection
    {

        return TaskSection::select('id', 'title')->toBase()->get();
    }

    /**
        Получить цвет из поля properties
     */
    public function getColor(TaskSection $tasksSection): string
    {
        if(is_null($tasksSection->properties)) {

            return 'белый';
        } else {

            return $tasksSection->properties['color'];
        }
    }
}
