@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    Edit Category
                    <a href="{{ route('categories.create') }}" class="btn btn-primary float-right">Create category</a>
                </div>

                <div class="card-body">
                    
                     <?php /*@include('partials.alerts')  */?>

                    <form action="{{ route('categories.update', ['category'=>$category_data->id] ) }}" method="post">
                        {{ csrf_field() }}
                        <input name="_method" type="hidden" value="PUT">
                        <div class="form-group">
                            <label for="name">Category Name:</label>
                            <input type="name" class="form-control" id="name" name="name" value="{{ $category_data->name }}">
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        </div>
                        <div class="form-group">
                            <label for="pwd">Parent Category:</label>
                            <select type="text" name="parent_id" class="form-control">
                                        <option value="">None</option>
                                        @if($categories)
                                            @foreach($categories as $category)
                                                <?php $dash=''; ?>
                                                <option value="{{$category->id}}" @if($category_data->parent_id == $category->id) {{ 'selected' }} @endif>{{$category->name}}</option>
                                                @if(count($category->subcategory))
                                                    @include('subCategoryList-option',['subcategories' => $category->subcategory,'selected_id'=>$category_data->parent_id])
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                            <span class="text-danger">{{ $errors->first('parent_category') }}</span>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection