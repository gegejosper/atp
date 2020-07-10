@extends('layouts.incharge')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="x_panel">
            <div class="x_content">
            <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        From
                        <address>
                        <img src="{{ asset('img/logo.png') }}" alt="" style="width:50px;">
                            
                            <br><strong>ATP Caltex Station</strong>
                            <br>Purok La Joma,
                            <br>San Jose, Aurora
                            <br>Zamboanga Del Sur
                            
                        </address>
                    </div>

                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong>{{ucwords($dataAccount->lname)}}, {{ucwords($dataAccount->fname)}} {{ucwords($dataAccount->mname)}}</strong>
                            <br>Address: {{ucwords($dataAccount->address)}}
                            <br>Phone: {{$dataAccount->contactnum}}
                            
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-lg-4 invoice-col">
                        
                        
                    </div>
            </div>
                <section class="content invoice">
                    <!-- Table row -->
                    <div class="row">
                    <div class="col-xs-12 table">
                        <table class="table table-striped" id="table">
                            <thead>
                            <tr>
                                <th> Date</th>             
                                <th> Bill #</th>
                                <th> Payment  </th>
                                <th> Balance </th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($accountBill as $Bills)
                            <tr class="item{{$Bills->id}}">
                                <td>{{$Bills->created_at}}</td>
                                <td><a href="/incharge/bill/{{$Bills->billid}}">{{$Bills->bill->billnum}}</a></td>
                                <td>{{number_format($Bills->payment,3)}}</td>
                                <td>{{number_format($Bills->balance,3)}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" align="center"><em>No Bill Record</em></td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                    </div>
                   
                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                    <div class="col-xs-12">
                        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                    </div>
                    </div>
                </section>
        
            </div>
        </div>
    </div><!--row-->
</div>

<script src="{{ asset('js/app.js') }}"></script>
@endsection