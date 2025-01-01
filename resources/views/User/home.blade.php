@include('User.header')
<style>
  .move-box {
    position: relative;
    width: 80%; /* Adjust as needed */
    height: 40vh; /* Adjust as needed */
   /* border: 1px solid black;*/
    overflow: hidden; /* Prevents text from moving outside the box */
    margin: 20px auto; /* Center the box */
  }

  .text {
    position: absolute;
    left: 0;
    top: 0;
  }
</style>

<div class="move-box">
  <h1 class="text"><b><i>WELCOME</i></b></h1>
</div>

<script>
  $(document).ready(function(){
    function moveRight() {
      const distance = $(".move-box").width() * 0.6; // 80% of box width
      $(".text").animate({left: `+=${distance}`}, 2000, moveDown);
    }

    function moveDown() {
      const distance = $(".move-box").height() * 0.7; // 50% of box height
      $(".text").animate({top: `+=${distance}`}, 2000, moveLeft);
    }

    function moveLeft() {
      const distance = $(".move-box").width() * 0.6;
      $(".text").animate({left: `-=${distance}`}, 2000, moveUp);
    }

    function moveUp() {
      const distance = $(".move-box").height() * 0.7;
      $(".text").animate({top: `-=${distance}`}, 2000, moveRight);
    }

    moveRight(); // Start the loop
  });

  // Update dimensions on window resize
  $(window).resize(function(){
    $(".text").stop(); // Stop the current animation
    moveRight(); // Restart the animation with updated dimensions
  });
</script>

@include('User.footer')



