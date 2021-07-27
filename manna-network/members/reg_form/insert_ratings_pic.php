<? 
//// insert ratings pic
$PeerOverallpic="";
$PeerOverallvotecount="";
$PeerOverallvotecount = $peer_vote_count;
If($peer_rating == '0'){
$PeerOverallpic = "Not Rated By Its Peers Yet";
}
else
{
//$peer_rating = round($peer_rating/$PeerOverallvotecount);

$PeerOverallpic = "<img src=\"http://bungeebones.com/images/$peer_rating star.jpg\" alt=\"rated $peer_rating star\">";
}
$PublicOverallpic="";
$PublicOverallvotecount = $public_vote_count;
If($avg_public_rating == '0'){
$PublicOverallpic = "Not Rated By The Public Yet";
}
else
{
$avg_public_rating = round($avg_public_rating/$PublicOverallvotecount);

$PublicOverallpic = "<img src=\"http://bungeebones.com/images/$avg_public_rating star.jpg\" alt=\"rated $avg_public_rating star\">";
}
//// end rtings pic


 ?>
