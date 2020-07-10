@extends('layouts.admin')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
<div class="row">
    <div class="col-md-6 col-lg-5 col-sm-12  col-xs-12">
        <div class="x_panel">
                  <div class="x_title">
                    <h2>Create Purchase Request
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                <div class="x_content">
                  <form action="{{ route('createpurchase') }}" method="post">	
                        {{ csrf_field() }}
                        <fieldset>	                                        
                            <div class="form-group">
                              <label class="control-label" for="Purchase #" >Purchase #:</label>
                              @forelse($dataPurchaseLast as $request)
                              <?php 
                              $prnum = date("m-d-Y");
                              ?>
                              <input type="text" class="form-control" placeholder="Purchase #"  aria-describedby="basic-addon2" name="purchasenumber" id="purchasenumber" value="ATP-{{$prnum}}-{{$request->id + 1}}">
                              @empty
                              <input type="text" class="form-control" placeholder="Purchase #"  aria-describedby="basic-addon2" name="purchasenumber" id="purchasenumber" value="ATP-<?php echo date('m-d-Y'); ?>-01">
                              @endforelse 
                            </div>
                            <div class="form-group">
                              <label class="control-label" for="date" >Date:</label>
                              <input class="form-control" type="text" name="purchasedate" id="purchasedate" aria-describedby="basic-addon2" value="<?php echo date('m/d/Y'); ?>">
                              
                            </div> 
                            <div class="form-group">
                              <label class="control-label" for="Branch" >Branch:</label>
                              
                              <select name="branch" id="branch" class="form-control" >
                                @foreach($dataBranch as $Branch)
                                  <option value="{{$Branch->id}}">{{$Branch->branchname}}</option>
                                @endforeach
                              </select>
                            </div>      
                            <button type="submit" class="btn btn-warning btn-small form-control">Create Purchase Request</button>      
                        </fieldset>
                  </form>   
                </div>
                
         </div>
      </div>
      <div class="col-md-6 col-lg-7 col-sm-12  col-xs-12">
        <div class="x_panel">
                <div class="x_title">
                    <h2>Purchase Order History
                    </h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-striped table-bordered">
                        <th>Purchase Number</th>
                        <th>Status</th>
                        <th>Date</th>
                    
                      @foreach($dataPurchase as $puchase)
                      <tr>
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


</div>
</div>
@endsection

