<style>
.under_li ul li{
  list-style: none;
}
</style>
<!-- Left navbar-header -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse slimscrollsidebar">
        <div class="user-profile">
            <div class="dropdown user-pro-body">
                <div><img src="../../plugins/images/users/no-image.png" alt="user-img" class="img-circle"></div> <a href="#" class="dropdown-toggle u-dropdown" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?= $_SESSION['admin'];?><span class="caret"></span></a>
                <ul class="dropdown-menu animated flipInY" style="border-color:#ddd">
                    <li><a href="../logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
                </ul>
            </div>
        </div>
        <ul class="nav" id="side-menu">
            <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                <!-- input-group -->
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search..."> <span class="input-group-btn">
            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
            </span> </div>
                <!-- /input-group -->
            </li>
            
            <li> <a href="../../dashboard/index.php" class="waves-effect"><i data-icon="v" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Dashboard</span></a>
            </li>
            
            <li>
                <a href="../../../admin" class="waves-effect">
                    <i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"> </i>
                    <span class="hide-menu">Products</span>
                </a>
            </li>
            <!--
            <li>
                <a href="../../../events/admin/event/list.php" class="waves-effect">
                    <i data-icon="A" class="linea-icon linea-elaborate fa-fw"></i>
                    <span class="hide-menu">Schedule</span>
                </a>
            </li>
            -->
            <li> <a href="javascript:void(0);" class="waves-effect"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Content Management System<span class="fa arrow"></span></span></a>
              <ul class="nav nav-second-level">
                    
                    <li class="under_li">
                        <a href="../about/list.php" class="waves-effect">About</a>
                    </li>
                    
		    <li class="under_li">
                        <a href="../cafes/list.php" class="waves-effect">Cafe's</a>
                    </li>
		    <!--
                    <li class="under_li">
                        <a href="../lifestyle/list.php" class="waves-effect">Life Style</a>
                    </li>
                    
                    <li class="under_li">
                        <a href="../food/list.php" class="waves-effect">FOOD</a>
                    </li>

                    <li class="under_li">
                        <a href="../courses/list.php" class="waves-effect">Courses</a>
                    </li>

                    <li class="under_li">
                        <a href="../about/list.php" class="waves-effect">About</a>
                    </li>
                    
                    <li class="under_li">
                        <a href="../staff/list.php" class="waves-effect">Staff</a>
                    </li>
                    
                    <li class="under_li">
                        <a href="../blog/list.php" class="waves-effect">Blog</a>
                    </li>

                    <li class="under_li">
                        <a href="../review/list.php" class="waves-effect">Review</a>
                    </li>
                    -->
              <!--
              <ul class="nav nav-second-level">
                <li><a href="javascript:void(0);" class="waves-effect">Home<span class="fa arrow"></span></a>
                  <ul class="nav nav-third-level">
                    <li><a href="../banner/list.php">Banner</a></li>
                    <li><a href="../our_process/list.php">Our Process</a></li>
                    <li><a href="../our_benefits/list.php">Our Benefits</a></li>
                  </ul>
                </li>
                <li><a href="javascript:void(0);" class="waves-effect">About<span class="fa arrow"></span></a>
                  <ul class="nav nav-third-level">
                    <li><a href="../expertise/list.php">Expertise</a></li>
                    <li><a href="../proffessionalism/list.php">Proffessionalism</a></li>
                    <li><a href="../compliance/list.php">Compliance</a></li>
                    <li><a href="../valueformoney/list.php">Value for Money</a></li>
                  </ul>
                </li>
                <li><a href="../service/list.php">Service</a></li>
                <li><a href="../latest_properties/list.php">Properties</a></li>
                <li><a href="../articles/list.php">Articles</a></li>
                <li><a href="../testimonials/list.php">Testimonials</a></li>
                <li><a href="../faq/list.php">FAQ</a></li>
                <li><a href="../contact/list.php">Contact</a></li>
                <li><a href="../gallery.php">Gallery</a></li>
                -->
              </ul>
            </li>
            <!--
            <li> <a href="../../newsletter/admin" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu"> Newsletter </span></a>
            </li>
            
            <li> <a href="../../ultimate_support_chat/" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu"> Chating </span></a>
            </li>
            -->
        </ul>
    </div>
</div>
<!-- Left navbar-header end -->