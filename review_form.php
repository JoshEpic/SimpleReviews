
<h2>Reviews</h2>

<?php  
  require('reviews.php'); 
  $reviews = new Reviews();
  $get_reviews = $reviews->getReviews($post_id);
  while($row = mysql_fetch_array($get_reviews)) :
?>
  <div class="row">
    <div class="col-md-8">
      <div class="name"><strong>Name:</strong> <a href="<?php echo $row['website']; ?>"><?php echo $row['name']; ?></a></div>
      <div class="rating"><strong>Rating:</strong> <?php echo $row['rating']; ?></div>
      <div class="review"><strong>Review:</strong></div>
      <p><?php echo $row['review']; ?></p>
    </div>
  </div>
<?php 
  endwhile;
?>

<h2>Submit Review</h2>
<div id="response"></div>

<form class="form-horizontal" action="" name="review" id="review" role="form">
	<input type="hidden" name="post_id" value="<?php echo $post_id; ?>" />
  <div class="form-group">
    <label for="name" class="col-sm-2 control-label">Name</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" id="name" placeholder="Name">
    </div>
  </div>
  <div class="form-group">
    <label for="email" class="col-sm-2 control-label">Email</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="email" name="email" placeholder="Email">
    </div>
  </div>
  <div class="form-group">
    <label for="website" class="col-sm-2 control-label">Website</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="website" name="website" placeholder="Website">
    </div>
  </div>
  <div class="form-group">
    <label for="rating" class="col-sm-2 control-label">Rating</label>
    <div class="col-sm-10">
      <select name="rating" class="form-control">
		  <option>1</option>
		  <option>2</option>
		  <option>3</option>
		  <option>4</option>
		  <option>5</option>
	  </select>

    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
      <textarea class="form-control" name="review" id="email" placeholder="Review..."></textarea>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10 col-sm-offset-2">
	  	<input id="num1" class="sum" type="text" name="num1" value="<?php echo rand(1,4) ?>" readonly="readonly" /> +
		<input id="num2" class="sum" type="text" name="num2" value="<?php echo rand(5,9) ?>" readonly="readonly" /> =
		<input id="captcha" class="captcha" type="text" name="captcha" maxlength="2" /><br />
		<span id="spambot">(Are you human, or spambot?)</span>
  	</div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" id="submit" data-loading-text="Loading..." class="btn btn-default">Submit</button>
    </div>
  </div>
</form>

<script type="text/javascript">
      $("#submit").click(function() {
        var btn = $(this);
      btn.button('loading...');
      if (parseInt($('#num1').val()) + parseInt($('#num2').val()) == parseInt($('#captcha').val())) {
          var url = "new_review.php"; // the script where you handle the form input.
          $.ajax({
                 type: "POST",
                 url: url,
                 data: $("#review").serialize(), // serializes the form's elements.
                 success: function(data)
                 {
                     $('#response').empty();
                     $('#response').append(data); // show response from the php script.
                     window.location.reload(); 
                 }
               });
        } else {
          $('#response').append('The Math Problem is incorrect.');
          btn.button('reset');
        }

      return false; // avoid to execute the actual submit of the form.
  });
 </script>
