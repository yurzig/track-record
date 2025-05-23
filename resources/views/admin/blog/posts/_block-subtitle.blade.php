<div class="accordion-item list-group-item block-subtitle">
    <i class="fa fa-arrows-alt handle"></i>
    <div class="block-body">
        <h2 class="accordion-header" id="accordion-header{{ $blockId }}">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapse{{ $blockId }}"
                    aria-expanded="false" aria-controls="panelsStayOpen-collapse{{ $blockId }}">
                <i class="fa fa-object-group"></i>
                Блок {{ $block['blockId'] }}{{ $block['block-title'] ? ' "'.$block['block-title'].'"' : '' }}
            </button>
            <div class="btn fa act-delete js-delete-block"></div>
        </h2>
        <div id="panelsStayOpen-collapse{{ $blockId }}" class="accordion-collapse collapse"
             aria-labelledby="accordion-header{{ $blockId }}">
            <div class="accordion-body">

                <div class="form-group row">
                    <div class="col-sm-12 row">
                        <label class="col-sm-4 form-control-label">Название блока</label>

                        <input type="hidden" name="content[{{ $blockId }}][type]" value="subtitle">
                        <input type="hidden" name="content[{{ $blockId }}][blockId]" value="{{ $blockId }}">

                        <div class="col-sm-8">
                            <input type="text" name="content[{{ $blockId }}][block-title]"
                                   class="form-control"
                                   value="{{ old('content['.$blockId.'][block-title]', $block['block-title']) }}"
                                   placeholder="Название блока">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 row">
                        <label class="col-sm-4 form-control-label">Тип заголовка</label>
                        <div class="col-sm-4">
                            <select name="content[{{ $blockId }}][title-type]" class="form-select item-status" >
                                <option value='h1' @selected($block['title-type'] === 'h1')>h1</option>";
                                <option value='h2' @selected($block['title-type'] === 'h2')>h2</option>";
                                <option value='h3' @selected($block['title-type'] === 'h3')>h3</option>";
                                <option value='h4' @selected($block['title-type'] === 'h4')>h4</option>";
                                <option value='h5' @selected($block['title-type'] === 'h5')>h5</option>";
                                <option value='h6' @selected($block['title-type'] === 'h6')>h6</option>";
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12 row">
                        <label class="col-sm-4 form-control-label">Расположен</label>
                        <div class="col-sm-6 row">
                            <div class="col-sm-4 form-group form-check">
                                <input type="radio" name="content[{{ $blockId }}][title-location]"
                                       id="title-location1" class="form-check-input"
                                       value="left"
                                       {{ old('content['.$blockId.'][title-location]', $block['title-location'] == 'left' ? 'checked' : '') }}>
                                <label class="form-check-label" for="title-location1">слева</label>
                            </div>
                            <div class="col-sm-4 form-group form-check">
                                <input type="radio" name="content[{{ $blockId }}][title-location]"
                                       id="title-location2" class="form-check-input"
                                       value="centre"
                                       {{ old('content['.$blockId.'][title-location]', $block['title-location'] == 'centre' ? 'checked' : '') }}>
                                <label class="form-check-label" for="title-location2">в центре</label>
                            </div>
                            <div class="col-sm-4 form-group form-check">
                                <input type="radio" name="content[{{ $blockId }}][title-location]"
                                       id="title-location3" class="form-check-input"
                                       value="right"
                                       {{ old('content['.$blockId.'][title-location]', $block['title-location'] == 'right' ? 'checked' : '') }}>
                                <label class="form-check-label" for="title-location3">справа</label>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-control-label justify-content-center">Заголовок</label>
                    <textarea name="content[{{ $blockId }}][text]" class="summernote form-control item-content">
                        {{ $block['text'] }}
                    </textarea>
                </div>
            </div>
        </div>
    </div>
</div>
