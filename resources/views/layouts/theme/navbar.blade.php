<nav id="compactSidebar">
<ul class="menu-categories">
@can('category_index')
        <li class="">
            <a href="{{url('categories')}}" data-active="true" class="menu-toggle">
                <div class="base-menu">
                    <div class="base-icons">
                     <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                     <span>CATEGORIAS</span>
                    </div>
             </div>
         </a>
     </li>
@endcan
@can('product_index', 'ver_productos')
     <li class="">
        <a href="{{url('products')}}" class="menu-toggle">
            <div class="base-menu">
                <div class="base-icons">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                    <span>PRODUCTOS</span>
                </div>
            </div>
        </a>
    </li>
@endcan









<li class="">
    <a href="{{url('variations')}}" class="menu-toggle">
        <div class="base-menu">
            <div class="base-icons">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                <span>VARIACIONES</span>
            </div>
        </div>
    </a>
</li>






<li class="">
    <a href="{{url('price-list')}}" class="menu-toggle">
        <div class="base-menu">
            <div class="base-icons">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                <span>LISTA DE PRECIOS</span>
            </div>
        </div>
    </a>
</li>


<li class="">
    <a href="{{url('payment-type')}}" class="menu-toggle">
        <div class="base-menu">
            <div class="base-icons">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                <span>METODOS DE PAGO</span>
            </div>
        </div>
    </a>
</li>








@can('order_index')
     <li class="">
        <a href="{{url('orders')}}" class="menu-toggle">
            <div class="base-menu">
                <div class="base-icons">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                    <span>ORDENES</span>
                </div>
            </div>
        </a>
    </li>
@endcan

@can('ver_productos_fabricas')
     <li class="">
        <a href="{{url('productos-fabricas')}}" class="menu-toggle">
            <div class="base-menu">
                <div class="base-icons">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7.01" y2="7"></line></svg>
                    <span>PRODUCTOS FABRICA</span>
                </div>
            </div>
        </a>
</li>
@endcan
@can('compras_fabrica')
     <li class="">
        <a href="{{url('ventas-fabricas')}}" class="menu-toggle">
          <div class="base-menu">
              <div class="base-icons">
               <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
               <span>NUEVO PEDIDO</span>
            </div>
       </div>
        </a>
    </li>
@endcan
@can('sale_index')
    <li class="">
        <a href="{{url('pos')}}" data-active="false" class="menu-toggle">
            <div class="base-menu">
                <div class="base-icons">
                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
                 <span>VENTA POS</span>
             </div>
            </div>
        </a>
    </li>
@endcan
@can('role_index')
 <li class="">
    <a href="{{url('roles')}}" data-active="false" class="menu-toggle">
        <div class="base-menu">
            <div class="base-icons">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-key"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path></svg>
             <span>ROLES</span>
         </div>
     </div>
 </a>
</li>
@endcan
@can('permission_index')
<li class="">
    <a href="{{url('permisos')}}" data-active="false" class="menu-toggle">
        <div class="base-menu">
            <div class="base-icons">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check-square"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>
            <span>PERMISOS</span> 
        </div>
     </div>
 </a>
</li>
@endcan
@can('assign_index')
<li class="">
    <a href="{{url('asignar')}}" data-active="false" class="menu-toggle">
        <div class="base-menu">
            <div class="base-icons">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            <span>ASIGNAR</span>
        </div>
     </div>
 </a>
</li>
@endcan


@can('associate_index')
<li class="">
    <a href="{{url('asociar')}}" data-active="false" class="menu-toggle">
        <div class="base-menu">
            <div class="base-icons">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
            <span>ASOCIAR</span>
        </div>
     </div>
 </a>
</li>
@endcan


@can('user_index')
<li class="">
    <a href="{{url('users')}}" data-active="false" class="menu-toggle">
        <div class="base-menu">
            <div class="base-icons">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
             <span>USUARIOS</span>
        </div>
     </div>
 </a>
</li>
@endcan

@can('client_index')
<li class="">
    <a href="{{url('clients')}}" data-active="false" class="menu-toggle">
        <div class="base-menu">
            <div class="base-icons">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
             <span>CLIENTES</span>
        </div>
     </div>
 </a>
</li>
@endcan

@can('denomination_index')
<li class="">
    <a href="{{url('coins')}}" data-active="false" class="menu-toggle">
        <div class="base-menu">
            <div class="base-icons">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-stop-circle"><circle cx="12" cy="12" r="10"></circle><rect x="9" y="9" width="6" height="6"></rect></svg>
            <span>MONEDAS</span>
         </div>
     </div>
 </a>
</li>
@endcan
@can('cashout_index')
<li class="">
    <a href="{{url('cashout')}}" data-active="false" class="menu-toggle">
        <div class="base-menu">
            <div class="base-icons">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
            <span>ARQUEOS</span>
         </div>
     </div>
 </a>
</li>
@endcan
@can('report_index')
<li class="">
    <a href="{{url('reports')}}" data-active="false" class="menu-toggle">
        <div class="base-menu">
            <div class="base-icons">
             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-pie-chart"><path d="M21.21 15.89A10 10 0 1 1 8 2.83"></path><path d="M22 12A10 10 0 0 0 12 2v10z"></path></svg>
             <span>REPORTES</span>
         </div>
     </div>
 </a>
</li>
@endcan
</ul>
</nav>
<!--
<div id="compact_submenuSidebar" class="submenu-sidebar" style="display: none!important">
</div>
-->