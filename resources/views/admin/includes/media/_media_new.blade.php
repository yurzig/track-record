@php
    $placementOptions = "<option value=''>Расположение картинки</option>";
    foreach ($placements as $key => $placement) {
        $placementOptions .= "<option value='$key'>$placement</option>";
     }
@endphp
<div class="group-item card js-block">
    <div class="card-header header">
        <div class="card-tools-start">
            <div class="btn btn-card-header act-show fa show js-repl"
                 title="Скрыть/Показать"
                 data-bs-target="#media-group-{{ $j }}"
                 data-bs-toggle="collapse"
                 aria-controls="media-group-{{ $j }}"
                 aria-expanded="true"></div>
        </div>
        <span class="item-label header-label">Новая картинка</span>
        <div class="card-tools-end">
            <div class="btn btn-card-header act-delete fa block-delete" title="Удалить этот блок"></div>
        </div>
    </div>
    <div id="media-group-{{ $j }}" class="card-block collapse row js-repl show" role="tabpanel">
        <input type="hidden" name="media[{{ $j }}][id]" class="js-repl" value="">
        <div class="col-xl-6">

            <div class="form-group media-preview">
                <input type="file" name="media{{ $j }}" class="js-img js-repl" required="required">
                <img src="" alt="">
            </div>
        </div>
        <div class="col-xl-6">
            <div class="form-group row">
                <label class="col-sm-4 form-control-label">Название</label>
                <div class="col-sm-8">
                    <input type="text" name="media[{{ $j }}][title]" class="form-control js-repl"
                           placeholder="Название картинки">
                </div>
            </div>
            <div class="form-group row mandatory">
                <label class="col-sm-4 form-control-label">Место размещения</label>
                <div class="col-sm-8">
                    <select name="media[{{ $j }}][placement]" class="form-select js-repl" required="required">
                        {!! $placementOptions !!}
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
