<?php
/*
  Templates render the content of your pages.

  They contain the markup together with some control structures
  like loops or if-statements. The `$page` variable always
  refers to the currently active page.

  To fetch the content from each field we call the field name as a
  method on the `$page` object, e.g. `$page->title()`.

  This note template renders a blog article. It uses the `$page->cover()`
  method from the `note.php` page model (/site/models/page.php)

  It also receives the `$tag` variable from its controller
  (/site/controllers/note.php) if a tag filter is activated.

  Snippets like the header and footer contain markup used in
  multiple templates. They also help to keep templates clean.

  More about templates: https://getkirby.com/docs/guide/templates/basics
*/
?>
<?php snippet('header') ?>

<?php if ($cover = $page->cover()): ?>
<a href="<?= $cover->url() ?>" data-lightbox class="img" style="--w:2; --h:1">
  <img src="<?= $cover->crop(1200, 600)->url() ?>" alt="<?= $cover->alt()->esc() ?>">
</a>
<?php endif ?>

<article class="note">
  <header class="note-header h1">
    <h1 class="note-title"><?= $page->title()->esc() ?></h1>
  </header>

  <div class="dates">
    <span class="start"><?= $page->start_date()->toDate('EEEE d MMMM') ?></span>
    <?php if ($page->start_time()->isNotEmpty()): ?>
      <span class="start"><?= $page->start_time()->toDate('HH:mm') ?></span>
    <?php endif ?>
    <?php if ($page->end_time()->isNotEmpty()): ?>
      - <span class="start"><?= $page->start_time()->toDate('HH:mm') ?></span>
    <?php endif ?>
  </div>

  <?php if ($page->location()->isNotEmpty()): ?>
    <div class="location">
      <div class="venue"><?= $page->location() ?></div>
    </div>
  <?php endif ?>

  <?php if ($page->description()->isNotEmpty()): ?>
    <div class="details"><?= $page->description() ?></div>
  <?php endif ?>

  <footer class="note-footer">
    <?php if (!empty($tags)): ?>
    <ul class="note-tags">
      <?php foreach ($tags as $tag): ?>
      <li>
        <a href="<?= $page->parent()->url(['params' => ['tag' => $tag]]) ?>"><?= esc($tag) ?></a>
      </li>
      <?php endforeach ?>
    </ul>
    <?php endif ?>
  </footer>

  <?php snippet('event_prevnext') ?>
</article>

<?php snippet('footer') ?>
