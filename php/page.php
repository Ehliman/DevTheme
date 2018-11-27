
<main id="content" class="container" role="main">
	<div class="row">
		<div class="col-lg-10 col-xl-8 mr-auto ml-auto">
			<?php Theme::plugins('pageBegin'); ?>
			<article class="post-wrap <?php echo $page->sticky() ? 'featured':''; ?>">
				<?php if($login->isLogged()) if($canEdit = checkRole(array('admin', 'editor'))):?>
				<a href="<?php echo HTML_PATH_ADMIN_ROOT.'edit-content/'.$page->slug() ?>" class="article-edit" target="_blank">
					<span>Edit</span>
					<i class="icon-arrow-right"></i>
				</a>
				<?php endif; ?>
				<h1 class="post-title">
					<?php echo $page->title(); ?>
				</h1>
				<div class="post-meta">
					<time datetime="<?php echo $page->dateRaw('c') ?>">
						<?php echo $page->date() ?>
					</time>
					<?php if ($page->category()):?>
					<span class="tags">
						<a href="<?php echo DOMAIN_CATEGORIES.$page->categoryKey() ?>" rel="tag">
							<?php echo $page->category() ?>
						</a>
					</span>					
					<?php endif?>
					<span class="read-later" data-toggle="tooltip" data-placement="top" data-id="<?php echo $page->slug() ?>" data-title="<?php echo $page->title() ?>" data-original-title="Read Later">
						<i></i>
					</span>
					<div class="inner">
						<?php include(THEME_DIR_PHP.'parts/socialshare.php');  ?>
					</div>
				</div>
				<?php if ($page->coverImage()): ?>
				<figure class="feature-image">
					<img src="<?php echo $helper->cdn_that_image ($page->coverImage(),1000) ?>" alt="<?php echo $page->title() ?>" />
				</figure>
				<?php endif ?>
				<div class="editor-content">
					<?php echo $page->content(); ?>
				</div>
				<div class="post-meta">
					<?php if ($page->tags()):?>
					<span class="tags">
						<?php
							  $tags = $page->tags(true);
							  foreach($tags as $tagKey=>$tagName) :?>
						<a href="<?php echo DOMAIN_TAGS.$tagKey ?>" rel="tag">
							<?php echo $tagName ?>
						</a>

						<?php endforeach ?>
					</span>
					<?php endif?>
					<div class="inner">
						<?php include(THEME_DIR_PHP.'parts/socialshare.php');  ?>
					</div>
				</div>
				<?php if($page->user(firstName) && $page->user(lastName)):
						  $fullName = $page->user(firstName) .' '.$page->user(lastName);?>
				<div class="authors">
					<section class="intro">
						<div class="intro-meta">
							<?php if($page->user(profilePicture)): ?>
							<figure class="intro-image">
								<img src="<?php echo $helper->cdn_that_image($page->user(profilePicture),100)?>?v1" alt="<?php echo $fullName?>" />
							</figure>
							<?php endif;?>
							<div class="inner">
								<h4>
									<strong>
										<?php echo $fullName?>
									</strong>
								</h4>
								<ul class="social">
									<?php if ($page->user(twitter)) : ?>
									<li class="nav-item">
										<a class="twitter" href="<?php echo $page->user(twitter) ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" data-original-title="Twitter" rel="nofollow noreferrer">
											<i class="icon-twitter" aria-hidden="true"></i>
										</a>
									</li>
									<?php endif ?>
									<?php if ($page->user(facebook)) : ?>
									<li class="nav-item">
										<a class="facebook" href="<?php echo $page->user(facebook) ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" data-original-title="Facebook" rel="nofollow noreferrer">
											<i class="icon-facebook" aria-hidden="true"></i>
										</a>
									</li>
									<?php endif ?>
									<?php if ($page->user(github)) : ?>
									<li class="nav-item">
										<a class="github" href="<?php echo $page->user(github) ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" data-original-title="GitHub" rel="nofollow noreferrer">
											<i class="icon-github" aria-hidden="true"></i>
										</a>
									</li>
									<?php endif ?>
									<?php if ($page->user(gitlab)) : ?>
									<li class="nav-item">
										<a class="gitlab" href="<?php echo $page->user(gitlab) ?>" target="_blank" data-toggle="tooltip" data-placement="bottom" data-original-title="GitLab" rel="nofollow noreferrer">
											<i class="icon-gitlab" aria-hidden="true"></i>
										</a>
									</li>
									<?php endif ?>
								</ul>
							</div>
						</div>
					</section>
				</div>
				<?php endif;?>
			</article>
			<?php
            $prevKey = $helper->previousKey();
            $nextKey = $helper->nextKey();
            if( $prevKey || $nextKey):
            ?>
			<?php if($prevKey):
					  $prevPage = new Page($prevKey);	?>
			<a href="<?php echo  $prevPage->permalink() ?>" rel="prev" class="btn prev-post">
				<i class="icon-arrow-left"></i>
				<span>
					<?php echo  $prevPage->title() ?>
				</span>
			</a>
			<?php endif;?>
			<?php if($nextKey):
					  $nextPage =  new Page($nextKey);?>
			<a href="<?php echo $nextPage->permalink() ?>" rel="next" class="btn next-post">
				<span>
					<?php echo $nextPage->title() ?>
				</span>
				<i class="icon-arrow-right"></i>
			</a>
			<?php endif;?>
			<?php endif;?>
			<?php
			$related = $helper->getRelated(2);
			if($related):?>
			<div class="related-posts">
				<h3 class="title">
					<?php echo $L->get('Related posts'); ?>
				</h3>
				<div class="loop">
					<?php foreach($related as $relpage): ?>
					<article class="post item">
						<div class="post-inner-content">
							<p>
								<a href="<?php echo $relpage->permalink() ?>" class="post-title" title="<?php echo $relpage->title() ?>">
									<strong>
										<?php echo $relpage->title() ?>
									</strong>
								</a>
							</p>
						</div>
						<div class="post-meta">
							<time datetime="<?php echo $relpage->dateRaw('c') ?>">
								<?php echo $relpage->date() ?>
							</time>
							<span class="tags">
								<a href="<?php echo DOMAIN_CATEGORIES.$relpage->categoryKey() ?>" rel="tag">
									<?php echo $relpage->category() ?>
								</a>
							</span>
							<div class="inner">
								<a href="https://twitter.com/share?text=<?php echo $relpage->title() ?>&amp;url=<?php echo $relpage->permalink() ?>" class="twitter" onclick="window.open(this.href, 'share-twitter', 'width=550,height=235');return false;"
									data-toggle="tooltip" data-placement="top" title="" data-original-title="Share on Twitter">
									<i class="icon-twitter"></i>
								</a>
								<a href="#" class="read-later" data-toggle="tooltip" data-placement="top" data-id="<?php echo $relpage->slug() ?>" data-title="<?php echo $relpage->title() ?>" data-original-title="Read Later">
									<i class="icon-bookmark"></i>
								</a>
							</div>
						</div>
					</article>
					<?php endforeach;?>
				</div>
			</div>
			<?php endif; ?>
			<div class="page-end">
				<?php Theme::plugins('pageEnd'); ?>
			</div>
		</div>
	</div>
</main>
