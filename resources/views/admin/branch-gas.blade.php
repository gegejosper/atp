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
    <div class="col-md-4 col-lg-6 col-sm-12 col-xs-12">
        <div class="x_panel">
            <h4>Petrol</h4>
            <!-- /widget-header -->
            <div class="widget-content">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        
                        <th> Petrol Name</th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    {{ csrf_field() }}   
                    @forelse($Gas as $Gastype)
                    <tr class="productitem{{$Gastype->id}}">
                        
                        <td>{{$Gastype->gasname}}</td>
                        <td>
                            <button class='addbranch btn btn-xs btn-success' data-id='{{$Gastype->id}}' data-productname='{{$Gastype->gasname}}' data-branchid='{{$BranchId}}'><i class='fa fa-plus'> Add to Branch</i></button>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" style="text-align:center;"><em>All Petrol Types Available to Branch </em></td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            <!-- /widget-content --> 
        </div>            
    <!-- /container --> 
    </div>
</div>    
<div class="row">
    <div class="col-md-6 col-lg-8 col-sm-12 col-xs-12">
        <div class="x_panel">
            <h4>Petrolium Products
            
            </h4>
            <!-- /widget-header -->
            <div class="x_content">
                            @foreach($dataBranchgas as $Branchgas)  
                            <h4>{{$Branchgas->gas['gasname']}}</h4>
                            <?php 
                            $tankvolume = 24000; 
                            $tankavailable = $Branchgas->volume;
                            $tankdiff =   $tankvolume - $tankavailable;
                            $tankpercent = ($tankdiff / $tankvolume) * 100;
                            if($tankpercent >= 76){
                                $tankprogress = "progress-bar-danger";
                                $tankwidth = 100 - $tankpercent;
                            }
                            else if($tankpercent >= 26 && $tankpercent <= 75){
                                $tankprogress = "progress-bar-warning";   
                                $tankwidth = 100 - $tankpercent;
                            }
                            else if($tankpercent <= 25){
                                $tankprogress = "progress-bar-success";   
                                $tankwidth = 100 - $tankpercent;
                            }
                            else {
                                $tankprogress = "progress-bar-info";
                            }
                            ?>
                            <div class="progress">
                                <div class="progress-bar {{$tankprogress}}" data-transitiongoal="{{$tankwidth}}" aria-valuenow="{{$tankwidth}}" style="width: {{$tankwidth}}%;">{{number_format($Branchgas->volume,2)}} Ltrs.</div>
                            </div>
                            @endforeach
                            </div><!--x_content-->
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