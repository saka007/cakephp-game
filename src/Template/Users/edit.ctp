<div class="users form">
    <?php echo $this->Form->create($user) ?>
    <fieldset>
        <legend><?php echo __('Add User') ?></legend>
        <?php echo $this->Form->control('name') ?>
        <?php echo $this->Form->control('username') ?>
        <?php echo $this->Form->control('role', [
            'options' => ['admin' => 'Admin', 'author' => 'Author']
        ]) ?>
    </fieldset>
    <?php echo $this->Form->button(__('Submit')); ?>
    <?php echo $this->Form->end() ?>
</div>
