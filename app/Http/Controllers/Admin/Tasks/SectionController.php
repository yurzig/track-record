<?php

namespace App\Http\Controllers\Admin\Tasks;

use App\Http\Controllers\Controller;
use App\Models\Blog\PostTag;
use App\Models\Tasks\Section;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SectionController extends Controller
{
    private $perPage;

    public function __construct()
    {
        $this->perPage = 25;
    }

    /**
     * Список разделов
     */
    public function index(): View
    {
        $items = sections()->getAll($this->perPage);

        return view('admin.tasks.sections.index', compact('items'));
    }

    /**
     * Создание раздела(форма)
     */
    public function create(): View
    {

        return view('admin.tasks.sections.create');
    }

    /**
     * Создание раздела (сохранение)
     */
    public function store(Request $request): RedirectResponse
    {

        return sections()->store($request);
    }

    /**
     * Редактирование раздела (форма)
     */
    public function edit(Section $section): View
    {

        return view('admin.tasks.sections.edit', compact('section'));
    }

    /**
     * Редактирование раздела (сохранение)
     */
    public function update(Request $request, Section $section): RedirectResponse
    {

        return sections()->update($request, $section);
    }

    /**
     * Удаление раздела.
     */
    // TODO проверить существование задач в разделе
    public function destroy(Section $section): RedirectResponse
    {

        return sections()->delete($section);
    }

    /**
     * Сохранение в сессии списка видимых колонок.
     */
    public function columns(Request $request): RedirectResponse
    {
        Sections()->setColumns($request->fields);

        return to_route('admin.tasks.sections.index');
    }

    /**
     * Сохранение в сессии примененных фильтров.
     */
    private function filter(Request $request): RedirectResponse
    {
        sections()->setFilters($request->filters);

        return to_route('admin.tasks.sections.index');
    }

    /**
     * Сброс и сохранение в сессии примененных фильтров.
     */
    public function filtersReset(): RedirectResponse
    {
        sections()->filtersReset();

        return to_route('admin.tasks.sections.index');
    }

    /**
     * Сохранение в сессии поля и направления сортировки.
     */
    public function sort(Request $request): RedirectResponse
    {
        sections()->setSort($request);

        return to_route('admin.tasks.sections.index');
    }

}
