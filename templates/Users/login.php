<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div class="row">
    <div class="column-responsive column-50" style="margin:0 auto">
    <?= $this->Flash->render() ?>
        <div class="users form content">
            <?= $this->Form->create() ?>
            <fieldset>
                <?php
                    echo $this->Form->control('username',['label'=>'Usuário']);
                    echo $this->Form->control('password',['label'=>'Senha']);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Entrar')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
