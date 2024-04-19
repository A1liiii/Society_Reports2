<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Complaint $complaint
 */
?>

<?php
$this->assign('title', __('Edit Complaint'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Complaints'), 'url' => ['action' => 'index']],
    ['title' => __('View'), 'url' => ['action' => 'view', $complaint->id]],
    ['title' => __('Edit')],
]);
$status = ['0'=>'Baru','dilihat'=>'Dilihat','ditanggapi'=>'Ditanggapi','proses'=>'Proses','ditangani'=>'Ditangani'];
?>

<div class="card card-primary card-outline">
    <?= $this->Form->create($complaint,['type'=>'file']) ?>
    <div class="card-body">
        <?= $this->Form->control('party_id', ['options' => $parties, 'class' => 'form-control']) ?>
        <?= $this->Form->control('date',['readolny'=>true]) ?>
        <?= $this->Form->control('report_content') ?>
        <?= $this->html->image('pengaduan/'.$complaint->evidence,['height'=>'100px']) ?>
        <?= $this->Form->control('evidence',['type'=>'hidden']) ?>
        <?= $this->Form->control('images',['type'=>'file']) ?>
        <?= $this->Form->control('status',['options'=>$status]) ?>
    </div>
    <div class="card-footer d-flex">
        <div class="mr-auto">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $complaint->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $complaint->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'view', $complaint->id], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>