@extends('layouts.admin')

@section('content')
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
<div class="col-md-4 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>Tank Dipping  
                </h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                {{ csrf_field() }}   
                <div class="input-group col-lg-12">
                    <label for="Petrol">Petrol</label>
                    <select name="gastype" id="gastype" class="form-control">
                    <option value=""></option>
                    @foreach($dataBranchgas as $Branchgas) 
                        <option value="{{$Branchgas->gas['id']}},{{$Branchgas->gas['gasname']}}, {{$Branchgas->branchdipping->dipclosevolume}}">{{$Branchgas->gas['gasname']}}</option>
                    @endforeach
                    </select>
                </div>                  
                <div class="input-group col-lg-12">
                    <label for="Volume">Open Volume</label>
                    <input type="text" class="form-control" placeholder="Open Volume"  aria-describedby="basic-addon2" name="dipopenvolume" id="dipopenvolume" readonly>
                </div>
                <div class="input-group col-lg-12">
                    <label for="Volume">Close Volume</label>
                    <input type="text" class="form-control" placeholder="Close Volume"  aria-describedby="basic-addon2" name="dipclosevolume" id="dipclosevolume">
                </div>
                <div class="input-group col-lg-12">
                    <label for="Date">Date</label>
                    <input type="hidden" name="branchid" value="{{$BranchId}}">
                    <input type="text" class="form-control"  aria-describedby="basic-addon2" name="dippingdate" id="dippingdate" value="{{ date('m-d-Y')}}">  
                </div>
                <div class="input-group col-lg-12">
                    <button class="btn btn-primary" type="submit" id="add">Save</button> 
                </div>
            </div>
        </div>
    </div> 
    <div class="col-md-4 col-lg-8 col-sm-12 col-xs-12">
        <div class="x_panel">
            <h4>Petrol Tank Dipping</h4>
            <!-- /widget-header -->
            <div class="widget-content">
                @if (session('success'))
                    
                    <div class="alert alert-success alert-dismissible fade in" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                    <tr>
                        
                        <th>Petrol Name</th>
                        <th>Open Volume <em class="cubic">( Cubic Meter )</em></th>
                        <th>Close Volume <em  class="cubic">( Cubic Meter )</em></th>
                        <th>Consume Volume <em  class="cubic">( Cubic Meter )</em></th>
                        <th>Action </th>
                    </tr>
                    </thead>
                    <tbody>
                
                    @forelse($dippingDate as $Dipping)
                    <tr class="dippingitem{{$Dipping->id}}">
                        
                        <td>{{$Dipping->gas->gasname}}</td>
                        <td>{{$Dipping->dipopenvolume}} <em class="cubic"> Liters</em></td>
                        <td>{{$Dipping->dipclosevolume}} <em class="cubic"> Liters</em></td>
                        <td>{{$Dipping->dipvolume}} <em class="cubic"> Liters</em></td>
                        <td>
                            <button class='delete-modal btn btn-xs btn-danger' data-id='{{$Dipping->id}}'><i class='fa fa-remove'></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr id="norecord"><td colspan="5" style="text-align:center;"><em>No Records </em></td></tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            
            <a href="/admin/branches/dipping/save/{{$BranchId}}" class="btn btn-sm btn-success">Save</a>
            
            
            <!-- /widget-content --> 
        </div>            
    <!-- /container --> 
    </div>
</div>    
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            
            <!-- /widget-header -->
            <div class="widget-content">
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-lg-4">
                        <div class="x_panel tile">
                        <div class="x_title">
                        <h4>Petrolium Products</h4>
                        </div>
                            <div class="clearfix"></div>
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
                                <div class="progress-bar {{$tankprogress}}" data-transitiongoal="{{$tankwidth}}" aria-valuenow="{{$tankwidth}}" style="width: {{$tankwidth}}%;">{{number_format($Branchgas->volume,2)}} <em class="cubic"> Liters</div>
                            </div>
                            @endforeach
                            </div><!--x_content-->
                        </div><!--x_panel-->   
                    </div><!--col-->
                    <div class="col-md-6 col-sm-12 col-lg-8">
                    <div class="x_panel tile">
                        <div class="x_title">
                            <h4>Dipping History</h4>
                        </div>
                        <div class="clearfix"></div>
                        <div class="x_content">
                        <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <?php $countHeader = 0;?>  
                        @foreach($dataBranchgas as $Branchgas)  
                                <h4></h4>
                                <?php 
                                if($countHeader == 0) {
                                    $addClassHeader ='active'; 
                                }
                                else {
                                    $addClassHeader ='';
                                }
                                ?>
                                <li role="presentation" class="{{$addClassHeader}}"><a href="#{{$Branchgas->gas['gasname']}}" id="{{$Branchgas->gas['gasname']}}-tab" role="tab" data-toggle="tab" aria-expanded="true">{{$Branchgas->gas['gasname']}}</a>
                                </li>  
                                <?php $countHeader = $countHeader + 1;?>   
                        @endforeach
                        
                        <!-- <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="false">Profile</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Profile</a>
                        </li> -->
                      </ul>
                      <div id="myTabContent" class="tab-content">
                      <?php $count = 0;?>  
                        @foreach($dataBranchgas as $Branchgas)
                                <?php 
                                if($count == 0) {
                                    $addClass ='active in'; 
                                }
                                else {
                                    $addClass ='';
                                }
                                ?>
                            <div role="tabpanel" class="tab-pane fade {{$addClass}}" id="{{$Branchgas->gas['gasname']}}" aria-labelledby="home-tab">
                                <table class="table table-striped table-bordered">
                                   <tr>
                                        <td>Date</td>
                                        <td>Open Dipping <em class="cubic">( Liters )</em></td>
                                        <td>Close Dipping <em class="cubic">( Liters )</em></td>
                                        <td>Volume Consume <em class="cubic">( Liters )</em></td>
                                   </tr>
                                @forelse($BranchGasDipping as $DippingRecord)
                                    @if($DippingRecord->gasid == $Branchgas->gasid)
                                    <tr>
                                        <td>{{$DippingRecord->dippingdate}} </td>
                                        <td>{{$DippingRecord->dipopenvolume}} <em class="cubic"> Liters</em></td>
                                        <td>{{$DippingRecord->dipclosevolume}} <em class="cubic"> Liters</em></td>
                                        <td>{{$DippingRecord->dipvolume}} <em class="cubic"> Liters</em></td>
                                    </tr>
                                    @endif
                                @empty
                                <tr>
                                    <td colspan="4">
                                    <em>No Record</em>
                                    </td>
                                </tr>
                                @endforelse
                                </table>
                            </div> 
                            <?php $count = $count + 1;?> 
                        @endforeach
                        
                        
                      </div>
                    </div>
                        </div><!--x_content-->
                    </div><!--x_panel-->   
                </div><!--col-->
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
<script src="{{ asset('js/branchdippingscript.js') }}"></script>
<!-- /main -->
@endsection