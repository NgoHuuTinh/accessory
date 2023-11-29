@extends('layouts.base')
@section('title', 'Danh sách phụ tùng')
@section('content')
@include('layouts.header')
<div class="wrapper">
    <aside class="right-side strech">
        <section class="content">
            <div class="row" style="display: contents;">
                <div class="col-8">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">
                                <span class="fa fa-cog"></span> Tạo mới phụ kiện thiết bị
                                <small>* Bắt buộc nhập</small>
                            </h3>
                            <div class="box-tools" style="float: right;">
                                <a href="{{ route('get.products.index') }}" class="btn btn-default"><span class="fa fa-arrow-left"></span> Quay về màn hình danh sách linh kiện thiết bị</a>
                            </div>
                        </div>
                        <form action="{{ isset($product) ? route('post.products.update', $product->id) : route('post.products.create') }}" class="form-horizontal" enctype="multipart/form-data" method="post">
                            @csrf
                            <div class="box-body">
                                @include("partials/flash")
                                <div class="form-group">
                                    <label class="col-xs-3 control-label">Tên*</label>
                                    <div class="col-xs-9">
                                        <input type="text" id="name" name="name" class="form-control input-sm" value="{{ old('name', isset($product->name) ? $product->name : '')}}" placeholder="Nhập tên linh kiện, thiết bị">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label">Mã hàng hóa</label>
                                    <div class="col-xs-9">
                                        <input type="text" id="product_id" name="product_id" class="form-control input-sm" value="{{ old('product_id', isset($product->product_id) ? $product->product_id : '')}}" placeholder="Nhập mã sản phẩm">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label">Giá mua vào*</label>
                                    <div class="col-xs-9">
                                        <input type="text" id="purchase_price" name="purchase_price" class="form-control input-sm" value="{{ old('purchase_price', isset($product->purchase_price) ? $product->purchase_price : '')}}" placeholder="Nhập giá mua vào">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label">Giá bán ra*</label>
                                    <div class="col-xs-9">
                                        <input type="text" id="sale_price" name="sale_price" class="form-control input-sm" value="{{ old('sale_price', isset($product->sale_price) ? $product->sale_price : '')}}" placeholder="Nhập giá bán ra">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-xs-3 control-label">Giá HEAD</label>
                                    <div class="col-xs-9">
                                        <input type="text" id="head_price" name="head_price" class="form-control input-sm" value="{{ old('head_price', isset($product->head_price) ? $product->head_price : '')}}" placeholder="Nhập giá bán của HEAD">
                                    </div>
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="col-xs-offset-3">
                                    <button class="btn btn-primary" type="submit">{{ isset($product) ? 'Cập nhật' : 'Tạo mới' }}</button>
                                    <button class="btn btn-default" type="reset">Làm mới</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </aside>
</div>
@endsection
