<!-- This file is used to store sidebar items, starting with Backpack\Base 0.9.0 -->
<li class="nav-item"><a class="nav-link" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a></li>
<li class="nav-item my-3" style="border-bottom: 1px solid #9c9c9c"></li>
<li class='nav-item pl-2'>Gestion de usuarios</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('contact') }}'><i style="font-size: 1.5rem;" class='nav-icon la la-question'></i> Contacts 
    @if(count(DB::table('contacts')->where('state',false)->get()) > 0)
        <span class="badge badge-danger">{{ count(DB::table('contacts')->where('state',false)->get())}} activo/s</span>
    @else
        <span class="badge badge-success">{{ count(DB::table('contacts')->where('state',false)->get())}} activos</span>
    @endif
</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('user') }}'><i style="font-size: 1.5rem;" class='nav-icon la la-users'></i> Usuarios</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('report') }}'><i style="font-size: 1.5rem;" class='nav-icon la la-exclamation-triangle'></i> Reportes
    @if(count(DB::table('reports')->whereDate('created_at', Carbon\Carbon::today())->get()) > 0)
        <span class="badge badge-danger">{{ count(DB::table('reports')->whereDate('created_at', Carbon\Carbon::today())->get()) }} hoy </span>
    @else
        <span class="badge badge-success">{{ count(DB::table('reports')->whereDate('created_at', Carbon\Carbon::today())->get()) }} hoy </span>
    @endif
</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('spymodel') }}'><i style="font-size: 1.5rem;" class='nav-icon la la-user-secret'></i> Espia</a></li>
<li class="nav-item my-3" style="border-bottom: 1px solid #9c9c9c"></li>
<li class='nav-item pl-2'>Gestion de entradas</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('post') }}'><i style="font-size: 1.5rem;" class='nav-icon la la-pencil-square-o'></i> Entradas</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('comment') }}'><i style="font-size: 1.5rem;" class='nav-icon la la-comments'></i> Comentarios</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('savepost') }}'><i style="font-size: 1.5rem;" class='nav-icon la la-save'></i> Entradas guardadas</a></li>
<li class="nav-item my-3" style="border-bottom: 1px solid #9c9c9c"></li>
<li class='nav-item pl-2'>Gestion de Eventos</li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('event') }}'><i style="font-size: 1.5rem;" class='nav-icon la la-lightbulb-o'></i> Eventos</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('myeventcomment') }}'><i style="font-size: 1.5rem;" class='nav-icon la la-commenting-o'></i> Comentarios</a></li>
<li class='nav-item'><a class='nav-link' href='{{ backpack_url('favoritepost') }}'><i style="font-size: 1.5rem;" class='la la-heart-o'></i> EntradasFav</a></li>