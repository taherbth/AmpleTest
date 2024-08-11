<div class="d-flex" x-data="{ open: true }">
    <!-- Sidebar -->
    <div :class="open ? 'd-block' : 'd-none'" class="bg-light border-right" id="sidebar-wrapper" style="width: 250px;">
        <div class="sidebar-heading text-center py-4 primary-text fs-4 fw-bold text-uppercase border-bottom">
            Link Harvester App
        </div>
        <div class="list-group list-group-flush my-3">
            <a href="#" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Dashboard</a>
            <a href="{{url('domains/create')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Create Domains</a>          
            <a href="{{url('domains')}}" class="list-group-item list-group-item-action bg-transparent second-text fw-bold">Lists Domains</a>    
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-700  font-bold py-2 px-4 rounded">
                    Logout
                </button>
        </form>
        </div>
    </div>

    <!-- Page Content -->
    <div id="page-content-wrapper" style="flex: 1;">
        <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
            <button class="btn btn-primary" @click="open = !open">
                <span x-show="!open">☰ Open Sidebar</span>
                <span x-show="open">✖ Close Sidebar</span>
            </button>
        </nav>
    </div>
</div>