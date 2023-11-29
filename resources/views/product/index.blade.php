@extends('layouts.base')
@section('title', 'Danh sách phụ tùng')
@section('content')
@include('layouts.header')
<div class="wrapper">
    <aside class="right-side strech">
        <section class="content" style="display:block;">
            @include("partials/flash")
            <div class="row" style="display: contents;">
                <div class="col-xs-12">
                    <div class="box box-primary collapsed-box">
                        <div class="box-header">
                            <h4 class="box-title"><i class="fa fa-search"></i> Tìm kiếm phụ tùng linh kiện</h4>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <div id="search-body" class="box-body">
                            <div class="row" style="display: contents;">
                                {{-- search: start --}}
                                <form action="{{ route('post.products.index') }}" class="form-horizontal" method="POST">
                                    @csrf
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <label class="col-xs-3 control-label"> Tên thiết bị</label>
                                            <div class="col-xs-9">
                                                <input type="text" id="name" name="name" value="{{ isset(session()->get('searchParams')['name']) ? session()->get('searchParams')['name'] : ''}}" class="form-control input-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-3">
                                        <div class="form-group">
                                            <button name="search" type="submit" class="btn btn-primary">Tìm kiếm</button>
                                            <a href="{{ route('get.products.index') }}" type="button" class="btn btn-default"> Làm mới</a>
                                        </div>
                                    </div>
                                </form>
                                {{-- search end --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="display: contents;">
                <div class="col-xs-12">
                    <div class="box box-primary">
                        <div class="box-header">
                            <h3 class="box-title">
                                <span class="fa fa-cog"></span> Danh sách phụ tùng linh kiện thiết bị ({{ $paginator->total() }})
                            </h3>
                            <div class="box-tools" style="float: right;">
                                <a href="{{ route('get.products.create') }}" class="btn btn-default"><span class="fa fa-plus"></span> Thêm mới</a>
                            </div>
                        </div>
                        <div class="box-body table-responsive">
                            <table class="table table-bordered table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th class="text-center">
                                            {!! \App\Helpers\Helper::sortable('id', 'Mã hàng hóa') !!}
                                        </th>
                                        <th class="text-center">
                                            {!! \App\Helpers\Helper::sortable('name', 'Tên thiết bị') !!}
                                        </th>
                                        <th class="text-center">
                                            {!! \App\Helpers\Helper::sortable('sale_price', 'Giá bán ra') !!}
                                        </th>
                                        <th class="text-center">
                                            {!! \App\Helpers\Helper::sortable('purchase_price', 'Giá mua vào') !!}
                                        </th>
                                        <th class="text-center">
                                            {!! \App\Helpers\Helper::sortable('head_price', 'Giá bên HEAD') !!}
                                        </th>
                                        <th class="text-center">
                                            {!! \App\Helpers\Helper::sortable('created_at', 'Ngày tạo', 'created_at', 'desc') !!}
                                        </th>
                                        <th class="text-center">Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($paginator as $row)
                                    <tr>
                                        <td>{{ $row->product_id }}</td>
                                        <td>{{ $row->name }}</td>
                                        <td>{{ number_format($row->sale_price) }}</td>
                                        <td>{{ number_format($row->purchase_price) }}</td>
                                        <td>{{ number_format($row->head_price) }}</td>
                                        <td>{{ $row->created_at }}</td>
                                        <td>
                                            <a href="{{ route('get.products.update', $row->id) }}" class="btn btn-primary btn-xs"><span class="fa fa-pen"></span></a>
                                            <a href="{{ route('get.products.delete', $row->id) }}" onclick="return confirm('Bạn có chắn chăn muốn xóa「{{ $row->name }}」không ?');" class="btn btn-primary btn-xs"><span class="fa fa-times"></span></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </aside>
</div>
@endsection
