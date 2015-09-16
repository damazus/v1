<header>
        <div class="menu">
            <div class="container">
                <div class="logo grid-2 grid-m-6">
                    <a href="<?= $this->url(); ?>">
                        <?= $this->Html->image('oranticket.png', ['width' => '190']); ?>
                    </a>
                </div>

                <div class="nav-center grid-10 grid-m-6">
                    <div class="right">
                        <nav>
                            <ul>
                                <li>
                                    <a href="<?= $this->url(); ?>tickets/">
                                        <i class="fa fa-ticket"></i>
                                    </a>
                                </li>

                                <li>
                                    <a href="<?= $this->url(); ?>users/profile">
                                        <i class="fa fa-user"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?= $this->url(); ?>tickets/add">
                                        <i class="fa fa-plus"></i>
                                    </a>
                                </li>
                                <!--
                                <li>
                                    <div class="notif">
                                        <div class="label label-notif-menu">2</div>
                                        <a href="#" class="launch">
                                            <i class="fa fa-bell-o"></i>
                                        </a>
                                    </div>
                                </li>
                                -->
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>