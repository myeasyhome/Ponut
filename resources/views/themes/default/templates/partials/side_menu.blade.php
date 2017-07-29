<!-- Side Menu -->
<aside id="menu">
    <div id="navigation">
        <ul class="nav" id="side-menu">
            <li class="{{ ($shared_data['sider_menu_data']['dashboard']) ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard.index.render') }}"> <span class="nav-label">Dashboard</span></a>
            </li>
            <li class="{{ ($shared_data['sider_menu_data']['departments']['base']) ? 'active' : '' }}">
                <a href="#"><span class="nav-label">Departments</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ ($shared_data['sider_menu_data']['departments']['all']) ? 'active' : '' }}"><a href="{{ route('admin.departments.index.render') }}">All Departments</a></li>
                    <li class="{{ ($shared_data['sider_menu_data']['departments']['add']) ? 'active' : '' }}"><a href="{{ route('admin.departments.add.render') }}">Add New</a></li>
                </ul>
            </li>
            <li class="{{ ($shared_data['sider_menu_data']['jobs']['base']) ? 'active' : '' }}">
                <a href="#"><span class="nav-label">Jobs</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ ($shared_data['sider_menu_data']['jobs']['all']) ? 'active' : '' }}"><a href="{{ route('admin.jobs.index.render') }}">All Jobs</a></li>
                    <li class="{{ ($shared_data['sider_menu_data']['jobs']['add']) ? 'active' : '' }}"><a href="{{ route('admin.jobs.add.render') }}">Add New</a></li>
                </ul>
            </li>
            <li class="{{ ($shared_data['sider_menu_data']['candidates']['base']) ? 'active' : '' }}">
                <a href="#"><span class="nav-label">Candidates</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ ($shared_data['sider_menu_data']['candidates']['all']) ? 'active' : '' }}"><a href="{{ route('admin.candidates.index.render') }}">All Candidates</a></li>
                    <li class="{{ ($shared_data['sider_menu_data']['candidates']['add']) ? 'active' : '' }}"><a href="{{ route('admin.candidates.add.render') }}">Add New</a></li>
                </ul>
            </li>
            <li class="{{ ($shared_data['sider_menu_data']['users']['base']) ? 'active' : '' }}">
                <a href="#"><span class="nav-label">Users</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ ($shared_data['sider_menu_data']['users']['all']) ? 'active' : '' }}"><a href="{{ route('admin.users.index.render') }}">All Users</a></li>
                    <li class="{{ ($shared_data['sider_menu_data']['users']['add']) ? 'active' : '' }}"><a href="{{ route('admin.users.add.render') }}">Add New</a></li>
                </ul>
            </li>
            <li class="{{ ($shared_data['sider_menu_data']['calendar']) ? 'active' : '' }}">
                <a href="{{ route('admin.calendar.index.render') }}"> <span class="nav-label">Calendar</span></a>
            </li>
            <li class="{{ ($shared_data['sider_menu_data']['appearance']['base']) ? 'active' : '' }}">
                <a href="#"><span class="nav-label">Appearance</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ ($shared_data['sider_menu_data']['appearance']['themes']) ? 'active' : '' }}"><a href="{{ route('admin.appearance.themes.render') }}">Themes</a></li>
                    <li class="{{ ($shared_data['sider_menu_data']['appearance']['customize']) ? 'active' : '' }}"><a href="{{ route('admin.appearance.customize.render') }}">Customize</a></li>
                </ul>
            </li>
            <li class="{{ ($shared_data['sider_menu_data']['plugins']) ? 'active' : '' }}">
                <a href="{{ route('admin.plugins.index.render') }}"> <span class="nav-label">Plugins</span></a>
            </li>
            <li class="{{ ($shared_data['sider_menu_data']['tools']['base']) ? 'active' : '' }}">
                <a href="#"><span class="nav-label">Tools</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ ($shared_data['sider_menu_data']['tools']['export']) ? 'active' : '' }}"><a href="{{ route('admin.tools.export.render') }}">Export</a></li>
                    <li class="{{ ($shared_data['sider_menu_data']['tools']['import']) ? 'active' : '' }}"><a href="{{ route('admin.tools.import.render') }}">Import</a></li>
                    <li class="{{ ($shared_data['sider_menu_data']['tools']['backups']) ? 'active' : '' }}"><a href="{{ route('admin.tools.backups.render') }}">Backups</a></li>
                </ul>
            </li>
            <li class="{{ ($shared_data['sider_menu_data']['settings']['base']) ? 'active' : '' }}">
                <a href="#"><span class="nav-label">Settings</span><span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li class="{{ ($shared_data['sider_menu_data']['settings']['general']) ? 'active' : '' }}"><a href="{{ route('admin.settings.general.render') }}">General</a></li>
                    <li class="{{ ($shared_data['sider_menu_data']['settings']['advanced']) ? 'active' : '' }}"><a href="{{ route('admin.settings.advanced.render') }}">Advanced</a></li>
                    <li class="{{ ($shared_data['sider_menu_data']['settings']['routes']) ? 'active' : '' }}"><a href="{{ route('admin.settings.routes.render') }}">Routes</a></li>
                    <li class="{{ ($shared_data['sider_menu_data']['settings']['roles']) ? 'active' : '' }}"><a href="{{ route('admin.settings.roles.render') }}">Roles</a></li>
                    <li class="{{ ($shared_data['sider_menu_data']['settings']['permissions']) ? 'active' : '' }}"><a href="{{ route('admin.settings.permissions.render') }}">Permissions</a></li>
                    <li class="{{ ($shared_data['sider_menu_data']['settings']['about']) ? 'active' : '' }}"><a href="{{ route('admin.settings.about.render') }}">About</a></li>
                </ul>
            </li>
        </ul>
    </div>
</aside>