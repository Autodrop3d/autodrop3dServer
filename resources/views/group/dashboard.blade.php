@extends('scaffold-interface.layouts.app')

@section('title')
    {{$group->name}}
@endsection

@section('content')

    <div class="container row">
        <br>
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="row">
                        <div class="col-sm-2">
                            @if ($group->image_id != null)
                                <img src="{{url(asset($group->image->path))}}" alt="{!!$group->name!!}">
                            @else
                                <img src="{{url(asset(App\Image::whereName('groupNoImage.svg')->first()->path))}}"
                                     alt="{!! $group->name !!}">
                            @endif
                        </div>
                        <div class="col-sm-10 row">
                            <div class="col-md-8">
                                <h1>
                                    {{$group->name}}
                                </h1>
                                <p>
                                    {!!nl2br($group->about)!!}
                                </p>
                            </div>
                            <div class="col-md-4" style="border: solid thin">
                                <h4>
                                    Contact Info
                                </h4>
                                <img>
                                    @foreach($group->leads as $groupUser)
                                        <br>

                                            <A href = {{$groupUser->UserUrl()}} >
                                            <img src="{{url($groupUser->image->path)}}" style="max-width: 50px;  height: auto;" alt="User Image">
                                            {{$groupUser->name }} {{$groupUser->LeadPhone}} <br>
                                            </A>

                                    @endforeach

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">
                        Calendar
                    </h3>
                </div>
                <div class="box-body">
                    {!! $calendar->calendar() !!}
                    {!! $calendar->script() !!}
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">

                <!-- Posts Box -->
                @include("partials.postsList")



    </div>



@endsection

@section('adminBar')
    @hasanyrole(['superadmin','admin'])
    <a data-toggle="modal" data-target="#myModal" class='delete btn btn-danger btn-xs'
       data-link="/g/{!!$group->id!!}/deleteMsg"><i class='material-icons'>delete</i></a>
    <a href='#' class='viewEdit btn btn-primary btn-xs' data-link='/g/{!!$group->id!!}/edit'><i class='material-icons'>edit</i></a>
    <a href='#' class='viewShow btn btn-warning btn-xs' data-link='/g/{!!$group->stub!!}'><i
                class='material-icons'>info</i></a>
    @endhasanyrole
@endsection