
    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
        <!-- first Panel start Here -->

        <?php $heading = array('0' => 'One', '1' => 'Two', '2' => 'Three', '3' => 'Four', '4' => 'Five', '5' => 'Six', '6' => 'Seven' ) ?>

        @foreach($categoriesButtonsName as $key => $categoryButtonsName)
            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading{{$heading[$key]}}">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse{{$heading[$key]}}" aria-expanded="true" aria-controls="collapse{{$heading[$key]}}" class="collapsed">
                           {{ $categoryButtonsName->name }}  <span class="glyphicon glyphicon-plus pull-right" aria-hidden="true"></span>
                        </a>
                    </h4>
                </div>

                <div id="collapse{{$heading[$key]}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading{{$heading[$key]}}" aria-expanded="true" style="height: 0px;">
                    <div class="panel-body">
                        <div class="list-group">
                            @foreach($subCategoriesButtonsName as $subCategoryButtonsName)
                                @if ($subCategoryButtonsName->category_id == $categoryButtonsName->id)
                                    <div class="checkbox">
                                        <label><input type="checkbox" value="">{{ $subCategoryButtonsName->name }}</label>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <!-- List Group End Here -->
                    </div>
                </div>
            </div>         <!-- first Panel End Here -->
        @endforeach
    </div><!-- /.sidebar column end here -->
        