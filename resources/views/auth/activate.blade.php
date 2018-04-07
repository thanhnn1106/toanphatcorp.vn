@extends("layouts.frontend.frontend_body_non_slider_and_categories")

@section('body')

    <div class="section">
        <div class="container group-section-magbe">
            <div class="articles-group-title text-center title-bar">
                <span class="group-title">{!! trans('wallet.activated_page_title') !!}</span>
            </div>
            <div class="articles-group-triangle"></div>
            <div class="row content">
                <div class="col-md-12 distance-row">
                        <span class="magbe-content-description">
                            <p>{!! trans('wallet.activated_page_text') !!}</p>
                        </span>
                </div>
            </div>
        </div>
    </div>
@endsection