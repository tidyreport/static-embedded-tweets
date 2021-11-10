var etweet = function() {
	var etweet = {
		update: update,
		datesToLocal: datesToLocal
	};
	document.addEventListener("DOMContentLoaded", function() {
		etweet.update()
	});
	return etweet;
	
	function datesToLocal(includeYear = true, className = "tweet-date") {
		// convert all dates/times into local time for the client
		const months = ["Jan ", "Feb ", "Mar ","Apr ", "May ", "Jun ", "Jul ", "Aug ", "Sep ", "Oct ", "Nov ", "Dec "];
		var tweetDates = document.getElementsByClassName(className);
		for (tweetDate of tweetDates) {
			var rawTimeData = (tweetDate.title == "Date") ? tweetDate.getAttribute("data-date") : tweetDate.title;
			var lDate = new Date(rawTimeData * 1000);
			let hours = lDate.getHours();
			if (includeYear) {
				var amPm = (hours < 12) ? " AM · " : " PM · ";
			} else {
				var amPm = (hours < 12) ? "AM " : "PM ";
			}
			hours = hours % 12;
			hours = (hours == 0) ? 12 : hours;
			let minutes = lDate.getMinutes();
			minutes = (minutes<10) ? "0" + minutes : minutes;
			if (includeYear) {
				tweetDate.innerText = hours + ":" + minutes  + amPm + months[lDate.getMonth()] + lDate.getDate() + ", " + lDate.getFullYear();
			} else {
				tweetDate.innerText = hours + ":" + minutes  + amPm + months[lDate.getMonth()] + lDate.getDate();
			}
		}
	}

	function update() {
		datesToLocal();
		
		var staticTweetGenTweets = document.getElementsByClassName("tweet-parent-1");
		
		// render twitter emoji's (requires twitter emoji js file loaded seperately)
		if (typeof twemoji != "undefined") {
			for (tweet of staticTweetGenTweets) {
				twemoji.parse(tweet);
			}
		} else {
			console.log("twitter emoji js not loaded: it is required to render static tweet emojis");
		}
		
		// add click events for the static tweets
		var staticTweetGenParents = document.querySelectorAll("blockquote[class^='tweet-parent-']");
		for (tweet of staticTweetGenParents) {
			tweet.addEventListener('click', function(event) {
				var tweetClasses = ['tweet-parent-1','tweet-parent-2','tweet-header','tweet-body','tweet-header2','tweet-body2','tweet-image','tweet-gif','tweet-media','tweet-footer','tweet-timestamp','tweet-reply-line','tweet-parent-tweet-card','tweet-card-image','tweet-card-title','tweet-card-description','tweet-card-link','tweet-card-link-icon']
				var referralClasses = ['tweet-parent-tweet-card','tweet-card-image','tweet-card-title','tweet-card-description','tweet-card-link','tweet-card-link-icon']
				var className = event.target.getAttribute('class')
				var firstClass = className.split(" ")[0]
				if ((tweetClasses.find((str) => str === firstClass)) !== firstClass) return
				event.stopPropagation();
				if ((referralClasses.find((str) => str === firstClass)) === firstClass) {
					window.open(this.closest("blockquote[class^='tweet-parent-']").getAttribute('href'), "_blank", "noopener")
				} else {
					window.open(this.closest("blockquote[class^='tweet-parent-']").getAttribute('href'), "_blank", "noopener,noreferrer")
				}
			});
		}

		// add click event listeners that change video posters into video players
		var videos = document.getElementsByClassName("tweet-video-wrapper");
		for (video of videos) {
			video.addEventListener('click', function tweetMediaClick(event) {
				this.removeEventListener('click', tweetMediaClick);
				this.innerHTML += this.dataset.videohtml;
			});
		}

		return true;
	}
}();