<div class="lg:float-left lg:w-1/12 md:w-2/12 bg-page md:bg-gray-900 text-default  text-center w-full fixed bottom-0 md:pt-8 md:top-0 md:left-0 h-16 md:h-screen">
    <div class="relative mx-auto"> 
        <ul class="list-reset flex flex-row md:flex-col text-center md:text-left">
            <li class="mr-3 flex-1">
                <a href="#" class="sidebar-item {{ request()->routeIs('agenda') ? 'active' : '' }}">
                <i class="fas fa-link pr-0 md:pr-3"></i><span class="sidebar-text">Agenda</span>
                </a>
            </li>
            <li class="mr-3 flex-1">
                <a href="/projects" class="sidebar-item {{ request()->routeIs('projects') ? 'active' : '' }}">
               
                <i class="fas fa-link pr-0 md:pr-3"></i><span class="sidebar-text">Projects</span>
                </a>
            </li>
            <li class="mr-3 flex-1">
                <a href="/tasks" class="sidebar-item {{ request()->routeIs('tasks') ? 'active' : '' }}">
                <i class="fas fa-link pr-0 md:pr-3 text-pink-500"></i><span class="sidebar-text">Tasks</span>
                </a>
            </li>
            
        </ul>
    </div>
 </div>