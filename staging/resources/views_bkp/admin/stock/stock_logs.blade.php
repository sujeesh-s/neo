<div class="page-header">
    <div class="page-leftheader">
        <h4 class="page-title mb-0">{{$title}}</h4>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#"><i class="fe fe-grid mr-2 fs-14"></i>Seller Management</a></li>
            <li class="breadcrumb-item"><a href="#" class="bc_list">Product Stock</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Stock Log</a></li>
        </ol>
    </div>
</div>

<div class="row flex-lg-nowrap">
    <div class="col-12">
        <div class="row flex-lg-nowrap">
            <div class="col-12 mb-3">
                <div class="e-panel card">
                    <div class="card-body">
                        <div class="tabs-menu mb-4">
                            <ul class="nav panel-tabs">
                                <li><a href="#tab1" data-toggle="tab" id="nav_tab_1" class="active"><span>Stock</span></a></li>
                                <li><a href="#tab2" data-toggle="tab" id="nav_tab_2"><span>Price</span></a></li>
                           </ul>
                        </div>
                        <div class="tab-content col-12">
                            <div class="tab-pane active " id="tab1">
                                <div class="card-header mb-4""><div class="card-title">Product Stock Log</div></div>
                                <div class="page-rightheader tar pr-6">
                                    <div class="btn btn-list">
                                        <a href="" id="editForm-{{$product->id}}" data-seller="{{$product->seller->seller_id}}" data-product="{{$product->id}}" class="btn btn-secondary editForm"><i class="fe fe-plus mr-1"></i> Add Stock</a>
                                    </div>
                                </div>
                                <div class="card-body table-card-body">
                                    <div>
                                        <table id="stock_log" class="stock_log-table table table-striped table-bordered w-100 text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="wd-15p notexport">Select</th>
                                                    <th class="wd-15p">Type</th>
                                                    <th class="wd-15p tar">Qty.</th>
                                                    <th class="wd-15p tar">Price ({{getCurrency()->name}})</th>
                                                    <th class="wd-20p">Stock Added On</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($product->stockLogs && count($product->stockLogs) > 0) @php $n = 0; @endphp
                                                   @foreach($product->stockLogs as $row) @php $n++; @endphp <?php // echo '<pre>'; print_r($row->price($row->prd_id)); echo '</pre>'; die; ?>
                                                        <tr class="dtrow" id="dtrow-{{$row->id}}">
                                                            <td><span class="d-none">{{$n}}</span></span></td>
                                                            <td>{{$row->type}}</td> 
                                                            <td class="tar">{{$row->qty}}</td> 
                                                            <td class="tar">{{$row->rate}}</td> 
                                                            <td>{{date('d M Y',strtotime($row->created_at))}}</td> 
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        {{ csrf_field() }}

                                    </div>
                                </div>
                            </div>
                            
                            <div class="tab-pane " id="tab2">
                                <div class="card-header mb-4""><div class="card-title">Product Price Log</div></div>
                                <div class="page-rightheader tar pr-6">
                                    <div class="btn btn-list">
                                        <a href="" id="addPice-{{$product->id}}" data-seller="{{$product->seller->seller_id}}" data-product="{{$product->id}}" class="btn btn-secondary addPice"><i class="fe fe-plus mr-1"></i> Add Price</a>
                                    </div>
                                </div>

                                <div class="card-body table-card-body">
                                    <div>
                                        <table id="price_log" class="price_log-table table table-striped table-bordered w-100 text-nowrap">
                                            <thead>
                                                <tr>
                                                    <th class="wd-15p notexport">Select</th>
                                                    <th class="wd-15p tar">Price ({{getCurrency()->name}})</th>
                                                    <th class="wd-15p tar">Sale Price ({{getCurrency()->name}})</th>
                                                    <th class="wd-15p ">Sale Starts On </th>
                                                    <th class="wd-20p">Sale Ends On</th>
                                                    <th class="wd-20p">Created On</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if($product->priceLogs && count($product->priceLogs) > 0) @php $n = 0; @endphp
                                                    @foreach($product->priceLogs as $row) 
                                                    @php $n++; 
                                                        if($row->sale_start_date != NULL){ $sDate = date('d M Y',strtotime($row->sale_start_date)); $eDate = date('d M Y',strtotime($row->sale_end_date)); }else{ $sDate = $eDate = 'Nill'; } 
                                                        if($row->sale_price != NULL){ $sPrice = $row->sale_price; }else{ $sPrice = 'Nill'; }
                                                    @endphp 
                                                        <tr class="dtrow" id="dtrow-{{$row->id}}">
                                                            <td><span class="d-none">{{$n}}</span></span></td>
                                                            <td class="tar">{{$row->price}}</td> 
                                                            <td class="tar">{{$sPrice}}</td> 
                                                            <td>{{$sDate}}</td> 
                                                            <td>{{$eDate}}</td> 
                                                            <td>{{date('d M Y',strtotime($row->created_at))}}</td> 
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                        {{ csrf_field() }}

                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        <div class="col-lg-12">
                            <div class="card-footer text-right">
                                <button id="cancel_btn" type="button" class="btn btn-secondary bc_list" data-dismiss="modal">Back</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
                    <div class="card-footer text-right">
                        <button id="cancel_btn" type="button" class="btn btn-secondary" data-dismiss="modal">Back</button>
                    </div>
                    </div>
</div>
<script src="{{URL::asset('admin/assets/js/datatable/tables/stock_log-datatable.js')}}"></script>
<script src="{{URL::asset('admin/assets/js/datatable/tables/price_log-datatable.js')}}"></script>

