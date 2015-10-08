<div class="sidebar" id="sidebar">
    <a id="sidebar--trigger" class="sidebar-trigger">
        <i class="fa fa-close sidebar-close" id="sidebar-close"></i>
    </a>
    <div class="sidebar-avatar">
        <img src="http://www.gravatar.com/avatar/35e7862d29684dc79145f7a356c82bac?s=80" alt="Photo de profil à Gynidark" width="85">
        <p class="sidebar-name">
            Gynidark
        </p>
    </div>
    <div class="sidebar-menu">
        <?php $profile_id = $this->request->session()->read('Auth.User.id'); ?>
        <?php if(empty($this->request->session()->read('Auth.User'))):?>
            <a href="<?= $this->url(); ?>users/login">
                <i class="fa fa-user"></i>
                Se connecter
            </a>
        <?php else: ?>
            <a href="<?= $this->url(); ?>users/profile/<?= $profile_id; ?>">
                <i class="fa fa-user"></i>
                Mon compte
            </a>
        <?php endif; ?>

        <a href="<?= $this->url(); ?>Tickets/">
            <i class="fa fa-ticket"></i>
            Mes tickets
        </a>

        <a href="<?= $this->url(); ?>message">
            <!--
               si message =  <i class="fa fa-envelope"></i>
               si vide    =  <i class="fa fa-envelope-o"></i>
            -->
            <i class="fa fa-envelope" style="color: rgb(71, 141, 40)"></i>
            Messagerie
        </a>
    </div>

    <div class="sidebar-footer sidebar-footer-animation">
        <div class="grid-6 a-deco">
            <i class="fa fa-power-off"></i>

            <a href="<?= $this->url(); ?>logout" class="a-deco">
                Déconnexion
            </a>
        </div>
        <div class="grid-6 a-admin">
            <i class="fa fa-cog"></i>

            <a href="<?= $this->url(); ?>admin/" class="a-plus">
                Admin
            </a>
        </div>
    </div>
</div>