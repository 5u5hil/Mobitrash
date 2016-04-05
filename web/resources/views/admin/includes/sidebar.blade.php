<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset('public/Admin/dist/img/user2-160x160.jpg') }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class=" {{ preg_match("/admin.schedule.view/",Route::currentRouteName())? 'active' : ''}}">
                <a href="{{ route('admin.schedule.view') }}">
                    <i class="fa fa-laptop"></i>
                    <span>Schedule Management</span>
                </a>
            </li>
            <li class=" {{ preg_match("/admin.servicehistory.view/",Route::currentRouteName())? 'active' : ''}}">
                <a href="{{ route('admin.servicehistory.view') }}">
                    <i class="fa fa-laptop"></i>
                    <span>Service History</span>
                </a>
            </li>
            <li class=" {{ preg_match("/admin.subscription.view/",Route::currentRouteName())? 'active' : ''}}">
                <a href="{{ route('admin.subscription.view') }}">
                    <i class="fa fa-laptop"></i>
                    <span>User Subscriptions</span>
                </a>
            </li>  
            <li class=" {{ preg_match("/admin.assets.view/",Route::currentRouteName())? 'active' : ''}}">
                <a href="{{ route('admin.assets.view') }}">
                    <i class="fa fa-laptop"></i>
                    <span>Asset Management</span>
                </a>
            </li>

            <li class=" {{ preg_match("/admin.record.view/",Route::currentRouteName())? 'active' : ''}}">
                <a href="{{ route('admin.record.view') }}">
                    <i class="fa fa-laptop"></i>
                    <span>Record Management</span>
                </a>
            </li>



            <li class="treeview {{ preg_match("/admin.roles.view|admin.systemusers.view/",Route::currentRouteName())? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>User Management</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ preg_match("/admin.roles.view/",Route::currentRouteName()) ? 'active' : '' }}"><a  href="{{ route('admin.roles.view') }}"><i class="fa fa-circle-o"></i>Roles</a></li>
                    <li class="{{ preg_match("/admin.systemusers.view/",Route::currentRouteName()) ? 'active' : '' }}"><a  href="{{ route('admin.systemusers.view') }}"><i class="fa fa-circle-o"></i>Users</a></li>
                </ul>
            </li>

            <li class="treeview {{ preg_match("/admin.cities.view|admin.additive.view|admin.fueltype.view|admin.frquency.view|admin.timeslot.view|admin.servicetype.view/",Route::currentRouteName())? 'active' : ''}}">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>Masters</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ preg_match("/admin.cities.view/",Route::currentRouteName()) ? 'active' : '' }}"><a  href="{{ route('admin.cities.view') }}"><i class="fa fa-circle-o"></i>Cities</a></li>
                    <li class="{{ preg_match("/admin.frquency.view/",Route::currentRouteName()) ? 'active' : '' }}"><a  href="{{ route('admin.frequency.view') }}"><i class="fa fa-circle-o"></i>Frequency</a></li>
                    <li class="{{ preg_match("/admin.timeslot.view/",Route::currentRouteName()) ? 'active' : '' }}"><a  href="{{ route('admin.timeslot.view') }}"><i class="fa fa-circle-o"></i>Timeslot</a></li>
                    <li class="{{ preg_match("/admin.servicetype.view/",Route::currentRouteName()) ? 'active' : '' }}"><a  href="{{ route('admin.servicetype.view') }}"><i class="fa fa-circle-o"></i>Servicetype</a></li>
                    <li class="{{ preg_match("/admin.wastetype.view/",Route::currentRouteName()) ? 'active' : '' }}"><a  href="{{ route('admin.wastetype.view') }}"><i class="fa fa-circle-o"></i>Wastetype</a></li>
                    <li class="{{ preg_match("/admin.fueltype.view/",Route::currentRouteName()) ? 'active' : '' }}"><a  href="{{ route('admin.fueltype.view') }}"><i class="fa fa-circle-o"></i>Fueltype</a></li>
                    <li class="{{ preg_match("/admin.additive.view/",Route::currentRouteName()) ? 'active' : '' }}"><a  href="{{ route('admin.additive.view') }}"><i class="fa fa-circle-o"></i>Additive</a></li>
                    <li class="{{ preg_match("/admin.recordtype.view/",Route::currentRouteName()) ? 'active' : '' }}"><a  href="{{ route('admin.recordtype.view') }}"><i class="fa fa-circle-o"></i>Recordtype</a></li>


                </ul>
            </li>




        </ul>
    </section>
    <!-- /.sidebar -->
</aside>