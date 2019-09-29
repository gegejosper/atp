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
        <div class="x_content">
            <table class="table table-striped" id="table">
                <thead>
                <tr>
            
                    <th> Account Number</th>
                    <th> Name</th>
                    <th> Balance </th>
                    <th> Action </th>
                    <th> </th>
                </tr>
                </thead>
                <tbody>
                @foreach($dataAccount as $Account)
                <tr class="item{{$Account->id}}">
                    
                    <td><a href="/billing/account/{{$Account->id}}">{{$Account->id}}</a></td>
                    <td><a href="/billing/account/{{$Account->id}}">{{$Account->lname}}, {{$Account->fname}} {{$Account->mname}}</a></td>
                    <td></td>
                    
                    <td class='td-actions'>
                        <a href="/billing/bill/{{$Account->id}}" class='btn btn-info btn-small'><i class='fa fa-search'></i></a>
                        <a href="/billing/account/{{$Account->id}}" class='btn btn-info btn-small'><i class='fa fa-folder'></i></a>
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div><!--row-->
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dashboardscript.js') }}"></script>

@endsection