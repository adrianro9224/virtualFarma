<h2>Productos relacionados</h2>
<div id="slick" data-slick='{"slidesToShow": 3, "slidesToScroll": <?= count($related_products)?>}'>
    <?php foreach ( $related_products as $product ): ?>
    <div class="slick-item-container">
        <h5><?= $product->name ?></h5>
        <a href="<?= base_url() . 'product/search_product/' . str_replace(' ', '_', $product->name )?>" class="btn btn-info btn-xs" role="button">Ver producto</a>
    </div>
    <?php endforeach; ?>
</div>
