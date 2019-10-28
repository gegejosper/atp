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
        <div class="col-lg-6">
            <form class="form-horizontal" action="{{ route('generatebill')}}" method="post">
            {{ csrf_field() }}
                <fieldset>
                    <div class="control-group">
                    <div class="controls">             
                        <div class="row-">
                            <div class="col-lg-6">
                                <div class="input-prepend input-group">
                                    <span class="add-on input-group-addon"><i class="glyphicon glyphicon-calendar fa fa-calendar"></i></span>
                                    <input type="text" style="width: 200px" name="billdate" id="reservation" class="form-control" value="{{date('m-01-Y')}} - {{date('m-15-Y')}}">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <button type="submit" class="form-control btn btn-success"> Generate Bill</button>
                                </div>
                            </div>
                        </div>   
                    </div>
                    </div>
                </fieldset>
            </form>
        </div>
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
                    <td><a href="/billing/account/{{$Account->account->id}}">{{$Account->account->id}}</a></td>
                    <td><a href="/billing/bill/{{$Account->id}}">{{$Account->billnum}}</a></td>
                    <td><a href="/billing/account/{{$Account->account->id}}">{{$Account->account->lname}}, {{$Account->account->fname}} {{$Account->account->mname}}</a></td>
                    <td>{{number_format($Account->balance,3)}}</td>
                    <td>{{number_format($Account->amount, 3)}}</td>
                    <td>{{ucwords($Account->billstatus)}}</td>
                    
                    <td class='td-actions'>
                        <a href="/billing/bill/{{$Account->id}}" class='btn btn-info btn-small'><i class='fa fa-search'></i></a>
                        <a href="/billing/account/{{$Account->account->id}}" class='btn btn-info btn-small'><i class='fa fa-folder'></i></a>
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