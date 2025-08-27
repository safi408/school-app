      <style>
    .brand-text {
        margin-left: 4px; /* Adjust as needed */
    }
      .app-sidebar {
      background-color: #2c3e50; /* School theme professional dark blue */
      color: white;
  }

  .app-sidebar .nav-link,
  .app-sidebar .brand-text {
      color: white;
  }

  .app-sidebar .nav-link:hover,
  .app-sidebar .nav-link.active {
      background-color: #1abc9c; /* Light teal hover */
      color: #fff;
  }

  .app-sidebar .nav-icon {
      color: #f1c40f; /* Golden icons for educational touch */
  }
</style>

      <aside  class="app-sidebar" data-bs-theme="dark">
        <!--begin::Sidebar Brand-->
        <div class="sidebar-brand text-white">
          <!--begin::Brand Link-->
          <a href="{{route('dashboard')}}" class="brand-link d-flex align-items-center">
    <i class="fas fa-school"></i>
    <span class="brand-text fw-light">School Admin</span>
</a>

          <!--end::Brand Link-->
        </div>
        <!--end::Sidebar Brand-->
        <!--begin::Sidebar Wrapper-->
        <div class="sidebar-wrapper">
          <nav class="mt-2 position-relative">
            <!--begin::Sidebar Menu-->
            <ul
              class="nav sidebar-menu flex-column"
              data-lte-toggle="treeview"
              role="menu"
              data-accordion="false"
            >
           
              <li class="nav-item">
                <a href="{{route('dashboard')}}" class="nav-link">
                  <i class="nav-icon bi bi-house-fill"></i>
                  <p>
                    Dashboard
                  </p>
                </a>
                <ul class="nav nav-treeview">
                </ul>
              </li>
             
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-book me-1"></i>
                  <p>
                     Subjects
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('subjects.add.subject')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add Subjects</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('subjects.manage.subject')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Manage Subjects</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-person-badge me-1"></i>
                  <p>
                   Teachers
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('teachers.add.teacher')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add Teacher</p>
                    </a>
                 
                      <li class="nav-item">
                    <a href="{{route('teachers.manage.teacher')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Manage Teacher</p>
                    </a>
                  </li>
                </ul>
              </li>
             <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class=" nav-icon bi bi-building me-1"></i>
                  <p>
                    Classes
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('classes.add.class')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add Classes</p>
                    </a>
                  </li>
                      <li class="nav-item">
                    <a href="{{route('classes.manage.class')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Manage Class</p>
                    </a>
                  </li>
                   
                </ul>
              </li>
                 <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-people me-1"></i>
                  <p>
                    Students
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('students.add.student')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add Students</p>
                    </a>
                  </li>

                      <li class="nav-item">
                    <a href="{{route('students.manage.student')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Manage Students</p>
                    </a>
                  </li>
                  
                </ul>
                             <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon bi bi-journal-text me-1"></i> 
                  <p>
                    Notes
                    <i class="nav-arrow bi bi-chevron-right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('notices.add.notice')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Add Notice</p>
                    </a>
                  </li>
                    <li class="nav-item">
                    <a href="{{route('notices.manage.notice')}}" class="nav-link">
                      <i class="nav-icon bi bi-circle"></i>
                      <p>Manage Notice</p>
                    </a>
                  </li>
                </ul>
              </li>
              </li>
              <!-- Add this inside your existing <ul class="nav sidebar-menu flex-column"> -->

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon bi bi-check2-square me-1"></i>
        <p>
            Attendance
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('attendance.create')}}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Mark Attendance</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('attendance.manage')}}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Manage Attendance</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('attendance.records')}}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Attendance Records</p>
            </a>
        </li>
    </ul>
</li>

<li class="nav-item">
    <a href="#" class="nav-link">
        <i class="nav-icon bi bi-calendar-week me-1"></i>
        <p>
            Timetable
            <i class="nav-arrow bi bi-chevron-right"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="{{route('timetables.create')}}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Add Timetable</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{route('timetables.list')}}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Manage Timetable</p>
            </a>
        </li>
         <li class="nav-item">
            <a href="{{route('timetables.listed')}}" class="nav-link">
                <i class="nav-icon bi bi-circle"></i>
                <p>Show Timetable</p>
            </a>
        </li>
    </ul>
</li>
<li class="nav-item">
    <a href="#" class="nav-link text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
        <i class="nav-icon bi bi-box-arrow-right me-3"></i>
          <span>   Logout</span>
    </a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</li>



  </ul>
            
                     
            <!--end::Sidebar Menu-->
          </nav>
    
        </div>
        <!--end::Sidebar Wrapper-->
        
      </aside>