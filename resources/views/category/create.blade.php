@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Add New Category</h2>
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
    <form role="form" method="post" action="{{ route('categories.store') }}">
        {{csrf_field()}}
        <div class="box-body">
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Category name*</label>
                        <input type="text" name="name" class="form-control" placeholder="Category name" value="{{old('name')}}" required />
                    </div>
                </div>

                

                <div class="col-sm-12">
                    <div class="form-group">
                        <label>Select parent category*</label>
                        <select type="text" name="parent_id" class="form-control">
                            <option value="">None</option>
                            @if($categories)
                                @foreach($categories as $category)
                                    <?php $dash=''; ?>
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @if(count($category->subcategory))
                                        @include('subCategoryList-option',['subcategories' => $category->subcategory,'selected_id'=>''])
                                    @endif
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>

            </div>
        </div>
        <div class="box-footer">
            <button type="submit" class="btn btn-primary">Create</button>

        </div>
    </form>

@endsection