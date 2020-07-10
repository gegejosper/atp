@extends('layouts.admin')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-4 col-sm-12 col-lg-4 no-print">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Purchase History</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped table-bordered">
                        <th>Purchase Number</th>
                        <th>Date</th>
                    
                        @foreach($dataPurchase as $purchase)
                        <tr>
                        <td><a href="/admin/purchase/history/{{$purchase->purchasenumber}}">{{$purchase->purchasenumber}}</a></td>
                        <td>{{$purchase->date}}</td>
                        </tr>
                        @endforeach 
                    </table>   
                </div> <!--end x_content-->
            </div><!--end x_panel-->
        </div>
        <div class="col-md-8 col-sm-12 col-lg-8">
            <div class="x_content">
            <div class="x_panel">
            <div class="text-center"><img src="{{ asset('img/logo.png') }}" alt="" style="width:50px;"></div>
            <div class="x_title">
            <h4>Purchase Request # <strong>{{$purchasenumber}}</strong>
            </h4>
            <div class="clearfix"></div>
            </div>
                <div class="x_content">
                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                        @php
                        Session::forget('success');
                        @endphp
                    </div>
                @endif
                <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th>Petrol Name</th>
                            <th>Request Quantity</th>
                            <th>Receive Quantity</th>
                            <th>Unit Price</th>
                            <th>Amount</th>
                            <th class="hidden-print noprint"></th>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?php $totalAmount = 0; ?>
                        @foreach($dataPurchaseRecord as $Record)
                            <tr id="row{{$Record->id}}">
                                <td>{{ ucfirst($Record->gasdetail->gasname) }}</td>
                                <td>{{$Record->quantity}}</td>
                                <td>{{$Record->recquantity}}</td>
                                <td>{{$Record->price}}</td>
                                
                                <?php 
                                if($Record->status == 'received')
                                {
                                ?>            
                                <td>
                                    {{number_format($Record->recquantity * $Record->price, 3)}}
                                    <?php 
                                        $itemAmount =   $Record->recquantity * $Record->price;                                 
                                        $totalAmount = $totalAmount + $itemAmount;
                                    ?>
                                </td>
                                <?php
                                }
                                ?>  
                                
                                <td style="width:100px;" class="td-actions hidden-print noprint">
                                <a href="javascript:;" class="addquantity-modal btn btn-info btn-sm hidden-print noprint" data-id="{{$Record->id}}" data-gasname="{{$Record->gasdetail->gasname}}" data-recquantity="{{$Record->quantity}}" data-recievequantity="{{$Record->recquantity}}">
                                    <i class="icon-plus"> </i> Add Unit Price
                                </a> 
                                </td>
                            
                            </tr>
                        @endforeach 
                        <?php 
                                if($dataPurchaseDetail->status == 'received')
                                {
                                ?>
                                <tr><td colspan="4"> Total Amount</td><td colspan="2">{{number_format($totalAmount,3)}}</td></tr>
                            <?php 
                            }
                        ?>
                        </tbody>
                    </table> 
                    @if(count($dataRecord) >= 1)
                    @foreach($dataRecord as $Record)
                    <div class="row-">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="Check Date">Check Date: </label>
                                    {{$Record->checkdate}}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="Bank Name">Bank Name: </label>
                                    {{$Record->bankname}}
                                </div>
                            </div>
                        </div>
                        <div class="row-">  
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="Check Number">Check Number: </label>
                                    {{$Record->checknum}}
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="Amount">Amount: </label>
                                    {{$Record->amount}}
                                </div>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <br>
                        <div class="row-">  
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="Prepared">Prepared by: </label>
                                    {{$name}}
                                </div>
                            </div>
                            
                        </div>
                    @endforeach
                    <a style="margin:20px 5px; float: right;"class="btn btn-primary hidden-print noprint" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print Preview</a> 
                    @else
                    
                    <form method="post" action="{{route('savepurchaserec')}}">
                        <div class="row-">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="Check Date">Check Date</label>
                                    <input type="date" name="checkdate" id="checkdate" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="Bank Name">Bank Name</label>
                                    <input type="text" name="bankname" id="bankname" class="form-control" placeholder="Bank Name">
                                </div>
                            </div>
                        </div>
                        <div class="row-">  
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="Check Number">Check Number</label>
                                    <input type="text" name="checknum" id="checknum" class="form-control" placeholder="000-000-000">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <label for="Amount">Amount</label>
                                    <input type="text" name="amount" id="amount" class="form-control" placeholder="0.00">
                                </div>
                            </div>
                        </div>
                        {{ csrf_field() }}   
                        <input type="hidden" name="prnum" id="prnum" value="{{$purchasenumber}}">
                       
                        <button style="margin:20px 0px; float: right;" type="submit" class="btn btn-success" ><i class="fa fa-save"></i> Save</a>       
                    </form>
                    
                    @endif
                    <script>
                    function myFunction() {
                    window.print();}
                    </script>   
                </div> <!--end x_content-->
            </div><!--end x_panel-->

            </div><!--x_content-->
        </div><!--col-->
    </div><!--row-->
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"></h4>
            </div>
        <div class="modal-body">
            <form class="form-horizontal" role="form">
                {{ csrf_field() }}
                <input type="hidden" class="form-control" id="fid">
                <input type="hidden" class="form-control" id="addrecievedate" name="addrecievedate" value="<?php echo date('m/d/Y'); ?>">
                <input type="hidden" class="form-control" id="gasname" name="gasname">
                <input type="hidden" class="form-control" id="recievequantity" name="recievequantity">
                <input type="hidden" class="form-control" id="recquantity" name="recquantity">
                <div class="row">
                    <div class="text-right col-sm-4" for="Gas Name" > <strong>Gas Name:</strong></div>
                        <div class="col-sm-8">
                            <em class=""><strong><span class="gasname"></span></strong></em>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="recievequantity" >Unit Price:</label>
                        <div class="col-sm-8">
                        <input type="text" class="form-control" id="unitprice" name="unitprice" placeholder="0.00">
                        </div>
                    </div>
            </form>
                <div class="deleteContent">
                    Are you Sure you want to delete <span class="dname"></span> ? <span
                        class="hidden did"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button"> </span>
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
        </div>          
    </div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/purchaseorder.js') }}"></script>
<!-- /main -->
@endsection
