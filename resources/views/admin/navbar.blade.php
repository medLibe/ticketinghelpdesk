<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
        <div class="navbar nav_title" style="border: 0;">
            <a href="index.html" class="site_title" style="font-size: 14pt;"><i class="fa fa-paper-plane"></i> <span>Helpdesk System</span></a>
        </div>
        <div class="clearfix"></div>

        <div class="profile clearfix">
            <div class="profile_pic">
                <img src="/images/profile.png" alt="..." class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Request::session()->get('username') }}</h2>
            </div>
        </div>

        <br />

        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>HOME</h3>
                <ul class="nav side-menu">
                    <li><a href="/admin/dashboard"><i class="fa fa-tachometer"></i> Dashboard </a></li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>TICKET</h3>
                <ul class="nav side-menu">
                    <li><a><i class="fa fa-ticket"></i> Master Ticket <span
                                class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="/admin/department">Departments</a></li>
                            <li><a href="/admin/helpdesk">Helpdesks</a></li>
                        </ul>
                    </li>
                    <li><a href="/admin/ticket"><i class="fa fa-laptop"></i> Active Tickets </a></li>
                </ul>
            </div>
            <div class="menu_section">
                <h3>OTHER</h3>
                <ul class="nav side-menu">
                    <li><a href="javascript:void(0)"><i class="fa fa-file"></i> Reports </a></li>
                    <li><a href="javascript:void(0)"><i class="fa fa-users"></i> Teams </a></li>
                </ul>
            </div>
        </div>

    </div>
</div>

<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
            <ul class=" navbar-right">
                <li class="nav-item dropdown open" style="padding-left: 15px;">
                    <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true"
                        id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
                        <img src="/images/profile.png" alt="">{{ Request::session()->get('username') }}
                    </a>
                    <div class="dropdown-menu dropdown-usermenu pull-right"
                        aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="javascript:;"> Profile</a>
                        <a class="dropdown-item" href="/logout"><i
                                class="fa fa-sign-out pull-right"></i> Log Out</a>
                    </div>
                </li>
            </ul>
        </nav>
    </div>
</div>
