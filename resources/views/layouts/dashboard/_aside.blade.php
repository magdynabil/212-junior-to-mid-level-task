<aside class="main-sidebar">

    <section class="sidebar">

        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('dashboard_files/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">
            {{--{{ route('dashboard.welcome') }}--}}
            <li><a href="{{route("employee.index")}}"><i class="fa fa-th"></i><span>@lang('site.employee')</span></a></li>
            <li><a href="{{route("employee.create")}}"><i class="fa fa-th"></i><span>@lang('site.employee_add')</span></a></li>

            <li><a href="{{route("company.index")}}"><i class="fa fa-th"></i><span>@lang('site.company')</span></a></li>
            <li><a href="{{route("company.create")}}"><i class="fa fa-th"></i><span>@lang('site.company_add')</span></a></li>
        </ul>

    </section>

</aside>

