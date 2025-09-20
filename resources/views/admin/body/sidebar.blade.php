<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{asset('adminbackend/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Admin Dashboard</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">

        <li>
            <a href="{{route('admin.dashboard')}}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashbaord</div>
            </a>
        </li>
        @if(\Illuminate\Support\Facades\Auth::user()->can('brand.menu'))
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                <li> <a href="{{route('all.brand')}}"><i class="bx bx-right-arrow-alt"></i>All Brands</a>
                </li>
                <li> <a href="{{route('add.brand')}}"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                </li>

            </ul>
        </li>
        @endif

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                <li> <a href="{{route('all.category')}}"><i class="bx bx-right-arrow-alt"></i>All Categories</a>
                </li>
                <li> <a href="{{route('add.category')}}"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Sub Category</div>
            </a>
            <ul>
                <li> <a href="{{route('all.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>All Sub Categories</a>
                </li>
                <li> <a href="{{route('add.subcategory')}}"><i class="bx bx-right-arrow-alt"></i>Add Sub Category</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Products</div>
            </a>
            <ul>
                <li> <a href="{{route('all.product')}}"><i class="bx bx-right-arrow-alt"></i>All Products</a>
                </li>
                <li> <a href="{{route('add.product')}}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Slider Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('all.sliders')}}"><i class="bx bx-right-arrow-alt"></i>All Sliders</a>
                </li>
                <li> <a href="{{route('add.slider')}}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Banner Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('all.banners')}}"><i class="bx bx-right-arrow-alt"></i>All Banner</a>
                </li>
                <li> <a href="{{route('add.banner')}}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
                </li>

            </ul>
        </li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Coupon Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('all.coupons')}}"><i class="bx bx-right-arrow-alt"></i>All Coupons</a>
                </li>
                <li> <a href="{{route('add.coupon')}}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
                </li>

            </ul>
        </li>

        {{-- <li>--}}
        {{-- <a href="javascript:;" class="has-arrow">--}}
        {{-- <div class="parent-icon"><i class='bx bx-home-circle'></i>--}}
        {{-- </div>--}}
        {{-- <div class="menu-title">Shipping Area</div>--}}
        {{-- </a>--}}
        {{-- <ul>--}}
        {{-- <li> <a href="{{route('all.divisions')}}"><i class="bx bx-right-arrow-alt"></i>All Division</a>--}}
        {{-- </li>--}}
        {{-- <li> <a href="{{route('all.districts')}}"><i class="bx bx-right-arrow-alt"></i>All District</a>--}}
        {{-- </li>--}}
        {{-- <li> <a href="{{route('all.states')}}"><i class="bx bx-right-arrow-alt"></i>All State</a>--}}
        {{-- </li>--}}

        {{-- </ul>--}}
        {{-- </li>--}}
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Order Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('pending.orders')}}"><i class="bx bx-right-arrow-alt"></i>Pending Orders</a>
                </li>

            </ul>
            <ul>
                <li> <a href="{{route('confirmed.orders')}}"><i class="bx bx-right-arrow-alt"></i>Confirmed Orders</a>
                </li>

            </ul>
            <ul>
                <li> <a href="{{route('processing.orders')}}"><i class="bx bx-right-arrow-alt"></i>Processing Orders</a>
                </li>

            </ul>
            <ul>
                <li> <a href="{{route('delivered.orders')}}"><i class="bx bx-right-arrow-alt"></i>Delivered Orders</a>
                </li>

            </ul>

        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Order Reports</div>
            </a>
            <ul>
                <li> <a href="{{route('report.view')}}"><i class="bx bx-right-arrow-alt"></i>Order Reports</a>
                </li>

            </ul>

        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">User Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('customers.view')}}"><i class="bx bx-right-arrow-alt"></i>All Customers</a>
                </li>

            </ul>
            <ul>
                <li> <a href="{{route('vendors.view')}}"><i class="bx bx-right-arrow-alt"></i>All Vendors</a>
                </li>

            </ul>

        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Blog Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.blog.category')}}"><i class="bx bx-right-arrow-alt"></i>Blog Categories</a>
                </li>

            </ul>
            <ul>
                <li> <a href="{{route('admin.blog.post')}}"><i class="bx bx-right-arrow-alt"></i>Blog Posts</a>
                </li>

            </ul>

        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Reviews Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('admin.reviews.pending')}}"><i class="bx bx-right-arrow-alt"></i>Pending Reviews</a>
                </li>

            </ul>
            <ul>
                <li> <a href="{{route('admin.reviews.accepted')}}"><i class="bx bx-right-arrow-alt"></i>Accepted Reviews</a>
                </li>

            </ul>

        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Setting Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('site.setting')}}"><i class="bx bx-right-arrow-alt"></i>Site Setting</a>
                </li>

            </ul>
            <ul>
                <li> <a href="{{route('seo.setting')}}"><i class="bx bx-right-arrow-alt"></i>SEO Setting</a>
                </li>

            </ul>
            <ul>
                <li> <a href="{{route('admin.reviews.accepted')}}"><i class="bx bx-right-arrow-alt"></i>Accepted Reviews</a>
                </li>

            </ul>

        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Stock Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('product.stock')}}"><i class="bx bx-right-arrow-alt"></i>Product Stock</a>
                </li>

            </ul>

        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Roles & Permissions</div>
            </a>
            <ul>
                <li> <a href="{{route('all.permission')}}"><i class="bx bx-right-arrow-alt"></i>All Permissions</a>
                </li>
                <li> <a href="{{route('all.roles')}}"><i class="bx bx-right-arrow-alt"></i>All Roles</a>
                </li>
            </ul>

        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Admin Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('all.admins')}}"><i class="bx bx-right-arrow-alt"></i>All Admins</a>
                </li>
                <li> <a href="{{route('add.admin')}}"><i class="bx bx-right-arrow-alt"></i>Add Admin</a>
                </li>
            </ul>

        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Application</div>
            </a>
            <ul>
                <li> <a href="app-emailbox.html"><i class="bx bx-right-arrow-alt"></i>Email</a>
                </li>
                <li> <a href="app-chat-box.html"><i class="bx bx-right-arrow-alt"></i>Chat Box</a>
                </li>
                <li> <a href="app-file-manager.html"><i class="bx bx-right-arrow-alt"></i>File Manager</a>
                </li>
                <li> <a href="app-contact-list.html"><i class="bx bx-right-arrow-alt"></i>Contatcs</a>
                </li>
                <li> <a href="app-to-do.html"><i class="bx bx-right-arrow-alt"></i>Todo List</a>
                </li>
                <li> <a href="app-invoice.html"><i class="bx bx-right-arrow-alt"></i>Invoice</a>
                </li>
                <li> <a href="app-fullcalender.html"><i class="bx bx-right-arrow-alt"></i>Calendar</a>
                </li>
            </ul>
        </li>
        <li class="menu-label">UI Elements</li>

        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-cart'></i>
                </div>
                <div class="menu-title">Vendor Manage</div>
            </a>
            <ul>
                <li> <a href="{{route('inactive.vendor')}}"><i class="bx bx-right-arrow-alt"></i>Inactive Vendors</a>
                </li>
                <li> <a href="{{route('active.vendor')}}"><i class="bx bx-right-arrow-alt"></i>Active Vendors</a>
                </li>

            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class='bx bx-bookmark-heart'></i>
                </div>
                <div class="menu-title">Components</div>
            </a>
            <ul>
                <li> <a href="component-alerts.html"><i class="bx bx-right-arrow-alt"></i>Alerts</a>
                </li>
                <li> <a href="component-accordions.html"><i class="bx bx-right-arrow-alt"></i>Accordions</a>
                </li>
                <li> <a href="component-badges.html"><i class="bx bx-right-arrow-alt"></i>Badges</a>
                </li>
                <li> <a href="component-buttons.html"><i class="bx bx-right-arrow-alt"></i>Buttons</a>
                </li>
                <li> <a href="component-cards.html"><i class="bx bx-right-arrow-alt"></i>Cards</a>
                </li>
                <li> <a href="component-carousels.html"><i class="bx bx-right-arrow-alt"></i>Carousels</a>
                </li>
                <li> <a href="component-list-groups.html"><i class="bx bx-right-arrow-alt"></i>List Groups</a>
                </li>
                <li> <a href="component-media-object.html"><i class="bx bx-right-arrow-alt"></i>Media Objects</a>
                </li>
                <li> <a href="component-modals.html"><i class="bx bx-right-arrow-alt"></i>Modals</a>
                </li>
                <li> <a href="component-navs-tabs.html"><i class="bx bx-right-arrow-alt"></i>Navs & Tabs</a>
                </li>
                <li> <a href="component-navbar.html"><i class="bx bx-right-arrow-alt"></i>Navbar</a>
                </li>
                <li> <a href="component-paginations.html"><i class="bx bx-right-arrow-alt"></i>Pagination</a>
                </li>
                <li> <a href="component-popovers-tooltips.html"><i class="bx bx-right-arrow-alt"></i>Popovers & Tooltips</a>
                </li>
                <li> <a href="component-progress-bars.html"><i class="bx bx-right-arrow-alt"></i>Progress</a>
                </li>
                <li> <a href="component-spinners.html"><i class="bx bx-right-arrow-alt"></i>Spinners</a>
                </li>
                <li> <a href="component-notifications.html"><i class="bx bx-right-arrow-alt"></i>Notifications</a>
                </li>
                <li> <a href="component-avtars-chips.html"><i class="bx bx-right-arrow-alt"></i>Avatrs & Chips</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"><i class="bx bx-repeat"></i>
                </div>
                <div class="menu-title">Content</div>
            </a>
            <ul>
                <li> <a href="content-grid-system.html"><i class="bx bx-right-arrow-alt"></i>Grid System</a>
                </li>
                <li> <a href="content-typography.html"><i class="bx bx-right-arrow-alt"></i>Typography</a>
                </li>
                <li> <a href="content-text-utilities.html"><i class="bx bx-right-arrow-alt"></i>Text Utilities</a>
                </li>
            </ul>
        </li>
        <li>
            <a class="has-arrow" href="javascript:;">
                <div class="parent-icon"> <i class="bx bx-donate-blood"></i>
                </div>
                <div class="menu-title">Icons</div>
            </a>
            <ul>
                <li> <a href="icons-line-icons.html"><i class="bx bx-right-arrow-alt"></i>Line Icons</a>
                </li>
                <li> <a href="icons-boxicons.html"><i class="bx bx-right-arrow-alt"></i>Boxicons</a>
                </li>
                <li> <a href="icons-feather-icons.html"><i class="bx bx-right-arrow-alt"></i>Feather Icons</a>
                </li>
            </ul>
        </li>







        <li>
            <a href="https://themeforest.net/user/codervent" target="_blank">
                <div class="parent-icon"><i class="bx bx-support"></i>
                </div>
                <div class="menu-title">Support</div>
            </a>
        </li>
    </ul>
    <!--end navigation-->
</div>
