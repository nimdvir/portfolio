var YnetYoutube = {
	players: {},
	playerInfoList: [],
	fpContinerSelector: '.art_video',
	floatClosed: false,
	lastPlayedContainerId: null,
	flaotingFirstFrame: {
		init: false,
		featuredVideo: null,
		containerId: null,
		iteration: 0,
		minScreenWidth: 1280
	},
	YitVideoEventReport:function(event, data){
		if(typeof YitVideo == "object") {
				try {
        if(typeof YitVideo.options.eventsCallback == "function") {
					  YitVideo.options.eventsCallback(event, data);
			  }
      } catch(e){}
		}
	},
	createPlayer: function (playerInfo) {
    if(!playerInfo.embedConfig){
      playerInfo.embedConfig = {
        autonavRelatedVideos : true
      };
    }
		return new YT.Player(playerInfo.id, {
			height: playerInfo.height,
			width: playerInfo.width,
			videoId: playerInfo.videoId,
			playerVars: playerInfo.playerVars,
			events: playerInfo.events,
			embedConfig: playerInfo.embedConfig,
		});
	},
	initPlayerVars: function(){
		try {
			var i;
			for (i = 0; i < this.playerInfoList.length; i++) {
				this.playerInfoList[i].playerVars.loop = 0;
				this.playerInfoList[i].playerVars.controls = 1;
				this.playerInfoList[i].playerVars.showinfo = 0;
				this.playerInfoList[i].playerVars.autohide = 1;
				this.playerInfoList[i].playerVars.autoplay = 0;
				this.playerInfoList[i].playerVars.hl = document.getElementsByTagName('html')[0].getAttribute('lang');
				if(this.playerInfoList[i].type != 'desktop') {
					this.playerInfoList[i].playerVars.modestbranding = 1;
				}
			}
		}catch(e){
			console.log(e)
		}
	},
	onPlayerReady: function (event) {
		var containerId = event.target.f.id;
		YnetYoutube.players[containerId].duration = YnetYoutube.players[containerId].getDuration();
		YnetYoutube.players[containerId].analyticsLabel = document.URL + '&dcPath=' + dcPath + '&video='+YnetYoutube.players[containerId].getVideoUrl();
		// if (!YnetYoutube.flaotingFirstFrame.init && YnetYoutube.YoutubeFloatingOrFp()) {
		// 		YnetYoutube.floatOnScroll(containerId).triggercloseFlaoting(YnetYoutube.players[containerId]);
		// }
		YnetYoutube.players[containerId].visibilityPrecentage = YnetYoutube.percentageSeen(document.querySelector("#"+containerId));
		if (YnetYoutube.players[containerId].visibilityPrecentage >= 50) {
			YnetYoutube.gaPushEvent(containerId, 'In-View');
		}
		YnetYoutube.gaPushEvent(containerId, 'Load');
		return this;
	},
	onYouTubeIframeAPIReady: function () {
		this.initPlayerVars();
		if (typeof this.playerInfoList === 'undefined') return;
		for (var i = 0; i < this.playerInfoList.length; i++) {
			if (i == 0 && typeof (ATFmnpltn) != "undefined") {
				this.playerInfoList[i].playerVars.autoplay = ATFmnpltn(this.playerInfoList[i]);
			}
			var curplayer = this.createPlayer(this.playerInfoList[i]);
			this.players[this.playerInfoList[i].id] = curplayer;
		}
	},
	onPlayerStateChange: function (event) {
		var containerId = event.target.f.id;
		var isPlay = 1 === event.data;
		var isPause = 2 === event.data;
		var isEnd = 0 === event.data;

		if (isPlay) {
			YnetYoutube.lastPlayedContainerId = containerId;
			document.getElementById(containerId).setAttribute('video_status','play');
			YnetYoutube.gaPushEvent(containerId, 'Play');
			YnetYoutube.YitVideoEventReport('play', {
				'playerType': 'youtube'
			});

			progressTimer = setInterval(function () {
				var percent = Math.round(
					(YnetYoutube.players[containerId].getCurrentTime() / YnetYoutube.players[containerId].duration) * 100);
				YnetYoutube.ReportProgress(percent, containerId, YnetYoutube.players[containerId]);
			}, 1000);


			if (!YnetYoutube.players[containerId].popularity) {

				var iframe = document.createElement('iframe');
				iframe.style.display = "none";
				iframe.src = 'https://mr-ynet-php-ext.ynet.co.il/popularity/popularity.php?id=' + containerId.split('_')[1]  +
				'&type=1&time=' + YnetYoutube.players[containerId].duration+ '&random=' + Math.random();
				document.body.appendChild(iframe);

				dataLayer.push({
					'event': 'youtube_event',
					'Category': 'YouTube Video',
					'Action': YnetYoutube.players[containerId].analyticsLabel,
					'Label': YnetYoutube.players[containerId].getVideoUrl()+' & Play'
				});
				YnetYoutube.players[containerId].popularity = true;
			}

			try{
				YnetYoutube.flaotingFirstFrame.featuredVideo.removeClass("is-paused");
				YnetYoutube.flaotingFirstFrame.featuredVideo.toggleClass("is-playing");
			}catch(e){}


			YnetYoutube.gaPushEvent(containerId, 'Play');
		}
		if (isPause) {
			YnetYoutube.gaPushEvent(containerId, 'Pause');
			document.getElementById(containerId).setAttribute('video_status','pause');
			YnetYoutube.YitVideoEventReport('pause', {
				'playerType': 'youtube'
			});
			try{
				YnetYoutube.flaotingFirstFrame.featuredVideo.removeClass("is-playing");
				YnetYoutube.flaotingFirstFrame.featuredVideo.toggleClass("is-paused");
			}catch(e){}

			clearTimeout(progressTimer);

		}
		if (isEnd) {
			try{
				YnetYoutube.flaotingFirstFrame.featuredVideo.removeClass("is-playing", "is-paused");
			}
			catch(e){}
			document.getElementById(containerId).setAttribute('video_status','pause');
			clearTimeout(progressTimer);
		}
		try{
			onPlayerStateChangeCallback(isPlay,isPause,isEnd,event);
		}catch(e){}
	},
	floatOnScroll: function (containerId) {
		// if (!YnetYoutube.flaotingFirstFrame.init && screen.width > YnetYoutube.flaotingFirstFrame.minScreenWidth) {
		// 	var $window = $(window);
		// 	var $featuredMedia = $(".video-wrap").first();
		// 	var $featuredVideo = $(".youtube-iframe").first();
		// 	var $CloseBtn = $('.close_youtube');
		// 	YnetYoutube.flaotingFirstFrame.featuredVideo = $featuredVideo;
		// 	YnetYoutube.flaotingFirstFrame.containerId = $(".youtube-iframe").first().attr('id');
		// 	var top = $featuredMedia.offset().top;
		// 	var offset = Math.floor(top + ($featuredMedia.outerHeight() / 2));
		// 	$window.on("resize", function () {
		// 		top = $featuredMedia.offset().top;
		// 		offset = Math.floor(top + ($featuredMedia.outerHeight() / 2));
		// 	}).on("scroll", function () {
		// 		if(YnetYoutube.flaotingFirstFrame.containerId == YnetYoutube.lastPlayedContainerId) {
		// 			$featuredVideo.toggleClass("is-sticky", $window.scrollTop() > offset && $featuredVideo.hasClass("is-playing"));
		// 			if (YnetYoutube.flaotingFirstFrame.featuredVideo.hasClass("is-sticky")) {
		// 				if (!YnetYoutube.floatClosed) {
		// 					$CloseBtn.addClass("show_close_btn");
		// 				}
		// 			} else {
		// 				$CloseBtn.removeClass("show_close_btn");
		// 			}
		// 		}
				
		// 	});
		// 	YnetYoutube.flaotingFirstFrame.init = true;
		// }
		// return this;
	},
	triggercloseFlaoting: function (player) {
		// $(".close_youtube").click(function () {
		// 	YnetYoutube.floatClosed = true;
		// 	$(this).removeClass('show_close_btn');
		// 	YnetYoutube.flaotingFirstFrame.featuredVideo.css({
		// 		'transform': 'none',
		// 		'position': 'inherit',
		// 		'transition': 'none'
		// 	});
		// 	player.pauseVideo();
		// });
	},
	gaPushEvent: function (containerId, action) {
		dataLayer.push({
			'event': 'youtube_event',
			'Category': 'YouTube Player Events',
			'Action': 'YouTube Player ' + action,
			'Label': YnetYoutube.players[containerId].analyticsLabel
		});
	},
	percentageSeen: function (div) {
		var windowHeight = window.innerHeight,
			docScroll = document.body.scrollTop,
			divPosition = div.offsetTop,
			divHeight = div.offsetHeight,
			hiddenBefore = docScroll - divPosition,
			hiddenAfter = (divPosition + divHeight) - (docScroll + windowHeight);

		if ((docScroll > divPosition + divHeight) || (divPosition > docScroll + windowHeight)) {
			return 0;
		} else {
			var result = 100;
			if (hiddenBefore > 0) {
				result -= (hiddenBefore * 100) / divHeight;
			}
			if (hiddenAfter > 0) {
				result -= (hiddenAfter * 100) / divHeight;
			}
			return Math.ceil(result);
		}
	},
	ReportProgress: function (percentage, containerId, player) {
		if (percentage > 0 && percentage <= 100) {
			if (percentage > 25 && percentage < 50 && !player.ga_25) {
				YnetYoutube.gaPushEvent(containerId, 'Quartiles 25%');
				YnetYoutube.YitVideoEventReport('progress', {
					'playerType': 'youtube',
					'percentageSeen': 'Quartiles 25%'
				});
				player.ga_25 = true;
			} else if (percentage > 50 && percentage < 75 && !player.ga_50) {
				YnetYoutube.gaPushEvent(containerId, 'Quartiles 50%');
				YnetYoutube.YitVideoEventReport('progress', {
					'playerType': 'youtube',
					'percentageSeen': 'Quartiles 50%'
				});
				player.ga_50 = true;
			} else if (percentage > 75 && percentage < 100 && !player.ga_75) {
				YnetYoutube.gaPushEvent(containerId, 'Quartiles 75%');
				YnetYoutube.YitVideoEventReport('progress', {
					'playerType': 'youtube',
					'percentageSeen': 'Quartiles 75%'
				});
				player.ga_75 = true;
			} else if (percentage == 100 && !player.ga_100) {
				YnetYoutube.gaPushEvent(containerId, 'Quartiles 100%');
				YnetYoutube.YitVideoEventReport('progress', {
					'playerType': 'youtube',
					'percentageSeen': 'Quartiles 100%'
				});
				player.ga_100 = true;
			} else {
				return false;
			}
		}
	},
	YoutubeFloatingOrFp: function () {
		if ($(YnetYoutube.fpContinerSelector).length == 0) {
			return true;
		}
		var youtubePosTop = $(".youtube-wrapper-iframe").first().offset().top;
		var fpPosTop = $(YnetYoutube.fpContinerSelector).first().offset().top;
		if (youtubePosTop < fpPosTop) {
			return true;
		}
		return false;
	}
};

try{
	window.onload = function() {
		YnetYoutube.onYouTubeIframeAPIReady();
	}
}catch(e) {

}


