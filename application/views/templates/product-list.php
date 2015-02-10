<?php foreach ( $products_by_category_id as $product ): ?>
	<div class="product-product">
		<div class="row">
			<div class="col-lg-3 col-md-4 col-xs-5">
	        	<img src="<?= base_url() . 'assets/images/products/' . $product->uri_img . $product->image_format_id ?>" class="img-responsive" alt="">
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
	                	    	<span class="old-price"><?= $product->old_price ?></span>
	                	    	<span class="new-price"><?= $product->new_price ?></span>
	                	    <?php else: ?>
	                	    	<span class="new-price"><?= $product->price ?></span>
	                	    <?php endif; ?>
						</div>
						<div class="stock-dropdown pull-left">
							<?php if( isset($product->stock) ): ?>
								<select name="<?="product-" . $product->id . "-cant"?>">
		                	    	<?php for ($i=1 ; $i <= $product->stock ; $i++):?>
		                	    		<option value="<?= $i?>"><?= $i?></option>
		                	    	<?php endfor;?>
			                	</select>
			                <?php else:?>
								<span class="label label-info">Out of stock</span>			                
			                <?php endif;?>	
	                	</div>
						<div class="pull-right">
	                		<button class="btn btn-danger btn-sm addtocart">Add to Cart</button>
	                    	<a href="productdetail.html" class="btn btn-primary btn-sm hidden-xs">More info</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php endforeach;?>
