@extends('layouts.incharge')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-6 col-sm-12 col-lg-6">
            <div class="x_panel tile">
                <div class="x_title">
                    <h3>Daily Report</h3>
                    
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped">
                    <tr>
                    <td>Date</td>
                    <td>Record Code</td>
                    <td>Processor</td>
                    <td>Action</td>
                    </tr>
                    @foreach($dataBranchReport as $Report)
                    <tr>
                        <td><a href="/incharge/viewrecord/{{$Report->sessionrecord}}">{{$Report->reportdate}}</a></td>
                        <td><a href="/incharge/viewrecord/{{$Report->sessionrecord}}">{{$Report->sessionrecord}}</a></td>
                        <td>{{$Report->user->name}}</td>
                        <td>
                        <a href="/incharge/viewrecord/{{$Report->sessionrecord}}" class="btn btn-info"><i class="fa fa-search"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div><!--x_content-->
        </div><!--col-->
        
    </div><!--row-->
</div>
@endsection