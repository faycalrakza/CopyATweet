<?php
// code made by Fayçal

/////////////////////////// CONFIGURATION /////////////////////////////

// add your Twitter Developer credits
$APIkey="";
$APIsecretKey="";
$AccesToken="";
$AccesTokenSecret="";

// add Twitter name (@) of the account you want to copy tweets
$victim="";

// add your Twitter name (@)
$me="";

///////////////////////////////////////////////////////////////////


require "autoload.php";
use Abraham\TwitterOAuth\TwitterOAuth;


function getVictimsLastTweet(){
  global $APIkey;
  global $APIsecretKey;
  global $AccesToken;
  global $AccesTokenSecret;
  global $victim;
  global $me;
  $twitter = new TwitterOAuth($APIkey, $APIsecretKey, $AccesToken, $AccesTokenSecret);
  $tweets = $twitter->get("search/tweets", ["count" => 1, "q" => "from:".$victim." -RT", "result_type" => "recent", "exclude_replies" => true]);
  foreach ($tweets as $tweet) {
    foreach ($tweet as $text) {
      return $text->text;
    }
  }
}


function main(){
  global $APIkey;
  global $APIsecretKey;
  global $AccesToken;
  global $AccesTokenSecret;
  $twitter = new TwitterOAuth($APIkey,$APIsecretKey,$AccesToken,$AccesTokenSecret);
  $victimsLastTweet=getVictimsLastTweet();
  $twitter->post("statuses/update", ["status" => $victimsLastTweet]);
}

main();
?>
