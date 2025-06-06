<div class="accordion-item list-group-item">
    <i class="fa fa-arrows-alt handle"></i>
    <div class="block-body">
        <h2 class="accordion-header" id="accordion-header{{ $blockId }}">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapse{{ $blockId }}"
                    aria-expanded="false" aria-controls="panelsStayOpen-collapse{{ $blockId }}">
                <i class="fa fa-image"></i>
                 Блок {{ $block['blockId'] }}{{ $block['block-title'] ? ' "'.$block['block-title'].'"' : '' }}
            </button>
            <div class="btn fa act-delete js-delete-block"></div>
        </h2>
        <div id="panelsStayOpen-collapse{{ $blockId }}" class="accordion-collapse collapse"
             aria-labelledby="accordion-header{{ $blockId }}">
            <div class="accordion-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="hidden" name="content[{{ $blockId }}][type]" value="img-only">
                        <input type="hidden" name="content[{{ $blockId }}][blockId]" value="{{ $blockId }}">
                        <input type="text" name="content[{{ $blockId }}][block-title]" class="form-control"
                               value="{{ old('content['.$blockId.'][block-title]', $block['block-title']) }}"
                               placeholder="Заголовок блока">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-6 box">
                        <div class="form-group form-check">
                            <input type="radio" name="content[{{ $blockId }}][img-width]"
                                   id="img-width1" class="form-check-input"
                                   data-width="{{ settings()->getBySlug('postImgSizeBig', 'width') }}"
                                   data-height="{{ settings()->getBySlug('postImgSizeBig', 'height') }}"
                                   value="100"
                                   {{ old('content['.$blockId.'][img-width]', $block['img-width'] == '100' ? 'checked' : '') }}>
                            <label class="form-check-label" for="img-width1">100%</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="radio" name="content[{{ $blockId }}][img-width]"
                                   id="img-width2" class="form-check-input"
                                   data-width="{{ settings()->getBySlug('postImgSizeMedium')['width'] }}"
                                   data-height="{{ settings()->getBySlug('postImgSizeMedium')['height'] }}"
                                   value="50"
                                   {{ old('content['.$blockId.'][img-width]', $block['img-width'] == '50' ? 'checked' : '') }}>
                            <label class="form-check-label" for="img-width2">50%</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="radio" name="content[{{ $blockId }}][img-width]"
                                   id="img-width3" class="form-check-input"
                                   data-width="{{ settings()->getBySlug('postImgSizeSmall', 'width') }}"
                                   data-height="{{ settings()->getBySlug('postImgSizeSmall', 'height') }}"
                                   value="30"
                                   {{ old('content['.$blockId.'][img-width]', $block['img-width'] == '30' ? 'checked' : '') }}>
                            <label class="form-check-label" for="img-width3">30%</label>
                        </div>
                    </div>
                    <div class="col-sm-6 box percent-100">
                        <div class="form-group form-check">
                            <input type="radio" name="content[{{ $blockId }}][img-horizontally]"
                                   id="img-horizontally1" class="form-check-input"
                                   value="left"
                                   {{ old('content['.$blockId.'][img-horizontally]', $block['img-horizontally'] == 'left' ? 'checked' : '') }}>
                            <label class="form-check-label" for="img-horizontally1">слева</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="radio" name="content[{{ $blockId }}][img-horizontally]"
                                   id="img-horizontally2" class="form-check-input"
                                   value="centre"
                                   {{ old('content['.$blockId.'][img-horizontally]', $block['img-horizontally'] == 'centre' ? 'checked' : '') }}>
                            <label class="form-check-label" for="img-horizontally2">в центре</label>
                        </div>
                        <div class="form-group form-check">
                            <input type="radio" name="content[{{ $blockId }}][img-horizontally]"
                                   id="img-horizontally3" class="form-check-input"
                                   value="right"
                                   {{ old('content['.$blockId.'][img-horizontally]', $block['img-horizontally'] == 'right' ? 'checked' : '') }}>
                            <label class="form-check-label" for="img-horizontally3">справа</label>
                        </div>
                    </div>
                </div>
                <div class="form-group media-preview">
                    <label>
                        <input type="file" id="zzz" class="form-control fileupload block-image-upload" value="Выберите картинку">
                        <div class="head-image">
                            <input type="hidden" name="content[{{ $blockId }}][img-path]" value="">
                            <img src="{{ '\\' . $block['img-path'] }}" alt="">
                        </div>
                    </label>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" name="content[{{ $blockId }}][img-title]"
                               class="form-control"
                               value="{{ old('content['.$blockId.'][img-title]', $block['img-title']) }}"
                               placeholder="Подпись под картинкой">
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="text" name="content[{{ $blockId }}][img-link]"
                               class="form-control"
                               value="{{ old('content['.$blockId.'][img-link]', $block['img-link']) }}"
                               placeholder="Ссылка картинки">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
