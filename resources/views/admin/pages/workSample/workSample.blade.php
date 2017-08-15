@extends('admin.layouts.master')



@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content-wrapper clearfix">
            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>نمونه کارها</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="{{route('profile')}}">خانه</a>
                        </li>
                        <li class="active">
                            <strong>نمونه کار</strong>
                        </li>
                    </ol>
                </div>
            </div>

            <div style="margin-top: 20px;" class="col-lg-4">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        افزودن
                    </div>
                    <div class="panel-body">
                        <form id="contact" action="{{route('work-sample.store')}}" method="post"
                              enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-group{{ $errors->has('name') ? ' has-error': ''}}">
                                <div class="col-sm-10 col-md-12">
                                    <input type="text" placeholder="نام"
                                           value="{{ Request::old('name') ?  : ''}}" class="form-control m-b"
                                           name="name"
                                           tabindex="1" required autofocus>
                                    @if($errors->has('name'))
                                        <span class="help-block">{{ $errors->first('name')}}</span>
                                    @endif
                                </div>
                            </div>

                            @if(count($categories) > 0)
                                <p>دسته بندی</p>
                                <div class="form-group{{ $errors->has('category_id[]') ? ' has-error': ''}}">
                                    <div style="margin-top: -10px;" class="ibox float-e-margins">
                                            <div class="form-group">
                                                <label class="font-noraml text-center"></label>
                                                <div>
                                                    <select data-placeholder="انتخاب کنید" name="category_id[]"
                                                            class="chosen-select" multiple
                                                            style="width:350px;" tabindex="4">
                                                        @foreach($categories as $category )
                                                            <option name="category_id[]"
                                                                    value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                    @if($errors->has('category_id[]'))
                                        <span class="help-block">{{ $errors->first('category_id[]')}}</span>
                                    @endif
                                </div>
                            @else
                                <p class="text-center">شما هیچ دسته بندی نساخته اید</p>
                            @endif


                            @if(count($skills) > 0)
                                <p>مهارت ها</p>
                                <div class="form-group{{ $errors->has('skill_id[]') ? ' has-error': ''}}">
                                    <div style="margin-top: -10px;" class="ibox float-e-margins">

                                            <div class="form-group">
                                                <label class="font-noraml text-center"></label>
                                                <div>
                                                    <select data-placeholder="انتخاب کنید" name="skill_id[]"
                                                            class="chosen-select" multiple
                                                            style="width:350px;" tabindex="4">
                                                        @foreach($skills as $skill )
                                                            <option name="skill_id[]"
                                                                    value="{{$skill->id}}">{{$skill->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                    </div>
                                    @if($errors->has('skill_id[]'))
                                        <span class="help-block">{{ $errors->first('skill_id[]')}}</span>
                                    @endif
                                </div>
                            @else
                                <p class="text-center">شما هیچ دسته بندی نساخته اید</p>
                            @endif


                            <div class="row">
                                <div style="margin-top: 20px;" class="col-md-6">
                                    <div class="ibox float-e-margins">
                                        <div class="form-group{{ $errors->has('photo') ? ' has-error': ''}}">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <span class="btn btn-default btn-file"><span
                                                    class="fileinput-new">بارگذاری عکس</span> <span
                                                    class="fileinput-exists"><span class="fileinput-exists"><span
                                                            style="color: #2aca76;">بارگذاری شد</span></span> </span>
                                            <input type="file"
                                                   value="{{ Request::old('photo') ?: ''}}" required name="photo"></span>
                                            </div>
                                            @if($errors->has('photo'))
                                                <span class="help-block">{{ $errors->first('photo')}}</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <button class="btn btn-primary col-md-4" name="submit" type="submit" id="contact-submit"
                                    data-submit="...Sending">ارسال
                            </button>

                        </form>
                    </div>
                </div>
            </div>

            <div style="margin-top:20px" class="col-lg-8">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <input type="text" class="form-control input-sm m-b-xs" id="filter"
                               placeholder="سرچ کردن">

                        <table class="footable table table-stripped" data-page-size="3" data-filter=#filter>
                            <thead>
                            <tr>
                                <td style="width: 30px;" class="text-center">عکس</td>
                                <td class="text-center">دسته بندی</td>
                                <td class="text-center">مهارت</td>
                                <td class="text-center">نام</td>
                                <th style="width: 30px;" class="text-center">تغییرات</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($workSamples as $workSample)
                                <tr>
                                    <td style="vertical-align: middle;" class="text-center"><img width="50"
                                                                                                 height="50"
                                                                                                 src="{{asset($workSample->photo)}}"
                                                                                                 alt="">
                                    </td>
                                    <td style="vertical-align: middle;" class="text-center">
                                        @foreach($workSample->category as $cat)

                                            {{$cat->name}}

                                        @endforeach
                                    </td>

                                    <td style="vertical-align: middle;" class="text-center">
                                        @foreach($workSample->skills as $skill)
                                            {{$skill->name}}
                                        @endforeach
                                    </td>
                                    <td style="vertical-align: middle;"
                                        class="text-center">{{$workSample->name}}</td>


                                    <td style="border: none;">
                                        <button style="margin-top: 12px; width:30px; height: 30px;" data-toggle="modal"
                                                data-href="{{ route('work-sample.edit', $workSample->id) }}"
                                                data-target="#myModal2" class="btn btn-warning edit">
                                            <i style="margin-right: -3px;" class="fa fa-paint-brush" aria-hidden="true">
                                            </i>
                                        </button>

                                        <form action="{{ route('work-sample.destroy', $workSample->id) }}"
                                              method="POST">
                                            {{ method_field('DELETE') }}
                                            {{ csrf_field() }}

                                            <button style="margin-top: 3px; width: 30px; height: 30px"
                                                    class="btn btn-danger"><i style="margin-right: -3px"
                                                                              class="fa fa-trash"
                                                                              aria-hidden="true"></i>
                                            </button>

                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="5">
                                    <ul class="pagination pull-right"></ul>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

            {{--<div class="wrapper wrapper-content animated fadeInRight col-md-8">--}}
                {{--<div class="row">--}}
                    {{--<div style="margin-top: 10px;">--}}
                        {{--<div class="ibox float-e-margins">--}}

                            {{--<div class="ibox-content">--}}
                                {{--<div class="table-responsive">--}}
                                    {{--<table class="table table-striped table-bordered table-hover dataTables-example">--}}
                                        {{--<thead>--}}

                                        {{--<tr>--}}
                                            {{--<td style="width: 30px;" class="text-center">عکس</td>--}}
                                            {{--<td class="text-center">دسته بندی</td>--}}
                                            {{--<td class="text-center">مهارت</td>--}}
                                            {{--<td class="text-center">نام</td>--}}
                                            {{--<th style="width: 30px;" class="text-center">تغیرات</th>--}}
                                        {{--</tr>--}}
                                        {{--</thead>--}}
                                        {{--<tbody>--}}
                                        {{--@foreach($workSamples as $workSample)--}}
                                            {{--<tr>--}}
                                                {{--<td style="vertical-align: middle;" class="text-center"><img width="50"--}}
                                                                                                             {{--height="50"--}}
                                                                                                             {{--src="{{asset($workSample->photo)}}"--}}
                                                                                                             {{--alt="">--}}
                                                {{--</td>--}}
                                                {{--<td style="vertical-align: middle;" class="text-center">--}}
                                                    {{--@foreach($workSample->category as $cat)--}}
                                                        {{--{{$cat->name}},--}}
                                                    {{--@endforeach--}}
                                                {{--</td>--}}

                                                {{--<td style="vertical-align: middle;" class="text-center">--}}
                                                    {{--@foreach($workSample->skills as $skill)--}}
                                                        {{--{{$skill->name}},--}}
                                                    {{--@endforeach--}}
                                                {{--</td>--}}
                                                {{--<td style="vertical-align: middle;"--}}
                                                    {{--class="text-center">{{$workSample->name}}</td>--}}


                                                {{--<td style="display: flex; border: none;">--}}
                                                    {{--<a href="{{route('work-experience.edit',$workExperience->id)}}">--}}
                                                    {{--<button style="margin-top: 12px; width:30px; height: 30px;"--}}
                                                            {{--data-toggle="modal"--}}
                                                            {{--data-target="#myModal2" class="btn btn-warning edit"><i--}}
                                                                {{--style="margin-right: -3px;"--}}
                                                                {{--class="fa fa-paint-brush" aria-hidden="true"></i>--}}
                                                    {{--</button>--}}
                                                    {{--</a>--}}

                                                    {{--<form action="{{ route('work-sample.destroy', $workSample->id) }}"--}}
                                                          {{--method="POST">--}}
                                                        {{--{{ method_field('DELETE') }}--}}
                                                        {{--{{ csrf_field() }}--}}

                                                        {{--<button style="margin-right: 10px; margin-top: 12px; width: 30px; height: 30px"--}}
                                                                {{--class="btn btn-danger"><i style="margin-right: -3px"--}}
                                                                                          {{--class="fa fa-trash"--}}
                                                                                          {{--aria-hidden="true"></i>--}}
                                                        {{--</button>--}}

                                                    {{--</form>--}}
                                                {{--</td>--}}

                                            {{--</tr>--}}
                                        {{--@endforeach--}}
                                        {{--</tbody>--}}
                                    {{--</table>--}}
                                {{--</div>--}}

                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</div>--}}
            <!-- /.row -->


            {{--</section>--}}

        {{--</div>--}}
    <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated flipInY">
                <div class="modal-header">
                    <button type="button" class="close"
                            data-dismiss="modal"><span aria-hidden="true">&times;</span><span
                                class="sr-only">Close</span></button>
                    <h4 class="modal-title">ویرایش فرم</h4>
                    <small class="font-bold">این فرم در صفحه اصلی شما نشان
                        داده میشود
                    </small>
                </div>
                <div style="background-color: #fff !important; height: 470px;" class="modal-body">
                    <div class="container">

                    </div>
                </div>

            </div>
        </div>
    </div>

    @include('admin.layouts.success')
    @include('admin.layouts.errors')
@endsection


@section('scripts')
    $('button.edit').click(function(e){
    e.preventDefault();
    $.get($(this).attr('data-href'),function(data){
    $('#myModal2').find('.modal-body').html(data);
    })
    });
@endsection