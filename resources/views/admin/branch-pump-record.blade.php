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

    </div>    
    <div class="col-md-8 col-lg-8 col-sm-12 col-xs-12 dailyrecord" id="dailyrecord">
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
                 <table class="table table-striped " id="table">
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
                    <?php $totalAmount =0 ;?>
                    @forelse($dataPumplogs as $Pumplog)
                    <tr class="item{{$Pumplog->id}}">
                        
                        <td>{{$Pumplog->pump->pumpname}}</td>
                        <td>{{$Pumplog->openvolume}}</td>
                        <td>{{$Pumplog->closevolume}}</td>
                        <td>{{$Pumplog->consumevolume}}</td>
                        <td>{{number_format($Pumplog->unitprice, 2)}}</td>
                        <td>{{number_format($Pumplog->amount,2)}}</td>
                        <?php 
                            $totalAmount = $totalAmount + $Pumplog->amount;
                        ?>
                    </tr>
                    @empty
                    <tr><td><em>No Data</em></td></tr>
                    @endforelse
                    <tr><td colspan="5" class="text-right">Total</td><td><strong>{{number_format($totalAmount, 2)}}</strong></td></tr>
                    <tr><td colspan="6"> <button onclick="window.print();" class="btn btn-info btn-small">Print</button></td></tr>
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

<script>
function PrintElem(elem)
{
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');

    mywindow.document.write('<html><head><title> Print Record</title>');
    mywindow.document.write('</head><body >');
    mywindow.document.write('<h1>' + document.title  + '</h1>');
    mywindow.document.write(document.getElementById(dailyrecord).innerHTML);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/

    mywindow.print();
    mywindow.close();

    return true;
}
<script src="{{ asset('js/branchpump.js') }}"></script>
<!-- /main -->
@endsection