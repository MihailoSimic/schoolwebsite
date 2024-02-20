<html>
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Star Rating Form</title>
<style>
  .star {
    font-size: 24px;
    cursor: pointer;
    color: #ccc;
  }
  .filled {
    color: gold;
  }
</style>
</head>
<?php

$x=$_POST['idC'];

?>

</body>
<center>
<h2> Ocenjivanje </h2>
<form method='post' action='oceni.php' id="starForm">
<table>
<tr>
    <td>Komentar:</td>
    <td><input type="text" name="komentarucenik"></td>
    <input type='hidden' value='<?php echo $x ?>' name='idC'>
</tr>
<tr>
    <td>Ocena</td>
    <td>
    
    <input type="hidden" id="rating" name="ocenaucenik" value="0">
    <span class="star" onclick="setRating(1)">★</span>
    <span class="star" onclick="setRating(2)">★</span>
    <span class="star" onclick="setRating(3)">★</span>
    <span class="star" onclick="setRating(4)">★</span>
    <span class="star" onclick="setRating(5)">★</span>
    </td>
</tr>
<tr>
    <td><input type='submit' name='btn' value='Oceni'><td>
</tr>
</table>
<script>
function setRating(rating) {
  document.getElementById('rating').value = rating;
  const stars = document.querySelectorAll('#starForm .star');
  stars.forEach((star, index) => {
    if (index < rating) {
      star.classList.add('filled');
    } else {
      star.classList.remove('filled');
    }
  });
}
</script>
</center>
</body>

</html>