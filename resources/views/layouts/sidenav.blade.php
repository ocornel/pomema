<div class="layout-sidebar-backdrop"></div>
<div class="layout-sidebar-body">
    <div class="custom-scrollbar">
        <nav id="sidenav" class="sidenav-collapse collapse">
            <br>
            <br>
            <ul class="sidenav">
                <li class="sidenav-heading">Navigation</li>
                <li class="sidenav-item">
                    <a href="{{ route('home') }}">
                        <span class="sidenav-icon icon icon-area-chart"></span>
                        <span class="sidenav-label">Dashboard</span>
                    </a>
                </li>
                <li class="sidenav-item has-subnav">
                    <a href="" aria-haspopup="true">
                        <span class="sidenav-icon icon icon-heartbeat"></span>
                        <span class="sidenav-label">Patients</span>
                    </a>
                    <ul class="sidenav-subnav collapse">
                        <li class="sidenav-subheading">Patients</li>
                        <li><a href="{{ route('patients') }}">All Patients</a></li>
                        <li><a href="{{ route('patients', \App\Http\Controllers\HomeController::WIDGET_U5) }}">Under 5 years</a></li>
                        <li><a href="{{ route('patients', \App\Http\Controllers\HomeController::WIDGET_O5) }}">Over 5 years</a></li>
                        <li><a href="{{ route('patients', \App\Http\Controllers\HomeController::PATIENTS_WITH_DEBT) }}">With Outstanding Debts</a></li>
                    </ul>
                </li>
                <li class="sidenav-item">
                    <a href="{{ route('noks') }}">
                        <span class="sidenav-icon icon icon-phone"></span>
                        <span class="sidenav-label">Contact Perole (NOKs)</span>
                    </a>
                </li>
                <li class="sidenav-item has-subnav">
                    <a href="" aria-haspopup="true">
                        <span class="sidenav-icon icon icon-credit-card"></span>
                        <span class="sidenav-label">Credits</span>
                    </a>
                    <ul class="sidenav-subnav collapse">
                        <li class="sidenav-subheading">Credits</li>
                        <li><a href="{{ route('credits') }}">All Credits</a></li>
                        <li><a href="{{ route('credits', \App\Http\Controllers\HomeController::WIDGET_OUTSTANDING) }}">Pending <span class="badge badge-danger" style="font-size: 5px">&nbsp;</span></a></li>
                        <li><a href="{{ route('credits', \App\Http\Controllers\HomeController::CREDITS_OVERPAID) }}">Overpaid <span class="badge badge-warning" style="font-size: 5px">&nbsp;</span></a></li>
                        <li><a href="{{ route('credits', \App\Http\Controllers\HomeController::WIDGET_CLEARED) }}">Cleared <span class="badge badge-success" style="font-size: 5px">&nbsp;</span></a></li>
                    </ul>
                </li>
                <li class="sidenav-heading">Administration</li>
                <li class="sidenav-item">
                    <a href="{{ route('users') }}">
                        <span class="sidenav-icon icon icon-users"></span>
                        <span class="sidenav-label">System Users</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
