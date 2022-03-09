 <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
 <link href="{{ asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/structure.css?v=-100') }}" rel="stylesheet" type="text/css" class="structure" />
 <!-- END GLOBAL MANDATORY STYLES -->


 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
 <link href="{{ asset('assets/css/apps/scrumboard.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/apps/notes.css') }}" rel="stylesheet" type="text/css" /> 
 


 <link href="{{ asset('plugins/font-icons/fontawesome/css/fontawesome.css') }}" rel="stylesheet" type="text/css">
 <link href="{{ asset('css/fontawesome.css') }}" rel="stylesheet" type="text/css" />

 <link href="{{ asset('assets/css/elements/avatar.css') }}" rel="stylesheet" type="text/css" />

 <link href="{{ asset('plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
 
 
 <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" />

  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/widgets/modules-widgets.css') }}">   
  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">


  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/flatpickr/flatpickr.dark.css') }}">

 <style>
   aside{
      display: none!important;
  }
    .page-item.active .page-link {
    z-index: 3;
    color: #fff;
    background-color: #ff0000;
    border-color: #ff0000;
  }

  /*GLOBAL STYLES*/
  @media (max-width: 480px) 
  {
      .mtmobile {
        margin-bottom: 20px!important;
      }
      .mbmobile {
        margin-bottom: 10px!important;
      }
      .hideonsm {
        display: none!important;
      }
      .inblock {
        display: block;
      }
    }

    /*background color SIDEBAR*/
    .sidebar-theme #compactSidebar {
      background: #f7f5f7!important;
    }

    /*color SIDEBAR COLLAPSE*/
	.header-container .sidebarCollapse {
		color: #3B3F5C!important;
	}

	/*search*/
	.navbar .navbar-item .nav-item form.form-inline input.search-form-control {
		font-size: 15px;
		background-color: #ff0000;
		padding-right: 40px;
		padding-top: 12px;
		border: none;
		color: #fff;
		box-shadow: none;
		border-radius: 30px;
    opacity: 0;
	}

  .sidebar-wrapper #compactSidebar .menu-categories a.menu-toggle .base-menu span {
    font-size: 11px;
    font-weight: 600;
    margin-top: 8px;
    display: inline-block;
    color: #333;
  }

  .sidebar-wrapper #compactSidebar .menu-categories a.menu-toggle[data-active="true"] .base-menu span {
    color: #333;
    font-size: 11px; }

    .sidebar-wrapper #compactSidebar .menu-categories a.menu-toggle .base-icons svg {
      position: relative;
      top: -3px;
      display: inline-block;
      color: #333;
      vertical-align: middle;
      width: 12px;
      height: 12px;
      fill: rgba(224, 230, 237, 0.109804);
      stroke-width: 0.7px; }

      .sidebar-wrapper #compactSidebar .menu-categories a.menu-toggle[data-active="true"] .base-icons svg {
        color: #333;}

        .sidebar-wrapper #compactSidebar .menu-categories a.menu-toggle {
          height: 40px;
          display: flex;
          justify-content: center;
          align-items: center;
          font-size: 13px;
          font-style: normal;
          font-weight: bold;
          color: #515365;
          transition: color .3s;
          transition: background .3s; }

  .backgroud-table-th{
    background-color: #ff0000
  }
  td a.btn{
    width: 23px!important; 
    height: 23px!important;
    padding: 0!important;
  }
  h1, h2, h3, h4, h5, h6 {
    color: #333!important;
    text-transform: uppercase!important;
  }


  .table-responsive table tbody tr td *{
    font-size: 11px!important;
    /*font-weight: bolder;*/
  }

  h4.card-title, h4.card-title *{font-size: 15px!important; font-style:italic}

  .navbar {background: #f7f5f7!important;border-bottom:0px!important}

  select.order_status, select.order_status option{width: 130px; color:white; font-weight:bold!important;}

  .select-person-relations{width: 300px!important; position:relative; left: -15px}

  .delete-attribute-btn{border-radius: 50px; padding: 1px!important; width: 21px; height: 21px; position:relative; left:9px}


</style>


@livewireStyles