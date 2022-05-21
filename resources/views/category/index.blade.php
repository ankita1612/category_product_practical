@extends('layouts.app')

@section('content')
 <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Categories </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('categories.create') }}" title="Create a category"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif  

    @if (count($categories)==0)
         <div class="alert alert-danger" align="center">No record Found.</div>
    @else           

         <table class="table table-bordered table-responsive-lg">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Parent Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $category)
                <tr>
                    <td>{{ $category->name}}</td>
                    <td>
                        @if ($category->parent)
                            {{ $category->parent->name}}
                        @endif
                    </td>
                    <td>
                        <a  href="{{ route('categories.edit',$category->id) }}">
                                <i class="fas fa-edit  fa-lg"></i>
                        </a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display: inline-block;">
                        

                            @method('DELETE')
                            @csrf
                           <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                <i class="fas fa-trash fa-lg text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
        </table>

        {!! $categories->links() !!}
    @endif    

@endsection