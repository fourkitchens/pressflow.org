  <section id="page">

    <header class="clearfix page-container">

      <?php if ($main_menu): ?>
        <nav>
          <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'inline', 'clearfix')))); ?>
        </nav>
      <?php endif; ?>

      <hgroup id="name-and-slogan">
        <h1 id="site-name">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">Pressflow</a>
        </h1>

        <div class="intro">
          <h2>Go ahead. Scale.</h2>
          <p>Pressflow is a distribution of <a href="http://drupal.org">Drupal</a> with integrated performance, scalability, availability, and testing enhancements.</p>
        </div><!-- .intro -->

        <div class="download">
          <h2>download and install</h2>
          <?php print $download; ?>
          <p class="pf7">Looking for Pressflow 7? You can check the progress on <a href="https://github.com/pressflow/7">Github</a></p>
        </div>
      </hgroup><!-- #name-and-slogan -->

      <?php print render($page['header']); ?>

    </header>

    <?php print $messages; ?>

    <section id="main" class="clearfix page-container">

      <div id="content">
        <?php if ($page['highlighted']): ?><div id="highlighted"><?php print render($page['highlighted']); ?></div><?php endif; ?>
        <a id="main-content"></a>
        <?php print render($title_prefix); ?>
        <?php if ($title): ?><h1 class="title" id="page-title"><?php print $title; ?></h1><?php endif; ?>
        <?php print render($title_suffix); ?>
        <?php if ($tabs): ?><div class="tabs"><?php print render($tabs); ?></div><?php endif; ?>
        <?php print render($page['help']); ?>
        <?php if ($action_links): ?><ul class="action-links"><?php print render($action_links); ?></ul><?php endif; ?>
        <?php print render($page['content']); ?>
        <?php print $feed_icons; ?>
      </div><!-- #content -->

      <?php if ($page['sidebar']): ?>
        <aside class="sidebar">
          <?php print render($page['sidebar']); ?>
        </aside><!-- .sidebar -->
      <?php endif; ?>

    </section><!-- #main -->

    <footer class="section">
      <?php print render($page['footer']); ?>
    </footer>

  </section><!-- #page -->
