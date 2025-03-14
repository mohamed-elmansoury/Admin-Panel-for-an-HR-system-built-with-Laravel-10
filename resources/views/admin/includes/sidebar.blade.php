<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('assets/admin/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Auth::user()->name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview menu-open">
                <a href="" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        قائمه الضبط
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ route('adminSittings') }}"
                            class="nav-link  {{ request()->is('admin/adminSittings*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>الضبط العام للشركه</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('finance_calender.index') }}"
                            class="nav-link  {{ request()->is('admin/finance_calender*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>السنوات الماليه</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('branches.index') }}"
                            class="nav-link  {{ request()->is('admin/branches*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> الفروع </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Shifts.index') }}"
                            class="nav-link  {{ request()->is('admin/Shifts*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> الشفتات </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Departments.index') }}"
                            class="nav-link  {{ request()->is('admin/Departments*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> الادارات </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('JopCategories.index') }}"
                            class="nav-link  {{ request()->is('admin/JopCategories*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>الوظائف </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Qualification.index') }}"
                            class="nav-link  {{ request()->is('admin/ََQualification*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>المؤهلات </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Occasions.index') }}"
                            class="nav-link  {{ request()->is('admin/ََQualification*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>المناسبات الرسميه </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Resignations.index') }}"
                            class="nav-link  {{ request()->is('admin/Resignations*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> انواع ترك العمل </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Nationality.index') }}"
                            class="nav-link  {{ request()->is('admin/Nationality*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> الحنسيات </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('Religion.index') }}"
                            class="nav-link  {{ request()->is('admin/Religion*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> الدين </p>
                        </a>
                    </li>
                    
                    <li class="nav-item">
                        <a href="{{ route('Employers.index') }}"
                            class="nav-link  {{ request()->is('admin/Employers*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> الموظفين </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('ShowRegister') }}"
                            class="nav-link  {{ request()->is('admin/ShowRegister*') ? 'active' : '' }}">
                            <i class="far fa-circle nav-icon"></i>
                            <p> اضافه مشرف</p>
                        </a>
                    </li>


                </ul>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
