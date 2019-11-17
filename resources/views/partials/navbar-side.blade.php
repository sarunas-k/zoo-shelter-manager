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
       @if(Auth::user()->isAdmin())
        <li class="nav-item">
          <a class="nav-link" href="{{route('settings')}}">
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
       @endif
       <li class="nav-item">
       <a class="nav-link" href="{{route('animals.index', ['only_adopted_reclaimed' => true])}}">
           <span data-feather="book"></span>
           Off-shelter animals
         </a>
       </li>
     </ul>
     
 
     {{-- <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
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
       
     </ul> --}}
   </div>
 </nav>

@section('scripts')
  <script>
    const pageName = document.title.substr(document.title.indexOf('|') + 2);
    let currentPage = 'Dashboard';
    switch(pageName) {
      case 'Animals':
      case 'Edit Animal':
      case 'Animal details':
      case 'New Procedure':
        currentPage = 'Animals';
        break;
      case 'New Animal':
        currentPage = 'Add Animal';
        break;
      case 'Calls':
        currentPage = 'Calls';
        break;
      case 'New Call':
        currentPage = 'Add Call';
        break;
      case 'Adoptions':
      case 'New Adoption':
      case 'Edit Adoption':
        currentPage = 'Adoptions';
        break;
      case 'Fosters':
      case 'New Foster':
      case 'Edit Foster':
        currentPage = 'Fosters';
        break;
      case 'Reclaims':
      case 'New Reclaim':
      case 'Edit Reclaim':
        currentPage = 'Reclaims';
        break;
      case 'Living Areas':
        currentPage = 'Living Areas';
        break;
      case 'People':
      case 'New Person':
      case 'Edit Person':
        currentPage = 'People';
        break;
      case 'Reports':
        currentPage = 'Reports';
        break;
      case 'Settings':
        currentPage = 'Settings';
        break;
      case 'Animals off shelter':
        currentPage = 'Off-shelter animals';
        break;
    }
    
    window.addEventListener('load', () => {
        $('.sidebar .nav-link').each((i, element) => {
            if ($(element).text().indexOf(currentPage) >= 0)
                $(element).addClass('active');
            else
                $(element).removeClass('active');
        });
    });
</script>
@endsection