<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

      <script src='https://cdn.tiny.cloud/1/eo59fq7w6j1puvdqjeu1rpwttfb7zmw1xt5pz6cxsykca6l9/tinymce/5/tinymce.min.js' referrerpolicy="origin">

  <script type="text/javascript">

  tinymce.init({
    selector: '#Textarea',
    width: 600,
    height: 300,
    plugins: [
      'advlist autolink link image lists charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
      'table emoticons template paste help'
    ],
    toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
      'bullist numlist outdent indent | link image | print preview media fullpage | ' +
      'forecolor backcolor emoticons | help',
    menu: {
      favs: {title: 'My Favorites', items: 'code visualaid | searchreplace | emoticons'}
    },
    menubar: 'favs file edit view insert format tools table help',
    content_css: 'css/content.css'
  });
  </script>
</head>


<!--  <body>
  <h1>Nouveau POST</h1>
<form method="post">
            <label name="post_title" for="post_title">Post titre</label>
            <input type="text" name="post_title" id="post_title"><br>                   
            <label name="post_content" for="post_title">Post Content</label>
            <textarea id="mytextarea" name="mytextarea"></textarea>
            <br><br>            
            <input type="submit"  name="submit" value="CREATE POST">
        </form>

  </body>
</html> --->

<h2>Nouveau POST</h2>

<?php if(!empty($formErrors)):?>
	<?php foreach($formErrors as $error):?>
		<li><?= $error ;?>
	<?php endforeach;?>
<?php endif;?>

<?php  App\Core\Form::showForm($form); ?>