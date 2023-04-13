<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item nav-profile">
            <div class="nav-link">
                <div class="profile-image"> <img src="{{ asset('assets/images/faces/face4.jpg') }}" alt="image" /> <span class="online-status online"></span> </div>
                <div class="profile-name">
                    <p class="name">Richard V.Welsh</p>
                    <p class="designation">Manager</p>
                    <div class="badge badge-teal mx-auto mt-3">Online</div>
                </div>
            </div>
        </li>
        <li class="nav-item"><a class="nav-link" href="{{ route('admin.index') }}"><img class="menu-icon" src="{{ asset('assets/images/menu_icons/01.png') }}" alt="menu icon"><span class="menu-title">Dashboard</span></a></li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.products') }}" aria-expanded="false" aria-controls="general-pages"> <span class="menu-title"> Manage Products</span><i></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.categories') }}" aria-expanded="false" aria-controls="general-pages"> <span class="menu-title"> Manage Category</span><i></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.brands') }}" aria-expanded="false" aria-controls="general-pages"> <span class="menu-title"> Manage Brands</span><i></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.divisions') }}" aria-expanded="false" aria-controls="general-pages"> <span class="menu-title"> Manage Divisions</span><i></i></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('admin.districts') }}" aria-expanded="false" aria-controls="general-pages"> <span class="menu-title"> Manage Districts</span><i></i></a>
        </li>
    </ul>
</nav>
<!-- partial -->
