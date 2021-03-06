@extends('layouts.admin')

@section('content')
<div class="right_col" role="main">
<div class="row"> 
<div class="page-title">
        <div class="title_left">
        <h3>Branches</h3>
        </div>
    </div>
</div>  
<div class="row">
    <div class="col-md-6 col-lg-4 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="widget-content" style="padding:20px;">
            {{ csrf_field() }}
                <fieldset>	                                        
                    <div class="input-group">
                    <input type="text" class="form-control" placeholder="Branch Name"  aria-describedby="basic-addon2" name="branch_name">
                        <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit" id="add">Save</button> 
                        </span>
                    </div>
                </fieldset>
            </div>
        </div>     
    </div>         
    <div class="col-md-6 col-lg-6 col-sm-12 col-xs-12">
          <div class="x_panel">
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered" id="table">
                <thead>
                  <tr>
                    <th> #</th>
                    <th> Name</th>
                    <th> Action </th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($dataBranch as $Branch)
                  <tr class="item{{$Branch->id}}">
                    <td>{{$Branch->id}}</td>
                    <td>{{$Branch->branchname}}</td>
                    <td class='td-actions'>
                    <a class='btn btn-info btn-small' href='/admin/branches/{{$Branch->id}}'><i class='fa fa-search'> View</i></a>
                        <button class='edit-modal btn btn-small btn-success' data-id='{{$Branch->id}}' data-name='{{$Branch->branchname}}'><i class='fa fa-pencil'> Edit</i></button>
                        <a class='delete-modal btn btn-danger btn-small' data-id='{{$Branch->id}}'><i class='fa fa-times'> Remove</i></a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /widget-content --> 
          </div>            
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
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
  							<label class="control-label col-sm-2" for="id">ID:</label>
  							<div class="col-sm-10">
  								<input type="text" class="form-control" id="fid" disabled>
  							</div>
  						</div>
  						<div class="form-group">
  							<label class="control-label col-sm-2" for="branch_name" >Branch Name:</label>
  							<div class="col-sm-10">
  								<input type="text" class="form-control" id="branchedit_name" name="branchedit_name">
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
<script src="{{ asset('js/branchscript.js') }}"></script>
<!-- /main -->
@endsection