@php $currency = getCurrency()->name; @endphp
<div class="card">
    <div class="card invoice">
        <div class="col-12">
            <h2><div class="tac pt-3 pb-3" style="border-bottom: 2px solid #ff0000;">Invoice</div></h2>
        </div>
        <div class="col-12">
            <div class="row">
                <div class="col-md-12 col-lg-4 fl">
                    <div class="card-header no-border"><div class="card-title">Billing Address</div></div>
                    <div class="card-body">
                        <div class="">
                            <div class="font-weight-bold"><i class="fa fa-user mr-1"></i>{{$order->address->name}}</div>
                        </div>
                        <div class="">
                            <div class=""><i class="fa fa-phone mr-1"></i>{{$order->address->phone}}</div>
                        </div>
                        <div class="">
                            <div class=""><i class="fa fa-envelope mr-1"></i>{{$order->address->email}}</div>
                        </div>
                        <div class="">
                            <div class=""><i class="fa fa-map mr-1"></i>{{$order->address->address1}}</div>
                        </div>
                        <div class="pl-4">
                            <div class="">{{$order->address->address2}}</div>
                        </div>
                        <div class="pl-4">
                            <div class="">{{$order->address->city}}</div>
                        </div>
                        <div class="pl-4">
                            <div class="">{{$order->address->state}}</div>
                        </div>
                        <div class="pl-4">
                            <div class="">{{$order->address->country}}</div>
                        </div>
                        <div class="pl-4">
                            <div class="">{{$order->address->zip_code}}</div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-12 col-lg-4 fl">
                    <div class="card-header no-border"><div class="card-title">Shipping Address</div></div>
                    <div class="card-body">
                        <div class="">
                            <div class="font-weight-bold"><i class="fa fa-user mr-1"></i>{{$order->address->s_name}}</div>
                        </div>
                        <div class="">
                            <div class=""><i class="fa fa-phone mr-1"></i>{{$order->address->s_phone}}</div>
                        </div>
                        <div class="">
                            <div class=""><i class="fa fa-envelope mr-1"></i>{{$order->address->s_email}}</div>
                        </div>
                        <div class="">
                            <div class=""><i class="fa fa-map mr-1"></i>{{$order->address->s_address1}}</div>
                        </div>
                        <div class="">
                            <div class=""><i class="fa fa-map mr-1"></i>{{$order->address->address1}}</div>
                        </div>

                        <div class="pl-4">
                            <div class="">{{$order->address->s_city}}</div>
                        </div>
                        <div class="pl-4">
                            <div class="">{{$order->address->s_state}}</div>
                        </div>
                        <div class="pl-4">
                            <div class="">{{$order->address->s_country}}</div>
                        </div>
                        <div class="pl-4">
                            <div class="">{{$order->address->s_zip_code}}</div>
                        </div>
                    </div>
                </div>
    
                <div class="col-md-12 col-lg-4 fl">
                    <div class="card-body">
                        <div class="mb-3 tar">
                            <div class="card-title"><span class="text-muted">Invoice No: </span><span class="font-weight-bold">#{{$order->order_id}}</span></div>
                        </div>
                        <div class="mb-3 tar">
                            <div class="card-title"><span class="text-muted">Date: </span><span class="font-weight-bold">{{date('d M Y',strtotime($order->created_at))}}</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="">
                <div class="card-header">
                        <h3 class="card-title">Products</h3>
                </div>
                <div class="">
                    <div class="table-responsive">
                        <table class="table table-bordered card-table table-vcenter text-nowrap">
                            <thead>
                                <tr>
                                    <th class="wd-15p">Sr.No.</th>
                                    <th>Name</th>
                                    <th>Price ({{$currency}})</th>
                                    <th>Qty.</th>
                                    <th>total ({{$currency}})</th>
                                </tr>
                            </thead>
                            <tbody>
                            @if($order->items && count($order->items) > 0) @php $n = 0; @endphp
                                @foreach($order->items as $item) @php $n++; @endphp
                                <tr>
                                    <th scope="row">{{$n}}</th>
                                    <td>{{$item->prd_name}}</td>
                                    <td>{{$item->price}}</td>
                                    <td>{{$item->qty}}</td>
                                    <td>{{$item->total}}</otaltd>
                                </tr>
                                @endforeach 
                                <tr>
                                    <th colspan="4" class="text-right">Gross Total</th>
                                    <th class="text-right">{{$currency}} {{$order->total}}</th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-right">Tax</th>
                                    <th class="text-right">{{$currency}} {{$order->tax}}</th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-right">Discount</th>
                                    <th class="text-right">{{$currency}} {{$order->discount}}</th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-right">Shiping Charge</th>
                                    <th class="text-right">{{$currency}} {{$order->shiping_charge}}</th>
                                </tr>
                                <tr>
                                    <th colspan="4" class="text-right">Net Payable</th>
                                    <th class="text-right">{{$currency}} {{($order->total+$order->tax+$order->shiping_charge)-$order->discount}}</th>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="card-footer text-right">
                         <button id="cancel_btn" type="button" class="btn btn-secondary">Back</button>
                     </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
