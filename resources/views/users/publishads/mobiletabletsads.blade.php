@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <strong>Categories</strong>
                </div>
                <div class="card-body cardcatogory">
                    <ul class="userpgcategory fa-ul">
                        @if(isset($catogories))
                            @if(count($catogories)>0)
                                @foreach($catogories as $catogory)
                                    <li><a href="{{url('/viewads/'.preg_replace('/\s+/','',$catogory->mainCategory).'/'.$catogory->id)}}">{!!html_entity_decode($catogory->icons)!!}{{$catogory->mainCategory}}</a></li>
                                @endforeach

                            @else

                            @endif
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    <strong>Advertisments</strong>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link" data-toggle="tabs" href="#home">Mobile and Tablets</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div id="home">
                            <h1 style="padding: 10px 10px;" id="selcamsg"></h1>
                            <form action="{{url('/postcarsbikes') }}" class="form=horizontal" enctype="multipart/form-data" method="POST" style="padding-left: 20px;">
                            {{csrf_field()}}
                                <div class="row">
                                    <div class="col-lg-6">
                                        @if(count($errors)>0)
                                        @foreach($errors->all() as $error)
                                       
                                        @endforeach
                                        @endif
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <input type="hidden" name="mainCategoryId" value="{{Request::segment(3) }}">
                                            <label><strong>Select Subcategory</strong></label>
                                            <select class="form-control" name="subCategoryId">
                                                <option value="">Select</option>
                                                @if(count($subcatogories)>0)
                                                @foreach($subcatogories as $subcatogory)
                                                <option value={{$subcatogory->id}}>{{$subcatogory->subcategory}}</option>
                                                @endforeach
                                                @else
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <label></label>
                                    @if($errors->has('subCategoryId'))
                                    <span class="alert alert-danger" style="margin-left: 13px;padding: 4px;">{{$errors->first('subCategoryId')}}</span>
                                    @endif
                                </div>
                                <div class="col-lg-6">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label><strong>Product Name</strong></label>
                                            <input type="text" class="form-control" name="productName" placeholder="Product Name">
                                        </div>
                                    </div>
                                
                                <label></label>
                                @if($errors->has('productName'))
                                    <span class="alert alert-danger" style="margin-left: 13px;padding: 4px;">{{$errors->first('productName')}}</span>
                                    @endif
                                    </div>
                            </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label><strong>Year of Purchase</strong></label>
                                        <input type="text" class="form-control" name="yearOfPurchase" placeholder="Year of Purchase">
                                    </div>
                                </div>
                            <label></label>
                            @if($errors->has('yearOfPurchase'))
                                    <span class="alert alert-danger" style="margin-left: 13px;padding: 4px;">{{$errors->first('yearOfPurchase')}}</span>
                                    @endif
                        </div>
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><strong>Expected Selling Price</strong></label>
                                    <input type="text" class="form-control" name="expSellPrice" placeholder="Expected Selling Price">
                                </div>
                            </div>
                            <label></label>
                            @if($errors->has('expSellPrice'))
                                    <span class="alert alert-danger" style="margin-left: 13px;padding: 4px;">{{$errors->first('expSellPrice')}}</span>
                                    @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><strong>Your Name</strong></label>
                                    <input type="text" class="form-control" name="name" placeholder="Your Name">
                                </div>
                            </div>
                            <label></label>
                            @if($errors->has('name'))
                                    <span class="alert alert-danger" style="margin-left: 13px;padding: 4px;">{{$errors->first('name')}}</span>
                                    @endif
                        </div>
                
                    <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><strong>Your Mobile</strong></label>
                                    <input type="text" class="form-control" name="mobile" placeholder="Your Mobile">
                                </div>
                            </div>
                            <label></label>
                            @if($errors->has('mobile'))
                                    <span class="alert alert-danger" style="margin-left: 13px;padding: 4px;">{{$errors->first('mobile')}}</span>
                                    @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label><strong>Your Email</strong></label>
                                    <input type="text" class="form-control" name="email" placeholder="Your Email">
                                </div>
                            </div>
                            <label></label>
                            @if($errors->has('email'))
                                    <span class="alert alert-danger" style="margin-left: 13px;padding: 4px;">{{$errors->first('email')}}</span>
                                    @endif
                        </div>
                    
                    <div class="col-lg-6">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label><strong>State</strong></label>
                                <select class="form-control" name="state">
                                    <option value="">Select</option>
                                    @if(count($states)>0)
                                    @foreach($states as $state)
                                    <option value={{$state->id}}>{{$state->stateName}}</option>
                                    @endforeach
                                    @else
                                    @endif
                                </select>
                            </div>
                        </div>
                        <label></label>
                        @if($errors->has('state'))
                                    <span class="alert alert-danger" style="margin-left: 13px;padding: 4px;">{{$errors->first('state')}}</span>
                                    @endif
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label><strong>City</strong></label>
                                <input type="text" class="form-control" name="city" placeholder="Enter Your City">
                            </div>
                        </div>
                        <label style="padding: 23px;"></label>
                        @if($errors->has('city'))
                                    <span class="alert alert-danger" style="margin-left: 13px;padding: 4px;">{{$errors->first('city')}}</span>
                                    @endif
                    </div>
                
                <div class="col-lg-6">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label><strong>Photos of your Vehicle (Max 4)</strong></label>
                            <input type="file" class="form-control" name="photos[]" multiple="true">
                        </div>
                    </div>
                    <label style="padding: 23px;"></label>
                    @if($errors->has('photos'))
                                    <span class="alert alert-danger" style="margin-left: 13px;padding: 4px;">{{$errors->first('photos')}}</span>
                                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="form-group" style="text-align: center;">
                    <button type="submit" class="btn btn-primary">
                        Post Your Add
                    </button>
                    <button id="reset" class="btn btn-default">Reset</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection