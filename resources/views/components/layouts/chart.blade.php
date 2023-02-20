<div class="col-md-{{ $sizeColumn }}">
    <div class="card card-{{ $color }}">
        <div class="card-header">
            <h3 class="card-title">{{ $value->options['chart_title'] }}</h3>

            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body">
            {!! $value->renderHtml() !!}
        </div>
    </div>
</div>
