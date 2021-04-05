<?php
/*
Template Name: Страница "Контакты"
Template Post Type: page
*/

get_header(); ?> 

<section class="section-dark">
  <div class="container">
      <!-- <?php the_title('<h1 class="page-title">', '</h1>', true);?> -->
      <h1 class="page-title">Свяжитесь с нами</h1>
      <div class="contacts-wrapper">
        <div class="left">
          <h2 class="contacts-title">Через эту форму обратной связи (html)</h2>

          <form action="form.php" class="contacts-form" method="POST">
            <input name="contact_name" type="text" class="input contacts-input" placeholder="Ваше имя">
            <input name="contact_email" type="email" class="input contacts-input" placeholder="Ваш Email">
            <textarea name="contact_comment" id="" class="textarea contacts-textarea" placeholder="Ваш вопрос"></textarea>
            <button type="submit" class="button more">Отправить</button>
          </form>
          <!-- /.конец формы HTML -->

          <h2 class="contacts-title">Или через эту форму обратной связи (CF7)</h2>
          <?php the_content( )?>
        </div>
        <!-- /.left -->
        <div class="right">
          <h2 class="contacts-title">Или по этим контактам</h2>
          <a href="mailto:world@forpeople.studio">world@forpeople.studio </a>
          <address>3522 I-75, Business Spur Sault Sainte Marie, MI, 49783</address>
          <a href="tel:+2 800 089 45-34">+2 800 089 45-34</a>
        </div>
        <!-- /.right -->
      </div>
      <!-- /.contacts-wrapper -->
  </div>
  <!-- /.container -->
</section>
<!-- /.section-dark -->
<?php get_footer();
