
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->

    <ul class="sidebar-menu">
      <li class="header"></li>

      <li class="@if(Request::is('admin/dashboard')) active @endif treeview">
        <a href="{{url('admin/dashboard')}}">
          <i class="fa fa-tachometer"></i> <span>Dashboard</span>
        </a>
      </li>

      <li class="header"></li>

        <li class="@if(Request::is('admin/users') ||Request::is('admin/users/*') ) active @endif treeview">
          <a href="{{url('admin/users')}}">
            <i class="fa fa-user-circle-o"></i> <span>Users</span>
          </a>
        </li>
        <li class="@if(Request::is('admin/ourTeam') ||Request::is('admin/ourTeam/*') ) active @endif treeview">
          <a href="{{url('admin/ourTeam')}}">
            <i class="fa fa-user-circle-o"></i> <span>Our Team</span>
          </a>
        </li>
        <li class="@if(Request::is('admin/freeQuote') ||Request::is('admin/freeQuote/*') ) active @endif treeview">
          <a href="{{url('admin/freeQuote')}}">
            <i class="fa fa-user-circle-o"></i> <span>Free Quote</span>
          </a>
        </li>
        <!-- <li class="@if(Request::is('admin/homePageSlider') ||Request::is('admin/homePageSlider/*') ) active @endif treeview">
          <a href="{{url('admin/homePageSlider')}}">
            <i class="fa fa-globe"></i> <span>Home Page Slider</span>
          </a>
        </li> -->

        <li class="@if(Request::is('admin/contact-us-messages') ||Request::is('admin/contact-us-messages/*') ) active @endif treeview">
          <a href="{{url('admin/contact-us-messages')}}">
            <i class="fa fa-envelope" aria-hidden="true"></i> <span>Contact Us Messages</span>
          </a>
        </li>
      <li class="header">CMS PAGES & FAQ</li>
        <li class="@if(Request::is('admin/pages')||Request::is('admin/pages/*') ||
          Request::is('admin/contact-us-page')||Request::is('admin/contact-us-page/*') ||
          Request::is('admin/faq') || Request::is('admin/faq/*') ) active @endif treeview">

          <a href="#">
              <i class="fa fa-dashboard"></i> <span>Pages</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
              <li class="@if(Request::is('admin/pages') || Request::is('admin/pages/*') ) active @endif treeview">
                  <a href="{{url('admin/pages')}}">
                      <i class="fa fa-pencil-square-o"></i> <span>CMS Pages</span>
                  </a>
              </li>
              <!-- <li class="@if(Request::is('admin/faq') ||Request::is('admin/faq/*') ) active @endif treeview">
                  <a href="{{url('admin/faq')}}">
                      <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                      <span>Help (FAQ)</span>
                  </a>
              </li> -->
          </ul>
        </li>

        <li class="header">Settings</li>
        <li class="@if(Request::is('admin/Settings')||Request::is('admin/Settings/*')) active @endif treeview">

          <a href="#">
              <i class="fa fa-dashboard"></i> <span>Settings</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
          <li class="@if(Request::is('admin/header_footer') ||Request::is('admin/header_footer/*') ) active @endif treeview">
                  <a href="{{url('admin/header_footer')}}">
                  <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                      <span>Header Footer Settings</span>
                  </a>
        </li>
          </ul>
        </li>

        <!-- <li class="@if(Request::is('admin/ourClientSay') ||Request::is('admin/ourClientSay/*') ) active @endif treeview">
          <a href="{{url('admin/ourClientSay')}}">
            <i class="fa fa-globe"></i> <span>Our Client Say</span>
          </a>
        </li> -->
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
