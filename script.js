let currentPairIndex = 0;
let pagePairs = [];
let timerInterval = null;
let bookEnded = false; // Prevent next page auto loading when book ends

let sessionId = ''; // initially empty
let sessionStartTime = null; // timestamp in ms
let sessionExpireAfter = 0; // in seconds


function loadCurrentPair() {
    const pair = pagePairs[currentPairIndex];
    if (!pair) {
        bookEnded = true;
        $('#leftPage, #rightPage').attr('src', '');
        $('#leftPageNum, #rightPageNum').text('');
        $('#timer').text("You've reached the end of the book!");
        return;
    }

    $.ajax({
        url: 'script/script.php',
        type: 'get',
        data: { page_nos: pair },
        success: function(res) {
            const data = res.data;

            $('#leftPage').attr('src', '');
            $('#rightPage').attr('src', '');
            $('#leftPageNum').text('');
            $('#rightPageNum').text('');

            let totalDuration = 0;

            if (data[0]) {
                $('#leftPage').attr('src', getSrc(data[0]));
                $('#leftPageNum').text('Page ' + data[0].page_no);
                totalDuration += parseInt(data[0].duration);
            }

            if (data[1]) {
                $('#rightPage').attr('src', getSrc(data[1]));
                $('#rightPageNum').text('Page ' + data[1].page_no);
                totalDuration += parseInt(data[1].duration);
            }

            const now = Date.now();
            const timeElapsed = sessionStartTime ? (now - sessionStartTime) / 1000 : 0;

            if (!sessionId || timeElapsed > sessionExpireAfter) {
                sessionId = generateSessionId();
                sessionStartTime = now;
            }

            sessionExpireAfter = totalDuration + 10;

            startTimer(totalDuration);
            recordUserTrigger(data);
        }
    });
}



function startTimer(seconds) {
    clearInterval(timerInterval);
    let remaining = seconds;
    document.getElementById('timer').innerText = `Time to read: ${remaining}s`;

    timerInterval = setInterval(() => {
        remaining--;
        if (remaining <= 0) {
            clearInterval(timerInterval);
            document.getElementById('timer').innerText = "Time's up!";
            nextPage();
        } else {
            document.getElementById('timer').innerText = `Time to read: ${remaining}s`;
        }
    }, 1000);
}

function getSrc(page) {
    let base = 'assets/files/';
    if (page.content_type === 'image') {
        return base + 'images/' + page.file_src;
    } else if (page.content_type === 'video') {
        return base + 'videos/' + page.file_src;
    } else if (page.content_type === 'text') {
        return base + 'texts/' + page.file_src;
    }
    return '';
}

let sessionCounter = parseInt(localStorage.getItem('sessionCounter') || '10');

function generateSessionId() {
    const id = String(sessionCounter).padStart(4, '0');
    sessionCounter++;
    localStorage.setItem('sessionCounter', sessionCounter); // store new counter
    return id;
}

function recordUserTrigger(pages) {
    const pageIds = pages.map(p => p.page_no);
    const pageRange = pageIds.length === 2 ? `${pageIds[0]}-${pageIds[1]}` : `${pageIds[0]}`;
    const page_id = pageIds[0];

    $.ajax({
        url: 'script/recordSession.php',
        type: 'POST',
        data: {
            session_id: sessionId,
            page_range: pageRange,
            page_id: page_id
        },
        success: function (res) {
            console.log('UserTrigger recorded:', res);
        }
    });
}



function nextPage() {
    if (bookEnded || currentPairIndex >= pagePairs.length - 1) return;
    currentPairIndex++;
    loadCurrentPair();
}

function prevPage() {
    if (currentPairIndex <= 0) return;
    currentPairIndex--;
    loadCurrentPair();
}

function jumpToPage() {
    let p = parseInt($('#jumpPage').val());

    // Validate input
    if (isNaN(p)) {
        alert('Please enter a valid page number');
        return;
    }

    // Search for the pair index that contains the page number
    const index = pagePairs.findIndex(pair => pair.includes(p));

    if (index !== -1) {
        currentPairIndex = index;
        loadCurrentPair();
    } else {
        alert('Page not found or is inactive');
    }
}


window.onload = () => {
    $.ajax({
        url: 'script/getPagePair.php',
        type: 'get',
        success: function(res) {
            if (res.pairs && res.pairs.length > 0) {
                pagePairs = res.pairs.map(pair => pair.map(Number));
                loadCurrentPair(); // load first pair
            } else {
                document.getElementById('timer').innerText = "No pages found.";
            }
        }
    });
};

