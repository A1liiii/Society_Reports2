<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Party $party
 */
?>

<?php
$this->assign('title', __('Party'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Parties'), 'url' => ['action' => 'index']],
    ['title' => __('View')],
]);
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-sm-flex">
        <h2 class="card-title"><?= h($party->name) ?></h2>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Nik') ?></th>
                <td><?= h($party->nik) ?></td>
            </tr>
            <tr>
                <th><?= __('Name') ?></th>
                <td><?= h($party->name) ?></td>
            </tr>
            <tr>
                <th><?= __('Username') ?></th>
                <td><?= h($party->username) ?></td>
            </tr>
            <tr>
                <th><?= __('Phone') ?></th>
                <td><?= h($party->phone) ?></td>
            </tr>
            <tr>
                <th><?= __('Role') ?></th>
                <td><?= h($party->role) ?></td>
            </tr>
            <tr>
                <th><?= __('Id') ?></th>
                <td><?= $this->Number->format($party->id) ?></td>
            </tr>
        </table>
    </div>
    <div class="card-footer d-flex">
        <div class="mr-auto">
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $party->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $party->id), 'class' => 'btn btn-danger']
            ) ?>
        </div>
        <div class="ml-auto">
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $party->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>

<div class="related related-complaint view card">
    <div class="card-header d-flex">
        <h3 class="card-title"><?= __('Related Complaints') ?></h3>
        <div class="ml-auto">
            <?= $this->Html->link(__('New Complaint'), ['controller' => 'Complaints', 'action' => 'add', '?' => ['party_id' => $party->id]], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= $this->Html->link(__('List Complaints'), ['controller' => 'Complaints', 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Party Id') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Report Content') ?></th>
                <th><?= __('Evidence') ?></th>
                <th><?= __('Status') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php if (empty($party->complaints)) : ?>
                <tr>
                    <td colspan="7" class="text-muted">
                        <?= __('Complaints record not found!') ?>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($party->complaints as $complaint) : ?>
                    <tr>
                        <td><?= h($complaint->id) ?></td>
                        <td><?= h($complaint->party_id) ?></td>
                        <td><?= h($complaint->date) ?></td>
                        <td><?= h($complaint->report_content) ?></td>
                        <td><?= h($complaint->evidence) ?></td>
                        <td><?= h($complaint->status) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Complaints', 'action' => 'view', $complaint->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Complaints', 'action' => 'edit', $complaint->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Complaints', 'action' => 'delete', $complaint->id], ['class' => 'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $complaint->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>

<div class="related related-response view card">
    <div class="card-header d-flex">
        <h3 class="card-title"><?= __('Related Responses') ?></h3>
        <div class="ml-auto">
            <?= $this->Html->link(__('New Response'), ['controller' => 'Responses', 'action' => 'add', '?' => ['party_id' => $party->id]], ['class' => 'btn btn-primary btn-sm']) ?>
            <?= $this->Html->link(__('List Responses'), ['controller' => 'Responses', 'action' => 'index'], ['class' => 'btn btn-primary btn-sm']) ?>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Id') ?></th>
                <th><?= __('Party Id') ?></th>
                <th><?= __('Complaint Id') ?></th>
                <th><?= __('Date') ?></th>
                <th><?= __('Response Content') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
            <?php if (empty($party->responses)) : ?>
                <tr>
                    <td colspan="6" class="text-muted">
                        <?= __('Responses record not found!') ?>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($party->responses as $response) : ?>
                    <tr>
                        <td><?= h($response->id) ?></td>
                        <td><?= h($response->party_id) ?></td>
                        <td><?= h($response->complaint_id) ?></td>
                        <td><?= h($response->date) ?></td>
                        <td><?= h($response->response_content) ?></td>
                        <td class="actions">
                            <?= $this->Html->link(__('View'), ['controller' => 'Responses', 'action' => 'view', $response->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Html->link(__('Edit'), ['controller' => 'Responses', 'action' => 'edit', $response->id], ['class' => 'btn btn-xs btn-outline-primary']) ?>
                            <?= $this->Form->postLink(__('Delete'), ['controller' => 'Responses', 'action' => 'delete', $response->id], ['class' => 'btn btn-xs btn-outline-danger', 'confirm' => __('Are you sure you want to delete # {0}?', $response->id)]) ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>
</div>
