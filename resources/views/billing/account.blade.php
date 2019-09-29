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
        </div>
    </div><!--row-->
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dashboardscript.js') }}"></script>

@endsection