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
                <h4>Add User   
                </h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                {{ csrf_field() }}                              
                <div class="input-group col-lg-12">
                    <input type="text" class="form-control" placeholder="Full Name"  aria-describedby="basic-addon2" name="fullname">
                    <input type="hidden" name="branchid" value="{{$BranchId}}">
                </div>
                <div class="input-group col-lg-12">
                    <input type="text" class="form-control" placeholder="Username"  aria-describedby="basic-addon2" name="username">
                    
                </div>
                
                <div class="input-group col-lg-12">
                    <input type="email" class="form-control" placeholder="Email"  aria-describedby="basic-addon2" name="email">
                </div>
                <div class="input-group col-lg-12">
                    <input type="password" class="form-control" placeholder="Password" aria-describedby="basic-addon2" name="password">
                </div>
                <div class="input-group col-lg-12">
                    <select name="usertype" id="usertype" class="form-control">
                        <option value="incharge">In-Charge</option>
                        <option value="billing">Billing</option>
                    </select>
                    
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
                <h4>Branch Users   
                </h4>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-striped" id="table">
                    <thead>
                    <tr>
                
                        <th> Name</th>
                        <th> Username</th>
                        <th> Email </th>
                        <th> Usertype </th>
                        <th> </th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($branchUsers as $User)
                    <tr class="item{{$User->user->id}}">
                       
                        <td>{{$User->user->name}}</td>
                        <td>{{$User->user->username}}</td>
                        <td>{{$User->user->email}}</td>
                        <td> {{$User->user->usertype}}</td>
                        <td class='td-actions'>
                            <button class='edit-modal btn btn-small btn-success' data-id='{{$User->user->id}}' data-name='{{$User->user->name}}' data-username='{{$User->user->username}}' data-email='{{$User->user->email}}'><i class='fa fa-pencil'> </i></button>
                            <a class='delete-modal btn btn-danger btn-small' data-id='{{$User->user->id}}'><i class='fa fa-times'></i></a>
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
  							<div class="col-sm-12">
  								<input type="text" class="form-control" id="edit_name" name="edit_name">
                            </div>
                        </div>
                        <div class="form-group align-left">
  							<label class="col-sm-12 " for="full_name" >Username:</label>
  							<div class="col-sm-12">
  								<input type="text" class="form-control" id="edit_username" name="edit_username">
                            </div>
                        </div>
                        <div class="form-group align-left">
  							<label class="col-sm-12 " for="Email" >Email:</label>
  							<div class="col-sm-12">
  								<input type="text" class="form-control" id="edit_email" name="edit_email">
                            </div>
                        </div>
                        <div class="form-group align-left">
  							<label class="col-sm-12 " for="pump_name" >Password:</label>
  							<div class="col-sm-12">
  								<input type="text" class="form-control" id="edit_password" name="edit_password">
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
<script src="{{ asset('js/branchuser.js') }}"></script>
<!-- /main -->
@endsection