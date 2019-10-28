@extends('layouts.incharge')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        
        <div class="col-lg-12">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                    @php
                    Session::forget('success');
                    @endphp
                </div>
                <a href="/incharge/payments" class="btn btn-success">Back</a>
            @endif
        </div>
        
        <div class="col-md-6 col-sm-12 col-lg-6">
        @foreach($accountBill as $Bill)
            <div class="x_panel tile">
                <div class="x_title">
                <h4>Bill #: {{$Bill->billnum}} | Bill Date - {{$Bill->billdate}}</h4>
                </div>
                <div class="clearfix"></div>
           
            <div class="x_content">
            
            <table class="table">
                <tbody>
                <tr>
                    <th style="width:50%">Total Amount Due:</th>
                    <td>{{number_format($Bill->amount,3)}}</td>
                </tr>
                <tr>
                    <th>Less Discount: </th>
                    <td>{{number_format($Bill->discount,3)}}</td>
                </tr>
                <tr>
                    <th>Amount Due :</th>
                    <td>{{number_format($Bill->totalamount,3)}}</td>
                </tr>
                <tr>
                    <th>Balance :</th>
                    <td>{{number_format($Bill->balance,3)}}</td>
                </tr>
                <tr>
                    <th>Status :</th>
                    <td>{{ucwords($Bill->billstatus)}}</td>
                </tr>
                
                </tbody>
            </table>
            @if($Bill->billstatus == 'not paid')
            <form class="form-horizontal" action="{{ route('processpayment')}}" method="post">
            {{ csrf_field() }}
                <fieldset>
                    <div class="control-group">
                    <div class="controls">             
                        <div class="input-group">
                            <input type="text" class="form-control" name="paymentadd" id="paymentadd" placeholder="Enter amount to pay">
                            <input type="hidden" class="form-control" name="paymentbillid" id="paymentbillid" value="{{$Bill->id}}">
                            <span class="input-group-btn">
                              <button type="submit" class="btn btn-primary">Submit Payment</button>
                            </span>
                          </div>
                    </div>
                    </div>
                </fieldset>
            </form> 
            @endif 
            @endforeach      
            </div><!--x_content-->
            </div>
        </div><!--col-->
        
    </div><!--row-->
</div>
@endsection