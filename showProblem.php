<?php
require('html/index.php');
require('database/index.php');
$id = $_GET['id'];
$id = intval($id);
echoHeader('题目描述');
echoNav();
if(isProblemVisibleToUser($_SESSION['username'], $id) == false){
    echoMessage("error", "times circle outline", "错误", "权限不足。");
}
else if(isset($id) == false){
    echoMessage("error", "times circle outline", "错误", "没有指定题目。");
}
else{
    $statement = getStatement($id);
    if($statement == false){
        echoMessage("error", "times circle outline", "错误", "没有找到该题目。");
    }
    else{
        echoTwoCol();
        echoBoard(getTitle($id), $statement, "main", "statement");
        echoSubmitForm($id);
        echoBoard("其他", "祝你好运！", "right");
    }
}
?>
<?php if(hasPermission($_SESSION['username'], $id)): ?>
<script>
    $(function(){
        $('#statement').dblclick(function(){
            // console.log('dblclick');
            var editble = $('#statement').attr('contenteditable');
            if(editble == 'true'){
                var tmp = document.createElement('div');
                tmp.innerHTML = $('#statement').html().replaceAll('<div>', '\n').replaceAll('</div>', '\n');
                var newStatement = $(tmp).text();
                
                $.ajax({
                    url: '/api/updateProblemMd.php',
                    type: 'POST',
                    data: {
                        id: <?php echo $id; ?>,
                        statement: newStatement
                    },
                    success: function(data){
                        console.log(data);
                        data = JSON.parse(data);
                        if(data.success == "ok"){
                            $('#statement').attr('contenteditable', 'false');
                            $('#statement').blur();
                            // console.log(newStatement);
                            $('#statement').html(markit(newStatement));
                            $("#statement").css("white-space", "");
                            renderMathInElement(document.body, {
                                delimiters: [
                                    {left: '$$', right: '$$', display: true},
                                    {left: '$', right: '$', display: false}
                                ],
                                throwOnError : false
                            });
                        }
                        else{
                            alert('更新失败');
                        }
                    }
                });
            }
            else{
                // fetch markdown
                $.ajax({
                    url: '/api/fetchProblemMd.php',
                    type: 'GET',
                    data: {
                        id: <?php echo $id; ?>
                    },
                    success: function(data){
                        data = JSON.parse(data);
                        $('#statement').css("white-space", "pre");
                        $('#statement').html(data.statement);
                        $('#statement').attr('contenteditable', 'true');
                        $('#statement').focus();
                    }
                });
            }
        });
    });
</script>
<?php endif; ?>
<?php
echoFooter();