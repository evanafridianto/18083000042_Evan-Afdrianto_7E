 <!-- .app-header -->
 <header class="app-header">
     <!-- .top-bar -->
     <div class="top-bar">
         <!-- .top-bar-brand -->
         <div class="top-bar-brand">

             <a href="<?=url('beranda')?>">

                 <img src="<?=templates()?>assets/images/brand-inverse.png" height="32" alt="">
             </a>
         </div>
         <!-- /.top-bar-brand -->
         <!-- .top-bar-list -->
         <div class="top-bar-list">
             <!-- .top-bar-item -->
             <div class="top-bar-item px-2 d-md-none d-lg-none d-xl-none">
                 <!-- toggle menu -->
                 <button class="hamburger hamburger-squeeze" type="button" data-toggle="aside" aria-label="Menu"
                     aria-controls="navigation">
                     <span class="hamburger-box">
                         <span class="hamburger-inner"></span>
                     </span>
                 </button>
                 <!-- /toggle menu -->
             </div>
             <!-- /.top-bar-item -->
             <!-- .top-bar-item -->
             <div class="top-bar-item top-bar-item-full">
                 <!-- .top-bar-search -->
                 <div class="top-bar-search">
                     <div class="input-group input-group-search">
                         <div class="input-group-prepend">
                             <span class="input-group-text">
                                 <span class="oi oi-magnifying-glass"></span>
                             </span>
                         </div>
                         <input type="text" class="form-control" aria-label="Search" placeholder="Search">
                     </div>
                 </div>
                 <!-- /.top-bar-search -->
             </div>
             <!-- /.top-bar-item -->
             <!-- .top-bar-item -->
             <div class="top-bar-item top-bar-item-right px-0 d-none d-sm-flex">
                 <!-- <a class="btn btn-primary" href="<?=url('login')?>">Login</a> -->
                 <!-- .btn-account -->
                 <div class="dropdown">
                     <button class="btn-account d-none d-md-flex" type="button" data-toggle="dropdown"
                         aria-haspopup="true" aria-expanded="false">
                         <span class="user-avatar">
                             <img src="<?=templates()?>assets/images/avatars/profile.jpg" alt="">
                         </span>

                         <span class="account-summary pr-lg-4 d-none d-lg-block">
                             <span class="account-name"><?=$session->get("username")?>
                                 [<?=$session->get("level")?>]</span>
                         </span>
                     </button>
                     <div class="dropdown-arrow dropdown-arrow-left"></div>
                     <!-- .dropdown-menu -->
                     <div class="dropdown-menu">
                         <a class="dropdown-item" href="user-profile.html">
                             <span class="dropdown-icon oi oi-person"></span> Profile</a>
                         <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalCenter">
                             <span class="dropdown-icon oi oi-account-logout"></span> Logout</a>
                     </div>
                     <!-- /.dropdown-menu -->
                 </div>
                 <!-- /.btn-account -->
             </div>
             <!-- /.top-bar-item -->
         </div>
         <!-- /.top-bar-list -->
     </div>
     <!-- /.top-bar -->
 </header>