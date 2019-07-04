<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="user-pro"> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><img src="{{ asset('img/user.png') }}" alt="user-img" class="img-circle">
                    <?php
                    $myvalue = Auth::user()->name;
                    $arr = explode(' ',trim($myvalue));
                    $name_auth = $arr[0]; // will print Test
                    ?>
                    <span class="hide-menu">{{ $name_auth }}</span></a>
                    <ul aria-expanded="false" class="collapse">
                        @if(Auth::user()->role_level == 1)        
                        <li><a href="javascript:void(0)" onclick="call('<?= url('my_profile'); ?>','_content_','My Profile')"><i class="ti-user"></i> My Profile</a></li>
                        @endif
                        <li><a href="{{ url('logout') }}"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </li>
                <li class="nav-small-cap">--- PERSONAL</li>
                <li> <a href="javascript:void(0)" aria-expanded="false" onclick="call('<?= url('dashboard'); ?>','_content_','Dashboard')"><i class="icon-speedometer"></i>  <span class="hide-menu">Dashboard </span></a>
                </li>
                @if(Auth::user()->role_level == 1)
                    @if(Auth::user()->state == 1)
                    <li> 
                        <a href="javascript:void(0)" aria-expanded="false" onclick="call('<?= url('my_profile'); ?>','_content_','Dashboard')"><i class="icon-user"></i>  <span class="hide-menu">Profile </span></a>
                    </li>
                    <li> 
                        <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-shopping-cart-full"></i><span class="hide-menu">Pengadaan Barang / Jasa</span></a>
                        <ul aria-expanded="false" class="collapse">
                            <li><a href="javascript:void(0)" onclick="call('<?= url('pengadaan/daftarmyproc'); ?>','_content_','Daftar Aktif')">Daftar Aktif</a></li>
                        </ul>
                    </li>
                    @endif
                    
                    @if(Auth::user()->state == 0)
                    <li> 
                        <a href="javascript:void(0)" onclick="call('<?= url('daftar'); ?>','_content_','Register User')" aria-expanded="false"><i class="ti-palette"></i><span class="hide-menu">Registrasi Vendor</span></a>
                    </li>
                    @endif
                @else
                    @if(Auth::user()->role_level == 2 || Auth::user()->role_level == 3)
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-layout-grid2"></i><span class="hide-menu">
                        Penyedia</span></a>
                            <ul aria-expanded="false" class="collapse">
                            @if(Auth::user()->role_level == 3)
                                <li><a href="javascript:void(0)" onclick="call('<?= url('vendor/daftar-calon'); ?>','_content_','Penyedia Baru/TIdak Aktif')">Baru/Tidak Aktif</a></li>
                            @endif
                                <li><a href="javascript:void(0)" onclick="call('<?= url('vendor/daftar'); ?>','_content_','Terverifikasi')">Terverifikasi</a></li>
                                <li><a href="javascript:void(0)" onclick="call('<?= url('vendor/daftarhitam'); ?>','_content_','Daftar Hitam')">Daftar Hitam</a></li>
                            </ul>
                        </li>
                        
                    @endif

                    @if(Auth::user()->role_level != 0)
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-receipt"></i><span class="hide-menu">Perencanaan Pengadaan</span></a>
                            <ul aria-expanded="false" class="collapse">
                            @if(Auth::user()->role_level == 2)
                                <li><a href="javascript:void(0)" onclick="call('<?= url('perencanaan/tambah'); ?>','_content_','Tambah Baru')">Tambah Baru</a></li>
                            @endif
                            @if(Auth::user()->role_level == 2 || Auth::user()->role_level == 4 || Auth::user()->role_level == 5 || Auth::user()->role_level == 6 || Auth::user()->role_level == 3)
                                <li><a href="javascript:void(0)" onclick="call('<?= url('perencanaan/daftar-calon'); ?>','_content_','Daftar Pengajuan')">Daftar Pengajuan</a></li>
                            @endif
                                <!-- <li><a href="app-compose.html">Compose Mail</a></li> -->
                            </ul>
                        </li>
                        
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-shopping-cart-full"></i><span class="hide-menu">Pengadaan Barang / Jasa</span></a>
                            <ul aria-expanded="false" class="collapse">
                            @if(Auth::user()->role_level == 3)
                                <li><a href="javascript:void(0)" onclick="call('<?= url('pengadaan/daftar-calon'); ?>','_content_','Draft')">Draft</a></li>
                            @endif
                            @if(Auth::user()->role_level == 3 || Auth::user()->role_level == 4 || Auth::user()->role_level == 5 || Auth::user()->role_level == 6 || Auth::user()->role_level == 2 || Auth::user()->role_level == 1)
                                <li><a href="javascript:void(0)" onclick="call('<?= url('pengadaan/daftar'); ?>','_content_','Daftar Aktif')">Daftar Aktif</a></li>
                            @endif
                            </ul>
                        </li>
                        
                        <li> 
                            <a href="javascript:void(0)" onclick="call('<?= url('/monitor/daftar'); ?>','_content_','Monitoring Pekerjaan')" aria-expanded="false">
                                <i class="ti-desktop"></i>
                                <span class="hide-menu">Monitoring Pekerjaan</span>
                            </a>
                        </li>
                    @endif
                    
                    @if(Auth::user()->role_level == 0)
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-email"></i><span class="hide-menu">Management User</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="javascript:void(0)" onclick="call('<?= url('user/register'); ?>','_content_','Register User')">Register User</a></li>
                                <li><a href="javascript:void(0)" onclick="call('<?= url('user/list'); ?>','_content_','List User')">List User</a></li>
                                <!-- <li><a href="app-compose.html">Compose Mail</a></li> -->
                            </ul>
                        </li>
                    @endif
                    @if(Auth::user()->role_level == 0 || Auth::user()->role_level == 3)
                    <li> 
                        <a href="javascript:void(0)" aria-expanded="false" onclick="call('<?= url('list/daftar-vendorstatus'); ?>','_content_','Daftar Status Vendor')"><i class="icon-list"></i>  <span class="hide-menu">Daftar Status Vendor </span></a>
                    </li>
                    @endif
                    <li> 
                        <a href="javascript:void(0)" aria-expanded="false" onclick="call('<?= url('daftar/reset_pass'); ?>','_content_','Reset Password')"><i class="icon-lock-open"></i>  <span class="hide-menu">Reset Password </span></a>
                    </li>
                @endif
                <li class="nav-small-cap">--- SUPPORT</li>
                <li> <a class="waves-effect waves-dark" href="http://eliteadmin.themedesigner.in/demos/bt4/documentation/documentation.html" aria-expanded="false"><i class="far fa-circle text-danger"></i><span class="hide-menu">User Manual</span></a></li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>