</div>
</div>

<script>
    // Vue main script
    var app = new Vue({
        el: '#app',
        data: <?php echo 'eval(atob("'.base64_encode('JSON.parse(atob("'.base64_encode(json_encode($data)).'"))').'"))' ?>
    });

    // markdown
    function markit(text){
        text = text.replaceAll('%', '\\%').replaceAll('_', '\\_');
        text = marked.parse(text);
        text = filterXSS(text);
        console.log(text);
        return text;
    }
    
    // 'Hack' is not allowed. You can try it yourself :-)
    // document.write(markit('# Hello World'));
    // document.write(markit('<script>alert("XSS")<\/script>'));
    // document.write(markit('<span>Hello<\/span>'));
    // document.write(markit('<a onclick="alert(\'XSS\')">Click me<\/a>'));
    // document.write(markit('<a href="javascript:alert(\'XSS\')">Click me<\/a>'));
    // document.write(markit('[Hello](javascript:alert(\'XSS\'))'));
    // document.write(markit('<span class="markdown">$Hello$</span>'))

    $('.markdown').each(function(){
        $(this).html(markit($(this).text()));
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        renderMathInElement(document.body, {
          delimiters: [
              {left: '$$', right: '$$', display: true},
              {left: '$', right: '$', display: false}
          ],
          throwOnError : false
        });
    });
</script>
</body>
</html>