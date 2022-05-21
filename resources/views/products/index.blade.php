@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products </h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('products.create') }}" title="Create a product"> <i class="fas fa-plus-circle"></i>
                    </a>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    @if (count($products)==0)
         <div class="alert alert-danger" align="center">No record Found.</div>
    @else
        <table class="table table-bordered table-responsive-lg">
            <tr>
                <th>Name</th>
                <th>Category Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->name}}</td>
                    <td>{{$product->category->name}}</td>                
                    <td>{{$product->description}}</td>
                    
                    <td>
                        <form action="" method="POST">                       
                            <a  href="{{ route('products.edit',$product->id) }}">
                                <i class="fas fa-edit  fa-lg"></i>
                            </a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" title="delete" style="border: none; background-color:transparent;">
                                <i class="fas fa-trash fa-lg text-danger"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </table>

        {!! $products->links() !!}
    @endif

@endsection