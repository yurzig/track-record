<div id="columns-form" class="modal fade" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Колонки</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" id="columns" action="{{ $action }}">
                    @csrf
                    <ul class="column-list">
                        @foreach($fields as $field)
                        <li class="column-item">
                            <label tabindex="tabindex">
                                <input type="checkbox"
                                       name="fields[]"
                                       class="form-check-input"
                                       value="{{ $field['dbName'] }}"
                                       @checked(in_array($field['dbName'], $columns))>
                                {{ $field['name'] }}
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
                <button type="submit" class="btn btn-primary" form="columns">Сохранить</button>
            </div>
        </div>
    </div>
</div>
