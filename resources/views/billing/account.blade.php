@extends('layouts.billing')

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
        <div class="x_panel">
            <div class="x_title">
                <h5>Account Details</h5>
                
                <div class="clearfix"></div>
            </div>
            <div class="col-lg-3">
                <div>
                    <div class="">
                        <img src="{{ asset('img/user.png') }}" alt="..." class="img-circle profile_img">
                    </div>
                </div>
                @foreach($dataAccount as $Account)
                <table class="table table-striped" style="margin-top:10px;">
                    <tr>
                        <td>Account: <strong>{{$Account->lname}}, {{$Account->fname}} {{$Account->mname}}</strong></td>
                    </tr>
                    <tr>
                        <td>Address: <strong>{{$Account->address}}</strong></td>
                    </tr>
                    <tr>
                        <td>Tax: <strong>{{$Account->tax}}</strong></td>
                    </tr>
                    <tr>
                        <td>Discount: <strong>{{$Account->discount}}</strong></td>
                    </tr>
                </table>
                @endforeach
            </div>
            <div class="col-lg-9">
                <div class="x_content">
                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#tab_recentbill" id="recentbill-tab" role="tab" data-toggle="tab" aria-expanded="true">Recent Bill</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_bill" role="tab" id="bill-tab" data-toggle="tab" aria-expanded="false">Bill History</a>
                            </li>
                            <li role="presentation" class=""><a href="#tab_payment" role="tab" id="payment-tab" data-toggle="tab" aria-expanded="false">Payment History</a>
                            </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">
                            <div role="tabpanel" class="tab-pane fade active in" id="tab_recentbill" aria-labelledby="recentbill-tab">
                                <table class="table table-striped" id="table">
                                    <thead>
                                    <tr>
                                        <th> Bill Date</th>             
                                        <th> Bill #</th>
                                        <th> Balance </th>
                                        <th> Amount </th>
                                        <th> Status </th>
                                        <th> Action </th>
                                        <th> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($recentBill as $Account)
                                    <tr class="item{{$Account->id}}">
                                        <td>{{$Account->billdate}}</td>
                                        <td><a href="/billing/bill/{{$Account->id}}">{{$Account->billnum}}</a></td>
                                        <td>{{number_format($Account->balance,3)}}</td>
                                        <td>{{number_format($Account->amount,3)}}</td>
                                        <td>{{ucwords($Account->billstatus)}}</td>
                                        
                                        <td class='td-actions'>
                                            <a href="/billing/bill/{{$Account->id}}" class='btn btn-info btn-small'><i class='fa fa-search'></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" align="center"><em>No Bill Record</em></td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_bill" aria-labelledby="bill-tab">
                                <table class="table table-striped" id="table">
                                    <thead>
                                    <tr>
                                        <th> Bill Date</th>             
                                        <th> Bill #</th>
                                        <th> Balance </th>
                                        <th> Amount </th>
                                        <th> Status </th>
                                        <th> Action </th>
                                        <th> </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($historyBill as $AccountHistory)
                                    <tr class="item{{$AccountHistory->id}}">
                                        <td>{{$AccountHistory->billdate}}</td>
                                        <td><a href="/billing/bill/{{$AccountHistory->id}}">{{$AccountHistory->billnum}}</a></td>
                                        <td>{{number_format($AccountHistory->balance,3)}}</td>
                                        <td>{{number_format($AccountHistory->amount,3)}}</td>
                                        <td>{{ucwords($AccountHistory->billstatus)}}</td>
                                        
                                        <td class='td-actions'>
                                            <a href="/billing/bill/{{$AccountHistory->id}}" class='btn btn-info btn-small'><i class='fa fa-search'></i></a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" align="center"><em>No Bill Record</em></td>
                                    </tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div role="tabpanel" class="tab-pane fade" id="tab_payment" aria-labelledby="payment-tab">
                            das
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!--row-->
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dashboardscript.js') }}"></script>

@endsection