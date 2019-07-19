@extends('layouts.admin')

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
    <div class="col-md-12  col-sm-12 col-xs-12">
          <div class="x_panel">
                  <div class="x_title">
                    <h4>Branch Menu  
                        
                    </h4>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  @include('admin.includes.branch-menu')
                  </div>
            </div>
        </div>            
</div>
<div class="row">
    <div class="col-md-4 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>Add Account   
                </h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                {{ csrf_field() }}                              
                <div class="input-group col-lg-12">
                    <input type="text" class="form-control" placeholder="First Name"  aria-describedby="basic-addon2" name="fname" id="fname">
                    <input type="hidden" name="branchid" value="{{$BranchId}}" id="branchid">
                </div>
                <div class="input-group col-lg-12">
                    <input type="text" class="form-control" placeholder="Middle Name"  aria-describedby="basic-addon2" name="mname" id="mname">
                </div>
                <div class="input-group col-lg-12">
                    <input type="text" class="form-control" placeholder="Last Name"  aria-describedby="basic-addon2" name="lname" id="lname">
                </div>
                <div class="input-group col-lg-12">
                    <label for="Address">Address</label>
                    <input type="text"  placeholder="address" class="form-control" aria-describedby="basic-addon2" name="address" id="address">
                </div>
                <div class="input-group col-lg-12">
                    <label for="Tax">Tax</label>
                    <input type="text" class="form-control" placeholder="Tax"  aria-describedby="basic-addon2" name="tax" value="0" id="tax">
                </div>
                <div class="input-group col-lg-12">
                    <label for="Discount">Discount</label>
                    <input type="text"  placeholder="Discount" class="form-control" aria-describedby="basic-addon2" name="discount" value="0" id="discount">
                </div> 
                <div class="input-group col-lg-12">
                    <button class="btn btn-primary" type="submit" id="add">Save</button> 
                </div>
            </div>
        </div>
    </div>   
    <div class="col-md-8 col-sm-6 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h4>Branch Accounts   
                </h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped table-bordered" id="table">
                    <thead>
                    <tr>
                        <th> Name</th>
                        <th> Address </th>
                        <th> Discount </th>
                        <th> Tax </th>
                        <th> Action </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataAccounts as $Account)
                    <tr class="item{{$Account->id}}">   
                        <td><a href="/admin/branches/account/{{$BranchId}}/{{$Account->id}}">{{$Account->lname}}, {{$Account->fname}} {{$Account->mname}}</a></td>
                        <td>{{$Account->address}}</td>
                        <td> {{$Account->discount}}</td>
                        <td> {{$Account->tax}}</td>
                        <td class='td-actions'>
                        <a href='/admin/branches/account/{{$Account->id}}' class='btn btn-info btn-small' data-id='{{$Account->id}}'><i class='fa fa-search'>View</i></a>
                            <button class='edit-modal btn btn-small btn-success' data-id='{{$Account->id}}' data-fname='{{$Account->fname}}' data-lname='{{$Account->lname}}' data-mname='{{$Account->mname}}' data-tax='{{$Account->tax}}' data-address='{{$Account->address}}' data-discount='{{$Account->discount}}'><i class='fa fa-pencil'> Edit</i></button>
                            <!-- <a class='delete-modal btn btn-danger btn-small' data-id='{{$Account->id}}'><i class='fa fa-times'>Remove</i> -->
                        </a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>           
</div>
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
  					<form class="form-horizontal" role="form">
                      {{ csrf_field() }}
  						<div class="form-group">
  							
  							<div class="col-sm-10">
  								<input type="hidden" class="form-control" id="fid">
  							</div>
  						</div>
  						<div class="form-group align-left">
  							<label class="col-sm-12 " for="full_name" >Full Name:</label>
  							<div class="col-sm-4">
  								<input type="text" class="form-control" id="edit_fname" name="edit_fname">
                            </div>
                            <div class="col-sm-4">
  								<input type="text" class="form-control" id="edit_mname" name="edit_mname">
                            </div>
                            <div class="col-sm-4">
  								<input type="text" class="form-control" id="edit_lname" name="edit_lname">
                            </div>
                        </div>
                        <div class="form-group align-left">
  							<label class="col-sm-12 " for="Email" >Address:</label>
  							<div class="col-sm-12">
  								<input type="text" class="form-control" id="edit_address" name="edit_address">
                            </div>
                        </div>
                        <div class="form-group align-left">
  							<label class="col-sm-12 " for="pump_name" >Tax:</label>
  							<div class="col-sm-12">
  								<input type="text" class="form-control" id="edit_tax" name="edit_tax">
                            </div>
                        </div>
                        <div class="form-group align-left">
  							<label class="col-sm-12 " for="pump_name" >Discount:</label>
  							<div class="col-sm-12">
  								<input type="text" class="form-control" id="edit_discount" name="edit_discount">
                            </div>
                        </div>
  					</form>
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
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
    </div>
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/branchaccount.js') }}"></script>
<!-- /main -->
@endsection