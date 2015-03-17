<?php foreach ( $products_by_category_id as $product ): ?>
	<div class="product-product">
		<div class="row">
			<div class="col-lg-3 col-md-4 col-xs-5">
	        	<img src="<?= base_url() . 'assets/images/products/' . $product->uri_img . $product->image_format_id ?>" class="img-responsive" alt=":D">
			</div>
			<div class="col-lg-9 col-md-8 col-xs-7">
	        	<div class="product-body">
					<div class="product-tags">
						<?php if( isset($product->stock) ):?>
	                		<span class="label label-info">Stock</span>
	                	<?php endif;?>
	                    <span class="label label-danger">New</span>
					</div>
	                <h3><a href="#"><?= $product->name ?></a></h3>
	                <p><?= $product->description ?></p>
	                <div class="clearfix">
	                	<div class="product-price pull-left">
	                		<?php if( $product->has_discount ): ?>
	                	    	<span class="old-price" ng-bind="<?= $product->old_price ?> | currency : '$' : 0"></span>
	                	    	<span class="new-price" ng-bind="<?= $product->new_price ?> | currency : '$' : 0"></span>
	                	    <?php else: ?>
	                	    	<span class="new-price" ng-bind="<?= $product->price ?> | currency : '$' : 0"></span>
	                	    <?php endif; ?>
						</div>
						<div class="stock-dropdown pull-left">
							<?php if( isset($product->stock) ): ?>
								<a id="decrease" ng-click="<?='product' . $product->id . 'cant = product' . $product->id . 'cant - 1'?>"><i class="fa fa-minus fa-lg"></i></a>
								<input type="number" name="<?='product-' . $product->id . '-cant'?>" ng-model="<?='product' . $product->id . 'cant'?>" ng-init="<?='product' . $product->id . 'cant=1'?>">
								<a id="increase" ng-click="<?='product' . $product->id . 'cant = product' . $product->id . 'cant + 1'?>"><i class="fa fa-plus fa-lg"></i></a>
			                <?php else:?>
								<span class="label label-info">Out of stock</span>			                
			                <?php endif;?>	
	                	</div>
						<div class="pull-right">
	                		<a class="btn btn-danger btn-sm addtocart <?= ( isset($product->stock) ) ? '' : "disabled"?>" ng-click="addToShoppingCart('<?= $product->id?>', '<?= $product->name?>', '<?= $product->PLU ?>', '<?= $product->barcode?>', '<?= $product->category_id?>', '<?= $product->presentation?>', product<?= $product->id?>cant, '<?= ($product->has_discount) ? $product->new_price : $product->price ;?>', '<?= ($product->has_discount) ? $product->discount : 0 ;?>', '<?= ( isset($product->tax) ) ? $product->tax : 0 ;?>')">Add to Cart</a>
	                    	<a href="productdetail.html" class="btn btn-primary btn-sm hidden-xs">More info</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach;?>
