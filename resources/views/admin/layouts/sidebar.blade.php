
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

        <li class="@if(Request::is('admin/reseller') ||Request::is('admin/reseller/*') ) active @endif treeview">
          <a href="{{url('admin/reseller')}}">
            <i class="fa fa-user-circle-o"></i> <span>Reseller</span>
          </a>
        </li>

        <li class="@if(Request::is('admin/product') ||Request::is('admin/product/*') ) active @endif treeview">
          <a href="{{url('admin/product')}}">
            <i class="fa fa-globe"></i> <span>Product</span>
          </a>
        </li>

        <li class="@if(Request::is('admin/newArrivalProduct') ||Request::is('admin/newArrivalProduct/*') ) active @endif treeview">
          <a href="{{url('admin/newArrivalProduct')}}">
            <i class="fa fa-globe"></i> <span>New Arrival Product</span>
          </a>
        </li>

        <li class="@if(Request::is('admin/bestSellersProduct') ||Request::is('admin/bestSellersProduct/*') ) active @endif treeview">
          <a href="{{url('admin/bestSellersProduct')}}">
            <i class="fa fa-globe"></i> <span>Best Sellers Product</span>
          </a>
        </li>
        <li class="@if(Request::is('admin/featuredProduct') ||Request::is('admin/featuredProduct/*') ) active @endif treeview">
          <a href="{{url('admin/featuredProduct')}}">
            <i class="fa fa-globe"></i> <span>Featured Product</span>
          </a>
        </li>
        <li class="@if(Request::is('admin/specialOfferProduct') ||Request::is('admin/specialOfferProduct/*') ) active @endif treeview">
          <a href="{{url('admin/specialOfferProduct')}}">
            <i class="fa fa-globe"></i> <span>Special Offer Product</span>
          </a>
        </li>

        <li class="@if(Request::is('admin/order') ||Request::is('admin/order/*') ) active @endif treeview">
          <a href="{{url('admin/order')}}">
            <i class="fa fa-globe"></i> <span>Order History</span>
          </a>
        </li>

      <!-- <li class="@if(Request::is('chat') ||Request::is('chat/*') ) active @endif treeview">
        <a href="{{url('chat')}}">
          <i class="fa fa-commenting-o"></i> <span>Chat</span>
        </a>
      </li> -->

        <!-- <li class="@if(Request::is('admin/banner') ||Request::is('admin/banner/*') ) active @endif treeview">
          <a href="{{url('admin/banner')}}">
            <i class="fa fa-flag"></i> <span>Manage Banner</span>
          </a>
        </li> -->

      <!-- <li class="@if(Request::is('admin/countries') ||Request::is('admin/countries/*') ) active @endif treeview">
        <a href="{{url('admin/countries')}}">
          <i class="fa fa-flag"></i> <span>Manage Country/State/City</span>
        </a>
      </li> -->



        <li class="@if(Request::is('admin/categories') ||Request::is('admin/categories/*') ) active @endif treeview">
          <a href="{{url('admin/categories')}}">
            <i class="fa fa-globe"></i> <span>Categories</span>
          </a>
        </li>

        <li class="@if(Request::is('admin/sub-categories') ||Request::is('admin/sub-categories/*') ) active @endif treeview">
          <a href="{{url('admin/sub-categories')}}">
            <i class="fa fa-globe"></i> <span>Sub Categories</span>
          </a>
        </li>

        <!-- <li class="@if(Request::is('admin/brand') ||Request::is('admin/brand/*') ) active @endif treeview">
          <a href="{{url('admin/brand')}}">
            <i class="fa fa-globe"></i> <span>Brand</span>
          </a>
        </li> -->
        <li class="@if(Request::is('admin/color') ||Request::is('admin/color/*') ) active @endif treeview">
          <a href="{{url('admin/color')}}">
            <i class="fa fa-globe"></i> <span>Color</span>
          </a>
        </li>
        <li class="@if(Request::is('admin/size') ||Request::is('admin/size/*') ) active @endif treeview">
          <a href="{{url('admin/size')}}">
            <i class="fa fa-globe"></i> <span>Size</span>
          </a>
        </li>
        <li class="@if(Request::is('admin/homePageSlider') ||Request::is('admin/homePageSlider/*') ) active @endif treeview">
          <a href="{{url('admin/homePageSlider')}}">
            <i class="fa fa-globe"></i> <span>Home Page Slider</span>
          </a>
        </li>
        <li class="@if(Request::is('admin/coupon') ||Request::is('admin/coupon/*') ) active @endif treeview">
          <a href="{{url('admin/coupon')}}">
            <i class="fa fa-globe"></i> <span>Coupon</span>
          </a>
        </li>

        <!-- <li class="@if(Request::is('admin/notification') ||Request::is('admin/notification/*') ) active @endif treeview">
          <a href="{{url('admin/notification')}}">
            <i class="fa fa-bell"></i> <span>Notification</span>
          </a>
        </li> -->

<?php /*

      <li class="@if(Request::is('admin/countries') ||Request::is('admin/countries/*') ) active @endif treeview">
        <a href="{{url('admin/countries')}}">
          <i class="fa fa-globe"></i> <span>Country/State/City</span>
        </a>
      </li>


*/?>
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
              <li class="@if(Request::is('admin/faq') ||Request::is('admin/faq/*') ) active @endif treeview">
                  <a href="{{url('admin/faq')}}">
                      <i class="fa fa-question-circle-o" aria-hidden="true"></i>
                      <span>Help (FAQ)</span>
                  </a>
              </li>
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

        <li class="@if(Request::is('admin/ourClientSay') ||Request::is('admin/ourClientSay/*') ) active @endif treeview">
          <a href="{{url('admin/ourClientSay')}}">
            <i class="fa fa-globe"></i> <span>Our Client Say</span>
          </a>
        </li>

<?php /*
        <li class="@if(Request::is('admin/permission') ||Request::is('admin/permission/*') ) active @endif treeview">
          <a href="{{url('admin/permission')}}">
            <i class="fa fa-globe"></i> <span>Permissions</span>
          </a>
        </li>
*/?>

      <!-- <li class="@if(Request::is('admin/roles') ||Request::is('admin/roles/*') ) active @endif treeview">
        <a href="{{url('admin/roles')}}">
          <i class="fa fa-globe"></i> <span>Manage Roles</span>
        </a>
      </li> -->

      <!-- <li class="@if(Request::is('admin/roleuser') ||Request::is('admin/roleuser/*') ) active @endif treeview">
        <a href="{{url('admin/roleuser')}}">
          <i class="fa fa-globe"></i> <span>Manage Role Users</span>
        </a>
      </li> -->
<?php /*

        {{-- <li class="header">Chat</li>
        <li class="@if(Request::is('admin/chat') ||Request::is('admin/chat/*') ) active @endif treeview">
          <a href="{{url('admin/chat')}}">
            <i class="fa fa-globe"></i> <span>Chat</span>
          </a>
        </li> --}}
*/?>


    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
