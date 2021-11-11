<section class="aside-menu has-scrollable">
    <!-- .stacked-menu -->
    <nav id="stacked-menu" class="stacked-menu">
        <!-- .menu -->
        <ul class="menu">
            <!-- .menu-item -->
            <li class="menu-item <?php if($title=='Beranda'):?> has-active <?php endif ?>">
                <a href="<?=url('beranda')?>" class="menu-link">
                    <span class="menu-icon oi oi-dashboard"></span>
                    <span class="menu-text">Dashboard</span>
                </a>
            </li>
            <li class="menu-item <?php if($title=='Peta Kota Malang'):?> has-active <?php endif ?>">
                <a href="<?=url('peta')?>" class="menu-link">
                    <span class="menu-icon oi oi-map"></span>
                    <span class="menu-text">Peta Kota Malang</span>
                </a>
            </li>
            <?php if ($session->get('level')=='Admin'): ?>
            <li class="menu-item <?php if($title=='Data Kecamatan'):?> has-active <?php endif ?>">
                <a href="<?=url('kecamatan')?>" class="menu-link">
                    <span class="menu-icon oi oi-grid-two-up"></span>
                    <span class="menu-text">Data Kecamatan</span>
                </a>
            </li>
            <li class="menu-item <?php if($title=='Data User'):?> has-active <?php endif ?>">
                <a href="<?=url('user')?>" class="menu-link">
                    <span class="menu-icon oi oi-people"></span>
                    <span class="menu-text">Data User</span>
                </a>
            </li>
            <?php endif ?>
            <li class="">
                <a class="menu-link" href="#" data-toggle="modal" data-target="#exampleModalCenter">
                    <span class="menu-icon oi oi-account-logout"></span>
                    <span class="menu-text"></span> Logout</a>
            </li>
        </ul>
        <!-- /.menu -->
    </nav>
    <!-- /.stacked-menu -->
</section>