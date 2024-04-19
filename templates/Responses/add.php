<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Response $response
 */
?>

<?php
$this->assign('title', __('Add Response'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Responses'), 'url' => ['action' => 'index']],
    ['title' => __('Add')],
]);
?>

<div class="card card-primary card-outline">
    <?= $this->Form->create($response, ['valueSources' => ['query', 'context']]) ?>
    <div class="card-body">
        <?= $this->Form->control('party_id', ['options' => $parties, 'class' => 'form-control']) ?>
        <?= $this->Form->control('complaint_id', ['options' => $complaints, 'class' => 'form-control']) ?>
        <?= $this->Form->control('date') ?>
        <?= $this->Form->control('response_content') ?>
    </div>
    <div class="card-footer d-flex">
        <div class="ml-auto">
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>