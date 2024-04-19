<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Party $party
 */
?>

<?php
$this->assign('title', __('Edit Party'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Parties'), 'url' => ['action' => 'index']],
    ['title' => __('View'), 'url' => ['action' => 'view', $party->id]],
    ['title' => __('Edit')],
]);
?>

<div class="card card-primary card-outline">
    <?= $this->Form->create($party) ?>
    <?php $isi=$this->Identity->get('role');
        if($isi == 'admin' ){
            $level = ['society' => 'Masyarakat','officer' => 'Petugas','admin' => 'Admin',];
        }elseif($isi == 'officer'){
            $level = ['society' => 'Masyarakat','officer' => 'Petugas'];            
        }else{
            $level = ['society' => 'Masyarakat'];            
        }
        echo $this->Form->control('nik', ['label' => 'Nomor Induk kependudukan']);
        echo $this->Form->control('name', ['label' => 'Nama Lengkap']);
        echo $this->Form->control('username', ['label' => 'Username']);
        echo $this->Form->control('password', ['label' => 'Password']);
        echo $this->Form->control('phone_num', ['label' => 'Nomor Telepon']);
        echo $this->Form->control('role' , ['options' => $level, 'label' => 'Peran']);
        ?>
    <div class="card-footer d-flex">
        <div class="mr-auto">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $party->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $party->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'view', $party->id], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>