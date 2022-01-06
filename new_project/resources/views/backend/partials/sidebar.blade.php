<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            FYP<span>PORTAL</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item">
                <a href="{{ url('dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item nav-category">Manage</li>
            @if (auth()->user()->hasRole('admin'))
            <li class="nav-item">
                <a href="{{ url('/admin/roles') }}" class="nav-link">
                    <i class="link-icon" data-feather="shield"></i>
                    <span class="link-title">Roles</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/permissions') }}" class="nav-link">
                    <i class="link-icon" data-feather="unlock"></i>
                    <span class="link-title">Permissions</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/users') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/applications') }}" class="nav-link">
                    <i class="link-icon" data-feather="chrome"></i>
                    <span class="link-title">Student Applications</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/groups') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Groups</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ url('/admin/supervisors') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Supervisors</span>
                </a>
            </li>
            @elseif(auth()->user()->hasRole('group'))
            <li class="nav-item">
                <a href="{{ url('/group/supervisors') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Supervisors</span>
                </a>
            </li>
            @if (\App\Models\Proposal::where(['user_id' => auth()->id(), 'is_accepted' => 1])->exists())
            <li class="nav-item">
                <a href="{{ url('/group/mid-term-report') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Mid Term Report</span>
                </a>
            </li>
            @endif
            @if (\App\Models\MidTermReport::where(['user_id'=> auth()->id()])->where('is_accepted', '!=',
            null)->exists())
            <li class="nav-item">
                <a href="{{ url('/group/report-status') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Report Status</span>
                </a>
            </li>
            @endif
            @if (\App\Models\MidTermReport::where(['user_id'=> auth()->id()])->where('is_accepted', 1)->exists())
            <li class="nav-item">
                <a href="{{ url('/group/project') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Project</span>
                </a>
            </li>
            @endif
            @if (\App\Models\Project::where(['user_id'=> auth()->id()])->where('is_accepted', '!=', null)->exists())
            <li class="nav-item">
                <a href="{{ url('/group/project-status') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Project Status</span>
                </a>
            </li>
            @endif
            @if (\App\Models\Viva::where(['user_id'=> auth()->id()])->exists())
            <li class="nav-item">
                <a href="{{ url('/group/viva') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Viva Detail</span>
                </a>
            </li>
            @endif


            <li class="nav-item">
                <a href="{{ url('/group/profile') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Profile</span>
                </a>
            </li>

            @elseif(auth()->user()->hasRole('supervisor'))
            @if (\App\Models\Proposal::count()>0)
            <li class="nav-item">
                <a href="{{ url('/supervisor/student-proposals') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Proposals</span>
                </a>
            </li>
            @endif
            @if (\App\Models\MidTermReport::count()>0)
            <li class="nav-item">
                <a href="{{ url('/supervisor/mid-term-report') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Mid Term Report</span>
                </a>
            </li>
            @endif
            @if (\App\Models\Project::count()>0)
            <li class="nav-item">
                <a href="{{ url('/supervisor/projects') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Projects</span>
                </a>
            </li>
            @endif

            @if (\App\Models\Project::where('is_accepted', 1)->exists())
            <li class="nav-item">
                <a href="{{ url('/supervisor/viva') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Viva Detail</span>
                </a>
            </li>
            @endif
            <li class="nav-item">
                <a href="{{ url('/supervisor/profile') }}" class="nav-link">
                    <i class="link-icon" data-feather="users"></i>
                    <span class="link-title">Profile</span>
                </a>
            </li>

            @endif
        </ul>
    </div>
</nav>
<nav class="settings-sidebar">
    <div class="sidebar-body">
        <a href="#" class="settings-sidebar-toggler">
            <i data-feather="settings"></i>
        </a>
        <h6 class="text-muted">Sidebar:</h6>
        <div class="form-group border-bottom">
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarLight"
                        value="sidebar-light" checked>
                    Light
                </label>
            </div>
            <div class="form-check form-check-inline">
                <label class="form-check-label">
                    <input type="radio" class="form-check-input" name="sidebarThemeSettings" id="sidebarDark"
                        value="sidebar-dark">
                    Dark
                </label>
            </div>
        </div>
        <div class="theme-wrapper">
            <h6 class="text-muted mb-2">Light Theme:</h6>
            <a class="theme-item active" href="{{ asset('demo_1/dashboard-one.html') }}">
                <img src="{{ asset('assets/images/screenshots/light.jpg') }}" alt="light theme">
            </a>
            <h6 class="text-muted mb-2">Dark Theme:</h6>
            <a class="theme-item" href="{{ asset('demo_2/dashboard-one.html') }}">
                <img src="{{ asset('assets/images/screenshots/dark.jpg') }}" alt="light theme">
            </a>
        </div>
    </div>
</nav>