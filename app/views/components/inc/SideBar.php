<div id="left-sidebar" class="sidebar">
    <h5 class="brand-name">Logo<a href="javascript:void(0)" class="menu_option float-right"><i class="icon-grid font-16" data-toggle="tooltip" data-placement="left" title="Grid & List Toggle"></i></a></h5>
    <ul class="nav nav-tabs">
        <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#menu-uni">Management</a></li>
        <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#menu-admin">Admin</a></li>
    </ul>
    <div class="tab-content mt-3">
        <div class="tab-pane fade" id="menu-uni" role="tabpanel">
            <nav class="sidebar-nav">
                <ul class="metismenu">
                    <li class="active"><a href="<?=ROOT?>Admin/index"><i class="fa fa-dashboard"></i><span>Dashboard</span></a></li>
                    <li><a href="<?=ROOT?>Admin/Professors"><i class="fa fa-black-tie"></i><span>Professors</span></a></li>
                    <li><a href="<?=ROOT?>Admin/Students"><i class="fa fa-users"></i><span>Students</span></a></li>
                    <li><a href="<?=ROOT?>Admin/Departments"><i class="fa fa-users"></i><span>Departments</span></a></li>
                    <li><a href="<?=ROOT?>Admin/Courses"><i class="fa fa-graduation-cap"></i><span>Courses</span></a></li>
                    <li><a href="<?=ROOT?>Admin/Library"><i class="fa fa-book"></i><span>Library</span></a></li>
                    <li><a href="<?=ROOT?>Admin/Holiday"><i class="fa fa-bullhorn"></i><span>Holiday</span></a></li>
                    <li class="g_heading">Extra</li>
                    <li><a href="<?=ROOT?>Admin/events"><i class="fa fa-calendar"></i><span>Calender</span></a></li>
                    <li><a href="<?=ROOT?>Admin/App-filemanager"><i class="fa fa-folder"></i><span>FileManager</span></a></li>
                </ul>
            </nav>
        </div>
        <div class="tab-pane fade show active" id="menu-admin" role="tabpanel">
            <nav class="sidebar-nav">
                <ul class="metismenu">
                    <li><a href="<?=ROOT?>Admin/Payments"><i class="fa fa-credit-card"></i><span>Payments</span></a></li>
                    <li><a href="<?=ROOT?>Admin/Transport"><i class="fa fa-truck"></i><span>Transport</span></a></li>
                    <li><a href="<?=ROOT?>Admin/Attendance"><i class="fa fa-calendar-check-o"></i><span>Attendance</span></a></li>
                    <li><a href="<?=ROOT?>Admin/Leave"><i class="fa fa-flag"></i><span>Leave</span></a></li>
                    <li><a href="<?=ROOT?>Admin/Setting"><i class="fa fa-gear"></i><span>Settings</span></a></li>
                </ul>
            </nav>
        </div>
    </div>
</div>