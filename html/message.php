<div class="ui <?php echo $type; ?> icon message">
    <?php echoIcon($icon); ?>
    <div class="content">
        <div class="header">
            <?php echo changeToVue($header); ?>
        </div>
        <p>
            <?php echo changeToVue($content); ?>
        </p>
    </div>
</div>