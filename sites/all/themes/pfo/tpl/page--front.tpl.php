  <section id="page">

    <header class="clearfix page-container">
      <div class="container">
      <?php if ($main_menu): ?>
        <nav>
          <?php print theme('links__system_main_menu', array('links' => $main_menu, 'attributes' => array('id' => 'main-menu', 'class' => array('links', 'inline', 'clearfix')))); ?>
        </nav>
      <?php endif; ?>
      </div><!-- .container -->

      <hgroup>
        <h1 id="site-name">
          <a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>" rel="home" id="logo">Pressflow</a>
        </h1>

        <div class="stripe clearfix">
        <div class="container">
          <div class="intro">
            <h2>Go ahead. Scale.</h2>
            <p>Pressflow is a distribution of <a href="http://drupal.org">Drupal</a> with integrated performance, scalability, availability, and testing enhancements.</p>
          </div><!-- .intro -->

          <div class="download">
            <h2>download and install</h2>
            <?php print $download; ?>
            <p class="pf7">Looking for Pressflow 7?<br> Check the progress on <a href="https://github.com/pressflow/7">Github</a></p>
          </div><!-- .download -->
        </div><!-- .container -->
        </div><!-- .stripe -->
      </hgroup>

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
        <?php /* print render($page['content']); */ ?>

        <div id="wat">
          <section class="install">
            <h3>What is Pressflow?</h3>
            <p>Pressflow is a fully API-compatible distribution of Drupal that offers the following benefits over a standard Drupal installation:</p>
            <ul>
              <li>One</li>
              <li>Two</li>
              <li>Three</li>
            </ul>
          </section>

          <section class="compat">
            <h3>Get involved</h3>
            <p>Pressflow is an open source project, which means not only is it free for everyone to use, but if you have ideas for improvement, it's possible to get them included in the next release.</p>
            <p>Get started today by viewing the project on <a href="http://github.com/pressflow">Github</a></p>
          </section>

          <section class="support">
            <h3>Need Support?</h3>
            <ul>
              <li>Read the documentation on the <a href="http://pressflow.atlassian.org">Pressflow wiki</a>.</li>
              <li>File bugs and issues on <a href="https://github.com/pressflow">Github</a></li>
              <li>Post questions and answers at <a href="http://drupal.stackexchange.com/questions/tagged/pressflow">drupal.stackexchange.com</a></li>
            </ul>

          </section>
        </div><!-- #wat -->

        <?php print $feed_icons; ?>
      </div><!-- #content -->

      <?php if ($page['sidebar']): ?>
        <aside class="sidebar">
          <?php print render($page['sidebar']); ?>
        </aside><!-- .sidebar -->
      <?php endif; ?>

    </section><!-- #main -->

    <?php include('_footer.tpl.inc'); ?>

  </section><!-- #page -->
