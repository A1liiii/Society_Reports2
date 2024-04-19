<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Response $response
 */
?>

<?php
$this->assign('title', __('Edit Response'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Responses'), 'url' => ['action' => 'index']],
    ['title' => __('View'), 'url' => ['action' => 'view', $response->id]],
    ['title' => __('Edit')],
]);
?>

<div class="card card-primary card-outline">
    <?= $this->Form->create($response) ?>
    <div class="card-body">
        <?= $this->Form->control('party_id', ['options' => $parties, 'class' => 'form-control']) ?>
        <?= $this->Form->control('complaint_id', ['options' => $complaints, 'class' => 'form-control']) ?>
        <?= $this->Form->control('date') ?>
        <?= $this->Form->control('response_content') ?>
    </div>
    <div class="card-footer d-flex">
        <div class="mr-auto">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $response->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $response->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'view', $response->id], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
    <?= $this->Form->end() ?>
</div>