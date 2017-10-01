@extends('layouts.app')

@section('content')

    @include('admin.admin_partials.admin_menu')


    <div class="basic-grey">
<form action="{{ route('products.store') }}" method="post">

    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
        <label>
            <span>Продукт:</span>
            <select class="form-control" name="category_id">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

        </label>
    </div>

    <div class="form-group{{ $errors->has('sub_category_id') ? ' has-error' : '' }}">
        <label>
            <span>Sub Category:</span>
            <select class="form-control" name="sub_category_id">
                <option value="">Select Sub Category</option>
                @foreach($subCategories as $sub_category)
                    <option value="{{ $sub_category->id }}">{{ $sub_category->name }}</option>
                @endforeach
            </select>
        </label>
    </div>

    <div class="form-group{{ $errors->has('identifier') ? ' has-error' : '' }}">
        <label>
            <span>Identifier:</span>
            <select class="form-control" name="identifier">
                <option value="">Select Identifier</option>
                @foreach($subCategories as $sub_category)
                    <option value="{{ $sub_category->identifier }}">{{ $sub_category->identifier }}</option>
                @endforeach
            </select>
        </label>
    </div>


    <label>
        <span>Article id:</span>
        <input type="text" name="description[article_id]" value="" id="admin_product_description" class="label-values"/>
    </label>

    <label>
        <span>Name product:</span>
        <input type="text" name="description[title_product]" value="" id="admin_product_description" class="label-values"/>
    </label>

    <label>
        <span>Product status:</span>
        <input type="text" name="description[product_status]" value="" id="admin_product_description" class="label-values"/>
    </label>

    <span>Product description:</span>
    <label>
        <textarea name="description[general_description]" id="article-ckeditor" ></textarea>
    </label>
<br>
    <label>
        <span>Price:</span>
        <input type="text" name="description[price]" value="" id="admin_product_description" class="label-values"/>
    </label>

    <label>
        <span>Currency:</span>
        <input type="text" name="description[currency]" value="" id="admin_product_description" class="label-values"/>
    </label>

    <label>
        <span>Basic image</span>
        <input type="text" name="description[main_picture_url]" value="" id="admin_product_description" class="label-values"/>
    </label>

    <div class="input_fields_wrap">
        <button class="add_field_button">Add gallery</button>
        <div>
            <label>
                <span>Product gallery:</span>
                <input type="text" name="description[gallery][][picture_url]">
            </label>
        </div>
    </div>

    <div class="specification_fields_wrap">
        <button class="add_spec_field_button">Add specification</button>
        <br>
        <br>
        <div>
            <label>
                <input style="width: 200px" type="text" name="description[properties][][name]" id="admin_product_description" class="label-names">
                <input             type="text" name="description[properties][][text]" id="admin_product_description" class="label-values">
            </label>
        </div>
    </div>

    <div class="actions">
            <input type="submit" name="commit" value="Create Product feature" class="btn btn-default">
        </div>
</form>

    </div>






    <script>
    $(document).ready(function() {
        var max_fields      = 20; //maximum input boxes allowed
        var wrapper         = $(".specification_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_spec_field_button"); //Add button ID
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                        '<div class="fields" ><label>' +
                        '<input style="width: 200px" type="text" name="description[properties][][name]" id="admin_product_description" class="label-names">' +
                        '                     <input type="text" name="description[properties][][text]" id="admin_product_description" class="label-values">' +
                        '<a href="#" class="remove_field">Remove</a>' +
                        '</label></div>'); //add input box
            }
        });
        $(wrapper).on("click", ".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div.fields label').remove(); x--;
        })
    });
    $(document).ready(function() {
        var max_fields      = 5; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append(
                        '<div class="fields" ><label><span>Product galery:</span>' +
                        '<input type="text" name="description[gallery][][picture_url]"/>' +
                        '<a href="#" class="remove_field">Remove</a>' +
                        '</label></div>'); //add input box
            }
        });
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div.fields label').remove(); x--;
        })
    });
</script>

    @include('admin.admin_partials.admin_menu_bottom')
@endsection
