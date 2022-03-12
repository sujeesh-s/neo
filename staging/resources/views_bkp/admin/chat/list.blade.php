@php $currency = getCurrency()->name; @endphp
<div class="row flex-lg-nowrap">
    <div class="col-12">
        <div class="row flex-lg-nowrap">
            <div class="col-12 mb-3">
                <div class="e-panel card">
                    <div id="data-content" class="card-body">
                       
                        <div id="table_body" class="card-body table-card-body">
                            <div>
                                    <table id="chatlist" class="chatlist table table-striped table-bordered w-100 text-nowrap">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p">#</th>
                                            <th class="wd-15p">Seller</th>
                                            <th class="wd-15p">Customer</th>
                                            <th class="wd-15p">View</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @if($list && count($list) > 0) @php $n = 0; @endphp
                                            @foreach($list as $row) @php $n++; @endphp 
                                    <tr>    
                                        <td class="align-middle select-checkbox"></td>
                                        @php $view = $row['chat_id']; @endphp
                                        <td>{{$row['seller']}}</td>
                                        <td>{{$row['customer']}}</td>
                                        <td><button id="viewBtn-@php echo $view @endphp" data-toggle="modal" data-target="#chatmodel" class="mr-2 btn btn-success btn-sm viewBtn"><i class="fa fa-eye mr-1"></i>View</button>
                                            
                                        </td>
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
            </div>
        </div>
    </div>
</div>
            <!-- Message Modal -->
        <div class="modal fade" id="chatmodel" tabindex="-1" role="dialog"  aria-hidden="true">
            <div class="modal-dialog modal-dialog-right chatbox" role="document">
                <div class="modal-content chat border-0">
                    <div class="card overflow-hidden mb-0 border-0 chat_content" id="chat_content">

                    </div>
                    <div class="card-footer">
                        <center>
                    <a href=""  class="btn btn-primary " data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true"><i class="fe fe-x fs-20"></i></span>
                                    </a></center>
                        </div>
                </div>
            </div>
        </div>
        <!-- End Page -->

       


 <script src="{{asset('admin/assets/js/datatable/tables/chat-datatable.js')}}"></script>
 <script type="text/javascript">
     $(document).ready(function(){
        
     
     });
     
 </script>
 