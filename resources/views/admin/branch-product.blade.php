@extends('layouts.admin')

@section('content')

<div class="right_col" role="main">
<div class="row"> 
<div class="page-title">
        <div class="title_left">
        <h3>
            @foreach($dataBranch as $Branch)
                {{$Branch->branchname}} Branch
            @endforeach 
        </h3>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12  col-sm-12 col-xs-12">
          <div class="x_panel">
                  <div class="x_title">
                    <h4>Branch Menu  
                        
                    </h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @include('admin.includes.branch-menu')
                  </div>
            </div>
        </div>            
</div>      
<div class="row">
    <div class="col-md-4 col-lg-3 col-sm-12 col-xs-12">
        <div class="x_panel">
            <h4>Products</h4>
            <!-- /widget-header -->
            <div class="widget-content">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th> Product Name</th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    {{ csrf_field() }}   
                    @forelse($Products as $Product)
                    <tr class="productitem{{$Product->id}}">
                        
                        <td>{{$Product->productname}}</td>
                        <td>
                            <button class='addbranch btn btn-xs btn-success' data-id='{{$Product->id}}' data-productname='{{$Product->productname}}' data-branchid='{{$BranchId}}'><i class='fa fa-plus'> Add to Branch</i></button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" style="text-align:center;"><em>All Products Available to Branch </em></td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /widget-content --> 
        </div>            
    <!-- /container --> 
    </div>
    <div class="col-md-10 col-sm-12 col-lg-8">
        <div class="x_panel tile">
            <div class="x_title">
                <h4>Available Products in Branch</h4>
            </div>
            <div class="clearfix"></div>
            <div class="x_content">
            <table class="table tablegas table-striped table-bordered" id="table">
                    <thead>
                    <tr>
                        <th> Product Name</th>
                        <th> Unit Price</th>
                        <th> Quantity</th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataBranchproducts as $Branchproducts)
                    <tr class="item{{$Branchproducts->id}}">
                        
                        <td>{{$Branchproducts->product->productname}}</td>
                        <td>{{number_format($Branchproducts->price, 2)}}</td>
                        <td>{{$Branchproducts->quantity}}</td>
                        <td>
                        <button class='edit-modal btn btn-xs btn-success' data-id='{{$Branchproducts->id}}' data-name='{{$Branchproducts->product->productname}}'><i class='fa fa-pencil'> </i> Update</button>
                        <a class='delete-modal btn btn-danger btn-xs' data-id='{{$Branchproducts->id}}' data-id='{{$BranchId}}'><i class='fa fa-times'> Remove</i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div><!--x_content-->
        </div><!--x_panel-->   
    </div><!--col-->
</div>
<!-- /main -->
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
  						<div class="form-group">
  							
  							<div class="col-sm-10">
                                  <input type="hidden" class="form-control" id="fid">
                                  <input type="hidden" class="form-control" id="productname">
  							</div>
  						</div>
  						<div class="form-group">
  							<label class="control-label col-sm-1" for="Price" >Price:</label>
  							<div class="col-sm-5">
  							    <input type="number" class="form-control" id="priceedit_name" name="priceedit_name">
                            </div>
                            <label class="control-label col-sm-2" for="Quantity" >Quantity:</label>
  							<div class="col-sm-4">
  							    <input type="number" class="form-control" id="quantityedit_name" name="quantityedit_name">
                            </div>
                        </div>
                        <div class="form-group">
  							
                        </div>
            
  					</form>
  					<div class="deleteContent">
  						Are you sure you want to delete <span class="dname"></span> ? <span
  							class="hidden did"></span>
  					</div>
  					<div class="modal-footer">
  						<button type="button" class="btn actionBtn" data-dismiss="modal">
  							<span id="footer_action_button" class='glyphicon'> </span>
  						</button>
  						<button type="button" class="btn btn-warning" data-dismiss="modal">
  							<span class='glyphicon glyphicon-remove'></span> Close
  						</button>
  					</div>
  				</div>
  			</div>
		  </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
    </div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/branchproductscript.js') }}"></script>
<!-- /main -->
@endsection