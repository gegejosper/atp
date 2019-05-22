@extends('layouts.admin')

@section('content')

<div class="right_col" role="main">
<div class="row">
    <div class="col-md-4 col-sm-4 col-xs-12">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
       
               <div class="x_panel">
                        <div class="x_title">
                            <h2>Product
                            </h2>
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
                            
                                    {{ csrf_field() }}     
                                    
                                    <div class="form-group">
                                        <label for="Product Name">Product Name</label>
                                        <input type="text" class="form-control" placeholder="Product Name"  name="productname">
                                    </div>
                                    <button class="btn btn-large btn-primary " type="submit" id="add">Save</button>      
         
                        </div> <!--end x_content-->
                </div><!--end x_panel-->
            </div><!--end col-->
            
        </div><!--end row-->
        
    </div>
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <!-- /widget-header -->
                    <div class="widget-content">
                        <table class="table table-striped table-bordered" id="table">
                            <thead>
                            <tr>
                                <th> Product Name</th>
                                <th> Action </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($dataProduct as $Product)
                            <tr class="item{{$Product->id}}">
                                
                                <td>{{$Product->productname}}</td>
                                <td class='td-actions'>
                                    <button class='edit-modal btn btn-small btn-success' data-id='{{$Product->id}}' data-name='{{$Product->productname}}'><i class='fa fa-pencil'> Edit</i></button>
                                    <a class='delete-modal btn btn-danger btn-small' data-id='{{$Product->id}}'><i class='fa fa-times'> Remove</i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /widget-content --> 
                </div>            
            <!-- /container --> 
            </div>
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
  							</div>
  						</div>
  						<div class="form-group">
  							<label class="control-label col-sm-2" for="product_name" >Product Name:</label>
  							<div class="col-sm-10">
  								<input type="text" class="form-control" id="productedit_name" name="productedit_name">
                </div>
          
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
<script src="{{ asset('js/productscript.js') }}"></script>
<!-- /main -->
@endsection