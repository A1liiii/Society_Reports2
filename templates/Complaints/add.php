<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Complaint $complaint
 */
use Cake\I18n\FrozenTime;
$time = FrozenTime::now();
?>

<?php
$this->assign('title', __('Add Complaint'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Complaints'), 'url' => ['action' => 'index']],
    ['title' => __('Add')],
]);
?>

<div class="card card-primary card-outline">
    <?= $this->Form->create($complaint, ['valueSources' => ['query', 'context'],'type'=>'file']) ?>
    <div class="card-body">
        <?= $this->Form->control('party_id', ['options' => $parties, 'class' => 'form-control']) ?>
        <?= $this->Form->control('date',['value'=>$time->i18nFormat('yyyy-MM-dd HH:mm:ss'),'readonly'=>true]) ?>
        <?= $this->Form->control('report_content') ?>
        <?= $this->Form->control('images',['type'=>'file','required'=>true]) ?>
        <?= $this->Form->control('status',['type'=>'hidden','value'=>'0']) ?>
    </div>
    <div class="card-footer d-flex">
        <div class="ml-auto">
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>