<div class="menus index content">
    <?= $this->Html->link(__('New Menu'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Menus') ?></h3>
    
    <div id="menu-list">
        <ul id="sortable" class="table-responsive">
            <?php foreach ($menus as $menu): ?>
                <li class="ui-state-default" data-id="<?= $menu->id ?>">
                    <span class="handle">☰</span>
                    <?= $this->Number->format($menu->ordre) ?> - 
                    <?= h($menu->intitule) ?> (Lien: <?= h($menu->lien) ?>)
                    <div class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $menu->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $menu->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $menu->id], ['confirm' => __('Are you sure you want to delete # {0}?', $menu->id)]) ?>
                    </div>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>
    
    <button id="save-order" class="button">Enregistrer l'ordre</button>

    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>

<?= $this->Html->script('https://code.jquery.com/jquery-3.6.0.min.js') ?>
<?= $this->Html->script('https://code.jquery.com/ui/1.13.2/jquery-ui.min.js') ?>
<?= $this->Html->css('https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css') ?>

<style>
    #sortable {
        list-style-type: none;
        margin: 0;
        padding: 0;
        width: 100%;
    }
    #sortable li {
        margin: 5px 0;
        padding: 10px;
        font-size: 1.2em;
        background-color: #f9f9f9;
        border: 1px solid #ddd;
        cursor: move;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    #sortable .handle {
        cursor: grab;
    }
</style>

<script>
    $(function() {
        $("#sortable").sortable({
            handle: ".handle"
        });
        $("#sortable").disableSelection();

        $("#save-order").click(function() {
            const orderedIds = [];
            $("#sortable li").each(function() {
                orderedIds.push($(this).data("id"));
            });

            $.ajax({
                url: "<?= $this->Url->build(['controller' => 'Menus', 'action' => 'updateOrder']) ?>",
                method: "POST",
                data: {
                    order: orderedIds,
                },
                success: function(response) {
                    alert("L'ordre des menus a été mis à jour avec succès !");
                },
                error: function() {
                    alert("Erreur lors de la mise à jour de l'ordre des menus.");
                },
            });
        });
    });
</script>
