@extends('Shared.Layouts.Master')

@section('title')
@parent

Event Surveys
@stop

@section('top_nav')
@include('ManageEvent.Partials.TopNav')
@stop

@section('menu')
@include('ManageEvent.Partials.Sidebar')
@stop

@section('page_title')
<i class='ico-cart mr5'></i>
Event Surveys
@stop

@section('head')

@stop

@section('page_header')
<div class="col-md-9 col-sm-6">
    <!-- Toolbar -->
    <div class="btn-toolbar" role="toolbar">
        <button class="loadModal btn btn-success" type="button" data-modal-id="CreateQuestion" href="javascript:void(0);"
                data-href="{{route('showCreateEventQuestion', ['event_id' => $event->id])}}">
            <i class="ico-question"></i> Add question
        </button>

        <div class="btn-group btn-group btn-group-responsive">
            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                <i class="ico-users"></i> Export Answers <span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <li><a href="{{route('showExportOrders', ['event_id'=>$event->id,'export_as'=>'xlsx'])}}">Excel (XLSX)</a></li>
                <li><a href="{{route('showExportOrders', ['event_id'=>$event->id,'export_as'=>'xls'])}}">Excel (XLS)</a></li>
                <li><a href="{{route('showExportOrders', ['event_id'=>$event->id,'export_as'=>'csv'])}}">CSV</a></li>
                <li><a href="{{route('showExportOrders', ['event_id'=>$event->id,'export_as'=>'html'])}}">HTML</a></li>
            </ul>
        </div>
    </div>
    <!--/ Toolbar -->
</div>
<div class="col-md-3 col-sm-6">

</div>
@stop


@section('content')
<!--Start Questions table-->
<div class="row">

    @if($questions->count())

    <div class="col-md-12">

        <!-- START panel -->
        <div class="panel">
            <div class="table-responsive">
                    @if($questions->count())
                        <table class="table">
                            <thead>
                            <th>
                                Question Title
                            </th>
                            <th>
                                Question Type
                            </th>
                            <th>
                                Required
                            </th>
                            <th>
                                Applies to tickets
                            </th>
                            <th>

                            </th>
                            </thead>
                            <tbody>
                            @foreach ($questions as $question)
                                <tr>
                                    <td>
                                        {{ $question->title }}
                                    </td>
                                    <td>
                                        {{ $question->question_type->name }}
                                    </td>
                                    <td>
                                        {{ $question->is_required ? 'Yes' : 'No' }}
                                    </td>
                                    <td>
                                        {{implode(', ', array_column($question->tickets->toArray(), 'title'))}}
                                    </td>
                                    <td>
                                        <a class="btn btn-xs btn-primary loadModal" data-modal-id="EditQuestion" href="javascript:void(0);"
                                           data-href="{{route('showEditEventQuestion', ['event_id' => $event->id, 'question_id' => $question->id])}}">
                                            Edit
                                        </a>
                                        <a data-id="{{ $question->id }}" data-route="{{ route('postDeleteEventQuestion', ['event_id' => $event->id, 'question_id' => $question->id]) }}" data-type="question"  href="javascript:void(0);" class="btn btn-xs btn-danger deleteThis">
                                            Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    @else
                        <div class="panel-body">
                            You haven't added any questions yet. You can add question by clicking the '<b>Add Question</b>' button below.
                        </div>
                    @endif
                </div>
        </div>
    </div>


    @else

        @include('ManageEvent.Partials.SurveyBlankSlate')

    @endif
</div>    <!--/End attendees table-->
@stop
