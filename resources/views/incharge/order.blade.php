@extends('layouts.incharge')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
<div class="row">
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
                        <td><a href="/incharge/order/history/{{$puchase->purchasenumber}}">{{$puchase->purchasenumber}}</a></td>
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

