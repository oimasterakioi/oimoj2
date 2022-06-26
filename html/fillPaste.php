<script>
    jQuery(document).on('cut', function(e){
        alert('一次性打完一整句话哦，记在心中！');
        return false;
    });
    jQuery(document).on('copy', function(e){
        alert('一次性打完一整句话哦，记在心中！');
        return false;
    });
    jQuery(document).on('paste', function(e){
        while(true){
            alert("啊，这样做不可以的！");
        } 
    });
</script>