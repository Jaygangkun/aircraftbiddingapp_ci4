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
        <a href="<?= base_url('/aircraft/categories') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'aircraft-categories' ? 'active' : '' ?>">
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
        <a href="<?= base_url('/closed-trips') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'closed-trips' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Closed Trips</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= base_url('/settled-trips') ?>" class="nav-link <?php echo isset($sub_page) && $sub_page == 'settled-trips' ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Settled Trips</p>
        </a>
    </li>
</ul>