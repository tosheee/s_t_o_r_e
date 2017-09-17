@extends('layouts.app')

@section('content')

    @include('admin.admin_partials.admin_menu')


    <div class="basic-grey">

        <label>
            <span>Категория:</span>
            <select class="form-control" name="category_id">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </label>

        <label>
            <span>Продукт:</span>
            <select class="form-control" name="category_id">
                <option value="">Select Category</option>
                @foreach($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}">{{ $subCategory->name }}</option>
                @endforeach
            </select>
        </label>

        <label>
            <span>Identifier:</span>
            <select class="form-control" name="category_id">
                <option value="">Select Category</option>
                @foreach($subCategories as $subCategory)
                    <option value="{{ $subCategory->id }}">{{ $subCategory->identifier }}</option>
                @endforeach
            </select>
        </label>


        <label>
            <span>Article id:</span>
            <input type="text" name="admin_product[description][aricle_id]" value="" id="admin_product_description" class="label-values"/>
        </label>

        <label>
            <span>Name product:</span>
            <input type="text" name="admin_product[description][code]" value="" id="admin_product_description" class="label-values"/>
        </label>

        <label>
            <span>Product status:</span>
            <input type="text" name="admin_product[description][product_status]" value="" id="admin_product_description" class="label-values"/>
        </label>

        <label>
            <span>Product description</span>
            <input type="text" name="admin_product[description][general_description]" value="" id="admin_product_description" class="label-values"/>
        </label>

        <label>
            <span>Price:</span>
            <input type="text" name="admin_product[description][price]" value="" id="admin_product_description" class="label-values"/>
        </label>

        <label>
            <span>Currency:</span>
            <input type="text" name="admin_product[description][currency]" value="" id="admin_product_description" class="label-values"/>
        </label>

        <label>
            <span>Basic image</span>
            <input type="text" name="admin_product[description][main_picture_url]" value="" id="admin_product_description" class="label-values"/>
        </label>

        <div class="input_fields_wrap">
            <button class="add_field_button">Add gallery</button>
            <div>
                <label>
                    <span>Product galery:</span>
                    <input type="text" name="admin_product[description][gallery][picture][][picture_url]">
                </label>
            </div>
        </div>

        <div class="specification_fields_wrap">
            <button class="add_spec_field_button">Add specification</button>
            <div>
                <label>
                    <input style="width: 200px" type="text" name="admin_product[description][properties][property][][name]" id="admin_product_description" class="label-names">
                    <input type="text" name="admin_product[description][properties][property][][text]" id="admin_product_description" class="label-values">
                </label>
            </div>
        </div>

        <div class="actions">
        </div>


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
                        '<input style="width: 200px" type="text" name="admin_product[description][properties][property][][name]" id="admin_product_description" class="label-names">' +
                        '  <input type="text" name="admin_product[description][properties][property][][text]" id="admin_product_description" class="label-values">' +
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
                        '<input type="text" name="admin_product[description][gallery][picture][][picture_url]"/>' +
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
