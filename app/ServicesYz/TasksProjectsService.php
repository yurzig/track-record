<?php

namespace App\ServicesYz;

use App\Models\Tasks\TasksProject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;


class TasksProjectsService
{
    /**
     * Получить список проектов в виде дерева методом Tommy Lacroix
     */
    public function getTree(): array
    {
        $projects = TasksProject::select('id', 'title', 'parent_id')
            ->orderBy('sort')
            ->toBase()
            ->get();

        $dataSet = [];
        foreach ($projects as $row) {
            $dataSet[$row->id] = ['id' => $row->id, 'title' => $row->title, 'parent' => $row->parent_id];
        }

        $tree = [];
        foreach ($dataSet as $id => &$node) {
            if (!$node['parent']) {
                $tree[$id] = &$node;
            } else {
                $dataSet[$node['parent']]['children'][$id] = &$node;
            }
        }

        return $tree;
    }

    /**
     * Сохранение проекта
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->input();
        $this->saveValidate($data);

        $project = (new TasksProject())->create($data);

        if (!$project) {

            return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
        }

        return to_route('admin.tasks.projects.edit', $project)->with(['success' => 'Успешно сохранено']);
    }

    /**
     * Обновить проект
     */
    public function update(Request $request, TasksProject $project): RedirectResponse
    {
        if (empty($project)) {

            return back()
                ->withErrors(['msg' => "Запись id=[{$project->id}] не найдена"])
                ->withInput();
        }

        $data = $request->all();

        $this->saveValidate($data);

        $result = $project->update($data);

        if (!$result) {

            return back()->withErrors(['msg' => 'Ошибка сохранения'])->withInput();
        }

        return to_route('admin.tasks.projects.edit', $project)->with(['success' => 'Успешно сохранено']);
    }

    /**
     * Удалить проект
     */
    public function delete (TasksProject $project): RedirectResponse
    {

        $result = $project->delete();

        if ($result) {

            return redirect()
                ->route('admin.tasks.projects.index')
                ->with(['success' => "Удалена запись id[$project->id] - $project->title"]);
        }

        return back()->withErrors(['msg' => 'Ошибка удаления']);
    }
/**
        Проверка перед удалением категории поста
     */
//    public function beforeDelete( Post $post_category ): void
//    {
//        if (count(posts()->getByCategoryId( $post_category )) > 0)
//
//            abort(403, ' Удаление невозможно. У этой категории есть посты');
//
//
//    }


    /**
     * Валидация
     * @throws ValidationException
     */
    public function saveValidate( array $data ): void
    {
        Validator::make( $data, [
            'title' => 'required|max:200',
            'parent_id' => 'required|integer',
        ])->validate();
    }

    /**
     * Получить список проектов для вывода в выпадающем списке
     */
    public function getForSelect(): array
    {

        return TasksProject::select('id', 'title')->toBase()->get();
    }

    /**
     * Получить дерево проектов для select
     */
    public function selectTree(int $active_id): string
    {

        return self::selectItems(projects()->getTree(), $active_id);
    }

    private static function selectItems(array $items, int $active_id, string $str=''): string
    {
        $string = '';
        foreach ($items as $item) {
            $string .= self::selectRow($item, $active_id, $str);
        }

        return $string;
    }

    private static function selectRow(array $project, int $active_id, string $str): string
    {

        $selected = ($active_id === $project['id']) ? ' selected="selected"' : '';
//        if($category['parent'] == 0) {
//            $row = '<option value="' . $category['id'] . '"' . $selected . '>' . $category['title'] . '</option>';
//        } else {
            $row = '<option value="' . $project['id'] . '"' . $selected . '>' . $str . $project['title'] . '</option>';
//        }

        if (isset($project['children'])) {
            $str .= '&nbsp&nbsp';
            $row .= self::SelectItems($project['children'], $active_id, $str);
        }

        return $row;
    }

    /**
     * Получить дерево проектов для меню
     */
    public function menuTree(int $active_id): string
    {
        $level = 1;
        $string = '<ul class="menu-tree node" data-level="' . $level . '" data-id="0" data-url="' . route("admin.tasks.projects.sortable") . '">';

        $string .= self::menuItems(projects()->getTree(), $active_id, $level);

        $string .= '</ul>';

        return $string;
    }


    private static function menuItems(array $projects, int $active_id, int $level): string
    {
        $string = '';
        foreach ($projects as $project) {
            $string .= self::menuRow($project, $active_id, $level);
        }

        return $string;
    }

    private static function menuRow(array $project, int $active_id, int $level): string
    {
        $active = ($active_id === $project['id']) ? ' active' : '';
        $row = '<li class="menu-tree-item' . $active . '" data-id="' . $project['id'] . '" data-level="' . $level . '">
                <div class="menu-tree-line d-flex justify-content-between">
                    <div>
                        <a class="btn fa act-add"
                            href="' . route('admin.tasks.projects.add', $project['id']) . '"
                            title="Новая запись">
                        </a>
                        <a class="menu-tree-text"
                            href="' . route('admin.tasks.projects.edit', $project['id']) . '"
                            title="Редактировать">' . $project['title'] . '</a>
                    </div>
                    <div>
                        <a class="btn fa act-delete js-delete"
                            href="' . route('admin.tasks.projects.destroy', $project['id']) . '"
                            title="Удалить запись"></a>
                    </div>
                </div>';

        if (isset($project['children'])) {
            $level = ++$level;
            $row .= '<ul class="node" data-level="' . $level . '" data-id="' . $project['id'] . '">' . self::menuItems($project['children'], $active_id, $level) . '</ul>';
        }
        $row .= '</li>';

        return $row;
    }

    /**
     * Сохранить сортировку блока проектов
     */
    public function setSortable(mixed $data): void
    {
        $parent_id = $data->node;
        $ids = explode(',', rtrim($data->ids, ','));

        foreach ($ids as $key => $id) {
            TasksProject::find($id)->update(['parent_id' => $parent_id, 'sort' => $key]);
        }
    }

}
