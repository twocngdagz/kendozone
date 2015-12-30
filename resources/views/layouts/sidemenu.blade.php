<!-- Main sidebar -->
<div class="sidebar sidebar-main">
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="category-content">
                <div class="media">
                    @if(Auth::check())
                        <a href="{!!   URL::action('UserController@edit',  Auth::user()->id) !!}"
                           class="media-left"><img src="{!! Auth::getUser()->avatar !!}"
                                                   class="img-circle img-sm" alt=""></a>


                    <div class="media-body">

                        <span class="media-heading text-semibold">{!! Auth::getUser()->name !!}</span>

                        <div class="text-size-mini text-muted">
                            <i class="icon-pin text-size-small"></i>
                            @if (!is_null(Auth::getUser()->city ))
                                {!!Auth::getUser()->city !!}, {!!Auth::getUser()->country->countryCode!!}
                            @endif
                        </div>
                    </div>
                    @endif
                    <div class="media-right media-middle">
                        <ul class="icons-list">
                            <li>
                                <a href="{!! URL::to('/settings')!!}"><i class="icon-cog3"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="sidebar-category sidebar-category-visible">
            <div class="category-content no-padding">
                <ul class="navigation navigation-main navigation-accordion">

                    <!-- Main -->
                    <li class="navigation-header"><span>Menu</span> <i class="icon-menu" title="Menu"></i></li>
                    <li {{ ((Request::is('admin') || Request::is('/')) ? 'class=active' : '') }}><a href="/admin"><i
                                    class="icon-home4"></i> <span>Dashboard</span></a></li>
                    <li {{ (Request::is('tournaments') ? 'class=active' : '') }}><a href="/tournaments"><i
                                    class="icon-trophy2"></i> <span>Torneos</span></a></li>
                    {{--                    <li {{ (Request::is('places') ? 'class=active' : '') }}><a href="/places"><i class="icon-location4"></i> <span>Lugares</span></a></li>--}}
                    <li {{ (Request::is('invites') ? 'class=active' : '') }}><a href="/invites"><i
                                    class="icon-mail5"></i> <span>{{trans_choice('crud.invite',2)}}</span></a></li>

                </ul>
            </div>
        </div>
    </div>
</div>

