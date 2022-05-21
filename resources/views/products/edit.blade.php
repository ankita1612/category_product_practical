@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                 <a class="btn btn-primary" href="{{ route('products.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update',$product->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Name *</label>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Category *</label>
                    <select type="text" name="category_id" class="form-control">
                                        <option value="">None</option>
                        @if($categories)
                            @foreach($categories as $category)
                                <?php $dash=''; ?>
                                <option value="{{$category->id}}" @if($product->category_id == $category->id) {{ 'selected' }} @endif>{{$category->name}}</option>
                                @if(count($category->subcategory))
                                    @include('subCategoryList-option',['subcategories' => $category->subcategory,'selected_id'=>$product->category_id])
                                @endif
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Description * </label>
                    <textarea class="form-control" style="height:50px" name="description"
                        placeholder="description">{{ $product->description }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <label>Price *</label>
                    <input type="number" name="price" class="form-control" placeholder=""
                        value="{{ $product->price }}">
                </div>
            </div>
        </div>
            <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection