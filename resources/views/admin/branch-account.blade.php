@extends('layouts.admin')

@section('content')

<!-- page content -->
<div class="right_col" role="main">
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
            <div class="clearfix"></div>
        
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Accounts Profile</h2>
                 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3 col-xs-12 profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          <img class="img-responsive avatar-view" src="{{ asset('img/user.png') }}" alt="Avatar" title="Change the avatar">
                        </div>
                      </div>
                      <h3>{{$dataAccount->lname}}, {{$dataAccount->fname}}</h3>

                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-map-marker user-profile-icon"></i> {{$dataAccount->address}}
                        </li>

                        <li>
                          <i class="fa fa-money user-profile-icon"></i> {{$dataAccount->discount}}
                        </li>

                        <li class="m-top-xs">
                          <i class="fa fa-external-link user-profile-icon"></i>
                          {{$dataAccount->tax}}
                        </li>
                      </ul>

                      <a class="btn btn-success"><i class="fa fa-edit m-right-xs"></i>Edit Profile</a>
                      <br />

                    </div>
                    <div class="col-md-9 col-sm-9 col-xs-12">

                      <div class="profile_title">
                        <div class="col-md-6">
                          <h2>User Activity Report</h2>
                        </div>
                        <div class="col-md-6">
                          <div id="reportrange" class="pull-right" style="margin-top: 5px; background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #E6E9ED">
                            <i class="glyphicon glyphicon-calendar fa fa-calendar"></i>
                            <span>December 30, 2014 - January 28, 2015</span> <b class="caret"></b>
                          </div>
                        </div>
                      </div>
                             <div class="" role="tabpanel" data-example-id="togglable-tabs">
                        <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                          <li role="presentation" class=""><a href="#tab_content2" role="tab" id="profile-tab" data-toggle="tab" aria-expanded="true">Account Statement</a>
                          </li>
                          <li role="presentation" class=""><a href="#tab_content3" role="tab" id="profile-tab2" data-toggle="tab" aria-expanded="false">Bills</a>
                          </li>
                        </ul>
                        <div id="myTabContent" class="tab-content">

                          <div role="tabpanel" class="tab-pane fade active in" id="tab_content2" aria-labelledby="profile-tab">

                            <!-- start user projects -->
                            <table class="data table table-striped no-margin">
                              <thead>
                                <tr>
                                  <th>Date</th>
                                  <th>Invoice No.</th>
                                  <th>Charge</th>
                                  <th>Credit</th>
                                  <th>Balance</th>
                                </tr>
                              </thead>
                              <tbody>
                                  @forelse($accountDetails as $accountDetail)
                                <tr>
                                  <td>{{$accountDetail->invoicedate}}</td>
                                  <td>{{$accountDetail->invoicenum}}</td>
                                  <td>{{$accountDetail->charge}}</td>
                                  <td>{{$accountDetail->credit}}</td>
                                  <td>{{$accountDetail->balance}}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5"><em>No Records found</em></td>
                                </tr>
                                @endforelse

                              </tbody>
                            </table>
                            <!-- end user projects -->

                          </div>
                          <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="profile-tab">
                            <p>xxFood truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1 labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft beer twee. Qui
                              photo booth letterpress, commodo enim craft beer mlkshk </p>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /page content -->
@endsection