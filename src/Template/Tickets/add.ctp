<h1 class="page-title">
    Tickets - Création du ticket
</h1>
<div class="container">
    <?= $this->Form->create($ticket) ?>
        <div class="container">
            <div class="grid-1">
                <h2>Sujet</h2>
            </div>
            <div class="grid-11">
                <?= $this->Form->input('subjects', ['class' => 'form', 'label' => false]); ?>
            </div>
            <div class="grid-1">
                <h2>Contenu</h2>
            </div>
            <div class="grid-11">
                <?= $this->Form->input('content', ['class' => 'form', 'id' => 'emoji', 'label' => false]); ?>
            </div>

            <div class="grid-1"></div>
            <div class="grid-11">
                <input type="checkbox"> Recevoir une copie de votre contenu sur votre boîte mail.
            </div>
            <?= $this->Recaptcha->display() ?>
            <div class="g-recaptcha" data-sitekey="6LdEgg4TAAAAAJ6Mdo3X49Bp9QT6dO4aYTmN3XVS"></di

            </div>

    <br>
    <?= $this->Form->button(__('Ajouté'), ['class' => 'btn btn-success right']) ?>
    <?= $this->Form->end() ?>
</div>
