# Citadine---Jade-HS

Website function: video trimmer

Library used is FFMpeg, experimented with Laragon (Apache server emulator, similar to XAMPP) in Windows 10. Main function code is written in PHP.

Requirements?
1.	The user can choose a section of a video and then download it
2.	Runs on server
3.	In English (and multi language?)
4.	Easy to use

FFMpeg video trim command:
ffmpeg -ss starttime -i inputfilepath -t duration -c copy -map 0 outputfilepath

written in PHP:
$command = "ffmpeg -ss " . $cut_from . " -i http://trim-a-video-citavi.test/input.mp4 -t " . $duration . " -c copy -map 0 " . $rename . ".mp4 2>&1";
    
echo shell_exec($command);

2>&1 
is required (more info on https://superuser.com/questions/404344/ffmpeg-works-on-terminal-not-with-php-exec)

-ss ... -i ... -t ...
It is important to write the arguments in that order to avoid audio sync problem (more info https://github.com/mifi/lossless-cut/pull/13) 

echo shell_exec($command);
echo: display the answer from FFMpeg on the website, for development purposes only.

The input variables are $cut_from, $duration and $rename. See line 8-10 (declaration of variable) and 43-56 (input form).


18.03.2020 

Requirements?
1.	Timestamp (video start at...)
HTML5 video player supports media fragment 
(more info https://aaronparecki.com/2017/02/19/4/day-61-media-fragments)

<video width="500" height="320" id="video" controls> 
<source src="http://trim-a-video-citavi.test/input.mp4#t=10,20" type="video/mp4">
                    Your browser does not support the video tag.
                    </video>
                </div>

#t= [start time],[pause time]


You can also write it on the url of the media
http://trim-a-video-citavi.test/input.mp4#t=23
the new page will only consist of the video, and it will be played starting from second 23.

Aaron’s javascript code (see link above) enables this timestamp on any url that contain video or audio
This screenshot has the url of http://trim-a-video-citavi.test/split%20sync%20problem%20rename%202%20mediafragment.php#t=23

With this help we can put buttons to “jump” to specific timestamp
<input type="button" value="go to introduction 00:23" class="btn btn-primary" onclick="window.location.href = '/split sync problem rename 2 mediafragment.php#t=23';">
When this button is clicked, the url will change to the one with the desired timestamp (here is sec 23)
