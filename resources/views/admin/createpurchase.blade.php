@extends('layouts.admin')

@section('content')
<div class="right_col" role="main">
<div class="row">
    <div class="col-md-4 col-sm-4 col-xs-12">
        
        <div class="x_panel">
                  <div class="x_title">
                    <h2>Branch Petrol
                    </h2>
                    
                   
                    <div class="clearfix"></div>
                  </div>
                <div class="x_content">
                <table class="table table-striped">
                    <tbody>
                    {{ csrf_field() }}   
                    @forelse($Gas as $Gastype)
                    <tr class="productitem{{$Gastype->id}}">
                        
                        <td style="width:80%;">{{$Gastype->gas->gasname}}</td>
                        <td>
                            <button class='request-modal btn btn-xs btn-success' data-id='{{$Gastype->gas->id}}' data-productname='{{$Gastype->gas->gasname}}' ><i class='fa fa-plus'></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="2" style="text-align:center;"><em>All Petrol Types Available to Branch </em></td></tr>
                    @endforelse
                    </tbody>
                </table>

                </div> <!--end x_content-->
         </div><!--end x_panel-->
      </div><!--end col-->
      <div class="col-md-8 col-sm-8 col-xs-12">
        <div class="x_panel">
                  <div class="x_title">
                    <h2>Purchase Request
                    </h2>
                    <div class="clearfix"></div>
                  </div>
                <div class="x_content">  
                <h3 style="padding-bottom:20px;">PR #: {{$purchasenumber}}</h3> 
                  <table class="table table-striped table-bordered" >
                    <thead>
                      <tr>
                        <th>Product Name</th>
                       
                        <th>Quantity</th>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                      @forelse($dataPurchaseRecord as $Request)
                      <tr>
                        <td>{{$Request->gasdetail->gasname}}</td>
                        
                        <td><em class="productprice">{{$Request->quantity}}</em>  </td>
                        <td style="width:100px;" class="td-actions"><a href="javascript:;" class="delete-modal btn btn-mini btn-danger" data-id="{{$Request->id}}" ><i class="icon-minus"> </i>Remove</a> </td>
                      </tr>
                      @empty
                      <tr><td colspan='4'><em>No Data</em></td></tr>
                      @endforelse 
                    </tbody>
                  </table>
                  
                  <div style="text-align:right; padding-top:20px;"><a href="javascript:;" class="generate-modal btn btn-mini btn-success" data-purchasenumber="{{$purchasenumber}}"><i class="icon-save"> </i>Generate Purchase Request</a></div>
                </div> <!--end x_content-->
         </div><!--end x_panel-->
      </div><!--end col-->
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
  				    <input type="hidden" class="form-control" id="fid" disabled>
                    <input type="hidden" class="form-control" id="skuid">
                    <input type="hidden" class="form-control" id="addpurchasenumber" name="addpurchasenumber" value="{{$purchasenumber}}">
                    <input type="hidden" class="form-control" id="addpurchasedate" name="addpurchasedate" value="<?php echo date('m/d/Y'); ?>">
              <div class="row">
                <div class="text-right col-sm-4" for="Product Name" > <strong>Petrol/Product:</strong></div>
                  <div class="col-sm-8">
                    <em class=""><strong><span class="productname"></span></strong></em>
                  </div> 
                </div>
               
              
              <div class="form-group">
                  <label class="control-label col-sm-4" for="quantity" >Request Quantity:</label>
  							<div class="col-sm-8">
  								<input type="number" class="form-control" id="quantity" name="quantity">
                </div>
              </div>
  					</form>
  					<div class="deleteContent">
  						Are you sure you want to remove this stock request <span class="dname"></span> ? <span
  							class="hidden did"></span>
  					</div>
                    <div class="generateContent">
  						Are you sure you want to generate this request order <span class="dname"></span> ? <span
  							class="hidden purchasenumber"></span>
  					</div>
  					<div class="modal-footer">
  						<button type="button" class="btn actionBtn" data-dismiss="modal">
  							<span id="footer_action_button"> </span>
  						</button>
  					</div>
  				</div>
  			</div>
		  </div>
    </div>
    <div id="CartInfo" class="modal fade" role="dialog">
  		<div class="modal-dialog">
  			<!-- Modal content-->
  			<div class="modal-content">
  				<div class="modal-header">
          <h4 class="modal-title" align="left"></h4>
  					<button type="button" class="close" data-dismiss="modal">&times;</button>
  					
  				</div>
  				<div class="modal-body">
  					<p>Stock Request Successfully Added!</p>
  					<div class="modal-footer">
              <button type="button" class="btn btn-warning" data-dismiss="modal">
  							<span class='glyphicon glyphicon-remove'></span> Close
  						</button>
  					</div>
  				</div>
  			</div>
		  </div>
</div>
</div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/requestscript.js') }}"></script>
<!-- /main -->
@endsection