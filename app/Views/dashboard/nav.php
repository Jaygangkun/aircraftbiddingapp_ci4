<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
        with font-awesome or any other icon font library -->
    <li class="nav-item">
        <a href="<?= base_url('/operators') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'operators' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Operators</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('/customers') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'customers' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Customers</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('/users') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'users' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Users</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('/aircrafts') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'aircrafts' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Aircrafts</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('/trips') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'trips' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Trips</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('/bids') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'bids' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Bids</p>
        </a>
    </li>
    <!-- <li class="nav-item <?php echo isset($sub_page) && ($sub_page == 'bids' || $sub_page == 'customer-bid' || $sub_page == 'operator-bid') ? 'menu-open' : '' ?>">
        <a href="#" class="nav-link <?php echo isset($sub_page) && ($sub_page == 'bids' || $sub_page == 'customer-bid' || $sub_page == 'operator-bid') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Bids <i class="fas fa-angle-left right"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="<?= base_url('/bids') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'bids' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>All</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/customer-bid') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'customer-bid' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Customer Bid</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="<?= base_url('/operator-bid') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'operator-bid' ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Add Operator Bid</p>
                </a>
            </li>
        </ul>
    </li> -->
</ul>