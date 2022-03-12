<div class="card-header mb-4"><div class="card-title">Product Info</div></div>
<div class="col-lg-6  col-lg-offset-6">
        <div class="form-group">
            {{Form::label('prd_type','Product Type',['class'=>''])}} <span class="text-red">*</span>
            {{Form::select('prd_type',$prdTypes,$prdType,['id'=>'prd_type','class'=>'form-control'])}}
            <span class="error"></span>
        </div>
    </div>

 <?php if($prdType !="") { if($prdType ==1) { $simple_prod = "display:block;"; $var_prod = "display:none;"; }else {  $simple_prod = "display:none;"; $var_prod = "display:block;"; } }else { $simple_prod = "display:block;"; $var_prod = "display:none;"; }  ?>

     <div class="row panel-body1 tabs-menu-body1 simple_prod" style="<?php echo $simple_prod; ?>">     
        <div class="tab-content col-12">
     <div class="card-header mb-4"><div class="card-title">Price & Tax</div></div>       
     <div class="clearfix"></div>   
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('price','Price',['class'=>''])}}
            {{Form::number('price[price]',$price,['id'=>'price', 'class'=>'form-control','placeholder'=>'price','max'=>9999999999])}}
            <span class="error"></span>
        </div>
    </div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('sale_price','Sale Price',['class'=>''])}}
            {{Form::number('price[sale_price]',$sPrice,['id'=>'sale_price','class'=>'form-control ','placeholder'=>'Sale Price','max'=>9999999999])}}
            <span class="error"></span>
        </div>
    </div> 
    <div class="clearfix"></div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('sale_start_date','Sale From Date',['class'=>''])}}
            <div   class=" input-group " >
            <input class="form-control datepicker sale_start_date" id="sale_start_date" name="price[sale_start_date]" type="text" readonly value="{{$stDate}}" placeholder="Start Date" data-date-format="yyyy-mm-dd" />
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
															
            <span class="error"></span>
        </div>
    </div> 
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('sale_end_date','Sale To Date',['class'=>''])}}
           
            <div   class=" input-group " >
            <input class="form-control datepicker sale_end_date" id="sale_end_date" name="price[sale_end_date]" type="text" readonly value="{{$edDate}}" placeholder="End Date" data-date-format="yyyy-mm-dd" />
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            </div>
            
            <span class="error"></span>
        </div>
    </div> 
    <div class="clearfix"></div>
    <div class="col-lg-6 fl">
        <div class="form-group">
            {{Form::label('tax','Tax',['class'=>''])}}
            {{Form::select('price[tax]',$taxes,$taxId,['id'=>'tax','class'=>'form-control','placeholder'=>'Select Tax'])}}
            <span class="error"></span>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="tab-content col-12">
     <div class="card-header mb-4"><div class="card-title">Shipping</div></div>       
     <div class="clearfix"></div>   
    <div class="col-lg-4 fl">
        <div class="form-group">
            {{Form::label('weight','Weight (kg)',['class'=>''])}}
            {{Form::number('dimension[weight]',$weight,['id'=>'weight', 'class'=>'form-control','placeholder'=>'Weight','max'=>9999999999])}}
            <span class="error"></span>
        </div>
    </div>
    <div class="col-lg-8 fl">
        <div class="form-group">
            {{Form::label('dimensions','Dimensions (cm)',['class'=>''])}}
            <div class="tab-content">
                <div class="col-lg-4 fl">
                <div class="form-group">
                
                {{Form::number('dimension[length]',$length,['id'=>'length', 'class'=>'form-control','placeholder'=>'Length','max'=>9999999999])}}
                <span class="error"></span>
                </div>
                </div>
                
                <div class="col-lg-4 fl">
                <div class="form-group">
                
                {{Form::number('dimension[width]',$width,['id'=>'width', 'class'=>'form-control','placeholder'=>'Width','max'=>9999999999])}}
                <span class="error"></span>
                </div>
                </div>
                <div class="col-lg-4 fl">
                <div class="form-group">
                
                {{Form::number('dimension[height]',$height,['id'=>'height', 'class'=>'form-control','placeholder'=>'Height','max'=>9999999999])}}
                <span class="error"></span>
                </div>
                </div>
            </div>    
     </div>
    </div> 
    
</div>
</div>
                <div class="row panel-body tabs-menu-body variable_prod attr_list" style="<?php echo $var_prod; ?>">
                <div class="tab-content col-12">
                <div class="tab-pane active " id="tab1">
                <div class="card-header mb-4"><div class="card-title">Attribute Details</div></div>
                <div class="row">
                        <div class="col-lg-7 col-lg-pull-5 fl prod_attr_1 tabs-menu-body">

                            <div>
                                <div class="form-group">
                                {{Form::label('attr_name','Attribute Name',['class'=>''])}} 
                                {{Form::text('attr_1[attr_name]',$attr_1_name,['id'=>'attr_name_1','class'=>'form-control attr_name','placeholder'=>'Attribute Name'])}}
                                <span class="error fl" id="attribute_1_name"></span>
                                </div>
                        
                                <div class="clr"></div>

                                    <div id="attr-val-content-1" > 

                                         <?php if($attr_1_value !=""){ $ar1_id = 0; foreach ($attr_1_value as $att1_k => $att1_v) {
                                            
                                        ?>  

                                            <div id="attr-val-row-<?php echo $ar1_id; ?>" class="attr_val_row_id">
                                            <div class="col-lg-6 tofix mb-2 fl">

                                            <div class="mb-1">
                                                {{form::label('attr_val_id','Options',['class'=>'m-0'])}}
                                                {{Form::text("attr_1_value[$att1_k][]",$att1_v[0],['id'=>'attr_val_id','class'=>'form-control attr_value required','placeholder'=>'Enter Variation Options, eg: Red, etc.','data-val'=>"$att1_k"])}}
                                            <span class="error"></span>
                                            </div>
                                            </div>
                                            <?php if($attr_1_img !=""){
                                                $var_p = 'attr1_'.$ar1_id;
                                                $attr1_img = $attr_1_img->$var_p;
                                                 }else {
                                                   $attr1_img = ""; 
                                                 }
                                                if($attr1_img !=""){
                                             ?> 
                                             <div class="col-4 pl-0 mb-2 fl">
                                            <div class="custom-file">
                                                {{form::label('attr_img','Image',['class'=>'m-0'])}}
                                                <input type="file" class="attr_img" id="attr_img" name="attr_1_img[attr1_<?php echo $ar1_id; ?>][]" >
                                                <input type="hidden" name="attr_1_img[attr1_<?php echo $ar1_id; ?>][]" value="{{ $attr1_img }}">
                                               
                                            </div>
                                            </div>
                                            <div class="col-1 pl-0 mt-5 fl">
                                            <div class="clr"></div>
                                            <img src="{{ config('app.storage_url').$attr1_img }}" width="30px;" />
                                            </div>
                                             <?php  }else { ?>
                                            <div class="col-5 pl-0 mb-2 fl">
                                            <div class="custom-file">
                                            {{form::label('attr_img','Image',['class'=>'m-0'])}}
                                            <input type="file" class="attr_img" id="attr_img" name="attr_1_img[attr1_<?php echo $ar1_id; ?>][]">

                                            </div>
                                            </div>
                                              <?php } ?>
                                            

                                            <div class="col-1 pl-0 mb-2 fl">
                                            <div class="clr"></div>
                                            <a id="del_val_<?php echo $ar1_id; ?>" class="del_val del"><i class="fa fa-trash"></I></a>
                                            </div>
                                            <div class="clr"></div>
                                            </div>
                                        <?php  ++$ar1_id; } }else { $ar1_id = 0;  ?>

                                            <div class="col-lg-6 mb-2 fl tofix">
                                           
                                                    <div class=" mb-1">

                                                    {{form::label('attr_val_id','Options',['class'=>'m-0'])}}
                                                    {{Form::text("attr_1_value[attr1_$ar1_id][]","",['id'=>'attr_val_id','class'=>'form-control attr_value required','placeholder'=>'Enter Variation Options, eg: Red, etc.','data-val'=>"attr1_$ar1_id"])}}
                                                    <span class="error"></span>
                                                    </div>

                                            </div>
                                            <div class="col-5 pl-0 mb-2 fl">
                                            <div class="custom-file">
                                                {{form::label('attr_img','Image',['class'=>'m-0'])}}
                                                <input type="file" class="attr_img" id="attr_img" name="attr_1_img[attr1_0][]">
                                               
                                            </div>
                                            </div>
                                  
                                            <div class="col-1 pl-0 mb-2 fl">
                                            <div class="clr"></div>
                                            <a id="del_val_id" class="del_val del"><i class="fa fa-trash"></I></a>
                                            </div>
                                            <div class="clr"></div>

                                           <?php } ?>

                                    </div>  
                                    <div class="clr"></div>
                                    <div class="col-12 text-right">
                                    <button id="add_val" class="mt-4 mb-4 btn btn-info btn-sm" <?php if($ar1_id>4){ ?> style="display: none;" <?php } ?> type="button"><i class="fa fa-plus mr-1"></i>Add</button>
                                    <div class="clr"></div>
                                    <span class="error fl" id="attribute_1_value"></span>
                                    </div>
                                </div>
                        </div>
                       <div class="col-lg-7 col-lg-pull-5 fl prod_attr_2 tabs-menu-body">
                                <a  class="btn btn-outline-primary variation " <?php if($attr_2_name !=""){ echo 'style="display:none;"'; }else { echo 'style="display:block;"'; } ?>><i class="fa fa-plus mr-2"></i>Add Attribute</a>

                            <div class="attr_content" <?php if($attr_2_name !=""){ echo 'style="display:block;"'; }else { echo 'style="display:none;"'; } ?>>
                                <a id="delete_existing"  class="delete_existing"><i class="ion-close-circled"></I></a>
                                <div class="form-group">
                                {{Form::label('attr_name','Attribute Name',['class'=>''])}} 
                                {{Form::text('attr_2[attr_name]',$attr_2_name,['id'=>'attr_name_2','class'=>'form-control attr_name','placeholder'=>'Attribute Name'])}}
                                <span class="error fl" id="attribute_2_name"></span>
                                </div>
                        
                                <div class="clr"></div>

                                    <div id="attr-val-content-2" > 

                                         <?php if($attr_2_value !=""){ $ar2_id = 0; foreach ($attr_2_value as $att2_k => $att2_v) {
                                            
                                        ?>  

                                            <div id="attr-val-row-<?php echo $ar2_id; ?>" class="attr_val_row_id">
                                            <div class="col-lg-6 tofix mb-2 fl">

                                            <div class="mb-1">
                                                {{form::label('attr_val_id','Options',['class'=>'m-0'])}}
                                                {{Form::text("attr_2_value[$att2_k][]",$att2_v[0],['id'=>'attr_val_id','class'=>'form-control attr_value required','placeholder'=>'Enter Variation Options, eg: Red, etc.','data-val'=>"$att2_k"])}}
                                            <span class="error"></span>
                                            </div>
                                            </div>

                                            <?php if($attr_2_img !=""){
                                            $var_p = 'attr2_'.$ar2_id;
                                            $attr2_img = $attr_2_img->$var_p;
                                            }else {  $attr2_img = ""; }
                                            if($attr2_img !=""){
                                            ?> 
                                            <div class="col-4 pl-0 mb-2 fl">
                                            <div class="custom-file">
                                            {{form::label('attr_img','Image',['class'=>'m-0'])}}
                                            <input type="file" class="attr_img" id="attr_img" name="attr_2_img[attr2_<?php echo $ar2_id; ?>][]" >
                                            <input type="hidden" name="attr_2_img[attr2_<?php echo $ar2_id; ?>][]" value="{{ $attr2_img }}">

                                            </div>
                                            </div>
                                            <div class="col-1 pl-0 mt-5 fl">
                                            <div class="clr"></div>
                                            <img src="{{ config('app.storage_url').$attr2_img }}" width="30px;" />
                                            </div>
                                            <?php }else { ?>
                                                <div class="col-5 pl-0 mb-2 fl">
                                            <div class="custom-file">
                                                {{form::label('attr_img','Image',['class'=>'m-0'])}}
                                                <input type="file" class="attr_img" id="attr_img" name="attr_2_img[attr2_<?php echo $ar2_id; ?>][]">
                                               
                                            </div>
                                            </div>

                                            <?php } ?>

                                            
                                            <div class="col-1 pl-0 mb-2 fl">
                                            <div class="clr"></div>
                                            <a id="del_val_<?php echo $ar2_id; ?>" class="del_val del"><i class="fa fa-trash"></I></a>
                                            </div>
                                            <div class="clr"></div>
                                            </div>
                                        <?php  ++$ar2_id; } }else { $ar2_id = 0; ?>


                                             <div class="col-lg-6 mb-2 fl tofix">
                                           
                                                    <div class=" mb-1">

                                                    {{form::label('attr_val_id','Options',['class'=>'m-0'])}}
                                                    {{Form::text("attr_2_value[attr2_$ar2_id][]","",['id'=>'attr_val_id','class'=>'form-control attr_value required','placeholder'=>'Enter Variation Options, eg: Red, etc.','data-val'=>"attr2_$ar2_id"])}}
                                                    <span class="error"></span>
                                                    </div>

                                            </div>
                                            <div class="col-5 pl-0 mb-2 fl">
                                            <div class="custom-file">
                                                {{form::label('attr_img','Image',['class'=>'m-0'])}}
                                                <input type="file" class="attr_img" id="attr_img" name="attr_2_img[attr2_0][]">
                                               
                                            </div>
                                            </div>
                                  
                                            <div class="col-1 pl-0 mb-2 fl">
                                            <div class="clr"></div>
                                            <a id="del_val_id" class="del_val del"><i class="fa fa-trash"></I></a>
                                            </div>
                                            <div class="clr"></div>

                                        <?php } ?>

                                    </div>  
                                    <div class="clr"></div>
                                    <div class="col-12 text-right">
                                    <button id="add_var_2" class="mt-4 mb-4 btn btn-info btn-sm" <?php if($ar2_id>4){ ?> style="display: none;" <?php } ?> type="button"><i class="fa fa-plus mr-1"></i>Add</button>
                                    <div class="clr"></div>
                                    <span class="error fl" id="attribute_2_value"></span>
                                    </div>
                                </div>
                        </div>
            
                        </div>    <!--  row ends -->
                     </div> <!--  tab1 ends -->


                </div><!--  tab content ends -->
                </div>   <!--  panel body ends -->       


<div id="adnl_rows" class="d-none">
    <div id="attr_val_row_id" class="attr_val_row_id">
                <div class="col-lg-6 tofix mb-2 fl">
                   
                        <div class="mb-1">
                            {{form::label('attr_val_id','Options',['class'=>'m-0'])}}
                            {{Form::text('value[val][]','',['id'=>'attr_val_id','class'=>'form-control attr_value required','placeholder'=>'Enter Variation Options, eg: Red, etc.','data-val'=>'attr1_0'])}}
                            <span class="error"></span>
                        </div>
                 
                   
                </div>
                <div class="col-5 pl-0 mb-2 fl">
                <div class="custom-file">
                {{form::label('attr_img','Image',['class'=>'m-0'])}}
                <input type="file" class="attr_img" id="attr_img" name="attr_0_img">

                </div>
                </div>
                <div class="col-1 pl-0 mb-2 fl">
                    <div class="clr"></div>
                    <a id="del_val_id" class="del_val del"><i class="fa fa-trash"></I></a>
                </div>
                <div class="clr"></div>
    </div>
</div>     


<div id="add_modal" class="d-none">
               

        <div class="modal fade tochange" role="dialog" tabindex="-1" id="modal_row_id">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title">Shipping</h5>
        <button type="button" class="close" data-dismiss="modal">
        <span aria-hidden="true">×</span>
        </button>
        </div>
        <div class="modal-body">
        <div class="tab-content col-12">
        <div class="card-header mb-4"><div class="card-title">Shipping</div></div>       
        <div class="clearfix"></div>   
        <div class="col-lg-4 fl">
        <div class="form-group">
        {{Form::label('mweight','Weight (kg)',['class'=>''])}}
        {{Form::number('mdimension[weight]','',['id'=>'mweight', 'class'=>'form-control','placeholder'=>'Weight','max'=>9999999999])}}
        <span class="error"></span>
        </div>
        </div>
        <div class="col-lg-8 fl">
        <div class="form-group">
        {{Form::label('mdimensions','Dimensions (cm)',['class'=>''])}}
        <div class="tab-content">
        <div class="col-lg-4 fl">
        <div class="form-group">

        {{Form::number('mdimension[length]','',['id'=>'mlength', 'class'=>'form-control','placeholder'=>'Length','max'=>9999999999])}}
        <span class="error"></span>
        </div>
        </div>

        <div class="col-lg-4 fl">
        <div class="form-group">

        {{Form::number('mdimension[width]','',['id'=>'mwidth', 'class'=>'form-control','placeholder'=>'Width','max'=>9999999999])}}
        <span class="error"></span>
        </div>
        </div>
        <div class="col-lg-4 fl">
        <div class="form-group">

        {{Form::number('mdimension[height]','',['id'=>'mheight', 'class'=>'form-control','placeholder'=>'Height','max'=>9999999999])}}
        <span class="error"></span>
        </div>
        </div>
        </div>    
        </div>
        </div> 

        </div>
        <div class="py-1">
        <div class="row">
        <div class="col d-flex justify-content-end">
        <input type="button" class="btn btn-primary mr-6" data-dismiss="modal" value="Save">
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>
        </div>

 
</div>  

<table class="variation_table_hid table" id="hidden_table" style="display: none;">
</table>

<div class="row panel-body tabs-menu-body variable_prod" style="<?php echo $var_prod; ?>">
                <div class="tab-content col-12">
                <div class="tab-pane active " id="tab1">
                <div class="card-header mb-4"><div class="card-title">Variation List</div></div>
                <div class="row">

                     <div class="variation_table_div table-responsive tabs-menu-body">


                        <table class="variation_table table" id="variation_table">
                            <thead>
                                <tr>
                                    <?php if($attr_1_name !=""){ ?> <th class="text-center init_name"><?php echo $attr_1_name; ?></th> <?php }else { ?> 
                                     <th class="text-center init_name">Name</th>
                                 <?php } ?>
                                 <?php if($attr_2_name !=""){ ?> <th class="text-center init_name"><?php echo $attr_2_name; ?></th> <?php } ?>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Stock</th>
                                    <th class="text-center">SKU</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  


               if(isset($attr_stock) && $attr_stock !=""  )
                {


                foreach($attr_stock as $dyk=>$dyv){
              
                if(is_array($dyv)) {
                    $at_2 = 0;
                    foreach($dyv as $dyk2=>$dyv2){
                         $at_2++;
                     
                    ?>

                   <tr>
                   <?php if($at_2 ==1){ ?> <td class="text-center init_value" rowspan="<?php echo count($dyv) ?>"><input class="form-control" placeholder="Option" value="<?php echo $attr_1_value->$dyk[0]; ?>" readonly="true" type="text"></td> <?php } ?>
                    <td class="text-center"><input class="form-control" placeholder="Option" value="<?php echo $attr_2_value->$dyk2[0]; ?>" type="text"></td>
                    <td class="text-center"><input class="form-control price_field" name="price[<?php echo $dyk; ?>][<?php echo $dyk2; ?>]" placeholder="Price" value="<?php echo $attr_price[$dyk][$dyk2]; ?>" type="text"></td>
                    <td class="text-center"><input class="form-control stock_field" name="stock[<?php echo $dyk; ?>][<?php echo $dyk2; ?>]" placeholder="Stock" value="<?php echo $attr_stock[$dyk][$dyk2]; ?>" type="text"></td>
                    <td class="text-center"><input class="form-control sku_field" name="sku[<?php echo $dyk; ?>][<?php echo $dyk2; ?>]" placeholder="SKU" value="<?php echo $attr_sku[$dyk][$dyk2]; ?>" type="text"></td>
                    </tr>

              <?php } }else { ?>
                    <tr>
                     <td class="text-center init_value" ><input class="form-control" placeholder="Option" value="<?php echo $attr_1_value->$dyk[0]; ?>" readonly="true" type="text"></td> 
                    
                    <td class="text-center"><input class="form-control" placeholder="Price" name="price[<?php echo $dyk; ?>]" value="<?php echo $attr_price[$dyk]; ?>" type="text"></td>
                    <td class="text-center"><input class="form-control" placeholder="Stock" name="stock[<?php echo $dyk; ?>]" value="<?php echo $attr_stock[$dyk]; ?>" type="text"></td>
                    <td class="text-center"><input class="form-control" placeholder="SKU" name="sku[<?php echo $dyk; ?>]" value="<?php echo $attr_sku[$dyk]; ?>" type="text"></td>
                    </tr>

                <?php }
                }
                }else { ?>

                                <tr>
                                    <td class="text-center init_value"><input class="form-control" placeholder="Option" readonly="true" type="text"></td>
                                    <td class="text-center"><input class="form-control" placeholder="Price" type="text"></td>
                                    <td class="text-center"><input class="form-control" placeholder="Stock" type="text"></td>
                                    <td class="text-center"><input class="form-control" placeholder="SKU" type="text"></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                            
                        </table>

                    </div>
                        
                        </div>    <!--  row ends -->
                     </div> <!--  tab1 ends -->


                </div><!--  tab content ends -->
                </div>   <!--  panel body ends -->          


<!-- Existing Dimensions -->
 
 <?php if($attr_weight !="" || $attr_length !="" || $attr_width !="" || $attr_height !=""){     ?>

            <?php  
            if(isset($attr_stock) && $attr_stock !=""  )
            {
            foreach($attr_stock as $dyk=>$dyv){
            if(is_array($dyv)) {
            $at_2 = 0;
                foreach($dyv as $dyk2=>$dyv2){
                $at_2++;
               
                if($attr_weight && isset($attr_weight[$dyk][$dyk2])) { $atr_weight = $attr_weight[$dyk][$dyk2]; }else { $atr_weight =''; }
                if($attr_length && isset($attr_length[$dyk][$dyk2])) { $atr_length = $attr_length[$dyk][$dyk2]; }else { $atr_length =''; }
                if($attr_width && isset($attr_width[$dyk][$dyk2])) { $atr_width = $attr_width[$dyk][$dyk2]; }else { $atr_width =''; }
                if($attr_height && isset($attr_height[$dyk][$dyk2])) { $atr_height = $attr_height[$dyk][$dyk2]; }else { $atr_height =''; }
                
                
                
                
                $row = "$dyk$dyk2";
                $row_name = "[$dyk][$dyk2]";
                ?>
                @include('admin.seller_product.details.shipping')
                <?php 
                 } 
            }else { 
              
               if($attr_weight) { $atr_weight = $attr_weight[$dyk]; }else { $atr_weight =''; }
                if($attr_length) { $atr_length = $attr_length[$dyk]; }else { $atr_length =''; }
                if($attr_width) { $atr_width = $attr_width[$dyk]; }else { $atr_width =''; }
                if($attr_height) {  $atr_height = $attr_height[$dyk]; }else { $atr_height =''; }
                
                
                
                
                
                $row = "$dyk";
                $row_name = "[$dyk]";
                ?>
                @include('admin.seller_product.details.shipping')
                <?php 
              }
            }
            } ?>

<?php } ?>

<!-- Existing Dimensions -->




<style type="text/css">
    .prod_attr_2 .attr_content{
        margin-top: 20px;
    }
    .prod_attr_2 {
          margin-top: 20px;
    }
    a.variation {
        margin: auto;
        display: block;
        text-align: center;
    }
    .delete_existing {
    position: absolute;
    right: 30px;
    border: 1px solid white;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    background: white;
    top: 5px;
    cursor: pointer;
}
.delete_existing i {
    display: block;
    text-align: center;
    margin: auto;
    padding-top: 15px;
    font-size: 20px;
    color: #f00;
    }
    .del_val i {
        font-size: 18px;
        margin-top: 30px;
    }
    .attr_name {
            max-width: 470px;
    margin-left: 10px;
    }
    .attr_img {
        padding: 3px;
    }
</style>
<script type="text/javascript">
    $(document).ready(function(){
        $("#variation_table input").trigger("input");
         build_table();
    });
    
     $(document).ready(function(){
           $(".datepicker").datepicker({ 
        autoclose: true, 
        todayHighlight: true,
       startDate: new Date()
  }).datepicker(); 
  
         var st_date = $("#sale_start_date").val();
         var en_date = $("#sale_end_date").val();
         console.log("st_date"+st_date);
         if(st_date){
           $('#sale_start_date').datepicker('startDate',new Date(st_date));  
         }else {
           $('#sale_start_date').datepicker("update", new Date());  
         }
         if(en_date){
           $('#sale_end_date').datepicker('startDate',new Date(en_date));  
         }else{
           $('#sale_end_date').datepicker("update", new Date());   
         }
      
  
        $('body').on('change','.sale_start_date,.sale_end_date',function(){
        var sdate=$("#sale_start_date").val();
        var tdate=$("#sale_end_date").val();
        
        // $('#sale_start_date').datepicker('setStartDate',new Date(sdate));
        if(sdate && tdate)
        {
        var d1 = Date.parse(sdate);
        var d2 = Date.parse(tdate);
        if (d1 > d2) 
        {
        $("#sale_end_date").val(sdate);
        $('#sale_end_date').datepicker('setStartDate',new Date(sdate));
        }
        }
        });
    });
</script>