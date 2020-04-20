<!-- PHP -->

<?php

if (isset($_POST["submit"]))
{
	
	$cut_from = $_POST["cut_from"];
	$duration = $_POST["duration"];
	$rename = $_POST["name"];

    
	$command = "ffmpeg -ss " . $cut_from . " -i http://trim-a-video-citavi.test/input.mp4 -t " . $duration . " -c copy -map 0 " . $rename . ".mp4 2>&1";
	
	echo shell_exec($command);
	
	//header("Location: /url/to/the/other/page");
    //exit;
}
?>

<!-- HTML and CSS-->

<link rel="stylesheet" href="bootstrap-darkly.min.css">

<header>
    <h1 style="text-align: center;">Citadine Video Split</h1>
  </header>

<div class="container" style="margin-top: 2%;">
	<div class="row">
		<div class="offset-md-4 col-md-4">
			<form method="POST" enctype="multipart/form-data">
				<div class="form-group">
					<label>[Video Title here]</label>
					
					<video width="500" height="320" id="video" controls> 
					<source src="http://trim-a-video-citavi.test/input.mp4" type="video/mp4">
					Your browser does not support the video tag.
					</video>
				</div>

                <input type="button" value="go to introduction 00:23" class="btn btn-primary" onclick="window.location.href = '/split sync problem rename 2 mediafragment.php#t=23';">


				<div class="form-group">
					<label>Cut from</label>
					<input type="text" name="cut_from" class="form-control" placeholder="00:00:00">
				</div>

				<div class="form-group">
					<label>Duration</label>
					<input type="text" name="duration" class="form-control" placeholder="00:00:00">
				</div>

				<div class="form-group">
					<label>Rename File</label>
					<input type="text" name="name" class="form-control" placeholder="Write the name here">
				</div>

				<input type="submit" name="submit" class="btn btn-primary" value="Split">

			</form>
		</div>
	</div>
</div>

<script>

// var firstlink = document.getElementByTagName('a')[0];
//firstlink.addEventListener("click", function (event) {
//    event.preventDefault();
//    myvideo.currentTime = 7;
//    myvideo.play();
//}, false);

function cloneMediaFragment() {
  // Check that the fragment is a Media Fragment (starts with t=)
  if(window.location.hash && window.location.hash.match(/^#t=/)) {
    // Find any video and audio tags on the page
    document.querySelectorAll("video,audio").forEach(function(el){
      // Create a virtual element to use as a URI parser
      var parser = document.createElement('a');
      parser.href = el.currentSrc;
      // Replace the hash 
      parser.hash = window.location.hash;
      // Set the src of the video/audio tag to the full URL
      el.src = parser.href;
    });
  }
}

document.addEventListener("DOMContentLoaded", function() {
  cloneMediaFragment();
  // When the media is paused, update the fragment of the page
  document.querySelectorAll("video,audio").forEach(function(el) { 
    el.addEventListener("pause", function(event) {
      // Update the media fragment to the current time
      // Use replaceState to avoid triggering the "hashchange" listener above
      history.replaceState(null, null, "#t=" + Math.round(event.target.currentTime));
    });
  });
});

// If the user changes the hash manually, clone the fragment to the media URLs
window.addEventListener("hashchange", cloneMediaFragment);
</script>
