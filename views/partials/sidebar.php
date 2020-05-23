<?php
    use yii\helpers\Url;
?>

<div class="col-md-4" data-sticky_column>
    <div class="primary-sidebar">
        <div class="row">
            <div class="col-md-10" style="margin-bottom: 20px">
                <form method="post" action="/site/search" class="form-horizontal">
                    <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken() ?>" />

                    <input type="submit" name="search" value="Search" class="btn btn-default pull-right" />

                    <input type="text" name="search_value" class="form-control pull-right" style="width: 60%; margin-right: 10px">
                </form>
            </div>
        </div>

        <aside class="widget">
            <h3 class="widget-title text-uppercase text-center">Popular Posts</h3>

            <?php foreach ($popular as $post): ?>
                <div class="popular-post">
                    <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]) ?>" class="popular-img">
                        <img src="<?= $post->getImage() ?>" alt="">

                        <div class="p-overlay"></div>
                    </a>

                    <div class="p-content">
                        <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]) ?>" class="text-uppercase">
                            <?= $post->title ?>
                        </a>

                        <span class="p-date"><?= $post->getDate() ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </aside>
        <aside class="widget pos-padding">
            <h3 class="widget-title text-uppercase text-center">Recent Posts</h3>

            <?php foreach ($recent as $post): ?>
                <div class="thumb-latest-posts">
                    <div class="media">
                        <div class="media-left">
                            <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]) ?>" class="popular-img">
                                <img src="<?= $post->getImage() ?>" alt="">

                                <div class="p-overlay"></div>
                            </a>
                        </div>
                        <div class="p-content">
                            <a href="<?= Url::toRoute(['site/view', 'id' => $post->id]) ?>" class="text-uppercase">
                                <?= $post->title ?>
                            </a>

                            <span class="p-date">
                                <?= $post->getDate() ?>
                            </span>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </aside>
        <aside class="widget border pos-padding">
            <h3 class="widget-title text-uppercase text-center">Categories</h3>
            <ul>
                <?php foreach ($categories as $category): ?>
                    <li>
                        <a href="<?= Url::toRoute(['site/category', 'id' => $category->id]) ?>">
                            <?= $category->title ?>
                        </a>
                        <span class="post-count pull-right">(<?= $category->getArticlesCount() ?>)</span>
                    </li>
                <? endforeach; ?>
            </ul>
        </aside>
    </div>
</div>
