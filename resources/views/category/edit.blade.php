@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Category</h2>
            </div>
            <div class="pull-right">
                 <a class="btn btn-primary" href="{{ route('categories.index') }}" title="Go back"> <i class="fas fa-backward "></i> </a>
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

        <form action="{{ route('categories.update', ['category'=>$category_data->id] ) }}" method="post">
            {{ csrf_field() }}
            <input name="_method" type="hidden" value="PUT">
            <div class="form-group">
                <label for="name">Category Name *</label>
                <input type="name" class="form-control" id="name" name="name" value="{{ $category_data->name }}">
                <span class="text-danger">{{ $errors->first('name') }}</span>
            </div>
            <div class="form-group">
                <label for="pwd">Parent Category *</label>
                <select type="text" name="category_id" class="form-control">
                            <option value="">None</option>
                            @if($categories)
                                @foreach($categories as $category)
                                    <?php $dash=''; ?>
                                    <option value="{{$category->id}}" @if($category_data->category_id == $category->id) {{ 'selected' }} @endif>{{$category->name}}</option>
                                    @if(count($category->subcategory))
                                        @include('subCategoryList-option',['subcategories' => $category->subcategory,'selected_id'=>$category_data->category_id])
                                    @endif
                                @endforeach
                            @endif
                        </select>
                <span class="text-danger">{{ $errors->first('parent_category') }}</span>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
               
@endsection