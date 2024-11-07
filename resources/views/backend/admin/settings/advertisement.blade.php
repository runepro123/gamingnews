@extends('backend.layouts.app')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Advertisement</h1>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
            @include('backend.message')
            <div class="card">
              <form action="{{ url('settings/advertisement/update') }}" method="post">
                @csrf
                <div class="card-body">
                  <div class="row">     
                    <!-- Admob Ads -->
                    <div class="col-md-12">
                      <label class="card-title">Admob Ads</label>              
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <h6>Inter Ad Unit</h6>
                        <input type="text" class="form-control" name="admob_inter" id="admob_inter" value="{{$advertisement->admob_inter}}" placeholder="Inter Ad Unit" >
                      </div>
                      <div class="form-group">
                        <h6>Banner Ad Unit</h6>
                        <input type="text" class="form-control" name="admob_banner" id="admob_banner" value="{{$advertisement->admob_banner}}" placeholder="Banner Ad Unit" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <h6>Native Ad Unit</h6>
                        <input type="text" class="form-control" name="admob_native" id="admob_native" value="{{$advertisement->admob_native}}" placeholder="Native Ad Unit" >
                      </div>
                      <div class="form-group">
                        <h6>Reward Ad Unit</h6>
                        <input type="text" class="form-control" name="admob_reward" id="admob_reward" value="{{$advertisement->admob_reward}}" placeholder="Reward Ad Unit" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <h6>Open Ads</h6>
                        <input type="text" class="form-control" name="admob_open_ads" id="admob_open_ads" value="{{$advertisement->admob_open_ads}}" placeholder="Open Ads" >
                      </div>
                    </div>

                    <!-- IOS Ads -->
                    <div class="col-md-12">
                      <label class="card-title">Admob Ads for IOS</label>              
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <h6>Inter Ad Unit</h6>
                        <input type="text" class="form-control" name="ios_inter" id="ios_inter" value="{{$advertisement->ios_inter}}" placeholder="Inter Ad Unit" >
                      </div>
                      <div class="form-group">
                        <h6>Banner Ad Unit</h6>
                        <input type="text" class="form-control" name="ios_banner" id="ios_banner" value="{{$advertisement->ios_banner}}" placeholder="Banner Ad Unit" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <h6>Native Ad Unit</h6>
                        <input type="text" class="form-control" name="ios_native" id="ios_native" value="{{$advertisement->ios_native}}" placeholder="Native Ad Unit" >
                      </div>
                      <div class="form-group">
                        <h6>Reward Ad Unit</h6>
                        <input type="text" class="form-control" name="ios_reward" id="ios_reward" value="{{$advertisement->ios_reward}}" placeholder="Reward Ad Unit" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <h6>Open Ads</h6>
                        <input type="text" class="form-control" name="ios_open_ads" id="ios_open_ads" value="{{$advertisement->ios_open_ads}}" placeholder="Open Ads" >
                      </div>
                    </div>
                      
                    <!-- Facebook Ads -->
                    <div class="col-md-12">
                      <label class="card-title">Facebook Ads</label>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <h6>Inter Ad Unit</h6>
                        <input type="text" class="form-control" name="facebook_inter" id="facebook_inter" value="{{$advertisement->facebook_inter}}" placeholder="Inter Ad Unit" >
                      </div>
                      <div class="form-group">
                        <h6>Banner Ad Unit</h6>
                        <input type="text" class="form-control" name="facebook_banner" id="facebook_banner" value="{{$advertisement->facebook_banner}}" placeholder="Banner Ad Unit" >
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <h6>Native Ad Unit</h6>
                        <input type="text" class="form-control" name="facebook_native" id="facebook_native" value="{{$advertisement->facebook_native}}" placeholder="Native Ad Unit" >
                      </div>
                      <div class="form-group">
                        <h6>Reward Ad Unit</h6>
                        <input type="text" class="form-control" name="facebook_reward" id="facebook_reward" value="{{$advertisement->facebook_reward}}" placeholder="Reward Ad Unit" >
                      </div>
                    </div>

                    <!-- Unity Ads -->
                    <div class="col-md-12">
                      <label class="card-title">Unity Ads</label>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <h6 style="color=red;">App Id / Game Id</h6>
                        <input type="text" class="form-control" name="unity_appId_gameId" id="unity_appId_gameId" value="{{$advertisement->unity_appId_gameId}}" placeholder="Enter your AppId/GameId" >
                      </div>
                    </div>

                    <!-- ironsource Ads start -->
                    <div class="col-md-12" style="display: none;">
                      <label class="card-title">Iron Source Ads</label>
                    </div>
                    <div class="col-md-12" style="display: none;">
                      <div class="form-group">
                        <h6>App Key</h6>
                        <input type="text" class="form-control" name="iron_appKey" id="iron_appKey" value="{{$advertisement->iron_appKey}}" placeholder="Enter Your App Key" >
                      </div>
                    </div>

                    <!-- AppNext Ads start -->
                    <div class="col-md-12" style="display: none;">
                      <label class="card-title">App Next Ads:</label>
                    </div>
                    <div class="col-md-12" style="display: none;">
                      <div class="form-group">
                        <h6>Placement Id</h6>
                        <input type="text" class="form-control" name="appnext_placementId" id="appnext_placementId" value="{{$advertisement->appnext_placementId}}" placeholder="Enter Your Placement ID" >
                      </div>
                    </div>

                    <!-- Startup Ads  -->
                    <div class="col-md-12" style="display: none;">
                      <label class="card-title">Startapp Ads:</label>
                    </div>
                    <div class="col-md-12" style="display: none;">
                      <div class="form-group">
                        <h6>App Id</h6>
                        <input type="text" class="form-control" name="startapp_appId" id="startapp_appId" value="{{$advertisement->startapp_appId}}" placeholder="Enter Your App Id" >
                      </div>
                    </div>

                    <div class="col-md-12">
                      <label class="card-title">Interstitial Interval</label>
                      <div class="form-group">
                        <input type="text" class="form-control" name="industrial_interval" id="industrial_interval" value="{{$advertisement->industrial_interval}}" placeholder="Industrial Interval" >
                      </div>
                    </div>

                    <div class="col-md-12" style="display: none;">
                      <label class="card-title">Native Ads</label>
                      <div class="form-group">
                        <input type="text" class="form-control" name="native_ads" id="native_ads" value="{{$advertisement->native_ads}}" placeholder="Native Ads" >
                      </div>
                    </div>
                      
                    <div class="col-md-12">
                      <label class="card-title" for="ads_type">Ads Type</label>
                    </div>
                    <div class="col-md-12 form-group">                
                      <select name="ads_type" id="ads_type" class="form-control">
                        <option disabled selected value>Select an Option</option>
                        <option  value="0" @if ($advertisement['ads_type'] == "0") {{ 'selected' }} @endif>Admob</option>  
                        <option  value="1" @if ($advertisement['ads_type'] == "1") {{ 'selected' }} @endif>Facebook</option>  
                        <!-- <option  value="2" @if ($advertisement['ads_type'] == "2") {{ 'selected' }} @endif>Startapp</option> -->
                        <!-- <option  value="4" @if ($advertisement['ads_type'] == "4") {{ 'selected' }} @endif>IronSource</option> -->
                        <!-- <option  value="5" @if ($advertisement['ads_type'] == "5") {{ 'selected' }} @endif>AppNext</option>   -->
                        <option  value="6" @if ($advertisement['ads_type'] == "6") {{ 'selected' }} @endif>Unity</option>
                        <option  value="3" @if ($advertisement['ads_type'] == "3") {{ 'selected' }} @endif>Show Ads on Mix</option>  
                      </select>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection