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
        <div class="col-md-6 col-sm-12 col-lg-4">
            <div class="x_panel tile">
                <div class="clearfix"></div>
                <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#tab-credit" id="credit-tab" role="tab" data-toggle="tab" aria-expanded="true">Credit</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab-discount" role="tab" id="discount-tab" data-toggle="tab" aria-expanded="false">Discount</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab-sales" role="tab" id="sales-tab" data-toggle="tab" aria-expanded="false">Sales</a>
                        </li>
                        <li role="presentation" class=""><a href="#tab-others" role="tab" id="others-tab" data-toggle="tab" aria-expanded="false">Others</a>
                        </li>
                      </ul>
                      <div id="myTabContent" class="tab-content">
                        <div role="tabpanel" class="tab-pane fade active in" id="tab-credit" aria-labelledby="credit-tab">
                            @csrf
                            <div class="input-group col-lg-12">
                                <label for="Invoice">Invoice No.</label>
                                <input type="text" class="form-control"  aria-describedby="basic-addon2" name="creditinvoicenum" id="creditinvoicenum" value="">  
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Account">Account</label>
                                <select name="accountcredit" id="accountcredit" class="js-example-basic-single form-control" type="text">
                                    <option value="0"></option>
                                    @foreach($dataAccount as $Account)
                                        <option value="{{$Account->lname}}, {{$Account->fname}},  {{ $Account->id }}">{{$Account->lname}}, {{$Account->fname}} </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Volume">Product</label>
                                <!-- <select name="branchgas" id="branchgas" class="form-control">
                                    @foreach($dataGas as $Gas)
                                        <option value="{{ $Gas->gasname }}, {{ $Gas->id }}">{{ $Gas->gasname }}</option>
                                    @endforeach
                                </select> -->
                                <select name="branchgas" id="branchgas" class="form-control branchgascredit">
                                    @foreach($dataBranchgas as $branchGas)
                                        <option value="{{ $branchGas->gas->gasname }}, {{ $branchGas->gas->id }}, {{ $branchGas->price }}">{{ $branchGas->gas->gasname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Unit Price">Unit Price</label>
                                <input type="text" class="form-control" placeholder="Unit Price"  aria-describedby="basic-addon2" name="creditunitprice" id="creditunitprice">
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Plate">Plate #</label>
                                <input type="text" class="form-control" placeholder="Plate #"  aria-describedby="basic-addon2" name="creditplatenum" id="creditplatenum">
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Liters">Liters</label>
                                <input type="text" class="form-control" placeholder="Liters"  aria-describedby="basic-addon2" name="creditliters" id="creditliters">
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Volume">Amount</label>
                                <input type="text" class="form-control" placeholder="Amount"  aria-describedby="basic-addon2" name="creditamount" id="creditamount">
                            </div>
                            
                            <div class="input-group col-lg-12">
                                <label for="Date">Date</label>
                                <input type="text" class="form-control"  aria-describedby="basic-addon2" name="creditdate" id="creditdate" value="{{ date('m-d-Y')}}">  
                            </div>
                            <div class="input-group col-lg-12">
                                <button class="btn btn-primary" type="submit" id="creditadd">Add</button> 
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-discount" aria-labelledby="discount-tab">

                            <div class="input-group col-lg-12">
                            @csrf
                                <select name="accountdis" id="accountdis" class="js-example-basic-single form-control" type="text">
                                    @foreach($dataAccount as $Account)
                                        <option value="{{$Account->lname}}, {{$Account->fname}},  {{ $Account->id }}">{{$Account->lname}}, {{$Account->fname}} </option>
                                    @endforeach
                                    <option value="0">Save Plus</option>  
                                </select>
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Product">Product</label>
                                <select name="branchgasdis" id="branchgasdis" class="form-control">
                                    @foreach($dataGas as $Gas)
                                        <option value="{{ $Gas->gasname }}, {{ $Gas->id }}">{{ $Gas->gasname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Plate">Plate #</label>
                                <input type="text" class="form-control" placeholder="Plate #"  aria-describedby="basic-addon2" name="displatenum" id="displatenum">
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Amount">Amount</label>
                                <input type="text" class="form-control" placeholder="Amount"  aria-describedby="basic-addon2" name="disamount" id="disamount">
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Date">Date</label>
                                <input type="text" class="form-control"  aria-describedby="basic-addon2" name="disdate" id="disdate" value="{{ date('m-d-Y')}}">  
                            </div>
                            <div class="input-group col-lg-12">
                                <input type="hidden" name="branchid" class="form-control" id="branchid" value="{{$BranchId}}">
                                <button class="btn btn-primary" type="submit" id="discountadd">Add</button> 
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-sales" aria-labelledby="sales-tab">
                            <div class="input-group col-lg-12">
                                <label for="Invoice">Invoice No.</label>
                                <input type="text" class="form-control"  aria-describedby="basic-addon2" name="saleinvoicenum" id="saleinvoicenum" value="">  
                            </div>
                            
                            <div class="input-group col-lg-12">
                                <label for="Product">Product</label>
                                <select name="salebranchproduct" id="salebranchproduct" class="form-control salebranchproduct">
                                    @foreach($dataProduct as $Product)
                                        <option value="{{ $Product->product->productname }}, {{ $Product->product->id }}, {{ $Product->price }}">{{ $Product->product->productname }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Price">Price</label>
                                <input type="text" class="form-control"  aria-describedby="basic-addon2" name="saleprice" id="saleprice" value="">  
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Quantity">Quantity</label>
                                <input type="text" class="form-control"  aria-describedby="basic-addon2" name="salequantity" id="salequantity" value="">  
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Amount">Amount</label>
                                <input type="text" class="form-control"  aria-describedby="basic-addon2" name="saleamount" id="saleamount" value="">  
                            </div>
                            <div class="input-group col-lg-12" id="paymentoption">
                                <label for="Payment">Payment</label>
                                <div class="form-check form-check-inline">
                                    <input type="radio" checked name="payment" class="paymenttype"  value="CASH">
                                    <label class="form-check-label" for="inlineRadio1">Cash</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio"  class="paymenttype" name="payment" value="CREDIT">  
                                    <label class="form-check-label" for="inlineRadio2">Credit</label>
                                </div>
                                
                                <select name="accountsale" id="accountsale" class="js-example-basic-single form-control" type="text">
                                    @foreach($dataAccount as $Account)
                                        <option value="{{$Account->lname}}, {{$Account->fname}},  {{ $Account->id }}">{{$Account->lname}}, {{$Account->fname}} </option>
                                    @endforeach
                                </select>
                                 
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Date">Date</label>
                                <input type="text" class="form-control"  aria-describedby="basic-addon2" name="salesdate" id="salesdate" value="{{ date('m-d-Y')}}">  
                            </div>
                            <div class="input-group col-lg-12">
                                <button class="btn btn-primary" type="submit" id="salesadd">Add</button> 
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane fade" id="tab-others" aria-labelledby="others-tab">
                            <div class="input-group col-lg-12">
                                <label for="Description">Description</label>
                                <input type="text" class="form-control" placeholder="Description"  aria-describedby="basic-addon2" name="description" id="description">
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Amount">Amount</label>
                                <input type="text" class="form-control" placeholder="Amount"  aria-describedby="basic-addon2" name="descamount" id="amount">
                            </div>
                            <div class="input-group col-lg-12">
                                <label for="Date">Date</label>
                                <input type="text" class="form-control"  aria-describedby="basic-addon2" name="descdate" id="descdate" value="{{ date('m-d-Y')}}">  
                            </div>
                            <div class="input-group col-lg-12">
                                <button class="btn btn-primary" type="submit" id="othersadd">Add</button> 
                            </div>
                        </div>
                      </div>
                    </div>
            </div>
        </div><!--col-->
        <div class="col-md-6 col-sm-12 col-lg-8">
            <div class="x_panel tile">        
                <div class="col-md-12 col-sm-12 col-lg-12">
                        <ul class="nav navbar-right panel_toolbox dashboard-panel">
                            <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                            </li>
                        </ul> 
                        <div class="x_title">
                            <h4>Credit</h4>
                        </div>
                    <div class="x_content">
                    <table class="table table-striped" id="credittable">
                    <thead>
                    <tr>
                    <td>Invoice #</td>
                    <td>Account</td>
                    <td>Product</td>
                    <td>Plate #</td>
                    <td>Liters</td>
                    <td>Unit Price</td>
                    <td>Amount</td>
                    </tr>
                    </thead>
                    @forelse($dataBranchcredit as $Branchcredit)
                    <tr class='credititem{{$Branchcredit->id}}'>
                    <td>{{$Branchcredit->invoice}}</td>
                    <?php 
                        $accountname = explode(",",$Branchcredit->account);
                        $gasname = explode(",",$Branchcredit->gasname);
                    ?>
                    <td>{{$accountname[0]}}, {{$accountname[1]}}</td>
                    <td>{{$gasname[0]}}</td>
                    <td>{{$Branchcredit->creditplatenum}}</td>
                    <td>{{$Branchcredit->liters}}</td>
                    <td>{{$Branchcredit->unitprice}}</td>
                    <td>{{$Branchcredit->amount}}</td>
                    <td><a class='delete-credit btn btn-danger btn-xs' data-id='{{$Branchcredit->id}}'><i class='fa fa-times'></i></a></td>
                    </tr>
                    @empty
                    <tr>
                    <td colspan="7" id="nocreditrecord"><em>No Record</em></td>
                    </tr>
                    
                    @endforelse
                    </table>
                    </div><!--x_content-->
                </div><!--col-->
               
            </div>
            <div class="x_panel tile">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <ul class="nav navbar-right panel_toolbox dashboard-panel">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul> 
                    <div class="x_title">
                        <h4>Discount</h4>
                    </div>
                    <div class="x_content">
                    <table class="table table-striped" id="discounttable">
                    <thead>
                    <tr>
                    
                    <td>Account</td>
                    <td>Product</td>
                    <td>Plate #</td>
                    
                    <td>Amount</td>
                    </tr>
                    </thead>
                    @forelse($dataBranchdiscount as $Branchdiscount)
                    <tr class='discountitem{{$Branchdiscount->id}}'>
                    
                    <?php 
                        $disaccountname = explode(",",$Branchdiscount->account);
                        $disgasname = explode(",",$Branchdiscount->gasname);
                    ?>
                    <td>{{$disaccountname[0]}}, {{$disaccountname[1]}}</td>
                    <td>{{$disgasname[0]}}</td>
                    <td>{{$Branchdiscount->platenum}}</td>
                    <td>{{$Branchdiscount->amount}}</td>
                    <td><a class='delete-discount btn btn-danger btn-xs' data-id='{{$Branchdiscount->id}}'><i class='fa fa-times'></i></a></td>
                    </tr>
                    @empty
                    <tr>
                    <td colspan="6" id="nodiscountrecord"><em>No Record</em></td>
                    </tr>
                    
                    @endforelse
                    </table>
                    </div><!--x_content-->
                </div><!--col-->
            </div>
            <div class="x_panel tile">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <ul class="nav navbar-right panel_toolbox dashboard-panel">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul> 
                    <div class="x_title">
                        <h4>Sales</h4>
                    </div>
                    <div class="x_content">
                    <table class="table table-striped" id="saletable">
                    <thead>
                    <tr>
                    <td>Invoice</td>
                    <td>Type</td>
                    <td>Account</td>
                    <td>Product</td>
                    <td>Quantity</td>
                    <td>Price</td>
                    <td>Amount</td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($dataBranchsale as $Branchsale) 
                    <?php 
                        $saleaccountname = explode(",",$Branchsale->account);
                        $saleproduct = explode(",",$Branchsale->product);
                    ?>
                    <tr class='saleitem{{$Branchsale->id}}'>
                        <td>{{$Branchsale->invoice}}</td>
                        <td>{{$Branchsale->paymenttype}}</td>
                        <?php 
                            if($saleaccountname[2] == 0){       
                        ?>
                        <td></td>
                        <?php  
                        } else {
                        ?>
                        <td>{{$saleaccountname[0]}}, {{$saleaccountname[1]}}</td>
                        <?php }
                        ?>
                        <td>{{$saleproduct[0]}}</td>
                        <td>{{$Branchsale->quantity}}</td>
                        <td>{{$Branchsale->price}}</td>
                        <td>{{$Branchsale->amount}}</td>
                        <td><a class='delete-sale btn btn-danger btn-xs' data-id='{{$Branchsale->id}}'><i class='fa fa-times'></i></a></td>
                    </tr>
                    @empty
                    <tr>
                    <td colspan="6" id="nosalesrecord"><em>No Record</em></td>
                    </tr>
                    @endforelse
                    
                    </tbody>
                    </table>
                    </div><!--x_content-->
                </div><!--col-->
            </div>
            <div class="x_panel tile">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <ul class="nav navbar-right panel_toolbox dashboard-panel">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul> 
                    <div class="x_title">
                        <h4>Others</h4>
                    </div>
                    <div class="x_content">
                    <table class="table table-striped" id="otherstable">
                    <thead>
                    <tr>
                    
                    <td>Description</td>
                    <td>Amount</td>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($dataBranchother as $Branchother) 
                        <tr class='otheritem{{$Branchother->id}}'>
                            <td>{{$Branchother->desc}}</td>
                            <td>{{$Branchother->amount}}</td>
                            <td><a class='delete-other btn btn-danger btn-xs' data-id='{{$Branchother->id}}'><i class='fa fa-times'></i></a></td>
                        </tr>
                    @empty
                    <tr>
                    <td colspan="3" id="nootherrecord"><em>No Record</em></td>
                    </tr>
                    @endforelse
                    </tbody>
                    </table>
                    </div><!--x_content-->
                </div><!--col-->
            </div>
            <div class="x_panel tile">
                <div class="col-md-12 col-sm-12 col-lg-12">
                    <ul class="nav navbar-right panel_toolbox dashboard-panel">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul> 
                    <div class="x_title">
                        <h4>Pumps</h4>
                    </div>
                    <div class="x_content">
                        <form action="{{ route('submitreport') }}" method="post">
                            <input type="hidden" name="branchid" class="form-control" id="branchid" value="{{$BranchId}}">
                            {{ csrf_field() }}
                            <table class="table table-striped table-bordered" id="table">
                                <thead>
                                <tr>
                            
                                    <th> Name</th>
                                    <th> Opening</th>
                                    <th> Closing</th>
                                    <th> Volume </th>
                                    <th> Unit Price </th>
                                    <th> Amount </th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse($dataPump as $Pump)
                                <tr class="item{{$Pump->id}}">
                                    
                                    <td>{{$Pump->pumpname}}</td>
                                    <td>
                                    <input type="hidden" name="pumpid[]" class="form-control" id="pump{{$Pump->id}}" value="{{$Pump->id}}">
                                    <input type="hidden" name="gasid[]" class="form-control" id="gasid{{$Pump->gasid}}" value="{{$Pump->gasid}}">
                                    
                                    <?php if($Pump->pumplog != null) {?>
                                        
                                            <input type="text" name="openvolume[]" class="form-control" id="openvolume{{$Pump->id}}" value="{{$Pump->pumplog['closevolume']}}" readonly></td>
                                        
                                    <?php }
                                    else{
                                    ?>
                                        <input type="text" name="openvolume[]" class="form-control" id="openvolume{{$Pump->id}}" value="0" readonly></td>
                                    
                                    <?php }?>
                                    <td><input type="text" name="closevolume[]" class="form-control" id="closevolume{{$Pump->id}}" ></td>
                                    <td><input type="text" name="consumevolume[]" class="form-control" id="consumevolume{{$Pump->id}}" readonly></td>
                                    <td>
                                    @foreach($dataBranchgasPump as $branchDetails)
                                        @if($branchDetails->gasid == $Pump->gasid && $branchDetails->branchid == $Pump->branchid)
                                        <input type="text" name="unitprice[]" class="form-control" id="unitprice{{$Pump->id}}" value="{{$branchDetails->price}}" readonly></td>
                                        @endif
                                    @endforeach
                                    <td><input type="text" name="amount[]" class="form-control" id="amount{{$Pump->id}}" readonly></td>
                                </tr>
                                @empty
                                
                                @endforelse
                                <tr><td colspan="6"> <button type="submit" class="btn btn-info btn-small">Save</button></td></tr>
                                </tbody>
                            </table>
                        </form>
                    </div><!--x_content-->
                   
                </div><!--col-->
            </div>
            
        </div><!--col-->
    </div><!--row-->
    </div>
<div id="myModal" class="modal fade" role="dialog">
  		<div class="modal-dialog">
  			<!-- Modal content-->
  			<div class="modal-content">
  				<div class="modal-header">
  					<button type="button" class="close" data-dismiss="modal">&times;</button>
  					<h4 class="modal-title"></h4>
  				</div>
  				<div class="modal-body">
  					
  					<div class="deleteContent">
  						Are you sure you want to delete <span class="dname"></span> ? <span
  							class="hidden did"></span>
  					</div>
  					<div class="modal-footer">
  						<button type="button" class="btn actionBtn" data-dismiss="modal">
  							<span id="footer_action_button" class='glyphicon'> </span>
  						</button>
  						<button type="button" class="btn btn-warning" data-dismiss="modal">
  							<span class='glyphicon glyphicon-remove'></span> Close
  						</button>
  					</div>
  				</div>
  			</div>
		  </div>
    </div>

<script type="text/javascript">

    $("#accountdis").select2({
      tags: true
    });
    $("#accountcredit").select2({
        tags: true
    });
</script>
<script src="{{ asset('js/app.js') }}"></script>
@foreach($dataPump as $Pump)
<script>
$(function() {
    $('#closevolume{{$Pump->id}}').keyup(function() {  
        updateTotal();
    });
    const updateTotal = function () {
      let closevalue = parseFloat($('#closevolume{{$Pump->id}}').val()).toFixed(3);
      let openvalue = parseFloat($('#openvolume{{$Pump->id}}').val()).toFixed(3);
      let consumevolume = closevalue - openvalue;
      $('#consumevolume{{$Pump->id}}').val(parseFloat(consumevolume).toFixed(3));
      let unitprice = parseFloat($('#unitprice{{$Pump->id}}').val()).toFixed(3);
      let amount = consumevolume * unitprice;
      $('#amount{{$Pump->id}}').val(parseFloat(amount).toFixed(3));
    };
 });
</script>
@endforeach



<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/dashboardscript.js') }}"></script>

@endsection