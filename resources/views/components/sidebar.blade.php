<style>
/* The sidebar menu */
.left-sidenav {
  height: 100%; /* Full-height: remove this if you want "auto" height */
  position: fixed; /* Fixed Sidebar (stay in place on scroll) */
  z-index: 1; /* Stay on top */
  top: 0; /* Stay at the top */
  left: 0;
  background-color: ; /* Black */
  padding-top: 20px;
}


</style>

<div class="sidebar-gradient set-color left-sidenav">
<div class=" text-center">  
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar toggled  sidebar-dark accordion " id="accordionSidebar" >

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('pages.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
          <i class="fas fa-window-restore"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Flashify <sup>2</sup></div>
      </a>

            <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('pages.dashboard') }}">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>



      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
        Flashcard Sets  
      </div>

      <li class="nav-item">
        <a class="nav-link" href="{{ route('pages.my-sets') }}">
          <i class="fas fa-fw fa-window-restore"></i>
          <span>My Card Sets</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{ route('pages.editor') }}">
          <i class="fas fa-fw fa-plus"></i>
          <span>Create A Set</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
         Community 
      </div>

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="{{ route('pages.search') }}">
          <i class="fas fa-fw fa-search"></i>
          <span>Browse Card Sets</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" onclick="moveContentForSidebar();" id="sidebarToggle"></button>
      </div>
    
  


    </ul>

    </div>
    </div>



