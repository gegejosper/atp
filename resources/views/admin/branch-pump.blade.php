@extends('layouts.admin')

@section('content')
<div class="right_col" role="main">
<div class="row"> 
<div class="page-title">
        <div class="title_left">
        <h3>
            @foreach($Branches as $Branch)
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
    <div class="col-md-4 lg-4 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>Recent Pump Reading
                </h4>
                <div class="clearfix"></div>
            </div>
        
            <div class="x_content">
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                    <tr>
                        <th> Date</th>
                        <th> Batch Code </th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($dataPumpReading as $PumpReading)
                        <tr>
                        <td>{{$PumpReading->readingdate}}</td>
                            <td><a href="/admin/branches/pumps/logs/{{$PumpReading->branchid}}/{{$PumpReading->batchcode}}">{{$PumpReading->batchcode}}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="x_panel">
            <div class="x_title">
                <h4>Add Pump   
                </h4>
                <div class="clearfix"></div>
            </div>
           
            <div class="x_content">
                {{ csrf_field() }}                              
                <div class="input-group col-lg-12">
                    <input type="text" class="form-control" placeholder="Pump Name"  aria-describedby="basic-addon2" name="pumpname" id="pumpname">
                    <input type="hidden" name="branchid" value="{{$BranchId}}">
                </div>
                <div class="input-group col-lg-12">
                    <select name="gastype" id="" class="form-control">
                        @foreach($dataGastype as $Gastype)
                            <option value="{{$Gastype->id}}">{{$Gastype->gasname}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group col-lg-12">
                    <button class="btn btn-primary" type="submit" id="add">Save</button> 
                </div>
                <h4>Pumps</h4>
                <table class="table table-striped table-bordered" id="tablepump">
                    <thead>
                    <tr>
                
                        
                        <th> Name</th>
                        <th> Petrol Type </th>
                        <th> Volumetric</th>
                        <th> Action </th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataPump as $Pump)
                    <tr class="item{{$Pump->id}}">
                       
                        <td>{{$Pump->pumpname}}</td>
                        <td>{{$Pump->gastype->gasname}}</td>
                        <td>{{number_format($Pump->volume,2)}} <em>ltrs</em> </td>
                        <td>
                            <button class='edit-modal btn btn-xs btn-success' data-id='{{$Pump->id}}' data-name='{{$Pump->pumpname}}' data-volume='{{$Pump->volume}}' data-gasname='{{$Pump->gastype->gasname}}'><i class='fa fa-pencil'></i></button>
                            <a class='delete-modal btn btn-danger btn-xs' data-id='{{$Pump->id}}'><i class='fa fa-times'></i></a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>

    </div>    
    <div class="col-md-8 col-lg-8  col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
            <h4>Pump Daily Reading  
                
            </h4>
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                    Session::forget('success');
                    @endphp
                </div>
            @endif
            <div class="clearfix"></div>
            </div>
            <div class="x_content">
            <form action="{{ route('savepumplog') }}" method="post">
            <input type="hidden" name="branchid" class="form-control" id="branchid" value="{{$BranchId}}">
            {{ csrf_field() }}
            <table class="table table-striped table-bordered" id="table">
                    <thead>
                    <tr>
                
                        <th> Name</th>
                        <th> Opening</th>
                        <th> Closing</th>
                        <th> Volume </th>
                        <th> Unit Price </th>
                        <th> Amount </th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($dataPump as $Pump)
                    <tr class="item{{$Pump->id}}">
                        
                        <td>{{$Pump->pumpname}}</td>
                        <td>
                        <input type="hidden" name="pumpid[]" class="form-control" id="pump{{$Pump->id}}" value="{{$Pump->id}}">
                        <input type="hidden" name="gasid[]" class="form-control" id="gasid{{$Pump->gasid}}" value="{{$Pump->gasid}}">
                        
                        <?php if($Pump->pumplog != null) {?>
                            
                                <input type="text" name="openvolume[]" class="form-control" id="openvolume{{$Pump->id}}" value="{{$Pump->pumplog['closevolume']}}" readonly></td>
                            
                        <?php }
                        else{
                        ?>
                            <input type="text" name="openvolume[]" class="form-control" id="openvolume{{$Pump->id}}" value="0" readonly></td>
                        
                        <?php }?>
                        <td><input type="text" name="closevolume[]" class="form-control" id="closevolume{{$Pump->id}}" ></td>
                        <td><input type="text" name="consumevolume[]" class="form-control" id="consumevolume{{$Pump->id}}" readonly></td>
                        <td>
                        @foreach($dataBranchgas as $branchDetails)
                            @if($branchDetails->gasid == $Pump->gasid && $branchDetails->branchid == $Pump->branchid)
                            <input type="text" name="unitprice[]" class="form-control" id="unitprice{{$Pump->id}}" value="{{$branchDetails->price}}" readonly></td>
                            @endif
                        @endforeach
                        <td><input type="text" name="amount[]" class="form-control" id="amount{{$Pump->id}}" readonly></td>
                    </tr>
                    @empty
                    
                    @endforelse
                    <tr><td colspan="6"> <button type="submit" class="btn btn-info btn-small">Save</button></td></tr>
                    </tbody>
                </table>
            </div>
        </div>   
    </div>   
           
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
                                  <input type="hidden" class="form-control" id="gasname">
  							</div>
  						</div>
  						<div class="form-group align-left">
  							<label class="col-sm-12 " for="pump_name" >Pump Name:</label>
  							<div class="col-sm-12">
  								<input type="text" class="form-control" id="pumpedit_name" name="pumpedit_name">
                            </div>
                        </div>
                        <div class="form-group align-left">
  							<label class="col-sm-12 " for="volume" >Volume ( <em style="font-weight:normal;">Liters</em> )</label>
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
@foreach($dataPump as $Pump)
<script>
$(function() {
    $('#closevolume{{$Pump->id}}').keyup(function() {  
        updateTotal();
    });
    const updateTotal = function () {
      let closevalue = parseFloat($('#closevolume{{$Pump->id}}').val()).toFixed(2);
      let openvalue = parseFloat($('#openvolume{{$Pump->id}}').val()).toFixed(2);
      let consumevolume = closevalue - openvalue;
      $('#consumevolume{{$Pump->id}}').val(parseFloat(consumevolume).toFixed(2));
      let unitprice = parseFloat($('#unitprice{{$Pump->id}}').val()).toFixed(2);
      let amount = consumevolume * unitprice;
      $('#amount{{$Pump->id}}').val(parseFloat(amount).toFixed(2));
    };
 });
</script>
@endforeach
<script src="{{ asset('js/branchpump.js') }}"></script>
<!-- /main -->
@endsection