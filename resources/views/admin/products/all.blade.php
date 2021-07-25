@extends('admin.admin_master')

@section('admin')
    <div class="row" dir="rtl">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">جدول محصولات</h3>


                    <div class="card-tools d-flex">
                        <form action="">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="search" class="form-control float-right" placeholder="جستجو"
                                       value="{{ request('search') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                        <div class="btn-group-sm mr-1">

                            @can('create-product')
                                <a href="{{ route('products.create') }}" class="btn btn-info">ایجاد محصول جدید</a>
                            @endcan

                        </div>
                    </div>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>آیدی محصول</th>
                            <th>نام محصول</th>
                            <th> توضیحات</th>
                            <th> قیمت</th>
                            <th>تعداد موجودی</th>
{{--                            <th>تعداد نظرات</th>--}}
                            <th>تعداد بازدید</th>
                            <th>اقدامات</th>
                        </tr>

                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->title }}</td>
                                <td>{{ $product->description }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->inventory }}</td>
                                <td>{{ $product->view_count }}</td>


                                <td class="d-flex">

                                    @can('delete-product')
                                        <form action="{{route('products.destroy',$product->id)}}" method="post">
                                            @csrf
                                            @method('Delete')
                                            <button type="submit" class=" btn btn-sm btn-danger mx-1">حذف</button>
                                        </form>

                                    @endcan

                                    @can('edit-products')
                                        <a href="{{ route('products.edit' ,$product->id) }}"
                                           class="btn btn-sm btn-primary">ویرایش</a>

                                    @endcan
                                        <a href="{{ route('products.gallery.index' , ['product' => $product->id ]) }}" class="btn btn-sm btn-warning mx-2">گالری تصاویر</a>


                                </td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{$products->appends(['search'=>request('search')])->render()}}
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>

@endsection
