<div class="container">
    <div class="history form">
        <?php echo $this->Form->create($user) ?>
        <fieldset>
            <legend class="col-md-6"><?php echo __('Add History') ?></legend>
            <div class="form-group">
                <?php echo $this->Form->control('result', [
                    'class' => 'col-md-6'
                ]) ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->control('uid', [
                    'class' => 'col-md-6'
                ]) ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->control('file_name', [
                    'class' => 'col-md-6'
                ]) ?>
            </div>
        </fieldset>
        <div class="form-group col-md-6">
            <?php echo $this->Form->button(__('Submit')); ?>
        </div>
        <?php echo $this->Form->end() ?>
    </div>
</div>
