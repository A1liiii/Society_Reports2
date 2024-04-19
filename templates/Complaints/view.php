<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Complaint $complaint
 */
use Cake\I18n\FrozenTime;
$time = FrozenTime::now();
?>

<?php
$this->assign('title', __('Complaint'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Complaints'), 'url' => ['action' => 'index']],
    ['title' => __('View')],
]);
$status = ['0'=>'Baru','dilihat'=>'Dilihat','ditanggapi'=>'Ditanggapi','proses'=>'Proses','ditangani'=>'Ditangani'];
?>

<div class="view card card-primary card-outline">
    <div class="card-header d-flex flex-wrap align-items-start">
    <div class="flex" >
        <h2 class="card-title mr-2"><?= $this->html->image('pengaduan/'.$complaint->evidence,['style'=>'max-width: 100%; height: 300px;']) ?></h2>
    </div>
    <div class="flex-grow-1" >
    <div class="table-responsive">
        <table class="table table-hover text-nowrap">
            <tr>
                <th><?= __('Party') ?></th>
                <td><?= $complaint->has('party') ? $this->Html->link($complaint->party->name, ['controller' => 'Parties', 'action' => 'view', $complaint->party->id]) : '' ?></td>
            </tr>
            <tr>
                <th><?= __('Date') ?></th>
                <td><?= h($complaint->date) ?></td>
            </tr>
            <tr>
                <th><?= __('Status') ?></th>
                <td><?= h($status[$complaint->status]) ?></td>
            </tr>
        </table>
            </div>
        </div>
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
            <?= $this->Html->link(__('Edit'), ['action' => 'edit', $complaint->id], ['class' => 'btn btn-secondary']) ?>
            <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>
</div>

<div class="view text card">
    <div class="card-header">
        <h3 class="card-title"><?= __('Report Content') ?></h3>
    </div>
    <div class="card-body">
        <?= $this->Text->autoParagraph(h($complaint->report_content)); ?>
    </div>
</div>

<div class="related related-response view card">
    <div class="card-header d-flex">
        <h3 class="card-title"><?= __('Related Responses') ?></h3>
        <div class="ml-auto">
            <?= $this->Html->link(__('New Response'), ['controller' => 'Responses', 'action' => 'add', '?' => ['complaint_id' => $complaint->id]], ['class' => 'btn btn-primary btn-sm']) ?>
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
            <?php if (empty($complaint->responses)) : ?>
                <tr>
                    <td colspan="6" class="text-muted">
                        <?= __('Responses record not found!') ?>
                    </td>
                </tr>
            <?php else : ?>
                <?php foreach ($complaint->responses as $response) : ?>
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
            <tr>
                <td colspan="6" >
                    <?= $this->Form->create(null,['url'=>['controller'=>'Responses','action'=>'add','role'=>'form']]) ?>
                <div class="card-body">
                    <?= $this->Form->control('party_id', ['type'=>'hidden','value'=>$this->Identity->get('id'), 'class' => 'form-control']) ?>
                    <?= $this->Form->control('complaint_id', ['type'=>'hidden','value'=>$complaint->id, 'class' => 'form-control']) ?>
                    <?= $this->Form->control('date',['value'=>$time->i18nFormat('yyyy-MM-dd HH:mm:ss'),'type'=>'hidden']) ?>
                    <?= $this->Form->control('response_content',['type'=>'textarea','value'=>'']) ?>
                </div>
                <div class="card-footer d-flex">
                <div class="ml-auto">
                    <?= $this->Form->button(__('Save'), ['class' => 'btn btn-primary']) ?>
                    <?= $this->Html->link(__('Cancel'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
                </td>
            </tr>
        </table>
    </div>
</div>
