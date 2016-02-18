<?php
 $tournament = \App\Tournament::with('categoryTournaments.users')->find($tournament->id);
?>
<div class="col-lg-6">
    <div class="panel panel-flat">
        <div class="panel-heading">
            <h6 class="panel-title"><a href="{!! URL::action('TournamentController@edit', $tournament->slug) !!}">{{ $tournament->name }}</a></h6>
            <div class="heading-elements">
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#"
                               class="btn border-teal text-teal  btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i class="icon-plus3"></i></a>
                        </li>
                        <li class="text-left">
                            <div class="text-semibold"> {{ trans_choice('crud.category',2) }}</div>
                            <div class="text-muted"><span class="status-mark border-success position-left"></span> {{ sizeof($tournament->categoryTournaments) }} </div>
                        </li>
                    </ul>

                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="content-group" id="new-visitors"></div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="index.html#"
                               class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                        class="icon-people"></i></a>
                        </li>
                        <li class="text-left">
                            <div class="text-semibold"> {{trans_choice('crud.competitor',2)}}</div>
                            <div class="text-muted"><span class="status-mark border-success position-left"></span> {{ sizeof($tournament->competitors()) }}

                            </div>

                        </li>
                    </ul>

                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="content-group" id="total-online"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="index.html#"
                               class="btn border-indigo-400 text-indigo-400  btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                        class="icon-watch2"></i></a>
                        </li>
                        <li class="text-left">
                            <div class="text-semibold">{{ trans('core.type') }}</div>
                            <div class="text-muted">{{ $tournament->type ? trans('crud.invitation') :  trans('core.open')}}</div>
                        </li>
                    </ul>

                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="content-group" id="new-sessions"></div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-4">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="#"
                               class="btn border-pink text-pink btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                        class="icon-calendar22"></i></a>
                        </li>
                        <li class="text-left">
                            <div class="text-semibold">{{ trans('crud.date') }}</div>
                            <div class="text-muted">{{ $tournament->date }}</div>
                        </li>
                    </ul>

                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="content-group" id="new-visitors"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="index.html#"
                               class="btn border-warning-400 text-warning-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                        class="icon-alert"></i></a>
                        </li>
                        <li class="text-left">
                            <div class="text-semibold">{{ trans('crud.limitDate')}}</div>
                            <div class="text-muted">{{ $tournament->registerDateLimit == '0000-00-00' ? '--' : $tournament->registerDateLimit  }}</div>
                        </li>
                    </ul>

                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="content-group" id="new-sessions"></div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <ul class="list-inline text-center">
                        <li>
                            <a href="index.html#"
                               class="btn border-indigo-400 text-indigo-400 btn-flat btn-rounded btn-icon btn-xs valign-text-bottom"><i
                                        class="icon-people"></i></a>
                        </li>
                        <li class="text-left">
                            <div class="text-semibold">{{trans('crud.level')}}</div>
                            <div class="text-muted"></span> {{ $tournament->level->name }}
                            </div>
                        </li>
                    </ul>

                    <div class="col-lg-10 col-lg-offset-1">
                        <div class="content-group" id="total-online"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="position-relative" id="traffic-sources"></div>
    </div>
</div>