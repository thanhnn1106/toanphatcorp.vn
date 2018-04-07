@extends('admin.layout')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>{{ trans('admin.product.lb_title_product') }}
            <small>{{ $title }}</small>
        </h1>
    </section>
    <?php
        $listStatus         = config('product.product_status.label');
        $listPaymentMethod  = config('product.payment_method.label');
        $listShippingMethod = config('product.shipping_method.label');
    ?>

    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('notifications')
                <div class="alert alert-danger alert-block" style="display:none;">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <p></p>
                </div>
                <form role="form" action="{{ route('ajax_admin_product_save') }}" id="form_product" method="POST" enctype="multipart/form-data">
                    <div class="box-footer">
                        {{ csrf_field() }}
                        <button type="button" id="save_product" class="btn btn-primary btn-sm">{{ trans('admin.product.btn_submit') }}</button>
                        <a href="{{ route('admin_product_index') }}" class="btn btn-default btn-sm">{{ trans('admin.product.btn_back') }}</a>
                    </div>
                    <!-- left -->
                    <div class="col-xs-6" style="padding-left: 0px; margin-top: 5px;">
                        <div class="box box-success">
                            <div class="box-body">
                                <div class="form-group form-categories">
                                    <input type="hidden" id="hide_category_id" value="{{ $product->category_id or null }}" />
                                    <input type="hidden" id="hide_sub_category_id" value="{{ $product->sub_category_id or null }}" />
                                    <input type="hidden" id="hide_position_use" value="{{ $product->position_use or null }}" />
                                    <input type="hidden" id="hide_size" value="{{ $product->size or null }}" />
                                    <input type="hidden" id="hide_style" value="{{ $product->style or null }}" />
                                    <input type="hidden" id="hide_material" value="{{ $product->material or null }}" />
                                    <input type="hidden" name="product_id" id="product_id" value="{{ $product->id or null }}" />
                                    <input type="hidden" name="image_thumb_hidden" value="{{ isset($product->image_rand) ? $product->image_rand : '' }}" />
                                    <label class="control-label">{{ trans('admin.product.lb_categories') }}</label>
                                    <select name="categories" id="categories" url-cate="{{ route('ajax_product_load_cate') }}" class="form-control border-corner">
                                        <option value="">------</option>
                                        @foreach ($categories as $cate)
                                        <option value="{{ $cate->id }}"  @if ((isset($product->category_id) ? $product->category_id : '') == $cate->id) selected="selected" @endif>{{ $cate->title }}</option>
                                        @endforeach
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-sub_categories">
                                    <label class="control-label">{{ trans('admin.product.lb_sub_categories') }}</label>
                                    <select name="sub_categories" id="sub_categories" data-url="{{ route('ajax_product_load_style') }}" class="form-control border-corner">
                                        <option value="">------</option>
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-status">
                                    <label class="control-label">{{ trans('admin.product.lb_status') }}</label>
                                    <select name="status" id="status" class="form-control border-corner">
                                        @foreach ($listStatus as $keyStatus => $status)
                                        <option value="{{ $keyStatus }}" @if ((isset($product->status) ? $product->status : '') == $keyStatus) selected="selected" @endif>{{ trans($status) }}</option>
                                        @endforeach
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-quantity">
                                    <label class="control-label">{{ trans('admin.product.lb_quantity') }}</label>
                                    <input type="text" class="form-control border-corner" id="quantity" name="quantity" placeholder="Input ..." value="{{ isset($product->quantity) ? $product->quantity : '' }}" />
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-quantity_limit">
                                    <label class="control-label">{{ trans('admin.product.lb_quantity_limit') }}</label>
                                    <input type="text" class="form-control border-corner" id="quantity_limit" name="quantity_limit" placeholder="Input ..." value="{{ isset($product->quantity_limit) ? $product->quantity_limit : '' }}" />
                                    <p class="help-block"></p>
                                </div>
                                <div id="load_style">

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- right -->
                    <div class="col-xs-6" style="padding-right: 0px; margin-top: 5px;">
                        <div class="box box-success">
                            <div class="box-body">
                                <div class="form-group form-seller_id">
                                    <label class="control-label">{{ trans('admin.product.lb_seller') }}</label>
                                    <input type="text" class="form-control border-corner" data-url="{{ route('ajax_load_seller') }}" name="seller" id="seller" placeholder="Input ..." value="{{ $company_name or null }}" />
                                    <input type="hidden" name="seller_id" id="seller_id" value="{{ isset($product->user_id) ? $product->user_id : '' }}" />
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-price">
                                    <label class="control-label">{{ trans('admin.product.lb_price') }}</label>
                                    <input type="text" class="form-control border-corner" id="price" name="price" placeholder="Input ..." value="{{ isset($product->price) ? $product->price : '' }}" />
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-payment_method">
                                    <label class="control-label">{{ trans('admin.product.lb_payment_method') }}</label>
                                    <select name="payment_method" id="payment_method" class="form-control border-corner">
                                        <option value="">------</option>
                                        @foreach($listPaymentMethod as $keyPay => $payMethod)
                                        <option value="{{ $keyPay }}" @if ((isset($product->payment_method) ? $product->payment_method : '') == $keyPay) selected="selected" @endif>{{ trans($payMethod) }}</option>
                                        @endforeach
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-shipping_method">
                                    <label class="control-label">{{ trans('admin.product.lb_shipping_method') }}</label>
                                    <select name="shipping_method" id="shipping_method" class="form-control border-corner">
                                        <option value="">------</option>
                                        @foreach ($listShippingMethod as $keyShip => $shipMethod)
                                        <option value="{{ $keyShip }}" @if ((isset($product->shipping_method) ? $product->shipping_method : '') == $keyShip) selected="selected" @endif>{{ trans($shipMethod) }}</option>
                                        @endforeach
                                    </select>
                                    <p class="help-block"></p>
                                </div>
                                <div class="form-group form-upload form-image_thumb">
                                    <label class="control-label">{{ trans('admin.product.lb_quantity_limit') }}{{ trans('admin.product.lb_image_thumb') }}</label>
                                    <input type="file" accept="image/*" name="image_thumb" id="image_thumb" class="img-value" />
                                    <p class="help-block-default">(Max: 2MB - *.jpg, *.jpeg, *.png)</p>
                                    <div class="col-sm-10 control-but">
                                        @if(isset($product->image_rand) && isset($product->image_real))
                                        <?php $imageThumb = getImage($product->image_rand, $product->image_real); ?>
                                        <a href="{{ $imageThumb['href'] }}" target="_blank"><img src="{{ $imageThumb['img_src'] }}" /></a><br/>
                                        @endif
                                    </div>
                                    <div style="clear: both"></div>
                                    <p class="help-block"></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Image detail -->
                    <div class="col-xs-12" style="padding-left: 0px; margin-top: 5px; padding-right: 0px;">
                        <div class="box box-success">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ trans('admin.product.lb_image_detail') }}</h3>
                                <p class="help-block-default">(Max: 2MB - *.jpg, *.jpeg, *.png, *.gif)</p>
                                <div class="form-group form-total_image_detail">
                                    <p class="help-block"></p>
                                </div>
                            </div>
                            <div class="box-body">
                                <input id="image_detail" name="files[]" type="file" multiple class="file-loading" accept="image/*" />
                            </div>
                        </div>
                    </div>
                    <!-- end image detail -->

                    <ul class="nav nav-tabs">
                        @foreach ($languages as $lang)
                        <li @if($lang->iso2 === 'vi') class="active" @endif><a href="#tab_{{ $lang->iso2 }}" data-toggle="tab">{{ $lang->name }}</a></li>
                        @endforeach
                    </ul>
                    <div class="tab-content">
                        @foreach ($languages as $lang)
                        <div class="tab-pane @if($lang->iso2 === 'vi') active @endif" id="tab_{{ $lang->iso2 }}">
                            <div class="row">
                                <?php 
                                    $title       = 'title_'.$lang->iso2;
                                    $slug        = 'slug_'.$lang->iso2;
                                    $color       = 'color_'.$lang->iso2;
                                    $tagImage       = 'tag_image_'.$lang->iso2;
                                    $brand       = 'brand_'.$lang->iso2;
                                    $infoTech    = 'info_tech_'.$lang->iso2;
                                    $featureHighlight = 'feature_highlight_'.$lang->iso2;
                                    $source           = 'source_'.$lang->iso2;
                                    $guarantee        = 'guarantee_'.$lang->iso2;
                                    $deliveryLocation = 'delivery_location_'.$lang->iso2;
                                    $detail           = 'detail_'.$lang->iso2;
                                    $formProduct      = 'form_product_'.$lang->iso2;
                                ?>
                                <!-- begin left -->
                                <div class="col-xs-6">
                                    <div class="box box-success">
                                        <div class="box-body">
                                            <div class="form-group form-{{ $title }}">
                                                <label class="control-label">{{ trans('admin.product.'.$title) }}</label>
                                                <input type="text" class="form-control border-corner title-slug" 
                                                       lang="{{ $lang->iso2 }}" name="{{ $title }}" placeholder="Input ..." value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->title : '' }}" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">{{ trans('admin.product.'.$slug) }}</label>
                                                <p class="help-block-default slug-{{ $lang->iso2 }}">{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->slug : '' }}</p>
                                            </div>

                                            <div class="form-group form-{{ $tagImage }}">
                                                <label class="control-label">{{ trans('admin.product.'.$tagImage) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $tagImage }}" data-role="tagsinput" placeholder="Input ..." value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->tag_image : '' }}" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group form-{{ $color }}">
                                                <label class="control-label">{{ trans('admin.product.'.$color) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $color }}" placeholder="Input ..." value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->color : '' }}" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group form-{{ $brand }}">
                                                <label class="control-label">{{ trans('admin.product.'.$brand) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $brand }}" placeholder="Input ..." value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->brand : '' }}" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group form-{{ $infoTech }}">
                                                <label class="control-label">{{ trans('admin.product.'.$infoTech) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $infoTech }}" placeholder="Input ..." value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->info_tech : '' }}" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group form-{{ $featureHighlight }}">
                                                <label class="control-label">{{ trans('admin.product.'.$featureHighlight) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $featureHighlight }}" placeholder="Input ..." value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->feature_highlight : '' }}" />
                                                  <p class="help-block"></p>
                                            </div>
                                        </div>
                                        <!-- /.box-body -->
                                    </div>
                                </div>
                                <!-- end left -->

                                <!-- begin right -->
                                <div class="col-xs-6">
                                    <div class="box box-success">
                                        <div class="box-body">
                                            <div class="form-group form-{{ $source }}">
                                                <label class="control-label">{{ trans('admin.product.'.$source) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $source }}" placeholder="Input ..." value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->source : '' }}" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group form-{{ $guarantee }}">
                                                <label class="control-label">{{ trans('admin.product.'.$guarantee) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $guarantee }}" placeholder="Input ..." value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->guarantee : '' }}" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group form-{{ $deliveryLocation }}">
                                                <label class="control-label">{{ trans('admin.product.'.$deliveryLocation) }}</label>
                                                <input type="text" class="form-control border-corner" name="{{ $deliveryLocation }}" placeholder="Input ..." value="{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->delivery_location : '' }}" />
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group form-{{ $detail }}">
                                                <label class="control-label">{{ trans('admin.product.'.$detail) }}</label>
                                                <textarea name="{{ $detail }}" class="form-control border-corner editor-content" rows="3">{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->detail : '' }}</textarea>
                                                  <p class="help-block"></p>
                                            </div>

                                            <div class="form-group form-{{ $formProduct }}">
                                                <label class="control-label">{{ trans('admin.product.'.$formProduct) }}</label>
                                                <textarea name="{{ $formProduct }}" class="form-control border-corner" rows="3">{{ isset($productTrans[$lang->iso2]) ? $productTrans[$lang->iso2]->form_product : '' }}</textarea>
                                                  <p class="help-block"></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- end right -->
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <!-- /.tab-content -->
                </div>
                </form>
                <!-- nav-tabs-custom -->
            </div>
        </div>
    </section>

    <div id="content_img" style="display: none;">
        <a href="javscript:void(0);" class="img-review"></a>
    </div>

<?php 
    $initPreviewImage = isset($productImages['initialPreview']) ? json_encode($productImages['initialPreview']) : NULL;
    $initPreviewConfig = isset($productImages['initialPreviewConfig']) ? json_encode($productImages['initialPreviewConfig']) : NULL;
?>

@endsection

@section('footer_script')

<script>
var product_ajax_upload = '{{ route('ajax_product_upload_file') }}';
var product_ajax_delete = '{{ route('ajax_product_delete_file') }}';

var initialPreviewImg = initialPreviewConfigImg = [];
    @if( ! is_null($initPreviewImage))
    initialPreviewImg = {!! $initPreviewImage !!};
    @endif

    @if( ! is_null($initPreviewConfig))
    initialPreviewConfigImg = {!! $initPreviewConfig !!};
    @endif

</script>
<!-- bootstrap multiple upload -->
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/css/fileinput.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/bootstrap-fileinput/themes/explorer/theme.css') }}">
<link href="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.css') }}" rel="stylesheet"/>
<script src="{{ asset('plugins/bootstrap-fileinput/js/plugins/piexif.min.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-fileinput/js/plugins/sortable.min.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap-fileinput/js/plugins/purify.min.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap-fileinput/js/fileinput.min.js') }}"></script>
<!--<script src="{{ asset_admin('/plugins/bootstrap-fileinput/themes/fa/theme.js') }}"></script>-->
<script src="{{ asset('/plugins/bootstrap-fileinput/js/locales/LANG.js') }}"></script>
<script src="{{ asset('/plugins/bootstrap-fileinput/themes/explorer/theme.js') }}"></script>
<script src="{{ asset('plugins/bootstrap-tagsinput/bootstrap-tagsinput.min.js') }}"></script>
<script src="{{ asset_admin('js/product.js') }}"></script>

<!-- TinyMCE -->
<script type="text/javascript" src="{{ asset('/plugins/tinymce/tinymce.min.js') }}"></script>
<script>
$(function() {
    tinymce.init({
        selector: ".editor-content", 
        theme: "modern", 
        height: 400,
        subfolder:"",
        plugins: [ 
        "advlist autolink link image lists charmap print preview hr anchor pagebreak", 
        "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking", 
        "table contextmenu directionality emoticons paste textcolor filemanager" 
        ], 
        image_advtab: true, 
        toolbar: "sizeselect | fontselect | fontsizeselect | undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code"
    });
});
</script>
@endsection