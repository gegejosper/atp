@extends('layouts.billing')

@section('content')

<div class="right_col" role="main">
    <div class="row">
        <div class="x_panel">
            <div class="x_content">
            @foreach($accountBill as $Bill)
                <section class="content invoice">
                    <!-- title row -->
                    <!-- info row -->
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
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        To
                        <address>
                            <strong>{{ucwords($Bill->account->lname)}}, {{ucwords($Bill->account->fname)}} {{ucwords($Bill->account->mname)}}</strong>
                            <br>{{ucwords($Bill->account->address)}}
                            <br>Phone: 1 (804) 123-9876
                            <br>Email: jon@ironadmin.com
                        </address>
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 invoice-col">
                        <b>Bill #: {{$Bill->billnum}}</b>
                        <br>
                        <b>Date:</b> {{$Bill->billdate}}
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- Table row -->
                    <div class="row">
                    <div class="col-xs-12 table">
                        <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>Qty</th>
                            <th>Product</th>
                            <th>Serial #</th>
                            <th style="width: 59%">Description</th>
                            <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                        </table>
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="row">
                    <!-- accepted payments column -->
                    <div class="col-xs-6">
                        <p class="lead">Payment Methods:</p>
                        <img src="images/visa.png" alt="Visa">
                        <img src="images/mastercard.png" alt="Mastercard">
                        <img src="images/american-express.png" alt="American Express">
                        <img src="images/paypal.png" alt="Paypal">
                        <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                        Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                        </p>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-6">
                        <p class="lead">Amount Due 2/22/2014</p>
                        <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>$250.30</td>
                            </tr>
                            <tr>
                                <th>Tax (9.3%)</th>
                                <td>$10.34</td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td>$5.80</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>$265.24</td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <!-- this row will not appear when printing -->
                    <div class="row no-print">
                    <div class="col-xs-12">
                        <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i> Print</button>
                        <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit Payment</button>
                        <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i class="fa fa-download"></i> Generate PDF</button>
                    </div>
                    </div>
                </section>
            @endforeach
            </div>
        </div>
    </div><!--row-->
</div>

<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dashboardscript.js') }}"></script>

@endsection