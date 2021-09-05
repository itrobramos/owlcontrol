<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
    {{-- <li class="nav-item">
      <a href="#" class="nav-link">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
          Dashboard
          <i class="right fas fa-angle-left"></i>
          </p>
      </a>
      <ul class="nav nav-treeview">
          <li class="nav-item">
          <a href="../../index.html" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Dashboard v1</p>
          </a>
          </li>
      </ul>
    </li> --}}

    {{-- @hasrole('super admin')
    <li class="nav-item">
        <a href="{{ route('platforms.index') }}" class="nav-link">
          <i class="fab fa-uber"></i>
          <p class="text">Plataformas</p>
        </a>
    </li>
    @endhasanyrole --}}


    <li class="nav-item">
      <a href="{{url('boxes')}}" class="nav-link">
        <i class="fas fa-box-open"></i>
        <p class="text">Cajas</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{url('box_types')}}" class="nav-link">
        <i class="fas fa-box"></i>
        <p class="text">Tipos de Caja</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{url('product_types')}}" class="nav-link">
        <i class="fas fa-candy-cane"></i>
        <p class="text">Tipos de Productos</p>
      </a>
    </li>
    
    

    <li class="nav-item">
      <a href="#" class="nav-link">
          <i class="nav-icon fas fa-fan"></i>
          <p>
              Productos
              <i class="right fas fa-angle-left"></i>
          </p>
      </a>
      <ul class="nav nav-treeview" style="display: none;">



        <li class="nav-item">
          <a href="{{url('products')}}" class="nav-link">
            <i class="fas fa-fan"></i>
            <p class="text">Catálogo</p>
          </a>
        </li>

        {{-- <li class="nav-item">
          <a href="{{url('products')}}" class="nav-link">
            <i class="fas fa-fan"></i>
            <p class="text">Inventario</p>
          </a>
        </li>

        <li class="nav-item">
          <a href="{{url('products')}}" class="nav-link">
            <i class="fas fa-fan"></i>
            <p class="text">Entrada Mercancía</p>
          </a>
        </li> --}}


        <li class="nav-item">
          <a href="{{url('entries')}}" class="nav-link">
            <i class="fas fa-fan"></i>
            <p class="text">Entradas</p>
          </a>
        </li>
          
          
          
          
      </ul>
  </li>


  <li class="nav-item">
    <a href="{{url('payment_methods')}}" class="nav-link">
      <i class="fas fa-dragon"></i>
      <p class="text">Métodos de Pago</p>
    </a>
  </li>


    <li class="nav-item">
      <a href="{{url('suppliers')}}" class="nav-link">
        <i class="fas fa-people-carry"></i>
        <p class="text">Proveedores</p>
      </a>
    </li>

    <li class="nav-item">
      <a href="{{url('thematics')}}" class="nav-link">
        <i class="fas fa-dragon"></i>
        <p class="text">Temáticas</p>
      </a>
    </li>

    <li class="nav-item mt-5">
        <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i>
          <p class="text">Cerrar sesión</p>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
          @csrf
        </form>
    </li>

</ul>