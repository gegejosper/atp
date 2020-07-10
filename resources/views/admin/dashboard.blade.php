@extends('layouts.admin')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-lg-6">
            <div class="x_panel tile"> 
                    <h5>Gas Prices</h5>
                <div class="clearfix"></div>
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                   
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <?php $tab=0;?>
                        @foreach($data_branch_gas as $branch_gas)
                        <li role="presentation" class="<?php echo $tab ==0 ? 'active' : ''; ?>"><a href="#{{$branch_gas->branchname}}" id="tab-{{$branch_gas->branchname}}" role="tab" data-toggle="tab" aria-expanded="true">{{$branch_gas->branchname}}</a>
                        </li>
                        <?php $tab=1;?>
                        @endforeach
                    </ul>
                    
                      <div id="myTabContent" class="tab-content">
                        <?php $count=0;?>
                        @foreach($data_branch_gas as $branch_gas)
                        
                        <div role="tabpanel" class="tab-pane fade <?php echo $count ==0 ? 'active' : ''; ?> in" id="{{$branch_gas->branchname}}" aria-labelledby="tab-{{$branch_gas->branchname}}">
                        <table class="table table-striped table-bordered">
                                <th>Petrol</th>
                                <th>Volume</th>
                                <th>Price</th>
                                <th></th>                    
                                @foreach($branch_gas->branchgas as $branch_gas)
                                <tr class="row{{$branch_gas->id}}">
                                    <td>{{$branch_gas->gas['gasname']}}</td>
                                    <td>{{$branch_gas->volume}}</td>
                                    <td>{{$branch_gas->price}}</td>
                                    <td width="50">
                                    <button class='update-modal-dashboard btn btn-md btn-info' 
                                        data-id='{{$branch_gas->id}}'
                                        data-branchid='{{$branch_gas->branchid}}' 
                                        data-gasname="{{$branch_gas->gas['gasname']}}" 
                                        data-volume='{{$branch_gas->volume}}' 
                                        data-price='{{$branch_gas->price}}' 
                                        data-gasid='{{$branch_gas->gasid}}'>
                                        <i class='fa fa-pencil'></i>
                                    </button>
                                    </td>
                                </tr>
                                @endforeach 
                        </table>
                        </div>
                        <?php $count=1;?>
                        @endforeach
                      </div>
                      
                </div>
               
            </div>
        </div>
        <div class="col-md-6 col-sm-12 col-lg-6">
            <div class="x_panel tile">
                    <h5>Recent Payments</h5>
                <div class="clearfix"></div>
            </div>
        </div><!--col-->

        <div class="col-md-6 col-lg-6 col-sm-12  col-xs-12">
        <div class="x_panel">   
            <h5>Recent Purchase Order
            </h5>
            <div class="clearfix"></div>
        
            <div class="x_content">
                <table class="table table-striped table-bordered">
                    <th>Purchase #</th>
                    <th>Status</th>
                    <th>Date</th>
                
                    @foreach($dataPurchase as $puchase)
                    <tr >
                    <td><a href="/admin/order/history/{{$puchase->purchasenumber}}">{{$puchase->purchasenumber}}</a></td>
                    <td><?php
                        if ($puchase->status == 'ordered'){
                        echo "<em>Requesting</em>";
                        }
                        elseif($puchase->status == 'received'){
                        echo "<em>Received</em>";
                        }
                        else {
                        echo "<em>Waiting</em>";
                        }
                    ?></td>
                    <td>{{$puchase->date}}</td>
                    </tr>
                    @endforeach 
                </table>   
            </div>  
         </div>
      </div>
        
    </div><!--row-->
</div>
<div id="updateGasModalDashBoard" class="modal fade" role="dialog">
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
                    <div class="form-group">	
                        <div class="col-sm-10">
                            <input type="hidden" class="form-control" id="branchid">
                            <input type="hidden" class="form-control" id="branchgasid">
                            <input type="hidden" class="form-control" id="gasid">
                            <input type="hidden" class="form-control" id="fid">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="Price" >Gas Name:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="gasname" name="gasname" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="Price" >Price:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="priceedit" name="priceedit">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-12" for="Volume" >Volume:</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="volumeedit" name="volumeedit">
                        </div>
                    </div>
                </form>
                <div class="deleteContent">
                    Are you sure you want to delete <span class="dname"></span> ? <span
                        class="hidden did"></span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_update_button" class='glyphicon'> </span>
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
<script src="{{ asset('js/branchgasscript.js') }}"></script>
@endsection