@extends('layouts.app')

@section('content')
@include('admin.admin_partials.admin_menu')


    <div class="basic-grey">
        <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">

            {{ csrf_field() }}

            <div class="form-group{{ $errors->has('category_id') ? ' has-error' : '' }}">
                <label>
                    <span>Category:</span>
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
                Available: <input type="radio" name="description[product_status]" value="наличен" checked>
                Order: <input type="radio" name="description[product_status]" value="по поръчка">
                Not available: <input type="radio" name="description[product_status]" value="не наличен">
            </label>

            <label>
                <span>Price:</span>
                <input type="text" name="description[price]" value="" id="admin_product_description" class="label-values"/>
            </label>

            <label>
                BGN: <input type="radio" name="description[currency]" value="лв." checked>
                EUR: <input type="radio" name="description[currency]" value="euro">
                USD: <input type="radio" name="description[currency]" value="usd">
            </label>
           <br>

            <span>Product description:</span>
            <label>
                <textarea name="description[general_description]" id="article-ckeditor" ></textarea>
            </label>

            <br>

            <div class="basic-img-wrap">
                <button class="upload-basic-img-butt btn btn-info btn-xs">Upload Basic Image </button>
                <button class="field-basic-img-butt btn btn-warning btn-xs">Add field Basic Image</button>
                <br>
                <br>
            </div>

            <div class="input_fields_wrap">
                <button class="upload-img-gallery-button btn btn-info btn-xs">Add upload form </button>
                <button class="field-img-gallery-button btn btn-warning btn-xs">Add field form</button>
                <br>
                <br>
            </div>

            <div class="specification_fields_wrap">
                <button class="add_spec_field_button btn-primary btn-xs">Add specification</button>
                <br>
                <br>
            </div>


            <div class="actions">
                <input type="submit" name="commit" value="Create Product" class="btn btn-success">
            </div>

        </form>
    </div>


    <script>

        //basic image
        $(document).ready(function() {
            var max_fields = 2;
            var wrapper    = $(".basic-img-wrap");
            var button_upload_basic_img = $(".upload-basic-img-butt");
            var button_url_basic_img    = $(".field-basic-img-butt");
            var x = 1;
            $(button_url_basic_img).click(function(e){
                e.preventDefault();
                if(x < max_fields){
                    x++;
                    $(wrapper).append('<div class="url-basic-image-field" ><label><span>Url Basic Image:</span>' +
                    '<input type="text" name="description[main_picture_url]" value="" id="admin_product_description" class="label-values"/>' +
                    '<a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                    '</label></div>');
                }
            });
            $(wrapper).on("click", ".remove_field", function(e){
                e.preventDefault(); $(this).parent('div.url-basic-image-field label').remove(); x--;
            });

            $(button_upload_basic_img).click(function(e){
                e.preventDefault();
                if(x < max_fields){
                    x++;
                    $(wrapper).append('<div class="upload-basic-img-wrapp">' +
                                        '<input type="file" name="upload_main_picture" class="label-values"/>' +
                                        '<a href="#" class="remove-img-upload-button">' +
                                        '<i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                                        '</div>');
                }
            });
            $(wrapper).on("click", ".remove-img-upload-button", function(e){
                e.preventDefault(); $(this).parent('div.upload-basic-img-wrapp').remove(); x--;
            });
        });

       // gallery images
        $(document).ready(function() {
            var max_fields = 6;
            var wrapper    = $(".input_fields_wrap");
            var upload_img_gallery_button = $(".upload-img-gallery-button");
            var field_img_gallery_button  = $(".field-img-gallery-button");
            var x = 1;

            $(field_img_gallery_button).click(function(e){
                e.preventDefault();
                if(x < max_fields){
                    x++;
                    $(wrapper).append(
                            '<div class="fields" ><label><span>Product galery:</span>' +
                            '<input type="text" name="description[gallery][][picture_url]"/>' +
                            '<a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                            '</label></div>');
                }
            });
            $(wrapper).on("click",".remove_field", function(e){
                e.preventDefault(); $(this).parent('div.fields label').remove(); x--;
            });

            $(upload_img_gallery_button).click(function(e){
                e.preventDefault();
                if(x < max_fields){
                    x++;
                    $(wrapper).append('<div class="upload-img-gallery-button">' +
                    '<input type="file" name="upload_gallery_pictures[]" class="label-values"/>' +
                    '<a href="#" class="remove-img-gallery-button">' +
                    '<i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                    '</div>');
                }
            });
            $(wrapper).on("click",".remove-img-gallery-button", function(e){
                e.preventDefault(); $(this).parent('div.upload-img-gallery-button').remove(); x--;
            });
        });


        // specification

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
                            '<a href="#" class="remove_field"><i style="color: red;" aria-hidden="true" id="chang-menu-icon" class="fa fa-times"></i></a>' +
                            '</label></div>'); //add input box
                }
            });
            $(wrapper).on("click", ".remove_field", function(e){ //user click on remove text
                e.preventDefault(); $(this).parent('div.fields label').remove(); x--;
            });
        });

    </script>

@include('admin.admin_partials.admin_menu_bottom')
@endsection
