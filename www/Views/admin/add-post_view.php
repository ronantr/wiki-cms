<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <script src="https://cdn.tiny.cloud/1/eo59fq7w6j1puvdqjeu1rpwttfb7zmw1xt5pz6cxsykca6l9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>



  <script>
    tinymce.init({
      selector: 'textarea',
      width: 800,
      height: 500,
      menubar: '  ',
      toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | outdent indent',
      toolbar_mode: 'floating',
      tinycomments_mode: 'embedded',
      tinycomments_author: 'Author name',
    });
  </script>
</head>

<body>

  <h2>Nouveau POST</h2>

  <?php if (!empty($formErrors)) : ?>
    <?php foreach ($formErrors as $error) : ?>
      <li><?= $error; ?>
      <?php endforeach; ?>
    <?php endif; ?>
    <div class="flex-col">
      <?php App\Core\Form::showForm($form); ?>
    </div>
</body>