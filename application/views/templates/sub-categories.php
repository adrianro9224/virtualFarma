<div class="well well-sm">
    <h2>Sub-categorias</h2>
    <div class="btn-group">
        <?php foreach( $subcategories as $subcategory ):?>
            <a class="btn btn-warning" href="<?= base_url() . "product/show_products_by_sub_category_id/" . lcfirst(str_replace(' ', '_', $subcategory->name)) . '/' . $subcategory->id?>" role="button"><?= $subcategory->name?></a>
        <?php endforeach;?>
    </div>
</div>