  <section id="page">

    <header class="clearfix page-container">

      <?php if ($main_menu): ?>
        <nav>
          <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'inline', 'clearfix')))); ?>
        </nav>
      <?php endif; ?>

      <?php if ($logo): ?>
        <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">
          <figure><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" /></figure>
        </a>
      <?php endif; ?>

      <?php if ($site_name || $site_slogan): ?>
        <hgroup id="name-and-slogan">
          <h1 id="site-name">
            <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home"><span><?php print $site_name; ?></a>
          </h1>

          <?php if ($site_slogan): ?>
            <h2><?php print $site_slogan; ?></h2>
          <?php endif; ?>
        </hgroup><!-- #name-and-slogan -->
      <?php endif; ?>

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
