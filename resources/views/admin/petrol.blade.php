@extends('layouts.admin')

@section('content')

<div class="right_col" role="main">
  
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <h4>Petrolium Products
            
            </h4>
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="row">
                    @foreach($dataBranch as $Branch)
                    <div class="col-md-6 col-sm-12 col-lg-6">
                        <div class="x_panel tile">
                            <div class="x_title">
                    <h4>{{$Branch->branchname}}</h4>
                    @foreach($Branch->branchgas as $Branchgas)  
                                {{$Branchgas->gas['gasname']}}
                                <div class="progress">
                                    <div class="progress-bar progress-bar-danger" data-transitiongoal="25" aria-valuenow="25" style="width: 25%;">{{number_format($Branchgas->gas['volume'],2)}} Ltrs.</div>
                                </div>     
                    @endforeach
                            </div>
                            <div class="clearfix"></div>
                            
                        </div><!--x_panel-->   
                    </div><!--col-->
                    @endforeach
                </div><!--row-->
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
<script src="{{ asset('js/branchgasscript.js') }}"></script>
<!-- /main -->
@endsection