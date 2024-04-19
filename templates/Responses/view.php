<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Response $response
 */
?>

<?php
$this->assign('title', __('Response'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Responses'), 'url' => ['action' => 'index']],
    ['title' => __('View')],
]);
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title"><?= h($response->id) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Party') ?></th>
                <td><?= $response->has('party') ? $this->Html->link($response->party->name, ['controller' => 'Parties', 'action' => 'view', $response->party->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Complaint') ?></th>
                <td><?= $response->has('complaint') ? $this->Html->link($response->complaint->evidence, ['controller' => 'Complaints', 'action' => 'view', $response->complaint->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($response->id) ?></td>
            </tr>
            <tr>
                <th><?= __('Date') ?></th>
                <td><?= h($response->date) ?></td>
            </tr>
        </table>
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
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $response->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>

<div class="view text card">
    <div class="card-header">
        <h3 class="card-title"><?= __('Response Content') ?></h3>
    </div>
    <div class="card-body">
        <?= $this->Text->autoParagraph(h($response->response_content)); ?>
    </div>
</div>
