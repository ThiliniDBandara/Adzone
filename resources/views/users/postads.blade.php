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
                            <a class="nav-link" data-toggle="tabs" href="#home">Categories</a>
                        </li>
                    </ul>
                    <div id="myTabContent" class="tab-content">
                        <div id="home">
                            <h3 style="padding: 10px;text-align: center;color: #6d6969;">Select Your Category</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection