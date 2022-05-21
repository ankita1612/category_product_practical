<?php $dash.='-- '; ?>
@foreach($subcategories as $subcategory)
    <option value="{{$subcategory->id}}" @if($selected_id == $subcategory->id) {{ 'selected' }} @endif>{{$dash}}{{$subcategory->name}}</option>
    @if(count($subcategory->subcategory))
        @include('subCategoryList-option',['subcategories' => $subcategory->subcategory])
    @endif
@endforeach