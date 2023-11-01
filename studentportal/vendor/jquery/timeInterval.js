setInterval(updateTimeAgo, 60000); // 60000 milliseconds = 1 minute

function updateTimeAgo() {
    var postTimes = document.querySelectorAll('[id^="postTime"]');
    postTimes.forEach(function(postTime) {
        var timestamp = new Date(postTime.getAttribute('datetime'));
        var currentTime = new Date();
        var timeAgo = getTimeAgo(timestamp, currentTime);
        postTime.textContent = timeAgo;
    });
}