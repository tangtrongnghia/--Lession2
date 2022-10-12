<p style="font-size: 100px;font-weight: bold;text-align: center;line-height: 80vh;">404</p>

<script>
    var colors = ['yellow', 'blue', 'red', 'black', 'white', 'green'];
    function randomColor()
    {
        var color = colors[Math.floor(Math.random()*colors.length)];
        document.body.style.backgroundColor = color;
    }
    setInterval(randomColor, 10);
</script>