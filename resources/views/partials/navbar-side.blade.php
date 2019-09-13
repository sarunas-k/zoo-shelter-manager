<nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-1 mb-2 text-muted">
              <span>Facility</span>
            </h6>
            <li class="nav-item">
                <form class="form-inline">
                    <select class="form-control mr-sm-2 text-center form-control-sm" aria-label="Group" style="width: 100%; margin-left: 15px; margin-bottom: 10px">
                      <option>Queenstown shelter</option>
                      <option>Cathouse in clinic</option>
                      <option>Rundalough shelter</option>
                    </select>
                  </form>
            </li> --}}
            <li class="nav-item">
              <a class="nav-link active" href="/">
                <span data-feather="home"></span>
                Dashboard <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('animals.index')}}">
                <span data-feather="clipboard"></span>
                Animals
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('animals.create')}}">
                <span data-feather="plus"></span>
                Add Animal
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('calls.index')}}">
                <span data-feather="list"></span>
                Calls
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('calls.create')}}">
                <span data-feather="phone"></span>
                Add Call
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('adoptions.index')}}">
                <span data-feather="briefcase"></span>
                Adoptions
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('fosters.index')}}">
                <span data-feather="sun"></span>
                Fosters
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('reclaims.index')}}">
                <span data-feather="arrow-left-circle"></span>
                Reclaims
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('living-areas.index')}}">
                <span data-feather="grid"></span>
                Living Areas
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('people.index')}}">
                <span data-feather="user"></span>
                People
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/settings">
                <span data-feather="sliders"></span>
                Settings
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{route('reports.index')}}">
                <span data-feather="bar-chart-2"></span>
                Reports
              </a>
            </li>
          </ul>
          
  
          <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span>Saved reports</span>
            <a class="d-flex align-items-center text-muted" href="#">
              <span data-feather="plus-circle"></span>
            </a>
          </h6>
          <ul class="nav flex-column mb-2">
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Current month
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Last quarter
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Social engagement
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file-text"></span>
                Year-end sale
              </a>
            </li>
            
          </ul>
        </div>
      </nav>