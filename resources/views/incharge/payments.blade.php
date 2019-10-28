@extends('layouts.incharge')

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
        <div class="x_content">
            <table class="table table-striped" id="table">
                <thead>
                <tr>
                    <th> Bill Date</th>
                    <th> Account #</th>                  
                    <th> Bill #</th>
                    <th> Name</th>
                    <th> Balance </th>
                    <th> Amount </th>
                    <th> Status </th>
                    <th> Action </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($accountBill as $Account)
                <tr class="item{{$Account->id}}">
                    <td>{{$Account->billdate}}</td>
                    <td><a href="/incharge/account/{{$Account->account->id}}">{{$Account->account->id}}</a></td>
                    <td><a href="/incharge/bill/{{$Account->id}}">{{$Account->billnum}}</a></td>
                    <td><a href="/incharge/account/{{$Account->account->id}}">{{$Account->account->lname}}, {{$Account->account->fname}} {{$Account->account->mname}}</a></td>
                    <td>{{number_format($Account->balance,3)}}</td>
                    <td>{{number_format($Account->amount, 3)}}</td>
                    <td>{{ucwords($Account->billstatus)}}</td>
                    
                    <td class='td-actions'>
                        <a href="/incharge/pay/{{$Account->id}}" class='btn btn-info btn-small'><i class='fa fa-shopping-cart'></i> Pay</a>
                        <a href="/incharge/bill/{{$Account->id}}" class='btn btn-info btn-small'><i class='fa fa-search'></i> View Bill</a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
            {{ $accountBill->links() }}
        </div>
    </div><!--row-->
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dashboardscript.js') }}"></script>

@endsection