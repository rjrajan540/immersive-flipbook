<!DOCTYPE html>
<html>
<head>
    <title>Immersive Flip Book</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="book">
        <div class="page">
            <iframe id="leftPage" src="" width="400" height="500"></iframe>
            <div id="leftPageNum" class="page-number"></div>
        </div>
        <div class="page">
            <iframe id="rightPage" src="" width="400" height="500"></iframe>
            <div id="rightPageNum" class="page-number"></div>
        </div>
    </div>

    <div id="controls">
        <button onclick="prevPage()">Prev</button>
        <input type="number" id="jumpPage" placeholder="Go to page">
        <button onclick="jumpToPage()">Go</button>
        <button onclick="nextPage()">Next</button>
    </div>

    <div id="timer"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>

</body>
</html>
