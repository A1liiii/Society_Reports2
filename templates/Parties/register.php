<?php
/**
 * @var \App\View\AppView $this
 */

$this->layout = 'CakeLte.login';
?>

<div class="card">
    <div class="card-body register-card-body">
        <p class="login-box-msg"><?= __('Register a new membership') ?></p>

        <?= $this->Form->create() ?>

        <?= $this->Form->control('nik', [
            'placeholder' => __('Nomor Induk Kependudukan'),
            'label' => false,
            'append' => '<i class="fas fa-id-card"></i>',
        ]) ?>

        <?= $this->Form->control('name', [
            'placeholder' => __('Nama Lengkap'),
            'label' => false,
            'append' => '<i class="fas fa-id-badge"></i>',
        ]) ?>

        <?= $this->Form->control('username', [
            'placeholder' => __('Username'),
            'label' => false,
            'append' => '<i class="fas fa-user"></i>',
        ]) ?>

        <?= $this->Form->control('password', [
            'placeholder' => __('Password'),
            'label' => false,
            'append' => '<i class="fas fa-lock"></i>',
        ]) ?>
        <?= $this->Form->control('phone', [
            'placeholder' => __('Nomor Telepon'),
            'label' => false,
            'append' => '<i class="fas fa-phone"></i>',
        ]) ?>
        <?= $this->Form->control('role',['type'=>'hidden','value'=>'society']) ?>

        <div class="row justify-content-center">
            <div class="col-4">
                <?= $this->Form->control(__('Register'), [
                    'type' => 'submit',
                    'class' => 'btn btn-primary btn-block',
                ]) ?>
            </div>
        </div>

        <?= $this->Form->end() ?>

        <?= $this->Html->link(__('Sudah Ada Akun'), ['action' => 'login']) ?>
    </div>
    <!-- /.register-card-body -->
</div>