<?php
//echo $actual_link = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'].'<br>';
//echo $_SERVER['REQUEST_URI'];
?>
<?php
if($_SERVER['REQUEST_URI'] == "/_tampernew/category/16/coffee/1")
{
?>
<div class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<ul>
					<li><a href="index.html">Home</a></li>
					<li><i class="fa fa-angle-right"></i></li>
					<li><a href="#">Products</a></li>
				</ul>
				<h2>Products</h2>
			</div>
		</div>
	</div>
</div>
<?php
}
if($_SERVER['REQUEST_URI'] == "/_tampernew/")
{
?>
<div id="layerslider" class="slider-home">
	<div class="ls-slide" data-ls="duration: 4000; transition2d: 5;">
		<img src="<?php echo SITE_URL ?>/mainimages/banner.jpg" class="ls-bg" alt="bg-slider">
		<!--<img src="<?php echo SITE_URL ?>/mainimages/Coffee-Beans-PNG.png" class="ls-layer" alt="slider-mask" data-ls="parallax:true;parallaxlevel:40;parallaxevent:cursor;" style="top: 0; left: 50%;">-->
		<h2 class="ls-l ls-hide-phone" style="top: 305px; left: 730px; font-size: 80px;" data-ls="offsetyin:100%;durationin:1500;delayin:100;clipin:0 0 100% 0;durationout:400;parallaxlevel:0;">Start The Day</h2>
		<h2 class="ls-l ls-hide-desktop ls-hide-tablet" style="top: 150px; left: 530px; font-size: 150px;" data-ls="offsetyin:100%;durationin:1500;delayin:100;clipin:0 0 100% 0;durationout:400;parallaxlevel:0;"> Start The Day</h2>
		<h3 class="ls-l test" style="top: 385px; left: 685px; font-size: 50px;" data-ls="offsetyin:-100%;durationin:1500;delayin:100;clipin:100% 0 0 0;durationout:400;parallaxlevel:0;">With a Great Taste.</h3>
		<a href="#" class="ls-l hover-bg-white hidden-xs hidden-sm" style="top: 475px; left: 855px; font-size: 12px; background-color: #d54343;padding: 10px 30px;color: #fff;text-transform: uppercase;" data-ls="offsetyin:-100%;durationin:1500;delayin:100;clipin:100% 0 0 0;durationout:400;parallaxlevel:0;"> Start Now for Free! </a>
	</div>
	<div class="ls-slide" data-ls="duration: 4000; transition2d: 5;">
		<img src="http://placehold.it/1980x810" class="ls-bg" alt="bg-slider2">
		<img src="http://placehold.it/780x1030" class="ls-layer" alt="slider-mask" data-ls="parallax:true;parallaxlevel:40;parallaxevent:cursor;" style="top: 0; left: 50%;">
	</div>
	<div class="ls-slide" data-ls="duration: 4000; transition2d: 5;">
		<img src="http://placehold.it/1980x810" class="ls-bg" alt="bg-slider2">

		<img src="images/one-test.png" class="ls-layer hidden-xs hidden-sm" alt="text-bg-slider" data-ls="parallax:true;parallaxlevel:20;parallaxevent:cursor;" style="top: 60%; left: 40%; z-index:9999;">

		<img src="images/test-two.png" class="ls-layer hidden-xs hidden-sm" alt="text-bg-slider" data-ls="parallax:true;parallaxlevel:20;parallaxevent:cursor;" style="top: 60%; left: 70%;">

		<img src="http://placehold.it/780x1030" class="ls-layer hidden-xs hidden-sm" alt="slider-mask" data-ls="parallax:true;parallaxlevel:40;parallaxevent:cursor;" style="top: 0; left: 50%;">
	</div>
</div>

<div class="container">
	<div class="row icon-text">
		<div class="col-md-4 col-sm-4 inside">
			<figure class="col-md-3">
				<img src="<?php echo SITE_URL ?>/mainimages/discount-system-icon.png" alt="discount-system-icon">
			</figure>
			<div class="text col-md-9">
				<h5> Loyalty<br>System </h5>
				<p>Each Tamper Me member receives exclusive discounts off their coffee.</p>
			</div><!--text-->
		</div>
		<div class="col-md-4 col-sm-4 inside">
			<figure class="col-md-3">
				<img src="<?php echo SITE_URL ?>/mainimages/satisfaction-icon.png" alt="discount-system-icon">
			</figure>
			<div class="text col-md-9">
				<h5>Quality Coffee<br>Accessories </h5>
				<p>Your complete range of coffee accessories</p>
			</div><!--text-->
		</div>
		<div class="col-md-4 col-sm-4 inside">
			<figure class="col-md-3">
				<img src="<?php echo SITE_URL ?>/mainimages/coupon.png" alt="discount-system-icon">
			</figure>
			<div class="text col-md-9">
				<h5>Student Get<br>20% Off</h5>
				<p>Lorem ipsum dolor adipiscing elit, sed tempor incididunt ut labore.</p>
			</div><!--text-->
		</div>
	</div>
</div>

<div class="heading text-center">
	<h4>Featured Items</h4>
	<p>Shop Our Range of Featured Items</p>
</div>
<?php
}
?>

<div class="container">
	<div class="front-container">
		<!--<?php echo $heading?>-->
		<div class="row">
			<!--
			<div class="col-md-2">
				<?php if(!empty($catlist)): ?>
					<div class="list-group">
				 		<a href="#" class="list-group-item active">Categories</a>
				    	<?php foreach($catlist as $k => $v): ?>
				    		<a href="<?php echo SITE_URL ?>/category/<?php echo $v['id'] ?>/<?php echo $v['link'] ; ?>" class="list-group-item">
				    			<?php echo $v['name'] ; ?>
				    		</a>
				    	<?php endforeach; ?>
				  	</div>
				<?php endif; ?>
				<?php echo (file_exists(INC_FOLDER . CACHE_FILE .'blog_latest.txt')) ? (file_get_contents(INC_FOLDER . CACHE_FILE .'blog_latest.txt')) : ('');?>
			</div>
			-->
			<div class="col-md-12 product_item">
				<?php
					if($_SERVER['REQUEST_URI'] == "/_tampernew/category/16/coffee/1")
					{
						echo $items;
					}
					else if($_SERVER['REQUEST_URI'] == "/_tampernew/")
					{
						echo $featured;
					}
				?>
			</div>
			<!--
			<div class="row">
			  	<div class="col-md-6 col-md-offset-3"><?php echo $pages['nav'] ?></div>
			</div>
			-->
		</div>
	</div>
</div>

<?php
if($_SERVER['REQUEST_URI'] == "/_tampernew/")
{
?>
<div class="anim-banner">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-sm-6 hidden-sm hidden-xs">
				<h1><img src="<?php echo SITE_URL ?>/mainimages/bacar.png" alt="back-girl"></h1>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="inside">
					<h5></h5>
					<h2>Discover what all the buzz is about!</h2>
					<h3>Our app will be available on any mobile device! Coming 2017!</h3>
					<div class="delivery">&nbsp;</div>
					<div class="row">
                    <div class="col-md-6 col-sm-6">
                    <h1 class="dwnld"><a href="#"><img src="<?php echo SITE_URL ?>/mainimages/download2.png" /></a></h1>
                    </div>
                    <div class="col-md-6 col-sm-6">
                    <h1 class="dwnld"><a href="#"><img src="<?php echo SITE_URL ?>/mainimages/download1.png" /></a></h1>
                    </div>
                    </div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="heading text-center">
		<h4>Partners</h4>
	</div>
	<div class="latest-blog">
		<div class="item">
			<img src="http://archtechitsols.com/_tampernew/images/logo.jpg">
		</div>
		<div class="item">
			<img src="http://archtechitsols.com/_tampernew/images/logo.jpg">
		</div>
		<div class="item">
			<img src="http://archtechitsols.com/_tampernew/images/logo.jpg">
		</div>
		<!--
		<div class="item">
			<article class="post-grid">
				<div class="picture">
					<a href="#"><img src="http://placehold.it/350x255" alt="blog"></a>
					<div class="post-categories">
						<a href="#">Fashion Advices</a>
					</div>
					<div class="blog-mask">
						<a href="#" class="btn read-more">Read more</a>
					</div>
				</div>
				<div class="blog-details">
					<div class="meta-post">
						<div class="post-date">November 29, 2017</div>
					</div>
					<h2><a href="#">learn how to design cool modern wesites!</a></h2>
					<p>Etiam nulla nunc, aliquet vel metus nec, scelerisque tempus enim. Sed eget blandit lectus. Donec facilisis ornare turpis id pretium scelerisque interdum.</p>
					<a href="#" class="post-comments"><i class="fa fa-comment-o" aria-hidden="true"></i>5 comments</a>
				</div>
			</article>
		</div>
		<div class="item">
			<article class="post-grid">
				<div class="picture">
					<a href="#"><img src="http://placehold.it/350x255" alt="blog"></a>
					<div class="post-categories">
						<a href="#">Fashion Advices</a>
					</div>
					<div class="blog-mask">
						<a href="#" class="btn read-more">Read more</a>
					</div>
				</div>
				<div class="blog-details">
					<div class="meta-post">
						<div class="post-date">November 29, 2017</div>
					</div>
					<h2><a href="#">learn how to design cool modern wesites!</a></h2>
					<p>Etiam nulla nunc, aliquet vel metus nec, scelerisque tempus enim. Sed eget blandit lectus. Donec facilisis ornare turpis id pretium scelerisque interdum.</p>
					<a href="#" class="post-comments"><i class="fa fa-comment-o" aria-hidden="true"></i>5 comments</a>
				</div>
			</article>
		</div>
		<div class="item">
			<article class="post-grid">
				<div class="picture">
					<a href="#"><img src="http://placehold.it/350x255" alt="blog"></a>
					<div class="post-categories">
						<a href="#">Fashion Advices</a>
					</div>
					<div class="blog-mask">
						<a href="#" class="btn read-more">Read more</a>
					</div>
				</div>
				<div class="blog-details">
					<div class="meta-post">
						<div class="post-date">November 29, 2017</div>
					</div>
					<h2><a href="#">learn how to design cool modern wesites!</a></h2>
					<p>Etiam nulla nunc, aliquet vel metus nec, scelerisque tempus enim. Sed eget blandit lectus. Donec facilisis ornare turpis id pretium scelerisque interdum.</p>
					<a href="#" class="post-comments"><i class="fa fa-comment-o" aria-hidden="true"></i>5 comments</a>
				</div>
			</article>
		</div>
		<div class="item">
			<article class="post-grid">
				<div class="picture">
					<a href="#"><img src="http://placehold.it/350x255" alt="blog"></a>
					<div class="post-categories">
						<a href="#">Fashion Advices</a>
					</div>
					<div class="blog-mask">
						<a href="#" class="btn read-more">Read more</a>
					</div>
				</div>
				<div class="blog-details">
					<div class="meta-post">
						<div class="post-date">November 29, 2017</div>
					</div>
					<h2><a href="#">learn how to design cool modern wesites!</a></h2>
					<p>Etiam nulla nunc, aliquet vel metus nec, scelerisque tempus enim. Sed eget blandit lectus. Donec facilisis ornare turpis id pretium scelerisque interdum.</p>
					<a href="#" class="post-comments"><i class="fa fa-comment-o" aria-hidden="true"></i>5 comments</a>
				</div>
			</article>
		</div>
		-->
	</div>

	<div class="prefooter">
		<div class="row">
			<div class="col-md-9">
				<div class="testimonials type-2">
	
					<div class="owl-testimonials text-center">
                
                    
						<div class="item text-center">
							<blockquote>Tamper Me has helped gain traffic into my coffee shop. The loyalty program is a great program, I encourage all cafe's to enquire about joining.</blockquote>
							
						</div><!--item-->
						<div class="item text-center">
							<blockquote>Great customer service! My order arrived prior to the initial notified date.</blockquote>
							
						</div><!--item-->
						<div class="item text-center">
							<blockquote>Extremely Reliable, Great Products - As a coffee shop owner I need equipment desperately and fast, Tamper me were able to bring me a Tamper on the same day!</blockquote>
							
						</div><!--item-->
					</div><!--owl-testimonials-->
				</div>
			</div>
			<div class="col-md-3">
				<div class="newsletter">
					<h3>Join the Database!</h3>
					<p>You can be always up to date with our company news!</p>
					<form>
						<input type="email" name="EMAIL" placeholder="Your email address">
						<input type="submit" value="Sign up">
					</form>
					<p>*Don’t worry, we won’t spam our customers mailboxes</p>
				</div><!--newsletter-->
			</div>
		</div>
	</div>
</div>
<?php
}
?>
