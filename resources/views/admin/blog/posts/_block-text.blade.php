<div class="accordion-item list-group-item">
    <i class="fa fa-arrows-alt handle"></i>
    <div class="block-body">
        <h2 class="accordion-header" id="accordion-header{{ $blockId }}">
            <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse"
                    data-bs-target="#panelsStayOpen-collapse{{ $blockId }}"
                    aria-expanded="false" aria-controls="panelsStayOpen-collapse{{ $blockId }}">
                <i class="fa fa-bars"></i>
                Блок {{ $block['blockId'] }}{{ $block['block-title'] ? ' "'.$block['block-title'].'"' : '' }}
            </button>
            <div class="btn fa act-delete js-delete-block"></div>
        </h2>
        <div id="panelsStayOpen-collapse{{ $blockId }}" class="accordion-collapse collapse"
             aria-labelledby="accordion-header{{ $blockId }}">
            <div class="accordion-body">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <input type="hidden" name="content[{{ $blockId }}][type]" value="text-only">
                        <input type="hidden" name="content[{{ $blockId }}][blockId]" value="{{ $blockId }}">

                        <input type="text" name="content[{{ $blockId }}][block-title]"
                               class="form-control"
                               value="{{ old('content['.$blockId.'][block-title]', $block['block-title']) }}"
                               placeholder="Заголовок блока">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-control-label justify-content-center">Текст блока</label>
                    <textarea name="content[{{ $blockId }}][text]" class="summernote form-control item-content">
                        {{ $block['text'] }}
                    </textarea>
                </div>
            </div>
        </div>
    </div>
</div>
