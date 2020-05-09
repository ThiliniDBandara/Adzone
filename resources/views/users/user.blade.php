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
                    <!-- <div class="col-lg-12">
                        @if(session('info'))
                        <div class="alert alert-success" style="margin-top: 5px;">
                        {{session('info')}}
                    </div>
                    @endif
                    </div> -->
                    <div class="row" id="Advertisments"> </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection