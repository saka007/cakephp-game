<div class="container">
    <div class="users form">
        <div class="container">
                <div class="col-md-6">
                    <?php echo $this->Flash->render() ?>
                </div>
                <?php echo $this->Form->create() ?>
                <fieldset>
                    <div class="col-md-6">
                        <legend class=""><?php echo __('Please enter username and password') ?></legend>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('username', [
                            'class' => 'col-md-6 required'
                        ]) ?>
                    </div>
                    <div class="form-group">
                        <?php echo $this->Form->control('password', [
                            'class' => 'col-md-6 required'
                        ]) ?>
                    </div>
                </fieldset>
                <div class="form-group col-md-6">
                    <?php echo $this->Form->button(__('Login')); ?>
                </div>
                <?php echo $this->Form->end() ?>
            </div>
    </div>
</div>
