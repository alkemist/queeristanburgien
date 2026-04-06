<?php

/*
  Snippets are a great way to store code snippets for reuse
  or to keep your templates clean.

  The note snippet renders an excerpt of a blog article.

  More about snippets:
  https://getkirby.com/docs/guide/templates/snippets
*/
?>
<article class="note-excerpt">
  <a href="<?= $page->url() ?>">
    <header>
      <figure class="img" style="--w: 16; --h:9">
        <?php if ($cover = $page->cover()): ?>
          <img src="<?= $cover->crop(320, 180)->url() ?>" alt="<?= $cover->alt()->esc() ?>">
        <?php endif ?>
      </figure>

      <h2 class="note-excerpt-title"><?= $page->title()->esc() ?></h2>
      <div class="dates">
        <span class="start"><?= $page->start_date()->toDate('EEEE d MMMM') ?></span>
        <?php if ($page->start_time()->isNotEmpty()): ?>
          <span class="start"><?= $page->start_time()->toDate('HH:mm') ?></span>
        <?php endif ?>
        <?php if ($page->end_time()->isNotEmpty()): ?>
          - <span class="start"><?= $page->start_time()->toDate('HH:mm') ?></span>
        <?php endif ?>
      </div>
    </header>
    <?php if (($excerpt ?? true) !== false): ?>
      <div class="note-excerpt-text">
        <?= $page->text()->toBlocks()->excerpt(280) ?>
      </div>
    <?php endif ?>
  </a>
</article>
