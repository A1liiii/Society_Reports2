<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Complaint[]|\Cake\Collection\CollectionInterface $complaints
 */
?>

<?php
$this->assign('title', __('Complaints'));
$this->Breadcrumbs->add([
    ['title' => __('Home'), 'url' => '/'],
    ['title' => __('List Complaints')],
]);
?>

<div class="card card-primary card-outline">
    <div class="card-header d-flex flex-column flex-md-row">
        <h2 class="card-title">
            <!-- -->
        </h2>
        <div class="d-flex ml-auto">
            <?= $this->Paginator->limitControl([], null, [
                'label' => false,
                'class' => 'form-control form-control-sm',
                'templates' => ['inputContainer' => '{{content}}']
            ]); ?>
            <?= $this->Html->link(__('New Complaint'), ['action' => 'add'], ['class' => 'btn btn-primary btn-sm ml-2']) ?>
        </div>
    </div>
                
            <style>
    .card-title-container {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
    }
    .card-title {
        font-weight: bold;
        margin-bottom: 0; /* Menghilangkan margin bawah default dari h5 */
    }
    .card-report {
        margin-top: 10px;
        height: 100px;
        max-height: 100px; /* Atur ketinggian maksimum */
        overflow: auto; /* Memberikan sedikit ruang di atas teks isi laporan */
    }
    .card:hover {
        box-shadow: 0 4px 8px rgba(0,0,0,0.2); /* Efek hover */
        transition: box-shadow 0.3s ease-in-out;
    }
    .card img:hover {
        cursor: pointer;
    }
</style>

<div class="container mt-4">
    <div class="row">
        <?php
        $status = ['0'=>'Baru', 'dilihat'=>'Dilihat', 'proses'=>'Proses', 'ditanggapi'=>'Ditanggapi','ditangani'=>'Ditangani'];
        ?>
        <?php foreach ($complaints as $complaint): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <a href="<?= $this->Url->build(['action' => 'view', $complaint->id]) ?>"><img src="<?= 'img/pengaduan/' . $complaint->evidence ?>" class="card-img-top" style="height:300px;" alt="Evidence"></a>
                    <div class="card-body">
                        <div class="card-title-container">
                            <h5 class="card-title"><?= $complaint->has('party') ? h($complaint->party->name) : '' ?></h5>
                            <small class="text-muted"><?= h($complaint->date) ?></small>
                        </div>
                        <p class="card-text card-report"><?= h($complaint->report_content) ?></p>
                        <p class="card-text"><?= h($status[$complaint->status]) ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
    <!-- /.card-body -->
    <div class="card-footer d-flex flex-column flex-md-row">
        <div class="text-muted">
            <?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </div>
        <ul class="pagination pagination-sm mb-0 ml-auto">
            <?= $this->Paginator->first('<i class="fas fa-angle-double-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->prev('<i class="fas fa-angle-left"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next('<i class="fas fa-angle-right"></i>', ['escape' => false]) ?>
            <?= $this->Paginator->last('<i class="fas fa-angle-double-right"></i>', ['escape' => false]) ?>
        </ul>
    </div>
    <!-- /.card-footer -->
</div>