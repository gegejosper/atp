@extends('layouts.incharge')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-lg-12">
            <div class="x_content">
            <div class="x_panel">
            <div class="x_title">
            <h2>Purchase Request # <strong>{{$purchasenumber}}</strong>
            </h2>
            <div class="clearfix"></div>
            </div>
                <div class="x_content">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                            <th>Petrol Name</th>
                            <th>Request Quantity</th>
                            <th>Receive Quantity</th>
                            
                            <?php 
                                if($dataPurchase->status == 'received')
                                {
                                ?>
                                <th>Amount</th>
                            <?php 
                            }
                            else{
                            ?>
                            <th>Action</th>
                            <?php }?>
                            </tr>
                            
                        </thead>
                        <tbody>
                            <?php $totalAmount = 0; ?>
                        @foreach($dataPurchaseRecord as $Record)
                            <tr id="row{{$Record->id}}">
                                <td>{{ ucfirst($Record->gasdetail->gasname) }}</td>
                                <td>{{$Record->quantity}}</td>
                                <td>{{$Record->recquantity}}</td>
                               
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

                               
                                <?php 
                                if($Record->status == 'ordered')
                                {
                                ?>
                                    <td style="width:100px;" class="td-actions">
                                    <a href="javascript:;" class="addquantity-modal btn btn-info btn-sm" data-id="{{$Record->id}}" data-gasname="{{$Record->gasdetail->gasname}}" data-recquantity="{{$Record->quantity}}">
                                        <i class="icon-plus"> </i> Add Quantity
                                    </a> 
                                    </td>
                                <?php 
                                }
                                
                                ?>
                                
                            </tr>
                        @endforeach 
                        <?php 
                                if($dataPurchase->status == 'received')
                                {
                                ?>
                                <tr><td colspan="4"> Total Amount</td><td >{{number_format($totalAmount,3)}}</td></tr>
                            <?php 
                            }
                        ?>
                        </tbody>
                    </table> 
                    <button style="margin:20px 0px; float: right;"class="btn btn-primary hidden-print noprint" align="right" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button> 
                    <?php 
                        if($dataPurchase->status != 'received')
                        {
                        ?>
                            <a href="/incharge/order/recieved/{{$purchasenumber}}" style="margin:20px 10px 20px 10px; float: right;"class="btn btn-success hidden-print noprint" align="right" >Recieved</a>
                        <?php 
                        }
                        
                        ?>
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
                <input type="hidden" class="form-control" id="recquantity">
                <input type="hidden" class="form-control" id="addrecievedate" name="addrecievedate" value="<?php echo date('m/d/Y'); ?>">
                <input type="hidden" class="form-control" id="gasnamevalue" name="gasnamevalue">
                <div class="row">
                    <div class="text-right col-sm-4" for="Gas Name" > <strong>Gas Name:</strong></div>
                        <div class="col-sm-8">
                            <em class=""><strong><span class="gasname"></span></strong></em>
                        </div> 
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-4" for="recievequantity" >Recieve Quantity:</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="recievequantity" name="recievequantity">
                            <input type="hidden" class="form-control" id="unitprice" name="unitprice" value="0">
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
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/inchargerequest.js') }}"></script>
<!-- /main -->
@endsection
