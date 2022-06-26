<h1 class="ui center aligned header">
    <?php echo changeToVue($header); ?>

</h1>
<form class="ui large form" action="<?php echo $page; ?>" method="post" style="width: 450px; margin-left: auto; margin-right: auto">
    <div class="ui segment">
        <button class="ui button primary fluid" type="submit"><?php echo changeToVue($action); ?></button>
    </div>
</form>