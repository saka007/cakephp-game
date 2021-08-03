<div class="container">
    <div class="users form">
        <?php echo $this->Form->create($user) ?>
        <fieldset>
            <legend class="col-md-6"><?php echo __('Add User') ?></legend>
            <div class="form-group">
                <?php echo $this->Form->control('name', [
                    'class' => 'col-md-6'
                ]) ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->control('username', [
                    'class' => 'col-md-6'
                ]) ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->control('password', [
                    'class' => 'col-md-6'
                ]) ?>
            </div>
            <div class="form-group">
                <?php echo $this->Form->control('role', [
                    'options' => ['admin' => 'Admin', 'author' => 'Author'],
                    'class' => 'col-md-6',
                ]) ?>
            </div>
        </fieldset>
        <div class="form-group col-md-6">
            <?php echo $this->Form->button(__('Submit')); ?>
        </div>
        <?php echo $this->Form->end() ?>
    </div>
</div>
